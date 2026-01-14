# 🚀 دليل خطوة بخطوة - رفع المشروع على هوستنجر

## الدومين: taseeswaesdar.com

---

## ⚠️ مهم جداً: اقرأ كل الخطوات قبل البدء!

---

## المرحلة 1: التحضير والتصدير من Docker

### الخطوة 1.1: التأكد من أن Docker يعمل

✅ من الصورة، Docker Desktop يعمل والحاويات نشطة:
- `wordpress_app` (WordPress)
- `wordpress_db` (phpMyAdmin)
- `wordpress_dt` (MySQL)

**تحقق:**
```bash
docker compose ps
```

يجب أن ترى الحاويات الثلاثة تعمل.

---

### الخطوة 1.2: تصدير كل شيء من Docker

**هذه هي الخطوة الأهم - لا تتخطاها!**

```bash
# تأكد أنك في مجلد المشروع
cd /Users/hossamelharery/Documents/taseeswaesdar-wordPress

# شغل السكريبت لتصدير كل شيء
./scripts/export-all.sh
```

**ماذا سيفعل السكريبت:**
- ✅ تصدير قاعدة البيانات الكاملة
- ✅ نسخ جميع الملفات (plugins, themes, uploads)
- ✅ نسخ جميع الصور
- ✅ نسخ wp-config.php
- ✅ إنشاء ملف ZIP (اختياري)

**النتيجة:**
سيتم إنشاء مجلد `export_YYYYMMDD_HHMMSS/` يحتوي على:
```
export_20260114_074500/
├── database.sql          ← قاعدة البيانات
├── wp-content/           ← كل الملفات
│   ├── plugins/          ← جميع plugins
│   ├── themes/           ← bizgen + bizgen-child
│   └── uploads/          ← جميع الصور
├── wp-config.php         ← ملف الإعدادات
└── README.txt           ← تعليمات
```

**⏱️ انتظر حتى ينتهي السكريبت (قد يستغرق دقائق)**

---

### الخطوة 1.3: التحقق من التصدير

```bash
# تحقق من وجود الملفات
ls -lh export_*/

# تحقق من حجم قاعدة البيانات
ls -lh export_*/database.sql

# تحقق من وجود الصور
ls -lh export_*/wp-content/uploads/
```

**✅ تأكد من:**
- [ ] ملف `database.sql` موجود
- [ ] مجلد `wp-content/` موجود
- [ ] مجلد `wp-content/uploads/` يحتوي على الصور
- [ ] مجلد `wp-content/themes/` يحتوي على `bizgen` و `bizgen-child`

---

## المرحلة 2: إعداد قاعدة البيانات على هوستنجر

### الخطوة 2.1: الدخول إلى لوحة تحكم هوستنجر

1. افتح: https://hpanel.hostinger.com
2. سجل دخول بحسابك
3. من القائمة الجانبية، اختر **"مواقع إلكترونية"** (Websites)

---

### الخطوة 2.2: الوصول إلى لوحة تحكم الموقع

1. ابحث عن الدومين **`taseeswaesdar.com`**
2. اضغط على **"لوحة التحكم"** (Control Panel)
3. سيتم فتح cPanel أو hPanel

---

### الخطوة 2.3: إنشاء قاعدة بيانات جديدة

1. في cPanel/hPanel، ابحث عن **"MySQL Databases"** أو **"قواعد البيانات"**
2. أنشئ قاعدة بيانات جديدة:
   - **اسم قاعدة البيانات:** `taseeswa_taseeswaesdar` (أو أي اسم تختاره)
   - **ملاحظة:** هوستنجر يضيف بادئة تلقائياً (مثل `taseeswa_`)
3. **احفظ اسم قاعدة البيانات** (ستحتاجه لاحقاً)

---

### الخطوة 2.4: إنشاء مستخدم قاعدة البيانات

1. في نفس صفحة MySQL Databases:
2. أنشئ مستخدم جديد:
   - **اسم المستخدم:** `taseeswa_wpuser` (أو أي اسم)
   - **كلمة المرور:** اختر كلمة مرور قوية
   - **ملاحظة:** هوستنجر يضيف بادئة تلقائياً
3. **احفظ اسم المستخدم وكلمة المرور** (مهم جداً!)

---

### الخطوة 2.5: ربط المستخدم بقاعدة البيانات

1. في قسم **"Add User To Database"**:
2. اختر المستخدم الذي أنشأته
3. اختر قاعدة البيانات التي أنشأتها
4. اضغط **"Add"**
5. في الصفحة التالية:
   - اختر **"ALL PRIVILEGES"** (جميع الصلاحيات)
   - اضغط **"Make Changes"**

