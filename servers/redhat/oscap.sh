
yum install openscap-utils
oscap -V | less
wget http://iase.disa.mil/stigs/os/u_redhat_6_v1r3_benchmark.zip
wget http://web.nvd.nist.gov/view/ncp/repository/checklist/download?id=1558
wget http://iase.disa.mil/stigs/os/unix/u_redhat_6_v1r3_stig.zip
unzip u_redhat_6_v1r3_stig.zip
unzip U_Redhat_6_V1R3_Manual_STIG.zip
rm u_redhat_6_v1r3_benchmark.zip
oscap xccdf eval --profile stig-rhel6-server-upstream --results `hostname`-ssg-results.xml --report `hostname`-ssg-results.html /root/U_RedHat_6_V1R3_Manual-xccdf.xml

vi /etc/rc.d/init.d/oscap-scan
vi /etc/sysconfig/oscap-scan
/etc/rc.d/init.d/oscap-scan start

vi /usr/share/doc/audit-2.2/stig.rules

wget http://www.redhat.com/security/data/metrics/com.redhat.rhsa-all.xccdf.xml
wget http://www.redhat.com/security/data/oval/com.redhat.rhsa-all.xml


oscap xccdf eval --results results.xml --report report.html com.redhat.rhsa-all.xccdf.xml

oscap info com.redhat.rhsa-all.xml



