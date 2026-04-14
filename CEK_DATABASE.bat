@echo off
title Pemeriksa Database - Randi Sahputra
echo ======================================================================
echo   PEMERIKSA DATABASE PORTOFOLIO
echo ======================================================================
echo.

set MYSQL_PATH=C:\xampp\mysql\bin\mysql.exe

if not exist "%MYSQL_PATH%" (
    echo [ERROR] MySQL XAMPP tidak ditemukan di C:\xampp.
    echo Pastikan XAMPP terpasang di C:\xampp.
    pause
    exit
)

echo [1/3] Memeriksa Database: skripsi_qorry...
"%MYSQL_PATH%" -u root -e "use skripsi_qorry" 2>nul
if %errorlevel% equ 0 (echo [OK] skripsi_qorry ditemukan.) else (echo [!!] skripsi_qorry TIDAK ADA.)

echo [2/3] Memeriksa Database: db_jne...
"%MYSQL_PATH%" -u root -e "use db_jne" 2>nul
if %errorlevel% equ 0 (echo [OK] db_jne ditemukan.) else (echo [!!] db_jne TIDAK ADA.)

echo [3/3] Memeriksa Database: skripsi_agel...
"%MYSQL_PATH%" -u root -e "use skripsi_agel" 2>nul
if %errorlevel% equ 0 (echo [OK] skripsi_agel ditemukan.) else (echo [!!] skripsi_agel TIDAK ADA.)

echo.
echo ----------------------------------------------------------------------
echo Jika ada database yang TIDAK ADA, silakan buka phpMyAdmin dan IMPORT:
echo 1. skripsi_qorry.sql
echo 2. db_jne.sql
echo 3. skripsi_agel.sql
echo ----------------------------------------------------------------------
pause
