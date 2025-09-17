# 🚀 Guide de Déploiement SOTUMA - Complet

## 📋 Table des Matières
1. [Prérequis Serveur](#prérequis-serveur)
2. [Préparation du Déploiement](#préparation-du-déploiement)
3. [Déploiement sur Hébergement Partagé](#hébergement-partagé)
4. [Déploiement sur VPS/Serveur Dédié](#vpsserveur-dédié)
5. [Configuration de Production](#configuration-de-production)
6. [Tests Post-Déploiement](#tests-post-déploiement)
7. [Maintenance et Mises à Jour](#maintenance-et-mises-à-jour)
8. [Dépannage](#dépannage)

---

## 🖥️ Prérequis Serveur

### **Configuration Minimale Requise:**
- **PHP:** 8.1 ou supérieur
- **Base de données:** MySQL 5.7+ ou MariaDB 10.3+
- **Mémoire:** 512MB minimum, 1GB recommandé
- **Espace disque:** 500MB minimum
- **SSL:** Certificat SSL recommandé

### **Extensions PHP Requises:**
```bash
# Extensions obligatoires
php-bcmath, php-ctype, php-json, php-mbstring
php-openssl, php-pdo, php-tokenizer, php-xml
php-curl, php-gd, php-zip, php-mysql
```

### **Configuration Apache/Nginx:**
- **Apache:** mod_rewrite activé
- **Nginx:** Configuration PHP-FPM
- **Permissions:** Accès en écriture sur storage/ et bootstrap/cache/

---

## 🛠️ Préparation du Déploiement

### **1. Optimisation Locale (Avant Upload)**
```bash
# Dans votre environnement local
cd C:\laragon\www\SOTUMA

# Installer les dépendances de production
composer install --optimize-autoloader --no-dev

# Compiler les assets
npm run production

# Optimiser Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Créer une archive propre
zip -r sotuma-production.zip . -x "node_modules/*" ".git/*" "storage/logs/*"
```

### **2. Fichiers à Exclure du Déploiement:**
```
.env (à créer sur le serveur)
.git/
node_modules/
storage/logs/*
.DS_Store
Thumbs.db
```

---

## 🌐 Hébergement Partagé

### **Étape 1: Upload des Fichiers**
```bash
# Structure recommandée sur l'hébergement partagé
/public_html/
├── sotuma/          # Dossier principal de l'application
└── public/          # Contenu du dossier public de Laravel
```

### **Étape 2: Configuration .htaccess**
Créer `/public_html/.htaccess` :
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### **Étape 3: Configuration de l'Environnement**
Créer `/public_html/sotuma/.env` :
```env
APP_NAME=SOTUMA
APP_ENV=production
APP_KEY=base64:VOTRE_CLE_GENEREE
APP_DEBUG=false
APP_URL=https://votre-domaine.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=votre_base_de_donnees
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### **Étape 4: Base de Données**
```bash
# Via phpMyAdmin ou ligne de commande
mysql -u username -p
CREATE DATABASE sotuma CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Import de la base (si vous avez un dump)
mysql -u username -p sotuma < database_export.sql
```

### **Étape 5: Commandes de Déploiement**
```bash
# Se connecter en SSH (si disponible) ou via le gestionnaire de fichiers
cd /path/to/sotuma

# Générer la clé d'application
php artisan key:generate

# Exécuter les migrations
php artisan migrate --force

# Créer le lien de stockage
php artisan storage:link

# Optimiser pour la production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🖥️ VPS/Serveur Dédié

### **Installation Complète sur Ubuntu 22.04**

#### **1. Mise à Jour du Système**
```bash
sudo apt update && sudo apt upgrade -y
```

#### **2. Installation LAMP Stack**
```bash
# Apache
sudo apt install apache2 -y

# MySQL
sudo apt install mysql-server -y
sudo mysql_secure_installation

# PHP 8.1
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.1 php8.1-fpm php8.1-mysql php8.1-mbstring php8.1-xml php8.1-gd php8.1-curl php8.1-zip php8.1-bcmath php8.1-json php8.1-tokenizer -y
```

#### **3. Configuration Apache**
```bash
# Créer le VirtualHost
sudo nano /etc/apache2/sites-available/sotuma.conf
```

Contenu du fichier :
```apache
<VirtualHost *:80>
    ServerName votre-domaine.com
    ServerAlias www.votre-domaine.com
    DocumentRoot /var/www/sotuma/public
    
    <Directory /var/www/sotuma/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/sotuma_error.log
    CustomLog ${APACHE_LOG_DIR}/sotuma_access.log combined
</VirtualHost>
```

```bash
# Activer le site et les modules
sudo a2ensite sotuma.conf
sudo a2enmod rewrite
sudo systemctl reload apache2
```

#### **4. Installation de Composer**
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

#### **5. Déploiement de l'Application**
```bash
# Cloner le repository
cd /var/www
sudo git clone https://github.com/rokhsario/sotuma.git
cd sotuma

# Installer les dépendances
sudo composer install --optimize-autoloader --no-dev

# Configuration des permissions
sudo chown -R www-data:www-data /var/www/sotuma
sudo chmod -R 755 /var/www/sotuma
sudo chmod -R 775 /var/www/sotuma/storage
sudo chmod -R 775 /var/www/sotuma/bootstrap/cache
```

#### **6. Configuration SSL (Let's Encrypt)**
```bash
sudo apt install certbot python3-certbot-apache -y
sudo certbot --apache -d votre-domaine.com -d www.votre-domaine.com
```

---

## ⚙️ Configuration de Production

### **1. Optimisations Laravel**
```bash
# Cache de configuration
php artisan config:cache

# Cache des routes
php artisan route:cache

# Cache des vues
php artisan view:cache

# Optimisation de l'autoloader
composer dump-autoload --optimize
```

### **2. Configuration de la Base de Données**
```sql
-- Créer la base de données
CREATE DATABASE sotuma CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Créer un utilisateur dédié
CREATE USER 'sotuma_user'@'localhost' IDENTIFIED BY 'mot_de_passe_securise';
GRANT ALL PRIVILEGES ON sotuma.* TO 'sotuma_user'@'localhost';
FLUSH PRIVILEGES;
```

### **3. Migration et Seeding**
```bash
# Exécuter les migrations
php artisan migrate --force

# Seeder la base de données (si nécessaire)
php artisan db:seed --force
```

### **4. Configuration du Stockage**
```bash
# Créer le lien symbolique
php artisan storage:link

# Vérifier les permissions
ls -la public/storage
```

---

## ✅ Tests Post-Déploiement

### **Checklist de Vérification:**
- [ ] **Page d'accueil** se charge correctement
- [ ] **Catalogue produits** fonctionne
- [ ] **Galerie projets** s'affiche
- [ ] **Panneau d'administration** accessible
- [ ] **Upload d'images** fonctionne
- [ ] **Changement de langue** opérationnel
- [ ] **Formulaire de contact** envoie les emails
- [ ] **Certificats SSL** valides
- [ ] **Performance** acceptable (< 3 secondes)

### **Tests de Performance:**
```bash
# Test de charge basique
curl -o /dev/null -s -w "%{time_total}\n" https://votre-domaine.com

# Vérification des logs
tail -f storage/logs/laravel.log
```

---

## 🔄 Maintenance et Mises à Jour

### **Processus de Mise à Jour:**
```bash
# 1. Sauvegarde
mysqldump -u username -p sotuma > backup_$(date +%Y%m%d).sql
tar -czf backup_files_$(date +%Y%m%d).tar.gz /var/www/sotuma

# 2. Mise à jour du code
cd /var/www/sotuma
git pull origin main

# 3. Mise à jour des dépendances
composer install --no-dev --optimize-autoloader

# 4. Migrations
php artisan migrate --force

# 5. Optimisations
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### **Surveillance:**
```bash
# Monitoring des logs
tail -f /var/log/apache2/sotuma_error.log
tail -f storage/logs/laravel.log

# Espace disque
df -h

# Utilisation mémoire
free -m
```

---

## 🚨 Dépannage

### **Erreur 500 - Internal Server Error**
```bash
# Vérifier les logs
tail -50 storage/logs/laravel.log
tail -50 /var/log/apache2/error.log

# Vérifier les permissions
sudo chmod -R 775 storage/
sudo chmod -R 775 bootstrap/cache/

# Vider les caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### **Images ne s'affichent pas**
```bash
# Recréer le lien symbolique
rm public/storage
php artisan storage:link

# Vérifier les permissions
sudo chmod -R 755 storage/app/public/
```

### **Base de données inaccessible**
```bash
# Tester la connexion
mysql -u username -p -h localhost sotuma

# Vérifier la configuration .env
php artisan config:show database
```

### **Performance lente**
```bash
# Optimiser MySQL
sudo mysql_secure_installation

# Activer la compression Apache
sudo a2enmod deflate
sudo systemctl reload apache2

# Optimiser PHP
sudo nano /etc/php/8.1/apache2/php.ini
# Augmenter memory_limit = 256M
# Activer opcache
```

---

## 📞 Support et Contact

### **En cas de problème:**
1. **Consultez les logs** : `storage/logs/laravel.log`
2. **Vérifiez la configuration** : `.env` et permissions
3. **Testez en local** avant de déployer
4. **Contactez l'hébergeur** pour les problèmes serveur

### **Ressources Utiles:**
- 📚 [Documentation Laravel](https://laravel.com/docs)
- 🛠️ [Laravel Forge](https://forge.laravel.com) - Déploiement automatisé
- 📊 [Laravel Telescope](https://laravel.com/docs/telescope) - Debugging

---

**✅ Votre projet SOTUMA est maintenant prêt pour la production !**

> **Note:** Gardez toujours une sauvegarde récente avant toute mise à jour ou modification en production.
