#!/bin/bash
#
# script to bootstrap a new centos based VPS from scratch
# This script configures the following:
#
# iptables, ssh_keys, deploy user with sudo, install updates, install the latest version openssl, ruby and ruby_gems
#
# Usage:
# ./bootstrap.sh > ~/bootstrap.log 2>&1
#

# set -x # for verbosity

cd ~/

sudo touch /var/log/wtmp
sudo chown root:utmp /var/log/wtmp
sudo chmod 0664 /var/log/wtmp

# allow current connection to stay up
sudo iptables -A INPUT -m conntrack --ctstate ESTABLISHED,RELATED -j ACCEPT

# accept ssh from home
# echo -n enter the source ip from which you want to ssh from
# read ANS
# sudo iptables -A INPUT -p tcp --source 99.121.52.198/32 --dport ssh -j ACCEPT
sudo iptables -A INPUT -p tcp --source 206.124.126.33/32 --dport ssh -j ACCEPT

# accept http from everywhere
sudo iptables -A INPUT -p tcp --dport 80 -j ACCEPT

# accept https from everywhere
sudo iptables -A INPUT -p tcp --dport 443 -j ACCEPT

sudo iptables -A INPUT -p tcp --dport 25 -j ACCEPT

# drop everything here
sudo iptables -A INPUT -j DROP

# but allow loopback traffic
sudo iptables -I INPUT  1 -i lo -j ACCEPT

# log all denied attempts to syslog
sudo iptables -I INPUT 5 -m limit --limit 5/min -j LOG --log-prefix "iptables denied: " --log-level 7

sudo sh -c "/sbin/service iptables save"

# save this iptables config in /etc/sysconfig/iptables for restart
# the existing file is saved with /etc/sysconfig/iptables.save 

# disable remote root login & force use of ssh keys
cp /etc/ssh/sshd_config  /etc/ssh/sshd_config.orig

printf ":g/^#/d\nw\nq\n" |ex /etc/ssh/sshd_config
printf ":g/^$/d\nw\nq\n" |ex /etc/ssh/sshd_config
printf ":g/PermitRootLogin /d\nw\nq\n" |ex /etc/ssh/sshd_config
printf ":g/PasswordAuthentication /d\nw\nq\n" |ex /etc/ssh/sshd_config
printf ":g/ClientAliveInterval /d\nw\nq\n" |ex /etc/ssh/sshd_config
printf ":g/ClientAliveCountMax /d\nw\nq\n" |ex /etc/ssh/sshd_config
cat << 'EOF' >> /etc/ssh/sshd_config
PermitRootLogin no
PasswordAuthentication no
ClientAliveInterval 18
ClientAliveCountMax 100
EOF
sudo service ssh restart

# set up deploy user with sudo access
adduser --home-dir /home/deploy --shell /bin/bash --comment 'deploy user needs sudo' deploy
curl https://github.com/cyberrecon.keys -O
mkdir -p /home/deploy/.ssh
cat cyberrecon.keys >> /home/deploy/.ssh/authorized_keys
chown -R deploy:deploy /home/deploy
chmod 0700 /home/deploy/.ssh
chmod 0400 /home/deploy/.ssh/authorized_keys
rm -f cyberrecon.keys*

echo '%deploy   ALL=(ALL) NOPASSWD: ALL' >> /etc/sudoers.d/deployers
chmod 0440 /etc/sudoers.d/deployers

cd ~/
echo "======================================================="
echo "System Updates"
echo "======================================================="
#
# install these rpm's from your own repo

#mkdir /mnt/temp ; mount -o nolock 192.168.252.201:/distro /mnt/temp 
#rpm -ivh --force /mnt/temp/RPMS/centos/6.2/bash-4.1.2-8.el6.x86_64.rpm
#rpm -ivh --force /mnt/temp//RPMS/centos/6.2/epel-release-6-5.noarch.rpm
#rpm -ivh --force /mnt/temp//RPMS/centos/6.2/security-banner-1.0-1.noarch.rpm
#rpm -ivh --force /mnt/temp//RPMS/centos/6.2/admin-users-20120621-1.noarch.rpm
#rpm -Uvh --force /mnt/temp//RPMS/centos/6.2/sudo-1.8.5-2.el6.x86_64.rpm

sudo rpm -Uvh http://download.fedoraproject.org/pub/epel/6/i386/epel-release-6-8.noarch.rpm
sudo yum clean all
sudo rpm --rebuilddb

sudo yum -y update
sudo yum -y erase rpcbind
sudo yum -y install kernel kernel-firmware kernel-devel kernel-headers
sudo yum -y install stunnel lsof net-snmp mlocate ntp smartmontools irqbalance cronie cpuspeed at acpid postfix puppet sysstat 
sudo yum -y upgrade

echo "======================================================="
echo " Extra Packages"
echo "======================================================="

mkdir -p /var/log/audit
# echo "WAF 6.3-min" > /etc/centos-release
# echo "PermitRootLogin no" >> /etc/ssh/sshd_config
# 
# cp /mnt/temp/kickstart/files/epel.repo /etc/yum.repos.d/epel.repo
# cp /mnt/temp/kickstart/files/CentOS-Base.repo /etc/yum.repos.d/CentOS-Base.repo
# cp /mnt/temp/kickstart/files/.repo /etc/yum.repos.d/.repo
# cp /mnt/temp/kickstart/files/yum.conf /etc/yum.conf
# 
yum -y install --enablerepo=epel syslog-ng
# 
# umount /mnt/temp
updatedb

