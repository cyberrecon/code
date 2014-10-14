# Python 2.7.6:
wget http://python.org/ftp/python/2.7.6/Python-2.7.6.tar.xz
tar xf Python-2.7.6.tar.xz
cd Python-2.7.6
./configure --prefix=/usr/local --enable-unicode=ucs4 --enable-shared LDFLAGS="-Wl,-rpath /usr/local/lib"
make && make altinstall

 
# # Python 3.3.5:
# wget http://python.org/ftp/python/3.3.5/Python-3.3.5.tar.xz
# tar xf Python-3.3.5.tar.xz
# cd Python-3.3.5
# ./configure --prefix=/usr/local --enable-shared LDFLAGS="-Wl,-rpath /usr/local/lib"
# make && make altinstall
# 