---

### الخطوة 2.6: ملاحظة معلومات الاتصال

**احفظ هذه المعلومات (ستحتاجها لاحقاً):**

```
Database Name: taseeswa_taseeswaesdar
Database User: taseeswa_wpuser
Database Password: [كلمة المرور التي اخترتها]
Database Host: localhost
```

**⚠️ مهم:** اكتب هذه المعلومات في ملف نصي مؤقت!

---

## المرحلة 3: استيراد قاعدة البيانات

### الخطوة 3.1: الوصول إلى phpMyAdmin

1. في cPanel/hPanel، ابحث عن **"phpMyAdmin"**
2. اضغط عليه (سيتم فتحه في نافذة جديدة)

---

### الخطوة 3.2: اختيار قاعدة البيانات

1. من القائمة الجانبية في phpMyAdmin
2. اختر قاعدة البيانات التي أنشأتها (`taseeswa_taseeswaesdar`)

---

### الخطوة 3.3: استيراد قاعدة البيانات

1. اضغط على تبويب **"Import"** (استيراد) في الأعلى
2. اضغط **"Choose File"** أو **"اختر ملف"**
3. اختر ملف `database.sql` من مجلد التصدير:
   ```
   export_YYYYMMDD_HHMMSS/database.sql
   ```
4. في قسم **"Format"** تأكد أنه **"SQL"**
5. اضغط **"Go"** أو **"تنفيذ"** في الأسفل

**⏱️ انتظر حتى ينتهي الاستيراد (قد يستغرق دقائق حسب حجم قاعدة البيانات)**

---

### الخطوة 3.4: التحقق من الاستيراد

1. بعد انتهاء الاستيراد، تأكد من:
   - [ ] ظهور رسالة نجاح
   - [ ] ظهور الجداول في القائمة الجانبية (wp_posts, wp_options, إلخ)

---

## المرحلة 4: تحديث URLs في قاعدة البيانات

### الخطوة 4.1: تحديث Site URL و Home URL

في phpMyAdmin، نفذ هذا الاستعلام:

```sql
UPDATE wp_options SET option_value = 'https://taseeswaesdar.com' WHERE option_name = 'siteurl';
UPDATE wp_options SET option_value = 'https://taseeswaesdar.com' WHERE option_name = 'home';
```

**كيفية التنفيذ:**
1. في phpMyAdmin، اختر قاعدة البيانات
2. اضغط على تبويب **"SQL"** في الأعلى
3. الصق الاستعلام أعلاه
4. اضغط **"Go"**

---

### الخطوة 4.2: تحديث جميع الروابط في المحتوى

نفذ هذا الاستعلام لتحديث جميع الروابط:

```sql
UPDATE wp_posts SET post_content = REPLACE(post_content, 'http://localhost:8080', 'https://taseeswaesdar.com');
UPDATE wp_posts SET post_content = REPLACE(post_content, 'https://localhost:8080', 'https://taseeswaesdar.com');
UPDATE wp_posts SET guid = REPLACE(guid, 'http://localhost:8080', 'https://taseeswaesdar.com');
UPDATE wp_posts SET guid = REPLACE(guid, 'https://localhost:8080', 'https://taseeswaesdar.com');
UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'http://localhost:8080', 'https://taseeswaesdar.com');
UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'https://localhost:8080', 'https://taseeswaesdar.com');
UPDATE wp_comments SET comment_content = REPLACE(comment_content, 'http://localhost:8080', 'https://taseeswaesdar.com');
UPDATE wp_comments SET comment_author_url = REPLACE(comment_author_url, 'http://localhost:8080', 'https://taseeswaesdar.com');
UPDATE wp_usermeta SET meta_value = REPLACE(meta_value, 'http://localhost:8080', 'https://taseeswaesdar.com');
```

**ملاحظة:** يمكنك استخدام ملف `scripts/update-urls.sql` وتعديله:
1. افتح `scripts/update-urls.sql`
2. استبدل `yourdomain.com` بـ `taseeswaesdar.com`
3. انسخ المحتوى والصقه في phpMyAdmin

---

## المرحلة 5: رفع الملفات على هوستنجر

### الخطوة 5.1: الوصول إلى File Manager

1. في cPanel/hPanel، ابحث عن **"File Manager"** أو **"مدير الملفات"**
2. اضغط عليه

---

### الخطوة 5.2: الانتقال إلى مجلد public_html

