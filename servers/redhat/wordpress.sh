
mysql -u root -p

# run these mysql commands

create database onemanops;
grant all privileges on onemanops.* to "chrisd"@"localhost" identified by "happinessis420;";
flush privileges;
exit

# end of mysql commands block

# mv the wordpress files to where you want them repective to the root
# http://example.com/
# http://example.com/blog/
#
curl -O https://wordpress.org/latest.tar.gz
tar zxvf latest.tar.gz
cd wordpress
mv * /usr/share/nginx/html/
cd /usr/share/nginx/html/
chown -R nginx:nginx *

#  If you placed the WordPress files in the root directory, you should visit: 
#    http://example.com/wp-admin/install.php 

