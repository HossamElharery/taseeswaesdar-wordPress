# ✅ Checklist سريع - رفع على taseeswaesdar.com

## قبل البدء

- [ ] Docker يعمل والحاويات نشطة
- [ ] قرأت `STEP_BY_STEP_DEPLOY.md` بالكامل

---

## المرحلة 1: التصدير

- [ ] `./scripts/export-all.sh` تم تنفيذه بنجاح
- [ ] مجلد `export_YYYYMMDD_HHMMSS/` موجود
- [ ] `database.sql` موجود
- [ ] `wp-content/` موجود
- [ ] `wp-content/uploads/` يحتوي على الصور
- [ ] `wp-content/themes/bizgen/` موجود
- [ ] `wp-content/themes/bizgen-child/` موجود

---

## المرحلة 2: قاعدة البيانات على هوستنجر

- [ ] قاعدة بيانات جديدة منشأة
- [ ] مستخدم قاعدة بيانات منشأ
- [ ] المستخدم مربوط بقاعدة البيانات
- [ ] معلومات الاتصال محفوظة:
  - [ ] Database Name: `_____________`
  - [ ] Database User: `_____________`
  - [ ] Database Password: `_____________`
  - [ ] Database Host: `localhost`

---

## المرحلة 3: استيراد قاعدة البيانات

- [ ] phpMyAdmin مفتوح
- [ ] قاعدة البيانات مختارة
- [ ] `database.sql` مستورد بنجاح
- [ ] الجداول ظاهرة (wp_posts, wp_options, إلخ)

---

## المرحلة 4: تحديث URLs

- [ ] Site URL و Home URL محدثة
- [ ] جميع الروابط محدثة (استخدم `scripts/update-urls-taseeswaesdar.sql`)

---

## المرحلة 5: رفع الملفات

- [ ] File Manager أو FTP جاهز
- [ ] `public_html/` فارغ أو تم تنظيفه
- [ ] ملفات WordPress مرفوعة
- [ ] `wp-content/plugins/` مرفوع
- [ ] `wp-content/themes/bizgen/` مرفوع
- [ ] `wp-content/themes/bizgen-child/` مرفوع
- [ ] `wp-content/uploads/` مرفوع (الصور)
- [ ] الصلاحيات محدثة (755 للمجلدات، 644 للملفات)

---

## المرحلة 6: wp-config.php

- [ ] `wp-config.php` محدث بإعدادات قاعدة البيانات
- [ ] Debug Mode معطل
- [ ] SSL مفعّل (إن وجد)

---

## المرحلة 7: الفحص

- [ ] https://taseeswaesdar.com يعمل
- [ ] https://taseeswaesdar.com/wp-admin يعمل
- [ ] تسجيل الدخول ناجح
- [ ] جميع الصور تظهر
- [ ] الثيم (bizgen-child) نشط
- [ ] جميع الروابط تعمل

---

## المرحلة 8: التحسينات

- [ ] Permalinks محدثة
- [ ] Search Engines غير محظورة
- [ ] نسخة احتياطية محفوظة

---

## 🎉 انتهى!

إذا كل شيء ✅، المشروع مرفوع بنجاح! 🚀
