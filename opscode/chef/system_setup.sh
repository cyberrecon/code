#!/bin/bash

#echo Enter user name for user
#read USERNAME
#echo "Enter passwd for $USERNAME
#read PASSWORD

for USERNAME in deploy opscode
do
  useradd $USERNAME
  mkdir -p ~$USERNAME/.ssh
  echo 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDE/sGXD1GL3qAfKjPLETFaT1+FYVZ8St75Feq2KWpvPkpwQSTrN2KnTv3/4mEQdRwswAt+zySMyeakbGf/ratTjldVuLk7FLc6+kNPZ4rt1O7YV7+yF0T/RWcibyLCQ71xMeKjfK0zo7elgMfscNI/zk7tNotRdBYVc13DwYYKzbzLnFbe7ulgFYxnQ0oX8cdY88MGag7S+BgodU/V6O+nC6bPjShaO9pFBDXYyEpOrJutKCnfssRx/xSw4BJT1YKYwMCYw2KzAMAFZUh3sG3Lj7x1T+o/BbymCMmyXlIAgZGi4/73YkWSmIrErjC2boRDYHMWKFeYCOqSZSuMcVM1 cdekonink@cdekonink-mac.local' > ~$USERNAME/.ssh/authorized_keys
  chmod 700 ~$USERNAME/.ssh
  chmod 600 ~$USERNAME/.ssh/authorized_keys
  chown $USERNAME. ~$USERNAME/.ssh ~$USERNAME/.ssh/authorized_keys
done

sed -i.orig  '/^SELINUX=/s/enforcing/permissive/g' /etc/selinux/config

#vi /etc/ssh/sshd_config 
cp /etc/ssh/sshd_config /etc/ssh/sshd_config.orig
sed -e /^#/d /etc/ssh/sshd_config| sed -e /^$/d | sed /^PasswordAuthentication/d > /etc/ssh/sshd_config.new
mv -f /etc/ssh/sshd_config.new /etc/ssh/sshd_config
echo 'PermitRootLogin no' >> /etc/sshd_config
echo 'PasswordAuthentication no' >> /etc/sshd_config
chmod 600 /etc/ssh/sshd_config
service sshd restart

visudo

#useradd -M vagrant
#passwd vagrant
#hostname build-cent65
#echo checking hostname is : `hostname`
#vi /etc/hosts
#grep `hostname` /etc/host

cat /etc/sysconfig/network
#hostname build-cent65

#vi /etc/sysconfig/network
#vi /etc/sysconfig/network-scripts/ifcfg-eth0 
#service network restart
#ifconfig
ping phoenix.princeton.edu
sudo yum -y install kernel kernel-firmware kernel-devel kernel-headers
sudo yum -y install make gcc rpm-build redhat-rpm-config openssl-devel
sudo yum -y install lsof mlocate ntp cronie postfix wget dialog curl
sudo yum -y update && sudo yum -y upgrade

chkconfig auditd on
chkconfig crond on
chkconfig network on
chkconfig restorecond on
chkconfig sshd on

chkconfig iptables off
chkconfig ip6tables off
chkconfig postfix off
chkconfig netfs off
chkconfig rsyslog off

# If this is a build system then

echo configuring system for building rpms
#yum -y install rpm-build redhat-rpm-config
#useradd build
#passwd build

yum -y erase rpcbind

updatedb
