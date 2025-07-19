# 🚀 SOTUMA DEPLOYMENT CHECKLIST

## ⚠️ CRITICAL PRE-DEPLOYMENT TASKS

### 1. **Environment Configuration**
- [ ] Create `.env` file from `.env.example`
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_URL=https://yourdomain.com`
- [ ] Generate new `APP_KEY` with `php artisan key:generate`

### 2. **Database Configuration**
- [ ] Update database credentials in `.env`:
  ```
  DB_HOST=your_hosting_db_host
  DB_DATABASE=your_database_name
  DB_USERNAME=your_database_user
  DB_PASSWORD=your_database_password
  ```

### 3. **Asset Optimization**
- [ ] Run `npm run production` or `npm run build`
- [ ] Clear compiled assets: `php artisan view:clear`
- [ ] Clear config cache: `php artisan config:clear`
- [ ] Clear route cache: `php artisan route:clear`

### 4. **Storage Setup**
- [ ] Create storage link: `php artisan storage:link`
- [ ] Ensure storage directories are writable
- [ ] Upload your product images to `storage/app/public/photos/1/`

### 5. **Database Migration & Seeding**
- [ ] Run migrations: `php artisan migrate`
- [ ] Seed categories: `php artisan db:seed --class=CategorySeeder`
- [ ] Seed products: `php artisan db:seed --class=ProductSeeder`

## 🔧 HOSTING REQUIREMENTS

### **PHP Requirements**
- PHP 8.1 or higher
- Extensions: BCMath, Ctype, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, cURL, GD, ZIP

### **Server Configuration**
- [ ] Set document root to `/public` folder
- [ ] Enable URL rewriting (mod_rewrite for Apache)
- [ ] Set proper file permissions (755 for directories, 644 for files)

### **File Permissions**
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
```

## 🚨 FIXED ISSUES

### ✅ **Branding Updated**
- Changed app name from "e-tech" to "SOTUMA" in `manifest.json`
- Updated page titles from "E-TECH" to "SOTUMA"

### ✅ **Social Login URLs Fixed**
- Updated `config/services.php` to use environment variables
- Removed hardcoded localhost URLs

### ✅ **Template References Cleaned**
- No more references to old e-commerce template data
- All e-commerce features properly removed

## 📁 FILES TO UPLOAD

### **Required Files**
- All Laravel application files
- `vendor/` directory (or run `composer install` on server)
- `node_modules/` directory (or run `npm install` on server)
- `.env` file (create on server)

### **Optional Files (Can be regenerated)**
- `storage/app/public/photos/` (upload your product images)
- `public/storage` (will be created by `storage:link`)

## 🔍 POST-DEPLOYMENT VERIFICATION

### **Test These Features**
- [ ] Homepage loads correctly
- [ ] Product listing works
- [ ] Category filtering works
- [ ] Admin panel accessible
- [ ] Image uploads work
- [ ] Storage links work

### **Common Issues to Check**
- [ ] 500 errors (check logs in `storage/logs/`)
- [ ] Image not loading (check storage permissions)
- [ ] Database connection errors (check `.env` settings)
- [ ] Route not found (check URL rewriting)

## 🆘 TROUBLESHOOTING

### **If Images Don't Load**
```bash
php artisan storage:link
chmod -R 755 storage/
```

### **If Database Errors**
```bash
php artisan config:clear
php artisan cache:clear
```

### **If Routes Don't Work**
- Check if mod_rewrite is enabled
- Verify `.htaccess` file exists in public folder
- Check server error logs

## 📞 SUPPORT

If you encounter issues:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check server error logs
3. Verify all environment variables are set correctly
4. Ensure file permissions are correct

---

**✅ Your project is now ready for hosting!** 