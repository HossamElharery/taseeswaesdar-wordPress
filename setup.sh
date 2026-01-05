#!/bin/bash

# Script to setup Bizgen WordPress Theme with Docker
# This script automates the initial setup process

echo "🚀 بدء إعداد بيئة Bizgen WordPress Theme..."

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ خطأ: Docker غير قيد التشغيل. يرجى تشغيل Docker Desktop أولاً."
    exit 1
fi

echo "✅ Docker يعمل بشكل صحيح"

# Create necessary directories
echo "📁 إنشاء المجلدات المطلوبة..."
mkdir -p wordpress
mkdir -p themes
mkdir -p plugins

# Create .env file if it doesn't exist
if [ ! -f .env ]; then
    echo "📝 إنشاء ملف .env..."
    cp .env.example .env
    echo "✅ تم إنشاء ملف .env"
else
    echo "ℹ️  ملف .env موجود بالفعل"
fi

# Extract themes if zip files exist
if [ -f bizgen.zip ]; then
    echo "📦 استخراج الثيم الرئيسي..."
    unzip -q -o bizgen.zip -d themes/ 2>/dev/null || echo "⚠️  قد تحتاج لاستخراج bizgen.zip يدوياً"
fi

if [ -f bizgen-child.zip ]; then
    echo "📦 استخراج الثيم الفرعي..."
    unzip -q -o bizgen-child.zip -d themes/ 2>/dev/null || echo "⚠️  قد تحتاج لاستخراج bizgen-child.zip يدوياً"
fi

# Start Docker containers
echo "🐳 تشغيل Docker containers..."
docker-compose up -d

# Wait for WordPress to be ready
echo "⏳ انتظار تهيئة WordPress (هذا قد يستغرق دقيقة أو دقيقتين)..."
sleep 10

# Check if containers are running
if docker ps | grep -q bizgen-wordpress; then
    echo "✅ تم تشغيل الحاويات بنجاح!"
    echo ""
    echo "🎉 الإعداد مكتمل!"
    echo ""
    echo "📍 الروابط المهمة:"
    echo "   - الموقع: http://localhost:8080"
    echo "   - لوحة التحكم: http://localhost:8080/wp-admin"
    echo "   - phpMyAdmin: http://localhost:8081"
    echo ""
    echo "📋 الخطوات التالية:"
    echo "   1. افتح http://localhost:8080 في المتصفح"
    echo "   2. أكمل إعداد WordPress"
    echo "   3. ثبّت الثيم من: المظهر > الثيمات"
    echo "   4. ثبّت الإضافات المطلوبة"
    echo ""
    echo "📖 للمزيد من التفاصيل، راجع ملف README-AR.md"
else
    echo "❌ حدث خطأ في تشغيل الحاويات"
    echo "🔍 راجع السجلات باستخدام: docker-compose logs"
    exit 1
fi

