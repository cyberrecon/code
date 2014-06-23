# PostgreSQL
echo "======================================================="
echo "Installing postgresql"
echo "======================================================="
echo "deb http://apt.postgresql.org/pub/repos/apt/ precise-pgdg main"  > pgdg.list
sudo mv pgdg.list /etc/apt/sources.list.d/pgdg.list
wget --quiet -O - http://apt.postgresql.org/pub/repos/apt/ACCC4CF8.asc | sudo apt-key add -
sudo apt-get -y update
sudo apt-get -y install postgresql-common -t raring
sudo apt-get -y install postgresql-9.2
sudo apt-get -y install postgresql-contrib

psql --version
#sudo -u postgres psql
# \password
# create user blog with password 'secret';
# create database blog_production owner blog;
# \q

