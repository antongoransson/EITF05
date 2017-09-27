# EITF05
Projekt i Webbsäkerhet EITF05

* Put env.php file in folder outside of html folder with url to db

# Perfom SQL-injection

* Register user with a username such as: a' OR 'x'='x
* Change putOrders($username) in html/sql/db.php
* Add:

```
$sql= "SELECT * from Orders where username='$username'";
$ret= $this->pdo->query($sql);
foreach ($ret as $row) {
	$items[]=$row;
}

```
* Remove:

```
$statement = $this->pdo->prepare("SELECT * from Orders WHERE username=:username");
$statement->bindValue(':username', $username, \PDO::PARAM_STR);
$ret = $statement->execute();
while($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
 $items[]=$row;
}
```

* Now go to "Beställningar" and see what everybody has ordered!(spooky)

# XSS Attack

* Create a user with username such as:
```
<script>
document.body.innerHTML=
 '<iframe src="https://antongoransson.github.io"
 width="100%"
 height="90%"
 frameborder="0" />';
</script>
```
* Remove for example the following code in header in checkout.php: (You might need
	to comment the $username line in addUser in db.php also)

```
htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8');
```
* Replace it with : $\_SESSION["username"]

* Now enter the checkout page and see what happens! (spooky)

# CSFR attack

* Remove csrf_check($\_POST['csrf']) in index.php and receipt.php

* Create website that adds items to cart through form and visits receipt.php (https://antongoransson.github.io does this to https://localhost)

* Open a tab of the shop and login, now visit your hacker-site

* Go to "Beställningar" and see some weird orders that you didn't do! (spooky)

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
