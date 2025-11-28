@echo off
cd /d C:\xampp\htdocs\Event-Booking-System-in-Laravel-8-master

echo Menjalankan Laravel Scheduler...
php artisan schedule:work

pause