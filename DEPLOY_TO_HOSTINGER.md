# دليل رفع المشروع على هوستنجر

## 🎯 الخطة الموصى بها: العمل المحلي ثم الرفع

### ✅ نعم، يمكنك الاستمرار في العمل محلياً ثم رفع كل شيء!

**الطريقة الأفضل:**
1. ✅ **اعمل محلياً على Docker** - عدل الثيم، الصور، المحتوى، كل شيء
2. ✅ **اختبر كل شيء محلياً** - تأكد أن كل شيء يعمل
3. ✅ **عندما تكون جاهزاً، ارفع كل شيء دفعة واحدة** - بدون فقدان أي بيانات

**مميزات هذه الطريقة:**
- ✅ لا تفقد أي بيانات أو صور أو licenses
- ✅ تعمل بسرعة على localhost
- ✅ تختبر كل شيء قبل الرفع
- ✅ رفع واحد شامل بدلاً من رفعات متعددة

---

## 📦 تصدير كل شيء من Docker (خطوة واحدة!)

### الطريقة السهلة: استخدام السكريبت الجاهز

```bash
# تصدير كل شيء (قاعدة البيانات + الملفات + الصور + كل شيء)
./scripts/export-all.sh
```

هذا السكريبت سيقوم بـ:
- ✅ تصدير قاعدة البيانات الكاملة
- ✅ نسخ جميع الملفات (plugins, themes, uploads)
- ✅ نسخ الصور والملفات المرفوعة
- ✅ نسخ wp-config.php
- ✅ إنشاء ملف ZIP جاهز للرفع
- ✅ إنشاء ملف README بالتعليمات

**النتيجة:** مجلد `export_YYYYMMDD_HHMMSS` يحتوي على كل شيء جاهز للرفع!

---

## 📋 الخطوات الكاملة للرفع على هوستنجر

### المرحلة 1: التحضير قبل الرفع

#### 1.1 تنظيف الملفات غير الضرورية

```bash
# حذف ملفات Docker (لا تحتاجها على السيرفر)
rm -rf docker-compose.yml .dockerignore php.ini env.example

# حذف ملفات التطوير (اختياري)
# rm -rf .git .vscode
```

#### 1.2 تصدير كل شيء من Docker (الطريقة الموصى بها)

**الطريقة السهلة - سكريبت واحد:**

```bash
# تصدير كل شيء دفعة واحدة
./scripts/export-all.sh
```

هذا سينشئ مجلد `export_YYYYMMDD_HHMMSS` يحتوي على:
- `database.sql` - قاعدة البيانات الكاملة
- `wp-content/` - جميع الملفات (plugins, themes, uploads, الصور)
- `wp-config.php` - ملف الإعدادات
- `README.txt` - تعليمات الرفع

**الطريقة اليدوية:**

```bash
# 1. تصدير قاعدة البيانات
docker compose exec db mysqldump -u wordpress_user -pwordpress_password_123 wordpress > database_backup.sql

# 2. نسخ wp-content (يحتوي على الصور والملفات)
docker compose cp wordpress:/var/www/html/wp-content ./wp-content-export

# 3. نسخ wp-config.php
docker compose cp wordpress:/var/www/html/wp-config.php ./wp-config.php

# أو استخدام phpMyAdmin
# 1. افتح http://localhost:8081
# 2. اختر قاعدة البيانات "wordpress"
# 3. اضغط Export → Go
```

#### 1.3 تحديث wp-config.php للإنتاج

سأقوم بإنشاء ملف `wp-config-production.php` كقالب للإنتاج.

---

### المرحلة 2: رفع الملفات على هوستنجر

#### 2.1 رفع الملفات عبر FTP/SFTP

**الطريقة الموصى بها: استخدام FileZilla أو أي FTP client**

1. **الاتصال بالسيرفر:**
   - Host: `ftp.yourdomain.com` أو IP السيرفر
   - Username: من لوحة تحكم هوستنجر
   - Password: من لوحة تحكم هوستنجر
   - Port: 21 (FTP) أو 22 (SFTP)

2. **رفع الملفات:**
   ```
   ارفع محتويات مجلد wordpress/ إلى:
   /public_html/ (أو /domains/yourdomain.com/public_html/)
   
   ارفع محتويات plugins/ إلى:
   /public_html/wp-content/plugins/
   
   ارفع محتويات themes/ إلى:
   /public_html/wp-content/themes/
   ```

