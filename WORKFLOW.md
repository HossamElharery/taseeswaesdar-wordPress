# 🚀 خطة العمل الموصى بها

## الطريقة الأفضل: العمل المحلي ثم الرفع الشامل

### ✅ نعم، يمكنك الاستمرار في العمل محلياً!

---

## 📝 خطة العمل اليومية

### 1. العمل المحلي (على Docker)

```bash
# شغل المشروع
docker compose up -d

# اعمل تعديلاتك:
# - عدل الثيم
# - غير الصور
# - عدل المحتوى
# - أضف plugins
# - كل شيء!

# اختبر على http://localhost:8080
```

**مميزات العمل المحلي:**
- ⚡ سريع جداً
- 🔄 إعادة تحميل فورية
- 🧪 اختبر بدون خوف
- 💾 لا يؤثر على السيرفر

---

## 📦 عندما تكون جاهزاً للرفع

### الخطوة 1: تصدير كل شيء

```bash
# سكريبت واحد يصدر كل شيء
./scripts/export-all.sh
```

**النتيجة:**
```
export_20260107_123456/
├── database.sql          # قاعدة البيانات الكاملة
├── wp-content/           # كل الملفات
│   ├── plugins/          # جميع plugins
│   ├── themes/           # جميع themes (مع licenses)
│   └── uploads/          # جميع الصور والملفات المرفوعة
├── wp-config.php         # ملف الإعدادات
└── README.txt           # تعليمات الرفع
```

### الخطوة 2: رفع على هوستنجر

1. **رفع الملفات:**
   ```
   ارفع wp-content/ → public_html/wp-content/
   ارفع wp-config.php → public_html/wp-config.php
   ```

2. **استيراد قاعدة البيانات:**
   - phpMyAdmin → Import → database.sql

3. **تحديث URLs:**
   - نفذ scripts/update-urls.sql في phpMyAdmin

4. **فحص الموقع:**
   - افتح https://yourdomain.com
   - تأكد أن كل شيء يعمل

---

## 🔄 العمل المستمر (بعد الرفع الأول)

### السيناريو 1: تعديلات بسيطة (ملفات فقط)

```bash
# 1. عدل الملفات محلياً
# 2. ارفع الملفات المعدلة فقط عبر FTP
# 3. لا حاجة لتحديث قاعدة البيانات
```

### السيناريو 2: تعديلات في المحتوى (قاعدة البيانات)

```bash
# 1. عدل المحتوى محلياً
# 2. استخدم plugin WP Migrate DB:
#    - Export من localhost
#    - Import على السيرفر
# 3. أو استخدم phpMyAdmin لتصدير/استيراد الجداول المعدلة
```

### السيناريو 3: رفع شامل جديد

```bash
# 1. اعمل كل تعديلاتك محلياً
# 2. ./scripts/export-all.sh
# 3. ارفع كل شيء على السيرفر
```

---

## 📸 الصور والملفات المرفوعة

### أين توجد الصور في Docker؟

الصور موجودة في:
```
wordpress/wp-content/uploads/
```

### كيف تسحبها؟

**الطريقة 1: السكريبت الجاهز**
```bash
./scripts/export-uploads-only.sh
```

**الطريقة 2: يدوياً**
```bash
docker compose cp wordpress:/var/www/html/wp-content/uploads ./uploads-export
```

**الطريقة 3: من phpMyAdmin**
- الصور موجودة في قاعدة البيانات (في wp_posts و wp_postmeta)
- لكن الملفات الفعلية في wp-content/uploads/

---

## 🔐 Licenses والملفات المهمة

### أين توجد Licenses؟

1. **Theme Licenses:**
   ```
   wp-content/themes/[theme-name]/
   ├── license.txt
   ├── readme.txt
   └── style.css (header comments)
   ```

2. **Plugin Licenses:**
   ```
   wp-content/plugins/[plugin-name]/
   ├── license.txt
   └── readme.txt
   ```

### هل ستفقدها؟

**لا!** ✅ لأن:
- السكريبت `export-all.sh` ينسخ كل `wp-content/`
- هذا يشمل themes و plugins بالكامل
- جميع ملفات license موجودة

---

## ✅ Checklist قبل الرفع

- [ ] عملت كل التعديلات محلياً
- [ ] اختبرت كل شيء على localhost
- [ ] تصدير كل شيء: `./scripts/export-all.sh`
- [ ] فحص محتويات مجلد التصدير
- [ ] التأكد من وجود:
  - [ ] database.sql
  - [ ] wp-content/uploads/ (الصور)
  - [ ] wp-content/themes/ (الثيمات + licenses)
  - [ ] wp-content/plugins/ (plugins + licenses)
- [ ] رفع الملفات على هوستنجر
- [ ] استيراد قاعدة البيانات
- [ ] تحديث URLs
- [ ] فحص الموقع

---

## 🎯 الخلاصة

### ✅ الطريقة الموصى بها:

1. **اعمل محلياً** → Docker (localhost:8080)
2. **اختبر كل شيء** → تأكد من الصور والمحتوى
3. **عندما تكون جاهزاً** → `./scripts/export-all.sh`
4. **ارفع كل شيء** → مجلد واحد يحتوي على كل شيء
5. **لا تفقد أي شيء** → كل البيانات والصور والlicenses موجودة

### ⚠️ نصائح مهمة:

- 💾 **اعمل backup قبل أي تعديل كبير**
- 🧪 **اختبر محلياً قبل الرفع**
- 📦 **استخدم السكريبت** - أسهل وأسرع
- 🔄 **ارفع كل شيء دفعة واحدة** - أفضل من رفعات متعددة

---

## 🆘 إذا واجهت مشكلة

### الصور لا تظهر بعد الرفع؟

```sql
-- في phpMyAdmin، نفذ:
UPDATE wp_posts SET guid = REPLACE(guid, 'localhost:8080', 'yourdomain.com');
UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'localhost:8080', 'yourdomain.com');
```

### Licenses مفقودة؟

- تأكد أنك رفعت `wp-content/themes/` و `wp-content/plugins/` بالكامل
- Licenses موجودة داخل مجلدات themes و plugins

### قاعدة البيانات كبيرة؟

- استخدم phpMyAdmin → Export → Custom → اختر الجداول المهمة فقط
- أو استخدم plugin WP Migrate DB

---

**💡 نصيحة أخيرة:** اعمل backup قبل أي رفع كبير!

