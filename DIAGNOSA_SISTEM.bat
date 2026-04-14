@echo off
title Diagnosa Sistem Portofolio - Randi Sahputra
echo ======================================================================
echo   DIAGNOSA SISTEM PORTOFOLIO (Next.js, PHP, Node.js)
echo ======================================================================
echo.

:: 1. Cek Folder Projek
echo [1/3] Memeriksa Folder Proyek...
set folders="e:\ecommers" "e:\portofolio randi sahputra\02-ai-chatbot" "e:\portofolio randi sahputra\Qorry-PSI" "e:\portofolio randi sahputra\SPK-Randi" "e:\portofolio randi sahputra\Tara-WP"
for %%f in (%folders%) do (
    if exist %%f (
        echo [OK] %%f ditemukan.
    ) else (
        echo [!!] %%f TIDAK DITEMUKAN!
    )
)
echo.

:: 2. Cek Koneksi MySQL dan Database
echo [2/3] Memeriksa Database MySQL (XAMPP)...
set DB_MYSQL=C:\xampp\mysql\bin\mysql.exe
if not exist "%DB_MYSQL%" (
    echo [ERROR] MySQL XAMPP tidak ditemukan di C:\xampp. Pastikan XAMPP terpasang.
) else (
    echo [OK] Executable MySQL ditemukan.
    
    echo Mencoba koneksi ke database...
    "%DB_MYSQL%" -u root -e "use skripsi_qorry" 2>nul && (echo [OK] skripsi_qorry siap.) || (echo [!!] skripsi_qorry BELUM DI-IMPORT!)
    "%DB_MYSQL%" -u root -e "use db_jne" 2>nul && (echo [OK] db_jne siap.) || (echo [!!] db_jne BELUM DI-IMPORT!)
    "%DB_MYSQL%" -u root -e "use skripsi_agel" 2>nul && (echo [OK] skripsi_agel siap.) || (echo [!!] skripsi_agel BELUM DI-IMPORT!)
)
echo.

:: 3. Cek Port yang Sedang Digunakan
echo [3/3] Memeriksa Port yang Aktif...
set ports=3000 3333 4001 8001 8002 8003
for %%p in (%ports%) do (
    netstat -ano | findstr :%%p > nul
    if !errorlevel! == 0 (
        echo [SIAP] Port %%p aktif ^(Server sudah jalan^).
    ) else (
        echo [X] Port %%p kosong ^(Server belum jalan^).
    )
)
echo.

echo ----------------------------------------------------------------------
echo Jika ada status [!!] atau [X], silakan jalankan JALANKAN_SEMUA.bat
echo pastikan XAMPP Apache dan MySQL dalam keadaan RUNNING (HIJAU).
echo ----------------------------------------------------------------------
pause
