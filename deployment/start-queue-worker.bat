@echo off
REM Start the Laravel queue worker for local development (Windows).
REM Keep this window open while testing payment proof uploads.
cd /d "%~dp0.."
php artisan queue:work database --sleep=1 --tries=3 --timeout=90
