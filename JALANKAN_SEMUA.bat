@echo off
setlocal enabledelayedexpansion
title PORTFOLIO MASTER LAUNCHER - Randi Sahputra

echo ======================================================================
echo   PENYALAN SEMUA SISTEM (Next.js, PHP, Node.js)
echo   STATUS: OPTIMASI FINAL (SNEAKER.HUB ^& NOVAMART RENAMED)
echo ======================================================================
echo.

:: 0. Clean up existing processes to avoid "Port in use"
echo [0] Membersihkan sisa server sebelumnya...
taskkill /f /im node.exe /fi "WINDOWTITLE eq Portfolio*" 2>nul
taskkill /f /im node.exe /fi "WINDOWTITLE eq NovaMart*" 2>nul
taskkill /f /im node.exe /fi "WINDOWTITLE eq SNEAKER.HUB*" 2>nul
taskkill /f /im node.exe /fi "WINDOWTITLE eq NOVAMART*" 2>nul
taskkill /f /im node.exe /fi "WINDOWTITLE eq AI-CHATBOT*" 2>nul

:: 1. Next.js Portfolio Utama (Port 3333)
echo [1/7] Menjalankan PORTFOLIO UTAMA (Port 3333)...
start "Portfolio-Utama" cmd /k "cd /d "C:\Users\Randi Saputra\.gemini\antigravity\scratch\portofolio-nextjs" && npm run dev -- -p 3333"

timeout /t 3 /nobreak > nul

:: 2. SNEAKER.HUB (Port 3000)
echo [2/7] Menjalankan SNEAKER.HUB (Port 3000)...
start "SNEAKER.HUB" cmd /k "cd /d "e:\ecommers" && npm run dev"

:: 3. AI Chatbot (Port 4001)
echo [3/7] Menjalankan 02-AI-CHATBOT (Port 4001)...
start "AI-CHATBOT" cmd /k "cd /d "e:\portofolio randi sahputra\02-ai-chatbot" && node app.js"

:: 4. NOVAMART Admin (Port 4002)
echo [4/7] Menjalankan NOVAMART Admin (Port 4002)...
start "NOVAMART" cmd /k "cd /d "e:\portofolio randi sahputra\project-1-admin" && node app.js"

:: 5. Qorry-PSI (Port 8001)
echo [5/7] Menjalankan QORRY-PSI (Port 8001)...
start "Qorry-PSI" cmd /k "cd /d "e:\portofolio randi sahputra\Qorry-PSI" && C:\xampp\php\php.exe -S localhost:8001"

:: 6. SPK-Randi (Port 8002)
echo [6/7] Menjalankan SPK-RANDI (Port 8002)...
start "SPK-Randi" cmd /k "cd /d "e:\portofolio randi sahputra\SPK-Randi" && C:\xampp\php\php.exe -S localhost:8002"

:: 7. Tara-WP (Port 8003)
echo [7/7] Menjalankan TARA-WP (Port 8003)...
start "Tara-WP" cmd /k "cd /d "e:\portofolio randi sahputra\Tara-WP" && C:\xampp\php\php.exe -S localhost:8003"

echo.
echo ======================================================================
echo   SEMUA SERVER BERHASIL DIPROSES!
echo   ----------------------------------------------------------------------
echo   PORT UTAMA: http://localhost:3333
echo   Jika ada jendela CMD yang menutup sendiri, periksa node_modules.
echo ======================================================================
echo.
pause
