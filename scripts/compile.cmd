@echo off
@SetLocal EnableDelayedExpansion

set BASEDIR=%~dp0

cd %BASEDIR%

rem App builder
set /P APPID=Give me app id : 
cd ../tools/grunt/
call grunt snapshot --app=%APPID%
pause