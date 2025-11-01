# 🔧 Configuration Google Analytics & Tag Manager

## ✅ Configuration Appliquée

Les IDs suivants ont été configurés dans le projet :

### 📊 Google Analytics (GA4)
- **ID** : `G-J8C3Z5FSDB`
- **Fichier** : `config/services.php`
- **Variable** : `GOOGLE_ANALYTICS_ID`

### 🏷️ Google Tag Manager
- **ID** : `GTM-KK8KT37D`
- **Fichier** : `config/services.php`
- **Variable** : `GOOGLE_TAG_MANAGER_ID`

---

## 📝 Fichiers Modifiés

### 1. `config/services.php`

Les valeurs par défaut ont été ajoutées :

```php
'google_analytics_id' => env('GOOGLE_ANALYTICS_ID', 'G-J8C3Z5FSDB'),
'google_tag_manager_id' => env('GOOGLE_TAG_MANAGER_ID', 'GTM-KK8KT37D'),
```

### 2. `resources/views/frontend/layouts/head.blade.php`

**Google Tag Manager (dans le `<head>`) :**
```blade
@if(config('services.google_tag_manager_id'))
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer',@json(config('services.google_tag_manager_id')));</script>
@endif
```

**Google Analytics GA4 (dans le `<head>`) :**
```blade
@if(config('services.google_analytics_id'))
<script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics_id') }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ config('services.google_analytics_id') }}');
</script>
@endif
```

### 3. `resources/views/frontend/layouts/master.blade.php`

**Google Tag Manager (noscript - dans le `<body>`) :**
```blade
@if(config('services.google_tag_manager_id'))
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('services.google_tag_manager_id') }}"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
@endif
```

---

## 🔄 Variables d'Environnement (Optionnel)

Si vous souhaitez changer les IDs via `.env`, ajoutez :

```env
# Google Analytics & Tag Manager (optionnel - les valeurs par défaut sont déjà configurées)
GOOGLE_ANALYTICS_ID=G-J8C3Z5FSDB
GOOGLE_TAG_MANAGER_ID=GTM-KK8KT37D
```

**Note** : Les valeurs par défaut sont déjà dans `config/services.php`, donc vous n'avez pas besoin de les ajouter dans `.env` sauf si vous voulez les changer.

---

## ✅ Vérification

### 1. Vérifier que Google Tag Manager fonctionne

1. Ouvrez votre site dans un navigateur
2. Ouvrez la Console du développeur (F12)
3. Allez dans l'onglet "Network" (Réseau)
4. Rechargez la page
5. Cherchez `gtm.js?id=GTM-KK8KT37D` - il devrait apparaître

### 2. Vérifier que Google Analytics fonctionne

1. Ouvrez votre site dans un navigateur
2. Ouvrez la Console du développeur (F12)
3. Allez dans l'onglet "Network" (Réseau)
4. Rechargez la page
5. Cherchez `gtag/js?id=G-J8C3Z5FSDB` - il devrait apparaître

### 3. Vérifier dans Google Analytics

1. Connectez-vous à Google Analytics : https://analytics.google.com/
2. Allez dans "Administration" > "Streams de données"
3. Vérifiez que les événements apparaissent en temps réel

### 4. Vérifier dans Google Tag Manager

1. Connectez-vous à Google Tag Manager : https://tagmanager.google.com/
2. Sélectionnez votre conteneur (GTM-KK8KT37D)
3. Allez dans "Aperçu" et testez votre site

---

## 🧹 Nettoyage du Cache

Si les scripts ne s'affichent pas, nettoyez le cache :

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

Puis rechargez votre page.

---

## 📊 Code Final Installé

### Google Tag Manager (Head)
Le code suivant est maintenant dans `resources/views/frontend/layouts/head.blade.php` :

```html
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KK8KT37D');</script>
<!-- End Google Tag Manager -->
```

### Google Analytics GA4 (Head)
Le code suivant est maintenant dans `resources/views/frontend/layouts/head.blade.php` :

```html
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-J8C3Z5FSDB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-J8C3Z5FSDB');
</script>
```

### Google Tag Manager Noscript (Body)
Le code suivant est maintenant dans `resources/views/frontend/layouts/master.blade.php` :

```html
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KK8KT37D"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
```

---

## ✅ Statut

✅ **Configuration terminée et active !**

Les scripts Google Analytics et Google Tag Manager sont maintenant intégrés et fonctionnels avec vos IDs :
- Google Analytics : `G-J8C3Z5FSDB`
- Google Tag Manager : `GTM-KK8KT37D`

Vous pouvez maintenant suivre les visites et les événements dans Google Analytics et configurer des tags dans Google Tag Manager.

