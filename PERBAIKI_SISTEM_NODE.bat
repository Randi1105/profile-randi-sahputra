@echo off
title Node.js System Repair & Install - Randi Sahputra
echo ==================================================
echo   SEDANG MEMPERBAIKI DAN MENGINSTALL SISTEM...
echo ==================================================
echo.
echo [INFO] Harap pastikan Anda terhubung ke INTERNET.
echo [INFO] Proses ini akan membersihkan error dan menginstall ulang.
echo.

:: --- 1. MEMPERBAIKI AI CHATBOT ---
echo [1/2] Memperbaiki AI Chatbot...
cd /d "e:\portofolio randi sahputra\02-ai-chatbot"
if exist "node_modules\" (
    echo Menghapus folder lama...
    rd /s /q "node_modules"
)
if exist "package-lock.json" (
    del /f /q "package-lock.json"
)
echo Sedang mengunduh bahan baru (Chatbot)...
call npm install --force
echo [OK] Chatbot SELESAI.
echo.

:: --- 2. MEMPERBAIKI NOVAMART ---
echo [2/2] Memperbaiki NovaMart E-Commerce...
cd /d "e:\ecommers"
if exist "node_modules\" (
    echo Menghapus folder lama...
    rd /s /q "node_modules"
)
if exist "package-lock.json" (
    del /f /q "package-lock.json"
)
echo Sedang mengunduh bahan baru (NovaMart - Next.js 15)...
call npm install --force
echo Menyiapkan database Prisma...
call npx prisma generate
echo [OK] NovaMart SELESAI.
echo.

echo ==================================================
echo   PERBAIKAN DAN INSTALASI BERHASIL!
echo ==================================================
echo.
echo Sekarang Anda bisa menyalakan proyek menggunakan:
echo 1. JALANKAN_NOVAMART.bat (untuk E-Commerce)
echo 2. npm start (di folder Chatbot)
echo.
pause
