#
# I think for workstation you should create an opscode user
#
# To be run after system setup as the opscode user
#
curl -L https://www.opscode.com/chef/install.sh | sudo bash
#
# Install git
#
# set up the chef-repo
mkdir ~/.chef
#
# Note: before running knife, you must first download the files
# from the chef server
#
scp root@107.170.176.25:/etc/chef-server/admin.pem  ~/.chef
scp root@107.170.176.25:/etc/chef-server/validator.pem ~/.chef
# copying the files this way allows for automatic node bootstrapping with
# knife bootstrap
#
cd ~/code
git clone git://github.com/opscode/chef-repo.git
cd chef-repo
echo '.chef' >> .gitignore
knife configure --initial
#
# Also the output from hostname -f on the server must be the FQDN
#
# The following is the expected output
# mountainlion:code chrisd$ knife configure --initial
# Overwrite /Users/chrisd/.chef/knife.rb? (Y/N)Y
# Please enter the chef server URL: [https://mountainlion:443] 
#     https://107.170.176.125:443
# Please enter a name for the new user: [chrisd] 
# 
# Please enter the existing admin name: [admin] 
# 
# Please enter the location of the existing admin's private key: [/etc/chef-server/admin.pem] 
#     ~/.chef/admin.pem 
# Please enter the validation clientname: [chef-validator] 
# 
# Please enter the location of the validation key: [/etc/chef-server/chef-validator.pem] 
#     ~/.chef/chef-validator
# Please enter the path to a chef repository (or leave blank): 
#     ~/code/chef-repo
# Creating initial API user...
# Please enter a password for the new user: 
# Created user[chrisd]
# Configuration file written to /Users/chrisd/.chef/knife.rb
# 
# mountainlion:build chrisd$ knife client list
# chef-validator
# chef-webui
# mountainlion:build chrisd$ knife user list
# admin
# chrisd
# mountainlion:build chrisd$ 
# 
