# 
# Runs after system setup gets run
#
mkdir -p ~chef/.ssh

echo 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDE/sGXD1GL3qAfKjPLETFaT1+FYVZ8St75Feq2KWpvPkpwQSTrN2KnTv3/4mEQdRwswAt+zySMyeakbGf/ratTjldVuLk7FLc6+kNPZ4rt1O7YV7+yF0T/RWcibyLCQ71xMeKjfK0zo7elgMfscNI/zk7tNotRdBYVc13DwYYKzbzLnFbe7ulgFYxnQ0oX8cdY88MGag7S+BgodU/V6O+nC6bPjShaO9pFBDXYyEpOrJutKCnfssRx/xSw4BJT1YKYwMCYw2KzAMAFZUh3sG3Lj7x1T+o/BbymCMmyXlIAgZGi4/73YkWSmIrErjC2boRDYHMWKFeYCOqSZSuMcVM1 cdekonink@cdekonink-mac.local' > ~chef/.ssh/authorized_keys

chmod 700 ~chef/.ssh
chmod 600 ~chef/.ssh/authorized_keys
chown chef. ~chef/.ssh ~chef/.ssh/authorized_keys

# NOTE: the output from hostname -f MUST be a FQDN

yum -y install curl wget
wget https://opscode-omnibus-packages.s3.amazonaws.com/el/6/x86_64/chef-server-11.1.0-1.el6.x86_64.rpm
sudo rpm -ivh chef-server-11.1.0-1.el6.x86_64.rpm
sudo chef-server-ctl reconfigure 
sudo chef-server-ctl test

# Next step, setup  workstation
#
# from the workstation
#   knife client list
#   knife user list


