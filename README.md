# إعداد Docker لمشروع WordPress

هذا المشروع يحتوي على إعداد Docker كامل لتطوير ثيم WordPress محلياً قبل رفعه على هوستنجر.

## المتطلبات

- Docker Desktop (docker.app) مثبت ومشغل
- Docker Compose (يأتي مع Docker Desktop)

## البنية

```
.
├── docker-compose.yml    # إعدادات Docker
├── .env                 # متغيرات البيئة
├── .dockerignore        # ملفات مستبعدة
├── wordpress/           # WordPress core
├── plugins/             # Plugins مخصصة
└── themes/              # Themes مخصصة
```

## التشغيل

### 1. تشغيل المشروع

```bash
docker-compose up -d
```

هذا الأمر سيقوم بـ:
- تحميل الصور المطلوبة (WordPress, MySQL, phpMyAdmin)
- إنشاء الحاويات
- ربط الملفات والملفات
- تشغيل الخدمات في الخلفية

### 2. التحقق من حالة الخدمات

```bash
docker-compose ps
```

### 3. عرض السجلات

```bash
# جميع السجلات
docker-compose logs

# سجلات WordPress فقط
docker-compose logs wordpress

# سجلات قاعدة البيانات
docker-compose logs db
```

## الوصول للخدمات

بعد التشغيل، يمكنك الوصول للخدمات من المتصفح:

- **WordPress**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081

## إعداد WordPress

1. افتح http://localhost:8080 في المتصفح
2. اختر اللغة العربية (أو أي لغة تفضلها)
3. املأ معلومات الموقع:
   - **عنوان الموقع**: اسم موقعك
   - **اسم المستخدم**: اختر اسم مستخدم للإدارة
   - **كلمة المرور**: اختر كلمة مرور قوية
   - **البريد الإلكتروني**: بريدك الإلكتروني
4. اضغط "تثبيت WordPress"

## إعدادات قاعدة البيانات

يمكنك الوصول لقاعدة البيانات من:

- **phpMyAdmin**: http://localhost:8081
  - **اسم المستخدم**: `wordpress_user`
  - **كلمة المرور**: `wordpress_password_123` (من ملف .env)

أو من خلال:
- **MySQL Host**: `db`
- **Port**: `3306`
- **Database**: `wordpress`
- **Username**: `wordpress_user`
- **Password**: `wordpress_password_123`

## الأوامر المفيدة

### إيقاف المشروع

```bash
docker-compose down
```

### إيقاف وحذف البيانات

```bash
docker-compose down -v
```

⚠️ **تحذير**: هذا الأمر سيحذف قاعدة البيانات وكل البيانات المحفوظة!

### إعادة تشغيل خدمة معينة

```bash
docker-compose restart wordpress
docker-compose restart db
docker-compose restart phpmyadmin
```

### الدخول لحاوية WordPress

```bash
docker-compose exec wordpress bash
```

### الدخول لقاعدة البيانات مباشرة

```bash
docker-compose exec db mysql -u wordpress_user -p wordpress
```

### عرض استخدام الموارد

```bash
docker stats
```

## Plugins و Themes

- **Plugins المخصصة**: موجودة في مجلد `plugins/` ومرتبطة تلقائياً
- **Themes المخصصة**: موجودة في مجلد `themes/` ومرتبطة تلقائياً

يمكنك الوصول لهم من لوحة تحكم WordPress:
- Plugins: `wp-admin/plugins.php`
- Themes: `wp-admin/themes.php`

## تعديل الإعدادات

### تغيير كلمات المرور

عدل ملف `.env` وعدل القيم التالية:
- `WORDPRESS_DB_PASSWORD`
- `MYSQL_ROOT_PASSWORD`

ثم أعد تشغيل الحاويات:
```bash
docker-compose down
docker-compose up -d
```

### تغيير المنافذ (Ports)

عدل ملف `docker-compose.yml` في قسم `ports`:
```yaml
ports:
  - "8080:80"  # غيّر 8080 للمنفذ المطلوب
```

## استكشاف الأخطاء

### المشروع لا يعمل

1. تأكد أن Docker Desktop يعمل
2. تحقق من المنافذ المستخدمة:
   ```bash
   lsof -i :8080
   lsof -i :8081
   ```
3. تحقق من السجلات:
   ```bash
   docker-compose logs
   ```

### قاعدة البيانات لا تتصل

1. تأكد أن حاوية `db` تعمل:
   ```bash
   docker-compose ps
   ```
2. انتظر حتى تصبح قاعدة البيانات جاهزة (قد تستغرق 30-60 ثانية)
3. تحقق من السجلات:
   ```bash
   docker-compose logs db
   ```

### الملفات لا تظهر

1. تأكد من وجود الملفات في المجلدات الصحيحة
2. تحقق من الصلاحيات:
   ```bash
   ls -la plugins/
   ls -la themes/
   ```

## النسخ الاحتياطي

### نسخ قاعدة البيانات

```bash
docker-compose exec db mysqldump -u wordpress_user -p wordpress > backup.sql
```

### استعادة قاعدة البيانات

```bash
docker-compose exec -T db mysql -u wordpress_user -p wordpress < backup.sql
```

## التحضير للرفع على هوستنجر

قبل رفع المشروع على هوستنجر:

1. **تغيير كلمات المرور**: استخدم كلمات مرور قوية في ملف `.env`
2. **تعطيل Debug Mode**: غيّر `WORDPRESS_DEBUG=0` في ملف `.env`
3. **نسخ قاعدة البيانات**: استخدم phpMyAdmin أو mysqldump لنسخ قاعدة البيانات
4. **رفع الملفات**: ارفع مجلدات `wordpress/`, `plugins/`, و `themes/` على السيرفر
5. **تحديث wp-config.php**: عدل إعدادات قاعدة البيانات على السيرفر

## الدعم

إذا واجهت أي مشاكل:
1. تحقق من السجلات: `docker-compose logs`
2. تأكد من تحديث Docker Desktop لأحدث إصدار
3. تحقق من أن المنافذ غير مستخدمة من تطبيقات أخرى

---

**ملاحظة**: هذا الإعداد مخصص للتطوير المحلي. عند الرفع على هوستنجر، استخدم إعداداتهم الموصى بها.

