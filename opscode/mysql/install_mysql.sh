mkdir -p ~/src/mysql_5.5
cd ~/src/mysql_5.5
wget http://dev.mysql.com/get/Downloads/MySQL-5.5/MySQL-5.5.37-1.el6.x86_64.rpm-bundle.tar
tar xf MySQL-5.5.37-1.el6.x86_64.rpm-bundle.tar
sudo yum -y install MySQL*rpm
sudo service mysql start
chkconfig mysql on
exit
##
## Great it works!!
##
#wget http://dev.mysql.com/get/Downloads/MySQL-5.6/MySQL-5.6.17-1.el6.x86_64.rpm-bundle.tar

# Check it with the follwoing


# set root password

mysql>
set password for root@localhost=password('password');

Query OK, 0 rows affected (0.00 sec)
# set root password

mysql>
set password for root@'127.0.0.1'=password('password');

Query OK, 0 rows affected (0.00 sec)
# set root password

mysql>
set password for root@'www.server.world'=password('password');

Query OK, 0 rows affected (0.00 sec)
# delete anonymous user

mysql> delete from mysql.user where user='';

Query OK, 2 rows affected (0.00 sec)
mysql> select user,host,password from mysql.user;

mysql> exit
# quit

Bye

# mysql -u root -p

Enter password:

Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 4
Server version: 5.1.52 Source distribution

Copyright (c) 2000, 2010, Oracle and/or its affiliates. All rights reserved.
This software comes with ABSOLUTELY NO WARRANTY. This is free software,
and you are welcome to modify and redistribute it under the GPL v2 license
Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> exit

