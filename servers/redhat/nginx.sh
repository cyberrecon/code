    1  sudo su -c 'rpm -Uvh http://dl.fedoraproject.org/pub/epel/6/x86_64/epel-release-6-8.noarch.rpm'
    2  yum -y install nginx
    3  vi /etc/nginx/nginx.conf
    4  grep nginx /etc/passwd
    5  cp /etc/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf.org 
    6  egrep -v "^ *#|^ *$" /etc/nginx/conf.d/default.conf.org > /etc/nginx/conf.d/default.conf 
    7  vi /etc/nginx/conf.d/default.conf 
    8  /etc/rc.d/init.d/nginx start
    9  yum -y install telnet