#### 2.2 رفع الملفات عبر File Manager (من لوحة تحكم هوستنجر)

1. اذهب إلى **File Manager** في لوحة تحكم هوستنجر
2. ارفع ملفات `wordpress/` إلى `public_html/`
3. ارفع `plugins/` إلى `public_html/wp-content/plugins/`
4. ارفع `themes/` إلى `public_html/wp-content/themes/`

---

### المرحلة 3: إعداد قاعدة البيانات على هوستنجر

#### 3.1 إنشاء قاعدة بيانات جديدة

1. اذهب إلى **MySQL Databases** في لوحة تحكم هوستنجر
2. أنشئ قاعدة بيانات جديدة (مثلاً: `yourdomain_wp`)
3. أنشئ مستخدم جديد (مثلاً: `yourdomain_wpuser`)
4. اربط المستخدم بقاعدة البيانات
5. **احفظ المعلومات:**
   - Database Name: `yourdomain_wp`
   - Database User: `yourdomain_wpuser`
   - Database Password: `your_password`
   - Database Host: `localhost` (عادة)

#### 3.2 استيراد قاعدة البيانات

**الطريقة 1: عبر phpMyAdmin (الأسهل)**

1. اذهب إلى **phpMyAdmin** في لوحة تحكم هوستنجر
2. اختر قاعدة البيانات الجديدة
3. اضغط **Import**
4. اختر ملف `database_backup.sql`
5. اضغط **Go**

**الطريقة 2: عبر Terminal (إذا كان متاحاً)**

```bash
mysql -u yourdomain_wpuser -p yourdomain_wp < database_backup.sql
```

---

### المرحلة 4: تحديث wp-config.php

#### 4.1 تحديث إعدادات قاعدة البيانات

عدل ملف `wp-config.php` على السيرفر:

```php
// ** Database settings - You can get this info from your web host ** //
define( 'DB_NAME', 'yourdomain_wp' );
define( 'DB_USER', 'yourdomain_wpuser' );
define( 'DB_PASSWORD', 'your_password' );
define( 'DB_HOST', 'localhost' );
```

#### 4.2 تحديث URLs في قاعدة البيانات

**مهم جداً:** يجب تحديث جميع الروابط من `localhost:8080` إلى دومينك الجديد.

**الطريقة 1: عبر SQL (الأسرع)**

```sql
-- في phpMyAdmin، نفذ هذه الاستعلامات:
UPDATE wp_options SET option_value = 'https://yourdomain.com' WHERE option_name = 'siteurl';
UPDATE wp_options SET option_value = 'https://yourdomain.com' WHERE option_name = 'home';
UPDATE wp_posts SET post_content = REPLACE(post_content, 'http://localhost:8080', 'https://yourdomain.com');
UPDATE wp_posts SET guid = REPLACE(guid, 'http://localhost:8080', 'https://yourdomain.com');
UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'http://localhost:8080', 'https://yourdomain.com');
```

**الطريقة 2: استخدام WP-CLI (إذا كان متاحاً)**

```bash
wp search-replace 'http://localhost:8080' 'https://yourdomain.com' --allow-root
```

**الطريقة 3: استخدام Plugin**

1. ثبت plugin **Better Search Replace** أو **Velvet Blues Update URLs**
2. استخدمه لتحديث جميع الروابط

---

### المرحلة 5: إعدادات الأمان والإنتاج

#### 5.1 تحديث wp-config.php للإنتاج

```php
// تعطيل Debug Mode
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );

// زيادة الأمان
define( 'DISALLOW_FILE_EDIT', true ); // منع تعديل الملفات من لوحة التحكم
define( 'WP_AUTO_UPDATE_CORE', true ); // تحديث تلقائي
```

#### 5.2 إعدادات SSL/HTTPS

إذا كان لديك SSL Certificate:

```php
// في wp-config.php
define( 'FORCE_SSL_ADMIN', true );
```

ثم في قاعدة البيانات:
```sql
UPDATE wp_options SET option_value = 'https://yourdomain.com' WHERE option_name IN ('siteurl', 'home');
```

---

### المرحلة 6: التحقق من كل شيء

#### 6.1 فحص الموقع