1. في File Manager، اذهب إلى:
   ```
   public_html/
   ```
   أو
   ```
   domains/taseeswaesdar.com/public_html/
   ```

2. **⚠️ مهم:** إذا كان هناك ملفات موجودة (مثل index.html)، احذفها أو انقلها للنسخ الاحتياطي

---

### الخطوة 5.3: رفع ملفات WordPress

**الطريقة 1: عبر File Manager (للملفات الصغيرة)**

1. في File Manager، اذهب إلى `public_html/`
2. اضغط **"Upload"** (رفع)
3. ارفع محتويات مجلد `wordpress/` من مجلد التصدير:
   - اختر جميع الملفات من `export_YYYYMMDD_HHMMSS/wordpress/`
   - **لا ترفع مجلد wordpress نفسه، فقط محتوياته!**

**الطريقة 2: عبر FTP (موصى بها للملفات الكبيرة)**

1. **تحميل FileZilla** (مجاني): https://filezilla-project.org
2. **الاتصال:**
   - Host: `ftp.taseeswaesdar.com` أو IP من هوستنجر
   - Username: من لوحة تحكم هوستنجر
   - Password: من لوحة تحكم هوستنجر
   - Port: 21 (FTP) أو 22 (SFTP)
3. **الرفع:**
   - في الجانب الأيسر: مجلد `export_YYYYMMDD_HHMMSS/wordpress/`
   - في الجانب الأيمن: `public_html/`
   - اسحب جميع الملفات من اليسار إلى اليمين

---

### الخطوة 5.4: رفع wp-content

**⚠️ مهم جداً:** يجب رفع `wp-content/` بشكل منفصل للتأكد من رفع كل شيء

1. في File Manager أو FTP:
2. اذهب إلى `public_html/wp-content/`
3. ارفع محتويات `export_YYYYMMDD_HHMMSS/wp-content/`:
   - `plugins/` → `public_html/wp-content/plugins/`
   - `themes/` → `public_html/wp-content/themes/`
   - `uploads/` → `public_html/wp-content/uploads/`

**✅ تأكد من:**
- [ ] `bizgen/` موجود في `themes/`
- [ ] `bizgen-child/` موجود في `themes/`
- [ ] جميع الصور موجودة في `uploads/`
- [ ] جميع plugins موجودة

---

### الخطوة 5.5: التحقق من الصلاحيات

1. في File Manager:
2. اختر مجلد `wp-content/`
3. اضغط **"Change Permissions"** أو **"تغيير الصلاحيات"**
4. اضبط على **755** للمجلدات
5. اضبط على **644** للملفات

**أو عبر Terminal (إذا كان متاحاً):**
```bash
chmod -R 755 wp-content/
find wp-content/ -type f -exec chmod 644 {} \;
```

---

## المرحلة 6: تحديث wp-config.php

### الخطوة 6.1: تحميل wp-config.php

1. في File Manager، اذهب إلى `public_html/`
2. ابحث عن `wp-config.php`
3. اضغط عليه → **"Edit"** (تعديل)

---

### الخطوة 6.2: تحديث إعدادات قاعدة البيانات

استبدل هذه الأسطر:

```php
define( 'DB_NAME', 'taseeswa_taseeswaesdar' );
define( 'DB_USER', 'taseeswa_wpuser' );
define( 'DB_PASSWORD', '[كلمة المرور التي حفظتها]' );
define( 'DB_HOST', 'localhost' );
```

**⚠️ استخدم المعلومات التي حفظتها في الخطوة 2.6!**

---

### الخطوة 6.3: تحديث إعدادات الإنتاج

أضف أو عدل هذه الأسطر:

```php
// تعطيل Debug Mode
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );

// الأمان
define( 'DISALLOW_FILE_EDIT', true );

// SSL (إذا كان لديك SSL)
define( 'FORCE_SSL_ADMIN', true );
```

---

### الخطوة 6.4: حفظ الملف

1. اضغط **"Save Changes"** أو **"حفظ"**
2. تأكد من حفظ الملف بنجاح

---

## المرحلة 7: إعداد SSL (إن وجد)

### الخطوة 7.1: التحقق من SSL

1. في لوحة تحكم هوستنجر
2. ابحث عن **"SSL"** أو **"Security"**
3. إذا كان SSL Certificate موجود، فعّله

---

### الخطوة 7.2: إجبار HTTPS

إذا كان SSL مفعّل، تأكد من:
1. في wp-config.php: `FORCE_SSL_ADMIN` موجود
2. في قاعدة البيانات: URLs تستخدم `https://`

