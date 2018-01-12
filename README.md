# BeeetClic

## Tuto install

Faire :
```
sudo apt update
sudo apt install nginx php mysql-server
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
```

```
git clone https://github.com/Taknok/BeeetClic.git
```

aller sur : http://MON_IP/phpmyadmin
- se co avec user : phpmyadmin et le mdp
- creer une nouvelle base
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

sudo cp -r BeeetClic/site/* /var/www/html/
```
aller a http://MON_IP/home.php

> Et ya pas windows ? Si cherche j'ai la flemme
