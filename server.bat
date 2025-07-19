@echo off

echo Lancement de l'application KIWEZA

set ip=%1

php artisan serve --port 7070

set /p exitkey="Appuyer sur une touche pour quitter"
