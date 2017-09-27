# EITF05
Projekt i Webbsäkerhet EITF05

* Put env.php file in folder outside of html folder with url to db

# Setup SSL

* Enable rewrite and ssl mod

```

sudo a2enmod rewrite

sudo a2enmod ssl

```

* Restart server

```
sudo service apache2 restart
```

* Create folder in apache

```
sudo mkdir /etc/apache2/ssl
```

* Create key and certificate

```
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/apache2/ssl/apache.key -out /etc/apache2/ssl/apache.crt
```

* Open file with root privilegies

```
sudo nano /etc/apache2/sites-available/default-ssl.conf
```
* Change the content to

```
<IfModule mod_ssl.c>
    <VirtualHost _default_:443>
        ServerAdmin webmaster@localhost
        DocumentRoot /yourhtmlpath/html>
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
        SSLEngine on
        SSLCertificateFile /etc/apache2/ssl/apache.crt
        SSLCertificateKeyFile /etc/apache2/ssl/apache.key
        <FilesMatch "\.(cgi|shtml|phtml|php)$">
            SSLOptions +StdEnvVars
        </FilesMatch>
        <Directory /yourhtmlpath/html>
            SSLOptions +StdEnvVars
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
        BrowserMatch "MSIE [2-6]" \
                        nokeepalive ssl-unclean-shutdown \
                        downgrade-1.0 force-response-1.0
        BrowserMatch "MSIE [17-9]" ssl-unclean-shutdown
    </VirtualHost>
</IfModule>
```

* Open conf file
```
sudo nano /etc/apache2/apache2.conf
```

* Find <Directory /pathtoyourhtml/html and change AllowOverride None to AllowOverride All

* Enable ssl and restart

```
sudo a2ensite default-ssl.conf

sudo service apache2 restart

```

* Create .htaccess file in html folder and and add

```
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```
