# ⚡ دليل سريع - سحب البيانات من Docker

## 🎯 الإجابة المختصرة: نعم، يمكنك العمل محلياً ثم رفع كل شيء!

---

## 📦 سحب كل البيانات من Docker (خطوة واحدة!)

### الطريقة السهلة:

```bash
./scripts/export-all.sh
```

**هذا السكريبت سينشئ مجلد يحتوي على:**
- ✅ قاعدة البيانات الكاملة
- ✅ جميع الصور والملفات المرفوعة
- ✅ جميع Themes (مع licenses)
- ✅ جميع Plugins (مع licenses)
- ✅ كل شيء!

---

## 🔍 أين توجد البيانات في Docker؟

من الصورة التي أرسلتها، البيانات موجودة في:

### 1. قاعدة البيانات:
- Container: `wordpress_db` (MySQL)
- قاعدة البيانات: `wordpress`
- **كيف تسحبها:** `./scripts/export-all.sh` أو من phpMyAdmin (localhost:8081)

### 2. الملفات والصور:
- Container: `wordpress_app` (WordPress)
- المسار: `/var/www/html/wp-content/`
  - الصور: `wp-content/uploads/`
  - Themes: `wp-content/themes/`
  - Plugins: `wp-content/plugins/`
- **كيف تسحبها:** `./scripts/export-all.sh`

---

## 📋 الخطوات العملية

### 1. اعمل كل تعديلاتك محلياً:
```bash
# شغل المشروع
docker compose up -d

# اعمل تعديلاتك على http://localhost:8080
# - عدل الثيم
# - غير الصور
# - عدل المحتوى
# - كل شيء!
```

### 2. عندما تكون جاهزاً، اصدّر كل شيء:
```bash
./scripts/export-all.sh
```

### 3. ارفع على هوستنجر:
- ارفع محتويات مجلد `export_YYYYMMDD_HHMMSS/` على هوستنجر
- اتبع التعليمات في `DEPLOY_TO_HOSTINGER.md`

---

## ✅ ما الذي لن تفقده؟

- ✅ **قاعدة البيانات** - كل المحتوى
- ✅ **الصور** - كل الصور المرفوعة
- ✅ **Themes** - الثيمات + licenses
- ✅ **Plugins** - الإضافات + licenses
- ✅ **الإعدادات** - wp-config.php
- ✅ **كل شيء!**

---

## 🛠️ السكريبتات المتاحة

| السكريبت | الوظيفة |
|---------|---------|
| `./scripts/export-all.sh` | تصدير كل شيء (موصى به) |
| `./scripts/export-database.sh` | تصدير قاعدة البيانات فقط |
| `./scripts/export-uploads-only.sh` | تصدير الصور فقط |

---

## 📖 للمزيد من التفاصيل

- **خطة العمل الكاملة:** `WORKFLOW.md`
- **دليل الرفع على هوستنجر:** `DEPLOY_TO_HOSTINGER.md`

---

**💡 نصيحة:** استخدم `./scripts/export-all.sh` - سهل وسريع ويصدر كل شيء!

