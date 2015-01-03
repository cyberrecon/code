# nginx
cd ~/
echo "======================================================="
echo "Installing nginx"
echo "======================================================="
sudo add-apt-repository ppa:nginx/stable
sudo apt-get -y update
sudo apt-get -y install nginx
sudo service nginx start
# it works

