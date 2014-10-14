sudo yum -y install rpmbuild redhat-rpm-config vim
sudo useradd rpmbuild
sudo passwd rpmbuild
sudo su - rpmbuild -c "mkdir -p ~/rpmbuild/{BUILD,RPMS,SOURCES,SPECS,SRPMS}"
sudo su - rpmbuild -c "echo '%_topdir %(echo $HOME)/rpmbuild' > ~/.rpmmacros"
sudo yum -y groupinstall "Development Tools"

wget http://vault.centos.org/6.5/os/Source/SPackages/openssl-1.0.1e-15.el6.src.rpm

# the simplest method, rebuild the srpm
# rpmbuild --rebuild /tmp/mypackage-1.0.0-1.src.rpm
#
# the standard method
# install the rpm, edit the source, build
#
rpm -i openssl-1.0.1e-15.el6.src.rpm
#rpm --no-md5 -i openssl-1.0.1e-15.el6.src.rpm
#
# now there is a specfile located under ~/rpmbuild/SPECS directory
# edit the SPEC file, then build the rpm
# rpmbuild -ba mypackage.spec
# the resultant rpm will be located under ~/rpmbuild/RPMS
# a new SRPM will be located unders ~/rpmbuild/SRPMS


yum -y install rpm-build

mkdir -p ~/rpmbuild/{BUILD,RPMS,SOURCES,SPECS,SRPMS}

yum -y install make gcc

1. Download the source rpms to ~/SRPMS/
2. install the source rpms
    rpm -i $i
    this will install the source code into ~/rpmbuild/SOURCES
    the spec files will be installed in ~/rpmbuild/SPECS
3. cd ~/rpmbuild/SPECS
    rpmbuild -bp app.spec
           this will uncompress the source in BUILD dir
4. cd ~/rpmbuild/BUILD
cp existing_directory existing_directory.orig
cd existing_directory
find the file you wish to change, modify it.
cd ~/rpmbuild/BUILD/
diff -Npru existing_directory.orig exiting_directory > name_of_your_patch_file.patch
cp name_of_your_patch_file.patch ~/rpmbuild/SOURCES/
cd ~/rpmbuild/SPECS/
edit the mypackage.spec file to add the definition of name_of_your_patch_file.patch and the application of your_patch_file -- please look in the file to see how that is done.
rpmbuild -ba mypackage.spec
cd ~/rpmbuild/RPMS/x86_64/
          rpm -ivh --force bash-4.1.2-8.el6.x86_64.rpm
