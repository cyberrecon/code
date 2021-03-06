#sudo rpm -Uvh http://download.fedoraproject.org/pub/epel/6/i386/epel-release-6-8.noarch.rpm

sudo rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm

sudo yum -y install mysql mysql-server

sudo /etc/init.d/mysqld restart

sudo /usr/bin/mysql_secure_installation

#
# first install nginx
#
sudo su -c 'rpm -Uvh http://nginx.org/packages/rhel/6/noarch/RPMS/nginx-release-rhel-6-0.el6.ngx.noarch.rpm'
yum -y install nginx
#
# Install the /etc/nginx/nginx.conf from Configuration Management
#
# Install /etc/nginx/conf.d/default.conf from Configuration Management
#
# Install /etc/nginx/conf.d/ssl.conf from Configuration Management
#
# Install /etc/nginx/conf.d/virtual.conf from Configuration Management
#

# Create SSL Server Ket and Certificate Signing Request
#
# For this i chose godaddy becuase the provide chained domain only certs
# but since we are not selling anything, just blogging, we'll use a self-signed
# cert

sudo mkdir /etc/nginx/ssl && cd /etc/nginx/ssl
sudo openssl genrsa -out server.key 2048
sudo openssl req -new -key server.key -out server.csr
sudo openssl x509 -req -days 365 -in server.csr -signkey server.key -out server.crt

#
# Note that nginx.conf file is loaded from config mgmt
# this should point to the keys and cert you generated
#

/etc/rc.d/init.d/nginx start

#sudo yum -y install nginx

#sudo /etc/init.d/nginx start

sudo yum --enablerepo=remi install php-fpm php-mysql

printf ":g/cgi.fix_pathinfo=/d\nw\nq\n" |ex /etc/php.ini
cat << 'EOF' >> /etc/php.ini
cgi.fix_pathinfo=0
EOF
#
## sudo vi /etc/nginx/nginx.conf
##Raise the number of worker processes to 4 then save and exit that file.
#printf ":g/worker_processes /d\nw\nq\n" |ex /etc/nginx/nginx.conf
#cat << 'EOF' >> /etc/nginx/nginx.conf
#worker_processes 4;
#EOF
#
#
#sudo vi /etc/nginx/conf.d/default.conf
#+---
#|
    #Add index.php within the index line.
    #Change the server_name to your domain name or IP address (replace the example.com in the configuration)
    #Change the root to /usr/share/nginx/html;
    #Uncomment the section beginning with "location ~ \.php$ {",
    #Change the root to access the actual document root, /usr/share/nginx/html;
    #Change the fastcgi_param line to help the PHP interpreter find the PHP script that we stored in the document root home.
#
#|
#+---
# sudo vi /etc/php-fpm.d/www.conf
#+---
#|
#user = nginx
#group = nginx
#|
#+---
#
sudo service php-fpm restart
#
#sudo vi /usr/share/nginx/html/info.php
#Add in the following line:
cat << 'EOF' >> /usr/share/nginx/html/info.php
<?php
phpinfo();
?>
EOF

sudo service nginx restart

sudo chkconfig --levels 235 mysqld on
sudo chkconfig --levels 235 nginx on
sudo chkconfig --levels 235 php-fpm on


