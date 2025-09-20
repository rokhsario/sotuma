Write-Host "🚀 Correction des dossiers Laravel..."

# Aller dans le dossier du projet
Set-Location "C:\works\sotuma"

# Créer les dossiers manquants
$folders = @(
    "storage\framework\sessions",
    "storage\framework\cache",
    "storage\framework\views"
)

foreach ($folder in $folders) {
    if (-Not (Test-Path $folder)) {
        Write-Host "📁 Création du dossier : $folder"
        New-Item -ItemType Directory -Force -Path $folder | Out-Null
    } else {
        Write-Host "✅ Dossier déjà existant : $folder"
    }
}

# Donner les permissions complètes à l’utilisateur courant
Write-Host "🔑 Attribution des permissions..."
icacls "storage" /grant "$($env:UserName):(OI)(CI)F" /T

# Nettoyer les caches Laravel
Write-Host "🧹 Nettoyage du cache Laravel..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan optimize:clear

Write-Host "✅ Correction terminée ! Tu peux relancer ton serveur 🚀"
