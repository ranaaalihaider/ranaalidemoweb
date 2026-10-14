@echo off
title Ali Haider Portfolio - Local Server
cd /d "%~dp0"

echo ====================================================
echo       ALI HAIDER - SOFTWARE ENGINEER PORTFOLIO
echo           COMSATS UNIVERSITY ISLAMABAD
echo ====================================================
echo.
echo [*] Document Root: public/
echo [*] Starting PHP local development server...
echo [*] URL: http://127.0.0.1:8000
echo [*] Launching Google Chrome...
echo.
echo Note: Keep this terminal window open while previewing.
echo Press Ctrl + C to stop the server when done.
echo ====================================================
echo.

:: Launch Google Chrome (or default browser fallback) after a 1-second delay to let server bind
start "" cmd /c "timeout /t 1 /nobreak >nul & (start chrome http://127.0.0.1:8000 2>nul || start http://127.0.0.1:8000)"

:: Start PHP Server serving from the 'public' directory
php -S 127.0.0.1:8000 -t public

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo [ERROR] Could not start PHP server.
    echo Please verify that PHP is installed and available in your system PATH.
    pause
)
