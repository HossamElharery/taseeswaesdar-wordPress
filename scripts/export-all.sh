#!/bin/bash

# سكريبت شامل لتصدير كل شيء من Docker
# يصدر: قاعدة البيانات + الملفات + الصور + كل شيء

echo "🚀 بدء تصدير المشروع الكامل من Docker..."
echo ""

# إنشاء مجلد للتصدير
EXPORT_DIR="export_$(date +%Y%m%d_%H%M%S)"
mkdir -p "$EXPORT_DIR"

echo "📁 تم إنشاء مجلد التصدير: $EXPORT_DIR"
echo ""

# 1. تصدير قاعدة البيانات
echo "📦 تصدير قاعدة البيانات..."
source .env 2>/dev/null || {
    DB_USER="wordpress_user"
    DB_PASSWORD="wordpress_password_123"
    DB_NAME="wordpress"
}

docker compose exec -T db mysqldump -u "${WORDPRESS_DB_USER:-$DB_USER}" \
    -p"${WORDPRESS_DB_PASSWORD:-$DB_PASSWORD}" \
    "${WORDPRESS_DB_NAME:-$DB_NAME}" > "$EXPORT_DIR/database.sql"

if [ $? -eq 0 ]; then
    echo "✅ تم تصدير قاعدة البيانات: $EXPORT_DIR/database.sql"
    echo "   الحجم: $(du -h "$EXPORT_DIR/database.sql" | cut -f1)"
else
    echo "❌ فشل تصدير قاعدة البيانات"
    exit 1
fi
echo ""

# 2. نسخ الملفات من الحاوية
echo "📂 نسخ الملفات من WordPress container..."

# نسخ wp-content بالكامل (plugins, themes, uploads)
docker compose cp wordpress:/var/www/html/wp-content "$EXPORT_DIR/wp-content"

if [ $? -eq 0 ]; then
    echo "✅ تم نسخ wp-content"
    echo "   الحجم: $(du -sh "$EXPORT_DIR/wp-content" | cut -f1)"
else
    echo "❌ فشل نسخ wp-content"
fi
echo ""

# 3. نسخ wp-config.php
echo "📄 نسخ wp-config.php..."
docker compose cp wordpress:/var/www/html/wp-config.php "$EXPORT_DIR/wp-config.php" 2>/dev/null
if [ $? -eq 0 ]; then
    echo "✅ تم نسخ wp-config.php"
else
    echo "⚠️  لم يتم العثور على wp-config.php (قد يكون في المجلد المحلي)"
    # نسخ من المجلد المحلي إن وجد
    if [ -f "wordpress/wp-config.php" ]; then
        cp wordpress/wp-config.php "$EXPORT_DIR/wp-config.php"
        echo "✅ تم نسخ wp-config.php من المجلد المحلي"
    fi
fi
echo ""

# 4. إنشاء ملف معلومات
echo "📝 إنشاء ملف المعلومات..."
cat > "$EXPORT_DIR/README.txt" << EOF
تصدير مشروع WordPress
=====================

التاريخ: $(date)
المجلد: $EXPORT_DIR

المحتويات:
----------
1. database.sql - قاعدة البيانات الكاملة
2. wp-content/ - جميع الملفات (plugins, themes, uploads)
3. wp-config.php - ملف الإعدادات

للرفع على هوستنجر:
------------------
1. ارفع wp-content/ إلى public_html/wp-content/
2. ارفع wp-config.php إلى public_html/
3. استورد database.sql في phpMyAdmin
4. حدث URLs في قاعدة البيانات (استخدم scripts/update-urls.sql)

ملاحظات:
--------
- جميع الصور موجودة في wp-content/uploads/
- جميع Plugins موجودة في wp-content/plugins/
- جميع Themes موجودة في wp-content/themes/
- Licenses موجودة في wp-content/themes/[theme-name]/ أو plugins/[plugin-name]/

EOF

echo "✅ تم إنشاء ملف المعلومات: $EXPORT_DIR/README.txt"
echo ""

# 5. إنشاء ملف ZIP (اختياري)
echo "📦 إنشاء ملف ZIP..."
zip -r "$EXPORT_DIR.zip" "$EXPORT_DIR" > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "✅ تم إنشاء ملف ZIP: $EXPORT_DIR.zip"
    echo "   الحجم: $(du -h "$EXPORT_DIR.zip" | cut -f1)"
else
    echo "⚠️  فشل إنشاء ZIP (قد لا يكون zip مثبتاً)"
fi
echo ""

# ملخص
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "✅ تم التصدير بنجاح!"
echo ""
echo "📊 الملخص:"
echo "   - قاعدة البيانات: $EXPORT_DIR/database.sql"
echo "   - الملفات: $EXPORT_DIR/wp-content/"
echo "   - الإعدادات: $EXPORT_DIR/wp-config.php"
echo ""
echo "📁 المجلد الكامل: $EXPORT_DIR"
if [ -f "$EXPORT_DIR.zip" ]; then
    echo "📦 ملف ZIP: $EXPORT_DIR.zip"
fi
echo ""
echo "💡 الآن يمكنك رفع محتويات $EXPORT_DIR على هوستنجر"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