---

## المرحلة 8: الفحص والتحقق

### الخطوة 8.1: فحص الموقع

1. افتح المتصفح
2. اذهب إلى: **https://taseeswaesdar.com**
3. **✅ يجب أن ترى الموقع يعمل!**

---

### الخطوة 8.2: فحص لوحة التحكم

1. اذهب إلى: **https://taseeswaesdar.com/wp-admin**
2. سجل دخول (استخدم نفس بيانات الدخول من المحلي)
3. **✅ يجب أن تعمل لوحة التحكم!**

---

### الخطوة 8.3: فحص الصور

1. في لوحة التحكم، اذهب إلى **Media → Library**
2. **✅ يجب أن ترى جميع الصور!**
3. افتح أي صورة للتأكد أنها تظهر

---

### الخطوة 8.4: فحص الثيم

1. في لوحة التحكم، اذهب إلى **Appearance → Themes**
2. **✅ يجب أن ترى:**
   - `bizgen` (Parent Theme)
   - `bizgen-child` (Active - Child Theme)

---

### الخطوة 8.5: فحص الروابط

1. افتح أي صفحة أو مقال
2. **✅ يجب أن تعمل جميع الروابط!**
3. تأكد أن الصور تظهر

---

## المرحلة 9: التحسينات النهائية

### الخطوة 9.1: تحديث Permalinks

1. في لوحة التحكم: **Settings → Permalinks**
2. اضغط **"Save Changes"** (حتى لو لم تغير شيء)
3. هذا يجدد روابط الموقع

---

### الخطوة 9.2: تحديث Search Engine Settings

1. في لوحة التحكم: **Settings → Reading**
2. **⚠️ مهم:** أزل علامة **"Discourage search engines"**
3. هذا يسمح لمحركات البحث بفهرسة الموقع

---

### الخطوة 9.3: عمل نسخة احتياطية

1. في لوحة تحكم هوستنجر
2. استخدم **Backup** أو **نسخ احتياطي**
3. احفظ نسخة احتياطية كاملة

---

## ✅ Checklist النهائي

قبل أن تنهي، تأكد من:

- [ ] قاعدة البيانات مستوردة بنجاح
- [ ] جميع الملفات مرفوعة
- [ ] wp-config.php محدث بإعدادات قاعدة البيانات
- [ ] URLs محدثة في قاعدة البيانات
- [ ] الموقع يعمل على https://taseeswaesdar.com
- [ ] لوحة التحكم تعمل
- [ ] جميع الصور تظهر
- [ ] الثيم (bizgen-child) نشط
- [ ] جميع الروابط تعمل
- [ ] SSL مفعّل (إن وجد)
- [ ] نسخة احتياطية محفوظة

---

## 🆘 استكشاف الأخطاء

### المشكلة: الموقع لا يعمل

**الحل:**
1. تحقق من wp-config.php (إعدادات قاعدة البيانات)
2. تحقق من الصلاحيات (755 للمجلدات، 644 للملفات)
3. تحقق من سجلات الأخطاء في cPanel

---

### المشكلة: الصور لا تظهر

**الحل:**
```sql
-- في phpMyAdmin، نفذ:
UPDATE wp_posts SET guid = REPLACE(guid, 'localhost:8080', 'taseeswaesdar.com');
UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'localhost:8080', 'taseeswaesdar.com');
```

---

### المشكلة: خطأ في الاتصال بقاعدة البيانات

**الحل:**
1. تحقق من wp-config.php
2. تأكد من اسم قاعدة البيانات والمستخدم صحيح
3. تأكد من كلمة المرور صحيحة
4. تأكد من Database Host = `localhost`

---

### المشكلة: الثيم لا يظهر

**الحل:**
1. تأكد من رفع `bizgen/` و `bizgen-child/` في `wp-content/themes/`
2. تحقق من الصلاحيات (755)
3. في لوحة التحكم: Appearance → Themes → Activate

---

## 📞 الدعم

إذا واجهت أي مشكلة:
1. راجع سجلات الأخطاء في cPanel
2. تحقق من `wp-content/debug.log` (إذا كان Debug مفعّل)
3. تواصل مع دعم هوستنجر

---

## 🎉 تهانينا!

إذا وصلت هنا وكل شيء يعمل، فقد نجحت في رفع المشروع! 🚀

**💡 نصيحة:** احتفظ بمجلد التصدير `export_YYYYMMDD_HHMMSS/` كنسخة احتياطية!
