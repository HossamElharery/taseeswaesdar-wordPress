# دليل تشغيل ثيم Bizgen Business WordPress Theme

## المتطلبات الأساسية

- Docker Desktop مثبت على جهازك
- متصفح ويب (Chrome, Firefox, Safari, etc.)

## الخطوات الكاملة لتشغيل الثيم

### الخطوة 1: إعداد Docker

1. تأكد من تشغيل Docker Desktop على جهازك
2. افتح Terminal (أو Command Prompt على Windows)

### الخطوة 2: إعداد ملفات المشروع

1. انتقل إلى مجلد المشروع:
```bash
cd /Users/hossamelharery/Documents/bizgen-business-wordpress-theme-rtl-2025-09-25-07-03-07-utc
```

2. أنشئ ملف `.env` من المثال:
```bash
cp .env.example .env
```

3. (اختياري) عدّل ملف `.env` إذا أردت تغيير كلمات المرور أو أسماء قواعد البيانات

### الخطوة 3: إنشاء المجلدات المطلوبة

قم بإنشاء المجلدات التالية:
```bash
mkdir -p wordpress themes plugins
```

### الخطوة 4: تشغيل Docker Containers

قم بتشغيل الأوامر التالية:

```bash
docker-compose up -d
```

هذا الأمر سيقوم بـ:
- تحميل صور WordPress و MySQL و phpMyAdmin
- إنشاء الحاويات (containers)
- إعداد قاعدة البيانات
- تشغيل الخوادم

### الخطوة 5: انتظار التهيئة

انتظر دقيقة أو دقيقتين حتى يتم تهيئة WordPress بالكامل. يمكنك متابعة السجلات باستخدام:

```bash
docker-compose logs -f wordpress
```

اضغط `Ctrl+C` للخروج من عرض السجلات.

### الخطوة 6: تثبيت WordPress

1. افتح المتصفح واذهب إلى: `http://localhost:8080`
2. اختر اللغة (العربية أو الإنجليزية)
3. املأ المعلومات التالية:
   - **عنوان الموقع**: اسم موقعك
   - **اسم المستخدم**: اختر اسم مستخدم (مثل: admin)
   - **كلمة المرور**: اختر كلمة مرور قوية
   - **البريد الإلكتروني**: بريدك الإلكتروني
   - **الخصوصية**: يمكنك إلغاء تحديد مربع محرك البحث إذا كنت تطور محلياً

4. اضغط على "تثبيت WordPress"

### الخطوة 7: تثبيت الثيم

#### الطريقة الأولى: من لوحة التحكم

1. بعد تسجيل الدخول، اذهب إلى: **المظهر (Appearance) > الثيمات (Themes)**
2. اضغط على **إضافة جديد (Add New)**
3. اضغط على **رفع ثيم (Upload Theme)**
4. اختر ملف `bizgen.zip`
5. اضغط على **تثبيت الآن (Install Now)**
6. بعد التثبيت، اضغط على **تفعيل (Activate)**

#### الطريقة الثانية: نسخ مباشر

```bash
# استخرج ملف الثيم الرئيسي
unzip bizgen.zip -d themes/

# استخرج ملف الثيم الفرعي (Child Theme) - اختياري
unzip bizgen-child.zip -d themes/
```

ثم من لوحة التحكم، اذهب إلى **المظهر > الثيمات** وفعّل الثيم.

### الخطوة 8: تثبيت الإضافات المطلوبة

الثيم يتطلب إضافات معينة. قم بتثبيتها:

1. اذهب إلى **الإضافات (Plugins) > إضافة جديد (Add New)**

2. ابحث عن وثبّت الإضافات التالية:
   - **Elementor** (محرر الصفحات)
   - **Contact Form 7** (إذا كان مطلوباً)

3. رفع الإضافات المرفقة:
   - اذهب إلى **الإضافات > إضافة جديد > رفع إضافة**
   - رفع `revslider.zip`
   - رفع `rt-custom-framework.zip`
   - رفع `rt-elements.zip` (أو نسخ مجلد `rt-elements` إلى `plugins/`)

### الخطوة 9: استيراد المحتوى التجريبي (Demo Content)

1. اذهب إلى **المظهر > استيراد المحتوى التجريبي** (إذا كان متوفراً)
   - أو ابحث في لوحة التحكم عن "Import Demo" أو "Demo Import"

2. اختر النسخة التي تريدها وانتظر حتى يكتمل الاستيراد

**ملاحظة مهمة**: تأكد من أن إعدادات PHP كافية (تم ضبطها في `php.ini`):
- memory_limit = 256M
- max_execution_time = 300
- post_max_size = 256M
- upload_max_filesize = 500M

### الخطوة 10: الوصول إلى phpMyAdmin (اختياري)

إذا أردت الوصول إلى قاعدة البيانات مباشرة:
- افتح: `http://localhost:8081`
- اسم المستخدم: `wordpress` (أو ما حددته في `.env`)
- كلمة المرور: `wordpress` (أو ما حددته في `.env`)

## الأوامر المفيدة

### إيقاف الخوادم
```bash
docker-compose down
```

### إيقاف الخوادم مع حذف البيانات
```bash
docker-compose down -v
```

### عرض السجلات
```bash
docker-compose logs -f
```

### إعادة تشغيل الخوادم
```bash
docker-compose restart
```

### الدخول إلى حاوية WordPress
```bash
docker exec -it bizgen-wordpress bash
```

### الدخول إلى قاعدة البيانات
```bash
docker exec -it bizgen-mysql mysql -u wordpress -p wordpress
```

## استكشاف الأخطاء

### المشكلة: الصفحة لا تفتح
- تأكد من أن Docker يعمل
- تحقق من أن المنفذ 8080 غير مستخدم: `lsof -i :8080`
- راجع السجلات: `docker-compose logs wordpress`

### المشكلة: خطأ في قاعدة البيانات
- تأكد من أن حاوية MySQL تعمل: `docker ps`
- أعد تشغيل الحاويات: `docker-compose restart`

### المشكلة: خطأ في رفع الملفات
- تحقق من إعدادات PHP في `php.ini`
- تأكد من أن `upload_max_filesize` و `post_max_size` كافيين

### المشكلة: خطأ 500 أو صفحة بيضاء
- راجع السجلات: `docker-compose logs wordpress`
- تحقق من صلاحيات الملفات في مجلد `wordpress`
- تأكد من إعدادات PHP memory_limit

## الروابط المهمة

- **الموقع**: http://localhost:8080
- **لوحة التحكم**: http://localhost:8080/wp-admin
- **phpMyAdmin**: http://localhost:8081
- **التوثيق الرسمي**: https://docs.reactheme.com/docs/bizgen-business-wordpress-theme/

## ملاحظات إضافية

1. **النسخ الاحتياطي**: احرص على عمل نسخة احتياطية من قاعدة البيانات والملفات بانتظام
2. **التحديثات**: عند تحديث WordPress أو الإضافات، استخدم `docker-compose restart`
3. **الأمان**: هذا الإعداد للتطوير المحلي فقط. لا تستخدمه في الإنتاج بدون إعدادات أمان إضافية

## الدعم

إذا واجهت أي مشاكل، راجع:
- [التوثيق الرسمي](https://docs.reactheme.com/docs/bizgen-business-wordpress-theme/)
- [منتدى WordPress العربي](https://ar.wordpress.org/support/)
- [منتدى Docker](https://forums.docker.com/)

---

**تم إنشاء هذا الدليل بواسطة AI Assistant**
**تاريخ التحديث**: 2025

