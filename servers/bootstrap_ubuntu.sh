#!/bin/bash
# script to bootstrap a new debian based VPS from scratch
# This script configures the following:
#
# iptables, ssh_keys, deploy user with sudo, install updates, install the latest version openssl, ruby and ruby_gems
#
# Usage:
# ./bootstrap.sh > ~/bootstrap.log 2>&1
#

set -x # for verbosity

cd ~/

sudo touch /var/log/wtmp
sudo chown root:utmp /var/log/wtmp
sudo chmod 0664 /var/log/wtmp

# allow current connection to stay up
sudo iptables -A INPUT -m conntrack --ctstate ESTABLISHED,RELATED -j ACCEPT

# accept ssh from home
sudo iptables -A INPUT -p tcp --source 99.121.52.198/32 --dport ssh -j ACCEPT

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

sudo sh -c "iptables-save > /etc/iptables.rules"

# save this iptables config for restart
cd ~/
cat << 'EOF' > iptablesload 
#!/bin/sh
iptables-restore < /etc/iptables.rules
exit 0
EOF

sudo mv iptablesload /etc/network/if-pre-up.d/

# save the counters across reboots
cd ~/
cat << 'EOF' > iptablessave 
#!/bin/sh
iptables-save -c > /etc/iptables.rules
if [ -f /etc/iptables.downrules ]; then
   iptables-restore < /etc/iptables.downrules
fi
exit 0
EOF
sudo mv iptablessave /etc/network/if-post-down.d/iptablessave
sudo chmod +x /etc/network/if-post-down.d/iptablessave
sudo chmod +x /etc/network/if-pre-up.d/iptablesload

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
adduser --disabled-password --home /home/deploy --shell /bin/bash --gecos 'deploy user needs sudo' deploy
wget https://github.com/cyberrecon.keys
mkdir -p /home/deploy/.ssh
cat cyberrecon.keys >> /home/deploy/.ssh/authorized_keys
chown -R deploy:deploy /home/deploy
chmod 0700 /home/deploy/.ssh
chmod 0400 /home/deploy/.ssh/authorized_keys
rm cyberrecon.keys*

echo '%deploy   ALL=(ALL) NOPASSWD: ALL' >> /etc/sudoers.d/deployers
chmod 0440 /etc/sudoers.d/deployers

cd ~/
echo "======================================================="
echo "System Updates"
echo "======================================================="
#
sudo apt-get -y update && sudo apt-get -y upgrade

echo "======================================================="
echo " Extra Packages"
echo "======================================================="
sudo apt-get install -y make g++ curl git-core python-software-properties
sudo apt-get install -y build-essential zlib1g-dev libyaml-dev libssl-dev
sudo apt-get install -y libgdbm-dev libreadline6-dev libncurses5-dev
sudo apt-get install -y libpq-dev libffi-dev unattended-upgrade

# get and install OpenSSL
cd ~/
echo "======================================================="
echo "Installing Openssl"
echo "======================================================="
wget http://www.openssl.org/source/openssl-1.0.1e.tar.gz 
tar zxvf openssl-1.0.1e.tar.gz
cd openssl-1.0.1e/
./config
make
sudo make install
sudo update-alternatives --install /usr/bin/openssl openssl /usr/local/ssl/bin/openssl 1 --force

# Install system-wide ruby 2.0.0-p247
cd ~/
echo "======================================================="
echo "Installing ruby"
echo "======================================================="
wget http://ftp.ruby-lang.org/pub/ruby/2.0/ruby-2.0.0-p247.tar.gz
tar zxvf ruby-2.0.0-p247.tar.gz
cd ruby-2.0.0-p247/
./configure
make
sudo make install
echo "======================================================="
echo "Installing ruby-gems"
echo "======================================================="
wget http://production.cf.rubygems.org/rubygems/rubygems-2.0.4.tgz
tar zxvf rubygems-2.0.4.tgz
cd rubygems-2.0.4/
sudo /usr/local/bin/ruby setup.rb
sudo gem install bundler --no-ri --no-rdoc

# Cleanup
echo "======================================================="
echo "Cleaning up Build Directories"
echo "======================================================="
cd ~/
rm -fr openssl-1.0.1e openssl-1.0.1e.tar.gz
rm -fr ruby-2.0.0-p247 ruby-2.0.0-p247.tar.gz
rm -fr rubygems-2.0.4 rubygems-2.0.4.tgz

