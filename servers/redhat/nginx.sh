#!/bin/bash
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

