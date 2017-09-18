# EITF05
Projekt i Webbsäkerhet EITF05

* Install sqlite3 for php
* Create database folder in same folder as html and put db in there
```
sqlite3 phpsqlite.db < ../webseq.sql
```
* Set www-data (the apache server) to owner of folder and db (If you're not using the standard directory)
```
sudo chown www-data:www-data html
sudo chown www-data:www-data db
sudo chown www-data:www-data /db/phpsqlite.db
```
* Change path in html/sql/Config.php to the path to your db
