# pre-requisites
# install ruby for puppet 3.2+

hostname puppet
ip=`ifconfig | grep -A 1 eth0 | tail -1 | awk -F':' '{print $2}'| awk '{print $1}'`
echo "$ip	puppet" >> /etc/hosts
echo puppet > /etc/hostname

git clone --recursive https://github.com/example42/puppet-modules-nextgen.git

# to enable the repository for Ubuntu 12.04 Precise Pangolin:
# main uri http://apt.puppetlabs.com/
wget http://apt.puppetlabs.com/puppetlabs-release-precise.deb
sudo dpkg -i puppetlabs-release-precise.deb
sudo apt-get update
sudo apt-get -y install puppetmaster
# end ubuntu

# sudo apt-get install puppet

# post-installation
vi /etc/puppet/puppet.conf
#
# On Puppet Masters
# Settings for puppet master servers should go in the [master] or [main] 
# block of puppet.conf.
#
# Note: puppet masters are usually also agent nodes; settings in [main] 
# will be available to both services, and settings in the [master] 
# and [agent] blocks will override the settings in [main].
#
# dns_alt_names: A list of valid hostnames for the master, which will be 
# embedded in its certificate. Defaults to the puppet master’s certname 
# and puppet, which is usually fine. 
# If you are using a non-default setting, set it before starting the 
# puppet master for the first time.
#
# Puppet agent, apply, and master also accept a --genconfig option, 
# which outputs a complete puppet.conf file
#
# edit the file to suit your specific taste and environment
#+---------------
# this is a comment on puppet.conf. comments must start at begin of line
#
# this is the [main] block settings here are always effective unless
# overridden by [agent], [master], or [user] block

[main]
  # setting = value pairs:
  server = master.example.com
  certname = 005056c00008.localcloud.example.com
  # variable interpolation:
  rundir = $vardir/run
  modulepath = /etc/puppet/modules/$environment:/usr/share/puppet/modules
[master]
  # a list:
  reports = store, http
  # a multi-directory modulepath:
  modulepath = /etc/puppet/modules:/usr/share/puppet/modules
  # setting owner and mode for a directory:
  vardir = /Volumes/zfs/vardir {owner = puppet, mode = 644}

  # Settings in [agent] will only be used by puppet agent
  # settings in [master] will be used by puppet master and puppet cert
  # settings in [user] will only be used by puppet apply
#+---------------------------------------

#
# Setup and install PuppetDB
#

# 1 . install puppet and request/sign/retrieve a certificate for the node.
# Your PuppetDB server should be running puppet agent and have a signed 
# certificate from your puppet master server. If you run 
puppet agent --test # should successfully complete a run, 
# ending with “notice: Finished catalog run in X.XX seconds.”

# 2. enable the repository for Ubuntu 12.04 Precise Pangolin:
wget http://apt.puppetlabs.com/puppetlabs-release-precise.deb
sudo dpkg -i puppetlabs-release-precise.deb
sudo apt-get update
sudo apt-get install puppet

# 3. # use puppet to install puppetdb
sudo puppet resource package puppetdb ensure=latest

# 4. confirm database settings 
# example /etc/puppet/puppetdb.conf # /etc/puppetdb/conf.d/
#+-----------------------------
# [main]
server = puppetdb.example.com
port = 8081
#+-----------------------------
# see the puppetdb manual
# http://docs.puppetlabs.com/puppetdb/latest/

# Puppet DB - critical server
# prerequisites java jdk 1.6+ openjdk
# 2 GB RAM per 100 nodes
# set up postgres as the backend
# on a server running postgres
$ sudo -u postgres sh
$ createuser -DRSP puppetdb
$ createdb -E UTF8 -O puppetdb puppetdb
$ exit
# test connectivity access
$ psql -h localhost puppetdb puppetdb

# 5. use puppet to start puppetdb
sudo puppet resource service puppetdb ensure=running enable=true

# Finish - configure puppet master to talk to puppet db
# install latest puppetdb-terminus
sudo puppet resource package puppetdb-terminus ensure=latest
# vi i/etc/puppet/puppetdb.conf
[main]
server = puppetdb.example.com
port = 8081

# vi /etc/puppet/puppet,conf
[master]
  storeconfigs = true
  storeconfigs_backend = puppetdb
  reports = store,puppetdb

# Enable experimental features
# http://docs.puppetlabs.com/puppetdb/latest/api/query/experimental/event.html
# http://docs.puppetlabs.com/puppetdb/latest/api/query/experimental/report.html
# http://docs.puppetlabs.com/puppetdb/latest/api/commands.html#store-report-version-1
# http://docs.puppetlabs.com/puppetdb/latest/api/wire_format/report_format.html


# vi /etc/puppet/routes.yaml
---
master:
  facts:
    terminus: puppetdb
    cache: yaml

# Restart the puppet master
# run puppet agent on any node and see if the logs are updated
/var/log/puppetdb/puppetdb.log

2012-05-17 13:08:41,664 INFO  [command-proc-67] [puppetdb.command] [85beb105-5f4a-4257-a5ed-cdf0d07aa1a5] [replace facts] screech.example.com
2012-05-17 13:08:45,993 INFO  [command-proc-67] [puppetdb.command] [3a910863-6b33-4717-95d2-39edf92c8610] [replace catalog] screech.example.com

