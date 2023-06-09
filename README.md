# BookLib

## Configure Booklib to Autonomus database oracle On Windows
What We Need?

- XAMMP
- Oracle Instant Client 
- PHP Oci8

*******
Tables of contents  
 1. [XAMPP](#xampp)
 2. [Oracle Instant Client](#oracle)
 3. [PHP Oci8](#php)
*******

<div id='xampp'/> 

### XAMP
For XAMPP we need xampp with php version that support php oci8 extension so here list xampp that we could use
- **[*XAMMP 8.1*](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.1.0/)**
- **[*XAMMP 8.0*](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.0.28/)** 

for more information click [here](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/).

You can just install xampp normaly.
<div id='oracle'/> 

### Oracle Instant Client
For Instant Client we recomend using the newest available version, that supported by you os 
- **[*Windows x64*](https://www.oracle.com/database/technologies/instant-client/winx64-64-downloads.html)**
- **[*Windows x32*](https://www.oracle.com/database/technologies/instant-client/microsoft-windows-32-downloads.html)**

What you need to install is ***Basic Package*** and ***Sqlplus Package***.
1. After all package downloaded, unzip them all. These 2 package will exctracted onto the same folder which is `instantclient_21_10`
2. Move `instantclient_21_10` folder into your `C:\` disk, just so it's easier to keep track of
3. Next we need to add `ORACLE_HOME` into your environtment variables.
4. Open your environtment variables setting and in **System Variables** add new variables `ORACLE_HOME` with value `C:\instantclient_21_10`
5. Still in **System Variables** edit path variables then add new entry with value `C:\instantclient_21_10`

But to acces autonomus database by oracle you need to have wallet. You can get your wallet by download on your adb console or conntacting your database admin.
1. If you already have wallet you just need to unzip it in folder `ORACLE_HOME\network\admin` example `C:\instantclient_21_10\network\admin`
2. then open **sqlnet.ora** changes `DIRECTORY=` line into your `ORACLE_HOME\network\admin` example `C:\instantclient_21_10\network\admin`
3. Open your environtment variables setting and in **System Variables** add new variables `TNS_ADMIN` with value `%ORACLE_HOME%\network\admin`
4. You can check your **tnsnames.ora** inside it's a connection string that needed to acces adb

With this you are set to go. If you want to check Instant client you can use sqlplus in command promt.
>**`sqlplus -l admin@booklibdb1_high`** booklibdb1_high is one off entry in **tnsnames.ora**, you need a password to login this. 

<div id='php'/> 

### PHP Oci8
You can use Oci8 to acces your adb with php. You can download this extension from [pecl](https://pecl.php.net/package/oci8).
```diff
Use oci8-3.2.1 for PHP 8.1.
Use oci8-3.0.1 for PHP 8.0.
```
What you need to pay attention to your php **Thread Safety** you can check it in `phpinfo()` just search Thread Safety. Then install oci8 according that and your windows 64 ord 86.
1. After you downloaded oci8 extension, you can extract it 
2. Copy every file that have **.dll** ext into `(YourEXAMMPFolder)\php\ext\`
3. then open your **php.ini** and on section *Dynamic Extensions* you can uncomment or add `extension=oci8_19` you can just change *19* into *12c* if you use 12c database
4. Done

now you can use func `oci_connect()` in your code for the example you can check [this file](https://github.com/zaaii/BookLib/blob/cloud/example.php)


## Configure Booklib On Your Cloud
>**You can use any cloud service provider but we use Oracle Cloud**

### Configure Booklib in Oracle Cloud Instance
We would be using Instance that installed with **Oracle Linux8** image.
To run booklib in oracle linux8 we need a feew package.

- Php8
- Apache or Nginx (We use apache)
- Oracle Instant client with sqlplus & sdk
- Git

*******
Tables of contents  
 1. [Php8](#php8)
 2. [Apache](#apache)
 3. [Oracle Instant Client](#iccloud)
 4. [Git](#git)
*******

<div id='php8'/> 

### Install & configure php8 on Oracle Linux8
Because booklib is a php based web app so we need php installed to run it.
We recomending suggest using php 8.

1. Connect to your instance using ssh or telnet
2. first before we do anything you need to update dnf 
```diff
sudo dnf update
```
4. Install php 8 using module arggument on dnf 
```diff
sudo dnf module install php:8.0
```
6. You can check if php8 is already installed.
```diff
sudo dnf module list php 
php -v
```
5. Then you can install all php feature 
```diff
sudo dnf install -y php-cli php-fpm php-mysqlnd php-zip php-devel php-gd php-mbstring php-curl php-xml php-pear
```
8. You can check if php-pear already install with 
```diff
pecl version
```

<div id='apache'/> 

### Install & configure Apache on Oracle Linux8

1. To install apache you need to install it with dnf 
```diff
sudo dnf install httpd
```

3. You need to Enable HTTP and HTTPS connection through port 80 and 443 
```diff
sudo firewall-cmd --add-service=http --permanent 
sudo firewall-cmd --add-service=https --permanent
```

4. Then you can reload the firewall 
```diff
sudo firewall-cmd --reload
```

6. You need to enable and start apache service 
```diff
sudo systemctl enable httpd  
sudo systemctl start httpd
```

7. You can just check it in web browser

8. To verify php installation on apache you need to make **info.php** file in `/var/www/html/` with content like below
```diff
<?php
phpinfo();
?>
```

9. next you need to make sure apache only index file **index.php** and **index.html** you need to insert line below into `/etc/httpd/conf.d/welcome.conf` inside line `<LocationMatch "^/+$"> ... </LocationMatch>`
```diff
DirectoryIndex index.php index.html
```

> **Note**: For Devlopment purpose you can active directory listing in your apache cofig file `/etc/httpd/conf.d/welcome.conf` and change **Options** (**-**) into (**+**) just remember to turn it off when it's done with devlopment
```diff
Options +Indexes
```
