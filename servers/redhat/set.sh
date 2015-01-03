# Install SET
git clone https://github.com/trustedsec/social-engineer-toolkit/ set/
# Install MSF
yum update
yum upgrade
yum groupinstall 'Development Tools'
yum install sqlite-devel libxslt-devel libxml2-devel java-1.7.0-openjdk libpcap-devel nano openssl-devel zlib-devel libffi-devel gdbm-devel readline-devel nano wget
cd /usr/src
wget http://pyyaml.org/download/libyaml/yaml-0.1.4.tar.gz
tar zxf yaml-0.1.4.tar.gz
cd yaml-0.1.4
./configure --prefix=/usr/local
make && make install
echo "Finished Installing"
read ans
cd /usr/src
 wget http://ftp.ruby-lang.org/pub/ruby/1.9/ruby-1.9.3-p374.tar.gz
 tar xvzf ruby-1.9.3-p374.tar.gz
 cd ruby-1.9.3-p374
 ./configure --prefix=/usr/local --with-opt-dir=/usr/local/lib
 make & make install
read ans
echo "Finished Installing"
read ans

# install nmap
cd /usr/src
svn co https://svn.nmap.org/nmap
cd nmap
./configure
make
make install
make clean
echo "Finished Installing"
read ans

# edit /etc/yum.conf and add 
echo 'exclude=postgresql*' >> /etc/yum.conf

# add the repo for postgres
wget http://yum.postgresql.org/9.2/redhat/rhel-6-x86_64/pgdg-centos92-9.2-6.noarch.rpm
 rpm -ivh pgdg-centos92-9.2-6.noarch.rpm
yum update
yum install postgresql92-server postgresql92-devel postgresql92
service postgresql-9.2 initdb
service postgresql-9.2 start
chkconfig postgresql-9.2 on
echo export PATH=/usr/pgsql-9.2/bin:\$PATH >> /etc/bashrc
source ~/.bashrc
echo "Create the postgres users and database"
echo "Dropping into child process"
exit
su - postgres
createuser msf -P -S -R -D
createdb -O msf msf
exit
exit
# edit /var/lib/pgsql/9.2/data/pg_hba.conf
# insert at beginning
local msf msf md5
hostmsf msf 127.0.0.1/8 md5
hostmsf msf ::1/128 md5
service postgresql-9.2 start

# Install Metasploit
gem install wirble pg sqlite3 msgpack activerecord redcarpet rspec simplecov yard bundler
cd /opt
git clone https://github.com/rapid7/metasploit-framework.git
cd metasploit-framework
bash -c 'for MSF in $(ls msf*); do ln -s /opt/metasploit-framework/$MSF /usr/local/bin/$MSF;done'
ln -s /opt/metasploit-framework/armitage /usr/local/bin/armitage
bundle install
nano /opt/metasploit-framework/database.yml
# edit the folloing
production:
 adapter: postgresql
 database: msf
 username: msf
 password: 
 host: 127.0.0.1
 port: 5432
 pool: 75
 timeout: 5
#
export MSF_DATABASE_CONFIG=/opt/metasploit-framework/database.yml >> /etc/bashrc
source ~/.bashrc
# first run
msfconsole
