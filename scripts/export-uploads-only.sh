#!/bin/bash

# سكريبت لتصدير الصور والملفات المرفوعة فقط

echo "📸 تصدير الصور والملفات المرفوعة..."

EXPORT_DIR="uploads_export_$(date +%Y%m%d_%H%M%S)"
mkdir -p "$EXPORT_DIR"

# نسخ مجلد uploads فقط
docker compose cp wordpress:/var/www/html/wp-content/uploads "$EXPORT_DIR/uploads"

if [ $? -eq 0 ]; then
    echo "✅ تم تصدير الصور: $EXPORT_DIR/uploads"
    echo "   الحجم: $(du -sh "$EXPORT_DIR/uploads" | cut -f1)"
    echo "   عدد الملفات: $(find "$EXPORT_DIR/uploads" -type f | wc -l)"
    echo ""
    echo "💡 يمكنك الآن رفع محتويات $EXPORT_DIR/uploads إلى public_html/wp-content/uploads/"
else
    echo "❌ فشل تصدير الصور"
    exit 1
fi

