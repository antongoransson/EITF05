# EITF05
Projekt i Webbsäkerhet EITF05

* Install sqlite3 for php
* Create database
```
sqlite3 db.db < ../webseq.sql
```
* Set www-data to owner of folder and db
```
chown www-data:www-data html
chown www-data:www-data html/db.db
```
