# 🚀 دليل البدء السريع - Bizgen Theme

## الطريقة السريعة (موصى بها)

```bash
# 1. تأكد من تشغيل Docker Desktop

# 2. شغّل سكريبت الإعداد التلقائي
./setup.sh

# 3. افتح المتصفح على: http://localhost:8080
```

## الطريقة اليدوية

### 1. إنشاء المجلدات
```bash
mkdir -p wordpress themes plugins
```

### 2. تشغيل Docker
```bash
docker-compose up -d
```

### 3. انتظر دقيقة ثم افتح
- **الموقع**: http://localhost:8080
- **لوحة التحكم**: http://localhost:8080/wp-admin
- **phpMyAdmin**: http://localhost:8081

### 4. أكمل إعداد WordPress
- اختر اللغة
- أدخل معلومات الموقع
- سجّل الدخول

### 5. ثبّت الثيم
- اذهب إلى: **المظهر > الثيمات**
- اضغط: **إضافة جديد > رفع ثيم**
- اختر: `bizgen.zip`
- فعّل الثيم

### 6. ثبّت الإضافات
- **Elementor** (من متجر WordPress)
- **rt-elements** (من ملفات المشروع)
- **rt-custom-framework** (من ملفات المشروع)
- **revslider** (من ملفات المشروع)

## ⚠️ ملاحظات مهمة

- تأكد من أن Docker Desktop يعمل قبل البدء
- انتظر دقيقة أو دقيقتين بعد `docker-compose up -d`
- إذا واجهت مشاكل، راجع `README-AR.md` للتفاصيل الكاملة

## 🛑 إيقاف الخوادم

```bash
docker-compose down
```

## 🔄 إعادة التشغيل

```bash
docker-compose restart
```

---

**للمزيد من التفاصيل**: راجع `README-AR.md`

