@echo off
title NovaMart E-Commerce Activator
echo ==================================================
echo   SEDANG MENYIAPKAN NOVAMART E-COMMERCE...
echo ==================================================
echo.

:: 1. Cek Node.js & NPM
echo [1/3] Mengecek Lingkungan Sistem...
node -v >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Node.js tidak ditemukan!
    echo Silakan install Node.js dari https://nodejs.org/ terlebih dahulu.
    pause
    exit
)
echo [OK] Node.js terdeteksi.
echo.

:: 2. Masuk ke Folder Proyek
echo [2/3] Masuk ke direktori proyek...
cd /d "e:\ecommers"
if %errorlevel% neq 0 (
    echo [ERROR] Gagal masuk ke folder e:\ecommers.
    echo Pastikan folder tersebut ada.
    pause
    exit
)
echo [OK] Direktori ditemukan.
echo.

:: 3. Cek node_modules
echo [3/3] Memeriksa Bahan-bahan (Dependencies)...
if not exist "node_modules\" (
    echo [INFO] Folder node_modules tidak ditemukan.
    echo Sedang mengunduh library stabil (Next 15 + Prisma 6)...
    echo Harap tunggu, ini memerlukan koneksi internet.
    npm install --force
    echo.
)

echo [OK] Semua siap!
echo [READY] Menyalakan server NovaMart di Port 3000...
echo.

:: Start Next.js Development Server
npm run dev

echo.
echo ==================================================
echo   SERVER NOVAMART TELAH BERHENTI.
echo ==================================================
pause
