# 🌐 Guides de Déploiement par Hébergeur

## 📋 Hébergeurs Recommandés pour SOTUMA

### 🥇 **Recommandations par Type**
- **Débutant:** Hostinger, 1&1 IONOS
- **Professionnel:** OVH, DigitalOcean
- **Entreprise:** AWS, Google Cloud

---

## 🇹🇳 Hébergeurs Tunisiens

### **1. TopNet Hosting**
```bash
# Configuration recommandée
PHP: 8.1+
MySQL: 5.7+
SSL: Let's Encrypt inclus
```

**Instructions spécifiques:**
1. Upload via FTP dans `/public_html/`
2. Créer la base MySQL via cPanel
3. Configurer `.env` avec les paramètres fournis
4. Exécuter les migrations via SSH (si disponible)

### **2. Orange Business**
```bash
# Spécificités
Document Root: /var/www/html/
PHP Config: Via .htaccess
Database: MySQL 8.0
```

---

## 🌍 Hébergeurs Internationaux

### **1. Hostinger (Recommandé Débutant)**

#### **Plan Recommandé:** Business ou Premium

#### **Étapes de Déploiement:**
```bash
# 1. Via File Manager Hostinger
- Upload du ZIP dans public_html/
- Extraire les fichiers
- Déplacer le contenu du dossier public/ vers public_html/
- Déplacer le reste dans un dossier sotuma/
```

#### **Configuration .htaccess:**
```apache
# Dans public_html/.htaccess
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ sotuma/public/$1 [L]
</IfModule>
```

#### **Base de Données:**
```sql
-- Via phpMyAdmin Hostinger
CREATE DATABASE u123456789_sotuma;
```

### **2. OVH (Recommandé Professionnel)**

#### **Plan Recommandé:** Pro ou Performance

#### **SSH Deployment:**
```bash
# Connexion SSH
ssh username@ssh.cluster0XX.hosting.ovh.net

# Cloner le projet
cd www
git clone https://github.com/rokhsario/sotuma.git
cd sotuma

# Installation
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan storage:link
```

#### **Configuration Domaine:**
```
Document Root: /homez.XXX/username/www/sotuma/public
```

### **3. DigitalOcean (VPS)**

#### **Droplet Recommandé:** 2GB RAM, Ubuntu 22.04

#### **Installation Complète:**
```bash
# 1. Connexion au serveur
ssh root@your-server-ip

# 2. Installation LAMP
apt update && apt upgrade -y
apt install apache2 mysql-server php8.1 php8.1-mysql php8.1-mbstring php8.1-xml php8.1-gd php8.1-curl php8.1-zip -y

# 3. Configuration MySQL
mysql_secure_installation

# 4. Déploiement
cd /var/www
git clone https://github.com/rokhsario/sotuma.git
cd sotuma
composer install --no-dev --optimize-autoloader

# 5. Configuration Apache
cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/sotuma.conf
nano /etc/apache2/sites-available/sotuma.conf
```

**VirtualHost Configuration:**
```apache
<VirtualHost *:80>
    ServerName votre-domaine.com
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
# Activer le site
a2ensite sotuma.conf
a2enmod rewrite
systemctl reload apache2

# Permissions
chown -R www-data:www-data /var/www/sotuma
chmod -R 755 /var/www/sotuma
chmod -R 775 /var/www/sotuma/storage
```

### **4. AWS EC2**

#### **Instance Recommandée:** t3.micro (Free Tier)

#### **User Data Script:**
```bash
#!/bin/bash
yum update -y
yum install -y httpd php php-mysql php-mbstring php-xml php-gd php-curl php-zip
systemctl start httpd
systemctl enable httpd

# Installation de Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Clonage du projet
cd /var/www/html
git clone https://github.com/rokhsario/sotuma.git
cd sotuma
composer install --no-dev --optimize-autoloader

# Permissions
chown -R apache:apache /var/www/html/sotuma
chmod -R 755 /var/www/html/sotuma
```

---

## 📱 Déploiement Mobile/App

### **PWA Configuration**
```javascript
// public/sw.js - Service Worker pour PWA
const CACHE_NAME = 'sotuma-v1';
const urlsToCache = [
  '/',
  '/css/app.css',
  '/js/app.js',
  '/images/logo.png'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});
```

### **Manifest.json Optimisé**
```json
{
  "name": "SOTUMA - Menuiserie Aluminium",
  "short_name": "SOTUMA",
  "description": "Catalogue produits et projets SOTUMA",
  "start_url": "/",
  "display": "standalone",
  "theme_color": "#1a73e8",
  "background_color": "#ffffff",
  "icons": [
    {
      "src": "/images/icon-192.png",
      "sizes": "192x192",
      "type": "image/png"
    },
    {
      "src": "/images/icon-512.png",
      "sizes": "512x512",
      "type": "image/png"
    }
  ]
}
```

---

## 🔧 Configurations Spéciales

### **Hébergement Partagé sans SSH**

#### **Via File Manager uniquement:**
```bash
# 1. Préparer localement
composer install --no-dev --optimize-autoloader
npm run production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 2. Créer l'archive
zip -r sotuma-ready.zip . -x "node_modules/*" ".git/*"

# 3. Upload et extraction via File Manager
```

#### **Script PHP pour migrations:**
```php
<?php
// migrate.php - À exécuter une seule fois via navigateur
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Exécuter les migrations
$kernel->call('migrate', ['--force' => true]);
$kernel->call('storage:link');

echo "Migration terminée !";
// Supprimer ce fichier après utilisation
?>
```

### **Configuration pour CDN**

#### **CloudFlare Setup:**
```php
// config/filesystems.php - Configuration pour CDN
'cloudflare' => [
    'driver' => 's3',
    'key' => env('CLOUDFLARE_R2_ACCESS_KEY'),
    'secret' => env('CLOUDFLARE_R2_SECRET_KEY'),
    'region' => 'auto',
    'bucket' => env('CLOUDFLARE_R2_BUCKET'),
    'endpoint' => env('CLOUDFLARE_R2_ENDPOINT'),
],
```

---

## 📊 Monitoring et Performance

### **Google Analytics Setup**
```html
<!-- Dans resources/views/layouts/master.blade.php -->
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'GA_MEASUREMENT_ID');
</script>
```

### **Performance Monitoring**
```php
// app/Http/Middleware/PerformanceMonitor.php
public function handle($request, Closure $next)
{
    $startTime = microtime(true);
    
    $response = $next($request);
    
    $endTime = microtime(true);
    $duration = round(($endTime - $startTime) * 1000, 2);
    
    // Log des requêtes lentes (> 1000ms)
    if ($duration > 1000) {
        Log::warning("Slow request: {$request->url()} took {$duration}ms");
    }
    
    return $response;
}
```

---

## 🚨 Checklist Final

### **Avant de Mettre en Ligne:**
- [ ] Tests complets en local
- [ ] Base de données migrée
- [ ] Images uploadées
- [ ] SSL configuré
- [ ] Domaine pointé
- [ ] Emails fonctionnels
- [ ] Analytics configurés
- [ ] Sauvegardes planifiées

### **Après Mise en Ligne:**
- [ ] Test de tous les formulaires
- [ ] Vérification mobile
- [ ] Test de performance
- [ ] Monitoring activé
- [ ] Documentation équipe
- [ ] Formation client

---

**💡 Conseil:** Commencez toujours par un sous-domaine de test avant de déployer sur le domaine principal !

**📞 Support:** En cas de problème, consultez d'abord les logs Laravel dans `storage/logs/laravel.log`
