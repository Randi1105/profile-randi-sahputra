@echo off
title Portfolio Diagnostic System - Randi Sahputra
echo ======================================================================
echo   SISTEM DIAGNOSTIK PORTOFOLIO RANDI SAHPUTRA
echo ======================================================================
echo.

echo [1/3] Memeriksa Koneksi Port...
set ports=3000 3001 4001 8001 8002 8003
for %%p in (%ports%) do (
    netstat -ano | findstr :%%p > nul
    if !errorlevel! == 0 (
        echo [OK] Port %%p sedang digunakan ^(Server aktif^).
    ) else (
        echo [!!] Port %%p kosong ^(Server tidak aktif^).
    )
)
echo.

echo [2/3] Memeriksa Path Proyek...
if exist "e:\portofolio randi sahputra\02-ai-chatbot" (echo [OK] Chatbot folder ada.) else (echo [!!] Chatbot folder hilang!)
if exist "e:\ecommers" (echo [OK] NovaMart folder ada.) else (echo [!!] NovaMart folder hilang!)
if exist "e:\portofolio randi sahputra\Qorry-PSI" (echo [OK] Qorry-PSI folder ada.) else (echo [!!] Qorry-PSI folder hilang!)
echo.

echo [3/3] Memeriksa Database PHP...
echo Catatan: Pastikan XAMPP MySQL Anda berwarna HIJAU sebelum menjalankan proyek PHP.
echo Database yang harus ada:
echo - skripsi_qorry   ^(Qorry-PSI^)
echo - db_jne          ^(SPK-Randi^)
echo - skripsi_agel    ^(Tara-WP^)
echo.

echo ----------------------------------------------------------------------
echo Jika ada [!!], silakan jalankan JALANKAN_SEMUA.bat untuk memulai.
echo ----------------------------------------------------------------------
pause
