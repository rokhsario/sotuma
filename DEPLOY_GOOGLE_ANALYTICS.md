# 🚀 Guide de Déploiement Google Analytics

## ❌ Problème Actuel

Google Analytics indique : **29 pages sur 30 sans balise**

Cela signifie que les fichiers modifiés ne sont **pas encore déployés en production** sur `sotuma.net`.

---

## ✅ Solution : Déployer les Fichiers Modifiés

### 📁 Fichiers à Déployer

Les fichiers suivants contiennent le code Google Analytics et doivent être déployés :

1. **`config/services.php`** (IDs configurés)
2. **`resources/views/frontend/layouts/head.blade.php`** (Code Google Analytics)
3. **`resources/views/frontend/layouts/master.blade.php`** (Google Tag Manager noscript)
4. **`resources/views/errors/404.blade.php`** (Code pour la page 404)

---

## 🔄 Méthodes de Déploiement

### Méthode 1 : Git (Recommandé)

**1. En local, commit les changements :**
```bash
git add config/services.php
git add resources/views/frontend/layouts/head.blade.php
git add resources/views/frontend/layouts/master.blade.php
git add resources/views/errors/404.blade.php

git commit -m "Add Google Analytics tracking code (G-J8C3Z5FSDB) and Google Tag Manager (GTM-KK8KT37D)"
git push origin main
```

**2. Sur le serveur de production :**
```bash
# Se connecter au serveur
ssh user@sotuma.net

# Aller dans le dossier du projet
cd /chemin/vers/sotuma

# Récupérer les changements
git pull origin main

# Vider tous les caches
php artisan optimize:clear
php artisan config:clear
php artisan view:clear
php artisan cache:clear

# Recompiler les caches
php artisan config:cache
php artisan view:cache

# Vérifier que les permissions sont correctes
chmod -R 755 storage bootstrap/cache
```

### Méthode 2 : FTP/SFTP

**1. Connectez-vous au serveur via FTP :**
- Hôte : `sotuma.net` (ou IP du serveur)
- Utilisateur : votre nom d'utilisateur FTP
- Mot de passe : votre mot de passe FTP

**2. Uploadez ces fichiers :**

```
config/services.php
  → Remplacez sur le serveur

resources/views/frontend/layouts/head.blade.php
  → Remplacez sur le serveur

resources/views/frontend/layouts/master.blade.php
  → Remplacez sur le serveur

resources/views/errors/404.blade.php
  → Remplacez sur le serveur
```

**3. Sur le serveur (via SSH), videz les caches :**
```bash
php artisan optimize:clear
php artisan config:cache
php artisan view:cache
```

### Méthode 3 : cPanel / Plesk

**1. Connectez-vous à votre cPanel/Plesk**

**2. Utilisez le gestionnaire de fichiers :**
- Allez dans le dossier du projet
- Uploadez les fichiers modifiés
- Remplacez les fichiers existants

**3. Utilisez le terminal intégré ou SSH :**
```bash
cd /home/votreuser/public_html/sotuma
php artisan optimize:clear
php artisan config:cache
php artisan view:cache
```

---

## ✅ Vérification Après Déploiement

### 1. Vérifier le Code Source HTML

**Sur le site en production (`https://sotuma.net`) :**

1. Ouvrez `https://sotuma.net`
2. Clic droit → **"Afficher le code source de la page"** (ou `Ctrl+U`)
3. Cherchez `G-J8C3Z5FSDB` avec `Ctrl+F`
4. **Vous devriez voir :**
```html
<script async src="https://www.googletagmanager.com/gtag/js?id=G-J8C3Z5FSDB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-J8C3Z5FSDB');
</script>
```

✅ **Si vous voyez ce code → Le déploiement est réussi !**

❌ **Si vous ne voyez pas ce code → Le déploiement n'a pas fonctionné**

### 2. Vérifier dans Network (F12)

1. Ouvrez `https://sotuma.net`
2. `F12` → Onglet **"Network"**
3. Rechargez la page (`F5`)
4. Cherchez `gtag/js?id=G-J8C3Z5FSDB`
5. **Vous devriez voir Status: 200**

### 3. Vérifier sur Plusieurs Pages

Testez ces URLs pour vérifier que toutes les pages ont la balise :

- ✅ `https://sotuma.net/` (page d'accueil)
- ✅ `https://sotuma.net/product-detail/[un-produit]`
- ✅ `https://sotuma.net/categories`
- ✅ `https://sotuma.net/about-us`
- ✅ `https://sotuma.net/contact`

**Pour chaque page :**
- Clic droit → Code source
- Cherchez `G-J8C3Z5FSDB`
- Si vous le voyez → ✅ Page OK

### 4. Vérifier dans Google Analytics

**Après 24-48 heures :**

1. Allez dans Google Analytics
2. Allez dans **"Admin"** → **"Balises"**
3. Cliquez sur **"Réessayez"** ou **"Vérifier la balise"**
4. Google devrait maintenant détecter la balise sur toutes les pages

---

## 🔧 Si Ça Ne Fonctionne Toujours Pas

### 1. Vérifier les Permissions

Sur le serveur :
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 2. Vérifier la Configuration PHP

Vérifiez que PHP peut exécuter les commandes Artisan :
```bash
php artisan --version
```

### 3. Vérifier les Variables d'Environnement

Vérifiez que `.env` contient (optionnel, car les valeurs par défaut sont dans config) :
```env
GOOGLE_ANALYTICS_ID=G-J8C3Z5FSDB
GOOGLE_TAG_MANAGER_ID=GTM-KK8KT37D
```

### 4. Forcer le Code (Test Temporaire)

Pour tester rapidement, vous pouvez temporairement forcer le code dans `head.blade.php` :

**Remplacez :**
```blade
@if(config('services.google_analytics_id'))
```

**Par :**
```blade
@if(true)
```

Ou mieux, enlevez complètement la condition :
```blade
<!-- Google Analytics (GA4) -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-J8C3Z5FSDB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-J8C3Z5FSDB');
</script>
```

⚠️ **Remettez la condition après le test !**

---

## 📋 Checklist Complète

- [ ] Fichiers modifiés commités dans Git (si vous utilisez Git)
- [ ] Fichiers déployés sur le serveur de production
- [ ] Cache Laravel vidé (`php artisan optimize:clear`)
- [ ] Config recacheée (`php artisan config:cache`)
- [ ] Code présent dans le code source HTML de `https://sotuma.net`
- [ ] Script visible dans Network (F12)
- [ ] Testé sur plusieurs pages (produit, catégorie, contact, etc.)
- [ ] Google Analytics détecte maintenant les balises (après 24-48h)

---

## ⏱️ Délais

- **Déploiement** : Immédiat après upload
- **Détection par Google Analytics** : **24 à 48 heures** (Google met du temps à scanner)

**Important** : Même si le code est présent, Google Analytics peut prendre jusqu'à 48h pour mettre à jour le rapport de couverture.

---

## 💡 Astuce : Test Rapide

Pour vérifier immédiatement que ça fonctionne :

1. Ouvrez `https://sotuma.net` en navigation privée
2. `F12` → Console
3. Tapez : `gtag`
4. Si vous voyez une fonction → ✅ Google Analytics est chargé !

---

**Dernière mise à jour :** 2025-01-15

