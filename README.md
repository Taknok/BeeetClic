# BeeetClic

## Tuto install

Faire :
```
sudo apt update
sudo apt install nginx
sudo apt install php-fpm mysql-server
sudo apt install phpmyadmin
```
- [tab]
- [entrer]
- Oui
- password
- password
```
rm -rf /usr/share/nginx/www
sudo ln -s /usr/share/phpmyadmin/ /var/www/html/phpmyadmin
sudo nano /etc/nginx/sites-available/default
```
Editer pour obtenir cela :
![img](https://i.imgur.com/zsj8CUI.png)

```
sudo service php7.0-fpm restart
sudo service nginx restart

sudo mysql --user=root mysql
GRANT ALL PRIVILEGES ON *.* TO 'phpmyadmin'@'localhost'  WITH GRANT OPTION;
FLUSH PRIVILEGES;
quit

sudo service mysql restart

git clone https://github.com/Taknok/BeeetClic.git
```

aller sur : http://MON_IP/phpmyadmin
- se co avec user : phpmyadmin et password
- databases
- creer une nouvelle base `site`
- selectionner la table (gauche)
- import
- importer site(2).sql
- 3 tables sont normalements créées


faire :
```
sudo apt-get install ssmtp
sudo nano /etc/ssmtp/ssmtp.conf

mailhub=smtp.gmail.com:587
UseSTARTTLS=YES
FromLineOverride=YES
AuthUser=login_gmail
AuthPass=password_gmail

sudo nano /etc/ssmtp/revaliases 

root:username@gmail.com:smtp.gmail.com:587
[user]:username@gmail.com:smtp.gmail.com:587

nano BeeetClic/site/php/config.php

$GLOBALS['dbUser'] = 'phpmyadmin';
$GLOBALS['dbPass'] = 'password';
$GLOBALS['dbName'] = 'site';


sudo cp -r BeeetClic/site/* /var/www/html/
```
aller a http://MON_IP/home.php

> Et ya pas windows ? Si cherche j'ai la flemme
