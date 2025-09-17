#!/bin/bash

# 🚀 Script de Déploiement Automatique SOTUMA
# Usage: ./deploy.sh [environment]
# Environments: shared, vps, local

set -e

# Configuration
PROJECT_NAME="SOTUMA"
REPO_URL="https://github.com/rokhsario/sotuma.git"
ENVIRONMENT=${1:-shared}

# Couleurs pour l'affichage
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Fonctions utilitaires
print_step() {
    echo -e "${BLUE}📋 $1${NC}"
}

print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

# Vérification des prérequis
check_requirements() {
    print_step "Vérification des prérequis..."
    
    # PHP
    if ! command -v php &> /dev/null; then
        print_error "PHP n'est pas installé"
        exit 1
    fi
    
    # Composer
    if ! command -v composer &> /dev/null; then
        print_error "Composer n'est pas installé"
        exit 1
    fi
    
    # MySQL
    if ! command -v mysql &> /dev/null; then
        print_warning "MySQL client n'est pas installé"
    fi
    
    print_success "Prérequis vérifiés"
}

# Installation des dépendances
install_dependencies() {
    print_step "Installation des dépendances..."
    
    if [ "$ENVIRONMENT" = "local" ]; then
        composer install
    else
        composer install --no-dev --optimize-autoloader
    fi
    
    if command -v npm &> /dev/null; then
        npm install
        if [ "$ENVIRONMENT" != "local" ]; then
            npm run production
        fi
    else
        print_warning "NPM n'est pas installé - assets non compilés"
    fi
    
    print_success "Dépendances installées"
}

# Configuration de l'environnement
setup_environment() {
    print_step "Configuration de l'environnement..."
    
    if [ ! -f .env ]; then
        if [ -f .env.example ]; then
            cp .env.example .env
            print_success "Fichier .env créé à partir de .env.example"
        else
            print_error "Fichier .env.example introuvable"
            exit 1
        fi
    fi
    
    # Génération de la clé d'application
    php artisan key:generate --force
    
    # Configuration selon l'environnement
    case $ENVIRONMENT in
        "shared")
            sed -i 's/APP_ENV=local/APP_ENV=production/' .env
            sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env
            ;;
        "vps")
            sed -i 's/APP_ENV=local/APP_ENV=production/' .env
            sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env
            ;;
        "local")
            sed -i 's/APP_ENV=production/APP_ENV=local/' .env
            sed -i 's/APP_DEBUG=false/APP_DEBUG=true/' .env
            ;;
    esac
    
    print_success "Environnement configuré pour: $ENVIRONMENT"
}

# Configuration de la base de données
setup_database() {
    print_step "Configuration de la base de données..."
    
    # Demander les informations de base de données
    echo -e "${YELLOW}Configuration de la base de données:${NC}"
    read -p "Host de la base de données (localhost): " DB_HOST
    DB_HOST=${DB_HOST:-localhost}
    
    read -p "Nom de la base de données (sotuma): " DB_DATABASE
    DB_DATABASE=${DB_DATABASE:-sotuma}
    
    read -p "Nom d'utilisateur: " DB_USERNAME
    read -s -p "Mot de passe: " DB_PASSWORD
    echo
    
    # Mise à jour du fichier .env
    sed -i "s/DB_HOST=.*/DB_HOST=$DB_HOST/" .env
    sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/" .env
    sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" .env
    sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env
    
    # Test de connexion
    if php artisan migrate:status &> /dev/null; then
        print_success "Connexion à la base de données établie"
    else
        print_error "Impossible de se connecter à la base de données"
        print_warning "Vérifiez vos paramètres dans le fichier .env"
        exit 1
    fi
}

# Migration de la base de données
migrate_database() {
    print_step "Migration de la base de données..."
    
    if [ "$ENVIRONMENT" = "local" ]; then
        php artisan migrate
    else
        php artisan migrate --force
    fi
    
    # Demander si on veut seeder
    read -p "Voulez-vous seeder la base de données ? (y/N): " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        if [ "$ENVIRONMENT" = "local" ]; then
            php artisan db:seed
        else
            php artisan db:seed --force
        fi
        print_success "Base de données seedée"
    fi
    
    print_success "Migration terminée"
}

# Configuration du stockage
setup_storage() {
    print_step "Configuration du stockage..."
    
    # Créer le lien symbolique
    php artisan storage:link
    
    # Définir les permissions appropriées
    if [ "$ENVIRONMENT" != "local" ]; then
        chmod -R 755 storage/
        chmod -R 755 bootstrap/cache/
        
        # Si on est root, changer le propriétaire
        if [ "$EUID" -eq 0 ]; then
            chown -R www-data:www-data storage/
            chown -R www-data:www-data bootstrap/cache/
        fi
    fi
    
    print_success "Stockage configuré"
}

# Optimisation pour la production
optimize_for_production() {
    if [ "$ENVIRONMENT" != "local" ]; then
        print_step "Optimisation pour la production..."
        
        php artisan config:cache
        php artisan route:cache
        php artisan view:cache
        
        print_success "Application optimisée"
    fi
}

# Tests post-déploiement
run_tests() {
    print_step "Tests post-déploiement..."
    
    # Test de base - vérifier que l'application démarre
    if php artisan --version &> /dev/null; then
        print_success "Laravel fonctionne correctement"
    else
        print_error "Problème avec Laravel"
        exit 1
    fi
    
    # Test de la base de données
    if php artisan migrate:status &> /dev/null; then
        print_success "Base de données accessible"
    else
        print_error "Problème avec la base de données"
    fi
    
    # Test du stockage
    if [ -L public/storage ]; then
        print_success "Lien de stockage créé"
    else
        print_warning "Lien de stockage manquant"
    fi
}

# Affichage des informations finales
show_final_info() {
    print_success "🎉 Déploiement terminé avec succès !"
    echo
    echo -e "${BLUE}📋 Informations importantes:${NC}"
    echo -e "• Environnement: ${YELLOW}$ENVIRONMENT${NC}"
    echo -e "• URL locale: ${YELLOW}http://localhost:8000${NC}"
    echo -e "• Admin: ${YELLOW}admin@gmail.com${NC} / ${YELLOW}1111${NC}"
    echo
    echo -e "${BLUE}🚀 Pour démarrer l'application:${NC}"
    echo -e "  ${YELLOW}php artisan serve${NC}"
    echo
    echo -e "${BLUE}📁 Fichiers importants:${NC}"
    echo -e "  • Configuration: ${YELLOW}.env${NC}"
    echo -e "  • Logs: ${YELLOW}storage/logs/laravel.log${NC}"
    echo
    if [ "$ENVIRONMENT" != "local" ]; then
        echo -e "${YELLOW}⚠️  N'oubliez pas de:${NC}"
        echo -e "  • Configurer votre domaine"
        echo -e "  • Installer un certificat SSL"
        echo -e "  • Configurer les sauvegardes"
    fi
}

# Script principal
main() {
    echo -e "${GREEN}🚀 Déploiement de $PROJECT_NAME${NC}"
    echo -e "Environnement: ${YELLOW}$ENVIRONMENT${NC}"
    echo "=================================="
    
    check_requirements
    install_dependencies
    setup_environment
    setup_database
    migrate_database
    setup_storage
    optimize_for_production
    run_tests
    show_final_info
}

# Gestion des erreurs
trap 'print_error "Erreur lors du déploiement"; exit 1' ERR

# Exécution du script principal
main "$@"