1. افتح `https://yourdomain.com`
2. تأكد أن الموقع يعمل
3. افتح `https://yourdomain.com/wp-admin`
4. سجل دخول

#### 6.2 فحص الروابط والصور

1. تأكد أن جميع الصور تظهر
2. تأكد أن الروابط الداخلية تعمل
3. جرب رفع صورة جديدة للتأكد

#### 6.3 فحص الأداء

1. استخدم **GTmetrix** أو **PageSpeed Insights**
2. فعّل **Caching Plugin** (مثل WP Super Cache أو W3 Total Cache)

---

## 🔧 العمل على السيرفر بعد الرفع

### الطريقة الموصى بها: العمل محلياً ثم رفع التحديثات

#### 1. العمل على Docker محلياً

```bash
# عدل الملفات محلياً
# اختبر على http://localhost:8080
# عندما تكون راضياً، ارفع التحديثات
```

#### 2. رفع التحديثات فقط

**للملفات:**
- رفع الملفات المعدلة فقط عبر FTP
- أو استخدام Git (إذا كان متاحاً)

**لقاعدة البيانات:**
- استخدم plugin **WP Migrate DB** أو **All-in-One WP Migration**
- أو استخدم phpMyAdmin لتصدير/استيراد الجداول المعدلة فقط

### نصائح مهمة:

1. **احتفظ بنسخة احتياطية دائماً:**
   ```bash
   # قبل أي تعديل كبير، اعمل backup
   ```

2. **استخدم Staging Environment (إن أمكن):**
   - هوستنجر يوفر subdomain للاختبار
   - اختبر التعديلات هناك أولاً

3. **استخدم Version Control (Git):**
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   # اربط مع GitHub/GitLab
   ```

4. **استخدم Plugin للنسخ الاحتياطي:**
   - **UpdraftPlus** (مجاني)
   - **BackWPup**
   - **Duplicator**

---

## 📝 Checklist قبل الرفع

- [ ] تصدير قاعدة البيانات
- [ ] تنظيف الملفات غير الضرورية
- [ ] تحديث wp-config.php
- [ ] رفع جميع الملفات
- [ ] إنشاء قاعدة بيانات على هوستنجر
- [ ] استيراد قاعدة البيانات
- [ ] تحديث URLs في قاعدة البيانات
- [ ] تفعيل SSL (إن وجد)
- [ ] تعطيل Debug Mode
- [ ] فحص الموقع
- [ ] فحص الروابط والصور
- [ ] عمل نسخة احتياطية

---

## 🚀 أوامر سريعة مفيدة

### على Docker (محلياً):

```bash
# تصدير قاعدة البيانات
docker compose exec db mysqldump -u wordpress_user -pwordpress_password_123 wordpress > backup.sql

# عرض السجلات
docker compose logs wordpress

# إعادة التشغيل
docker compose restart wordpress
```

### على هوستنجر (عبر SSH إذا كان متاحاً):

```bash
# تحديث URLs
wp search-replace 'http://localhost:8080' 'https://yourdomain.com' --allow-root

# تصدير قاعدة البيانات
wp db export backup.sql --allow-root

# استيراد قاعدة البيانات
wp db import backup.sql --allow-root
```

---

## ⚠️ مشاكل شائعة وحلولها

### 1. الصور لا تظهر
```sql
-- تحديث مسارات الصور في قاعدة البيانات
UPDATE wp_posts SET guid = REPLACE(guid, 'localhost:8080', 'yourdomain.com');
```

### 2. الروابط الداخلية لا تعمل
- استخدم plugin **Better Search Replace** لتحديث جميع الروابط

### 3. خطأ في الصلاحيات
```bash
# على السيرفر (عبر SSH)
chmod -R 755 wp-content/
chown -R www-data:www-data wp-content/
```

### 4. الموقع بطيء
- فعّل Caching Plugin
- استخدم CDN (Cloudflare مجاني)
- ضغط الصور

---

## 📞 الدعم

إذا واجهت أي مشاكل:
1. تحقق من سجلات الأخطاء في لوحة تحكم هوستنجر
2. راجع ملف `wp-content/debug.log` (إذا كان Debug مفعّل)
3. تواصل مع دعم هوستنجر

---

**ملاحظة:** احتفظ بنسخة من المشروع المحلي دائماً للرجوع إليها عند الحاجة.

