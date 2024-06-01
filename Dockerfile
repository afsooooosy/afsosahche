# استخدم صورة PHP الرسمية مع Apache
FROM php:7.4-apache

# نسخ محتويات المشروع إلى دليل الجذر في الخادم
COPY . /var/www/html/

# إعداد الدليل الافتراضي للنشر
WORKDIR /var/www/html

# فتح المنفذ 80 للخادم
EXPOSE 80
