@echo off
title Backup and zip.
echo back and zip database
php artisan backup:run --only-db
exit