#!/bin/bash

# سكريبت لتصدير قاعدة البيانات من Docker

echo "📦 تصدير قاعدة البيانات..."

# قراءة الإعدادات من .env
source .env 2>/dev/null || {
    echo "⚠️  ملف .env غير موجود، استخدام القيم الافتراضية"
    DB_USER="wordpress_user"
    DB_PASSWORD="wordpress_password_123"
    DB_NAME="wordpress"
}

# اسم ملف النسخة الاحتياطية
BACKUP_FILE="database_backup_$(date +%Y%m%d_%H%M%S).sql"

# تصدير قاعدة البيانات
docker compose exec -T db mysqldump -u "${WORDPRESS_DB_USER:-$DB_USER}" \
    -p"${WORDPRESS_DB_PASSWORD:-$DB_PASSWORD}" \
    "${WORDPRESS_DB_NAME:-$DB_NAME}" > "$BACKUP_FILE"

if [ $? -eq 0 ]; then
    echo "✅ تم تصدير قاعدة البيانات بنجاح: $BACKUP_FILE"
    echo "📊 حجم الملف: $(du -h "$BACKUP_FILE" | cut -f1)"
else
    echo "❌ فشل تصدير قاعدة البيانات"
    exit 1
fi

