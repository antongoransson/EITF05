# EITF05
Projekt i Webbsäkerhet EITF05

* Install sqlite3 for php
* Create database
```
sqlite3 db.db < ../webseq.sql
```
* Set www-data to owner of folder and db (the apache server)
```
sudo chown www-data:www-data html
sudo chown www-data:www-data html/db.db
```
* Change path in html/app/Config to the path to your db