# The rest of these should be installed from a private repo as rpm pkgs
#
# get and install OpenSSL
# cd ~/
# echo "======================================================="
# echo "Installing Openssl"
# echo "======================================================="
# wget http://www.openssl.org/source/openssl-1.0.1e.tar.gz 
# tar zxvf openssl-1.0.1e.tar.gz
# cd openssl-1.0.1e/
# ./config
# make
# sudo make install
# sudo update-alternatives --install /usr/bin/openssl openssl /usr/local/ssl/bin/openssl 1 --force
# 
# # Install system-wide ruby 2.0.0-p247
# cd ~/
# echo "======================================================="
# echo "Installing ruby"
# echo "======================================================="
# wget http://ftp.ruby-lang.org/pub/ruby/2.0/ruby-2.0.0-p247.tar.gz
# tar zxvf ruby-2.0.0-p247.tar.gz
# cd ruby-2.0.0-p247/
# ./configure
# make
# sudo make install
# echo "======================================================="
# echo "Installing ruby-gems"
# echo "======================================================="
# curl -O http://production.cf.rubygems.org/rubygems/rubygems-2.0.4.tgz
# tar zxvf rubygems-2.0.4.tgz
# cd rubygems-2.0.4/
# sudo /usr/local/bin/ruby setup.rb
# sudo gem install bundler --no-ri --no-rdoc
# 
# # Cleanup
# echo "======================================================="
# echo "Cleaning up Build Directories"
# echo "======================================================="
# cd ~/
# rm -fr openssl-1.0.1e openssl-1.0.1e.tar.gz
# rm -fr ruby-2.0.0-p247 ruby-2.0.0-p247.tar.gz
# rm -fr rubygems-2.0.4 rubygems-2.0.4.tgz
# # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # 
# HARDENING SCRIPTS - must create them from RedHat STIG
chkconfig acpid on
chkconfig atd on
chkconfig auditd on
chkconfig crond on
chkconfig cpuspeed on
chkconfig irqbalance on
chkconfig network on
chkconfig restorecond on
chkconfig smartd on
chkconfig sshd on
# chkconfig puppet on
# chkconfig syslog-ng on
# chkconfig snmpd on
chkconfig iptables on

chkconfig ip6tables off
chkconfig postfix off
chkconfig netfs off
chkconfig nfslock off
chkconfig rpcbind off
chkconfig rpcgssd off
chkconfig rpcidmapd off
chkconfig rsyslog off
chkconfig fcoe off
chkconfig lldpad off

#  /mnt/temp/kickstart/post-install-scripts/S0-backup-key-files
#  /mnt/temp/kickstart/post-install-scripts/S1-yum-updates
#  /mnt/temp/kickstart/post-install-scripts/S2-ssh-config
#  /mnt/temp/kickstart/post-install-scripts/S3-enable-sys-acct
#  /mnt/temp/kickstart/post-install-scripts/S4-remove-inetd-xinetd
#  /mnt/temp/kickstart/post-install-scripts/S5-tcpwrappers
#  /mnt/temp/kickstart/post-install-scripts/S6-iptables
#  /mnt/temp/kickstart/post-install-scripts/S7-set-daemon-umask
#  /mnt/temp/kickstart/post-install-scripts/S8-MTA
#  /mnt/temp/kickstart/post-install-scripts/S9-disable-std-boot-svcs
#  /mnt/temp/kickstart/post-install-scripts/S10-disable-nfs
#  /mnt/temp/kickstart/post-install-scripts/S11-disable-dns
#  /mnt/temp/kickstart/post-install-scripts/S12-network-param-mods
#  /mnt/temp/kickstart/post-install-scripts/S13-syslog-config
#  /mnt/temp/kickstart/post-install-scripts/S14-set-log-perms
#  /mnt/temp/kickstart/post-install-scripts/S15-configure-rsyslog
#  /mnt/temp/kickstart/post-install-scripts/S16-modify-fstab
#  /mnt/temp/kickstart/post-install-scripts/S17-disable-removable-fs
#  /mnt/temp/kickstart/post-install-scripts/S18-password-perms
#  /mnt/temp/kickstart/post-install-scripts/S19-flag-world-writable-dirs
#  /mnt/temp/kickstart/post-install-scripts/S20-find-world-writable-files
#  /mnt/temp/kickstart/post-install-scripts/S21-find-unauth-suid-sgid
#  /mnt/temp/kickstart/post-install-scripts/S22-find-unowned-files
#  /mnt/temp/kickstart/post-install-scripts/S23-disable-usb-storage
#  /mnt/temp/kickstart/post-install-scripts/S24-restrict-cron
#  /mnt/temp/kickstart/post-install-scripts/S25-restrict-root-logon
#  /mnt/temp/kickstart/post-install-scripts/S26-set-grub-password
#  /mnt/temp/kickstart/post-install-scripts/S27-req-auth-single-usr
#  /mnt/temp/kickstart/post-install-scripts/S28-block-system-account-login
#  /mnt/temp/kickstart/post-install-scripts/S29-check-empty-passwd
#  /mnt/temp/kickstart/post-install-scripts/S30-chk-roots-path
#  /mnt/temp/kickstart/post-install-scripts/S30-set-passwd-expiry
#  /mnt/temp/kickstart/post-install-scripts/S31-lock-down-home-dirs
#  /mnt/temp/kickstart/post-install-scripts/S32-disable-core-dumps
#  /mnt/temp/kickstart/post-install-scripts/S33-turn-on-wheel
#  /mnt/temp/kickstart/post-install-scripts/S34-turn-on-auditing
#  /mnt/temp/kickstart/post-install-scripts/S35-chk-dup-uids
#  /mnt/temp/kickstart/post-install-scripts/S36-chk-root-perms
#  /mnt/temp/kickstart/post-install-scripts/S37-enforce-passwd-complexity
#  /mnt/temp/kickstart/post-install-scripts/S38-restrict-perms
#  /mnt/temp/kickstart/post-install-scripts/S39-extra-hardening


