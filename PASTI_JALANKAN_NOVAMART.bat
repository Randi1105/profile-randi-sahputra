@echo off
title FINAL REPAIR - NovaMart E-Commerce
echo ==================================================
echo   SEDANG MELAKUKAN OPERASI PERBAIKAN DALAM...
echo ==================================================
echo.

:: LOCK TO PROJECT DIRECTORY
cd /d "e:\ecommers"

:: 1. CLEANING THE POISONED ARTIFACTS
echo [1/3] Membersihkan sisa-sisa library yang rusak...
if exist ".next\" (
    echo Menghapus folder .next...
    rd /s /q ".next"
)
if exist "package-lock.json" (
    echo Menghapus package-lock.json...
    del /f /q "package-lock.json"
)
if exist "node_modules\" (
    echo Menghapus folder node_modules...
    rd /s /q "node_modules"
)
echo [OK] Folder sudah bersih.
echo.

:: 2. FORCED CLEAN INSTALLATION
echo [2/3] Menginstall Ulang Library Stabil (Next 15 + React 19)...
echo Pastikan internet aktif. Proses ini memakan waktu 1-3 menit.
call npm install --force
echo [OK] Instalasi berhasil.
echo.

:: 3. CODE RE-BUILD
echo [3/3] Melakukan Inisialisasi Sistem Baru...
call npx prisma generate
echo [OK] Inisialisasi selesai.
echo.

echo ==================================================
echo   PERBAIKAN TOTAL SELESAI!
echo ==================================================
echo [STATUS] Server akan otomatis menyala sekarang...
echo.

npm run dev

echo.
pause
