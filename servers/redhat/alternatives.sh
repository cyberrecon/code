
# often times there is more than one version of a program
# to make /usr/local/ssl/bin/openssl the system default
# a generic name in the FS is shared by all files providing that functionality
# the generic name is not a direct symlink to the selected alternative

# instead its a symlink to to a name in the alternatives directory
# which in turn is a symlink to the actual program

# each alternative has a priority set to it
# use --config option to list all choices for given <name>

# Terminology
# generic name - a name like /usr/bin/openssl
# symlink - a symlink in the alrenatives directory
# alternative - name of specific file to be made accessible by generic name
# 

# Exactly one action must be specified
# --install link name path priority
#
# where name is generic name
# link is the name of its symlink
# path is the alternative being introduced for the master link
# 

mv /usr/bin/openssl /usr/bin/openssl.orig
alternatives --install /usr/bin/openssl openssl /usr/local/ssl/bin/openssl 1


