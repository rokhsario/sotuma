[![github-follow](https://img.shields.io/github/followers/rokhsario?label=Follow&logoColor=purple&style=social)](https://github.com/rokhsario)
[![GitHub stars](https://img.shields.io/github/stars/rokhsario/sotuma.svg?style=social)](https://github.com/rokhsario/sotuma/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/rokhsario/sotuma.svg)](https://github.com/rokhsario/sotuma/network)
[![license](https://img.shields.io/badge/License-MIT-brightgreen.svg)](https://choosealicense.com/licenses/mit/)

# 🏗️ SOTUMA - Système de Catalogue en Ligne Laravel 10
**SOTUMA** est une plateforme de catalogue moderne développée avec **Laravel 10** pour une entreprise spécialisée en menuiserie aluminium depuis 2014. Le système présente les produits, projets, et services avec un design moderne et une interface d'administration complète.

---

## 🏢 À Propos de SOTUMA
**SOTUMA** est une entreprise tunisienne fondée en 2014, spécialisée dans la fabrication et l'installation de menuiserie aluminium. Avec plus de 10 ans d'expérience, nous proposons des solutions techniques personnalisées pour tous types de projets : résidentiels, commerciaux et industriels.

---

## 🌟 Fonctionnalités

### 🔹 **Interface Utilisateur (Frontend)**
- 🎨 **Design moderne et responsive**
- 🌍 **Support multilingue (Français, Anglais, Arabe)**
- 🏗️ **Catalogue de produits aluminium**
- 📸 **Galerie de projets réalisés**
- 📜 **Présentation des certificats**
- 📱 **Compatible mobile et tablette**
- 🔍 **URLs SEO-friendly**

### 🔹 **Panneau d'Administration**
- 🎛️ **Gestion des utilisateurs et rôles**
- 📊 **Tableau de bord analytique**
- 🛍️ **Gestion des produits et catégories**
- 🏗️ **Gestion des projets**
- 📨 **Système de messagerie intégré**
- 📰 **Gestion du blog/actualités**
- 📸 **Gestionnaire de médias**
- 🏆 **Gestion des certificats**

### 🔹 **Fonctionnalités Techniques**
- 🔧 **Architecture MVC Laravel 10**
- 🗄️ **Base de données MySQL optimisée**
- 📁 **Gestion avancée des fichiers**
- 🌐 **Système de traduction intégré**
- 📈 **Suivi des visiteurs et analytics**

---

## 🛠️ Guide d'Installation

### 🔹 **Étape 1: Cloner le Repository**
```bash
git clone https://github.com/rokhsario/sotuma.git
cd sotuma
```

### 🔹 **Étape 2: Installer les Dépendances**
```bash
composer install
npm install
npm run build
```

### 🔹 **Étape 3: Configuration de l'Environnement**
```bash
cp .env.example .env
php artisan key:generate
```
Mettez à jour le fichier `.env` avec vos informations de base de données :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sotuma
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 🔹 **Étape 4: Configuration de la Base de Données**
```bash
# Créer la base de données
mysql -u root -p -e "CREATE DATABASE sotuma CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Exécuter les migrations et seeders
php artisan migrate --seed
```

### 🔹 **Étape 5: Configuration du Stockage**
```bash
php artisan storage:link
```

### 🔹 **Étape 6: Lancer l'Application**
```bash
php artisan serve
```
🔗 Ouvrir `http://localhost:8000`

### **Identifiants d'Administration:**
📧 **Email:** `admin@gmail.com`  
🔑 **Mot de passe:** `1111`

---

## 🏗️ Domaines d'Expertise SOTUMA

### **Nos Spécialités:**
✅ **Fenêtres et portes aluminium**
✅ **Façades vitrées et murs-rideaux**
✅ **Garde-corps et rampes**
✅ **Cloisons et verrières**
✅ **Vérandas et pergolas**
✅ **Volets roulants**

### **Nos Secteurs d'Intervention:**
🏠 **Résidentiel** - Villas, appartements, maisons individuelles
🏢 **Commercial** - Bureaux, magasins, showrooms
🏭 **Industriel** - Usines, entrepôts, bâtiments techniques

---

## 📊 Données du Système

### **Contenu Actuel:**
- 📦 **35 Produits** organisés en 9 catégories
- 🏗️ **25 Projets** réalisés avec galeries photos
- 📰 **11 Articles** de blog/actualités
- 🏆 **2 Certificats** de qualité
- 👥 **2 Utilisateurs** (Admin + Co-admin)

### **Performance:**
- ⚡ **Temps de requête:** 17.13ms (excellent)
- 💾 **Utilisation mémoire:** 19.48MB (optimisé)
- 🌐 **Support multilingue:** 3 langues (FR, EN, AR)
- 📱 **Responsive:** Compatible tous appareils

---

## 🛠️ Technologies Utilisées

### **Backend:**
- 🔧 **Laravel 10** - Framework PHP
- 🗄️ **MySQL** - Base de données
- 📁 **Laravel File Manager** - Gestion des médias
- 📄 **DomPDF** - Génération de PDF
- 🌐 **Laravel Socialite** - Authentification sociale

### **Frontend:**
- 🎨 **Bootstrap 5** - Framework CSS
- ⚡ **jQuery** - JavaScript
- 📱 **Responsive Design** - Mobile-first
- 🌍 **Multi-langue** - Système de traduction Laravel

### **Outils de Développement:**
- 🔍 **Laravel Pint** - Code styling
- 🧪 **PHPUnit** - Tests unitaires
- 📦 **Composer** - Gestionnaire de dépendances PHP
- 📦 **NPM** - Gestionnaire de dépendances JS

---

## 📞 Contact SOTUMA

### **Informations de Contact:**
🏢 **Entreprise:** SOTUMA - Menuiserie Aluminium  
📍 **Adresse:** Tunisie  
📧 **Email:** contact@sotuma.tn  
📱 **Téléphone:** +216 XX XXX XXX  

### **Services:**
- 💼 **Devis gratuit** pour tous vos projets
- 🔧 **Installation professionnelle**
- 🛠️ **Maintenance et SAV**
- 📐 **Conception sur mesure**

---

## 📜 Licence
🔹 Ce projet est sous **licence MIT** – Libre d'utilisation et de modification !

⭐ **Si ce projet vous aide, n'hésitez pas à lui donner une étoile !** ⭐

---

## 👨‍💻 Développeur
Développé par **@rokhsario** avec ❤️ pour SOTUMA

