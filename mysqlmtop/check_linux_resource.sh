#!/bin/bash

host=""
port=""
user=""
password=""
dbname=""

ip=$1
kernel=`snmpwalk -v1 -c mysqlmtop  ${ip}  SNMPv2-MIB::sysDescr.0|awk '{print $4 " " $6 " " $15}'`
hostname=`/usr/bin/snmpwalk -v1 -c mysqlmtop  ${ip}   SNMPv2-MIB::sysName.0|awk '{print $NF}'`
load1=`/usr/bin/snmpwalk -v1 -c mysqlmtop  ${ip}   UCD-SNMP-MIB::laLoad.1|awk '{print $NF}'`
load2=`/usr/bin/snmpwalk -v1 -c mysqlmtop  ${ip}   UCD-SNMP-MIB::laLoad.2|awk '{print $NF}'`
load3=`/usr/bin/snmpwalk -v1 -c mysqlmtop  ${ip}   UCD-SNMP-MIB::laLoad.3|awk '{print $NF}'`
root=`/usr/bin/snmpdf -v1 -c mysqlmtop ${ip} |grep  -w "/"|awk '{print $NF}'`
data=`/usr/bin/snmpdf -v1 -c mysqlmtop ${ip} |grep  -w "data"|awk '{print $NF}'`
home=`/usr/bin/snmpdf -v1 -c mysqlmtop ${ip} |grep  -w "home"|awk '{print $NF}'`
totalmem=`/usr/bin/snmpdf -v1 -c mysqlmtop ${ip} |grep "Physical"|awk '{print $3}'`
usedmem=`/usr/bin/snmpdf -v1 -c mysqlmtop ${ip} |grep "Physical"|awk '{print $4}'`

mysqlconn="mysql -h${host}  -P${port}  -u${user}  -p${password}"
$mysqlconn -N -e "insert  into $dbname.linux_resource(ip,hostname,kernel,load1,load5,load15,disk_use_root,disk_use_home,disk_use_data,mem_total,mem_use) values('${ip}','${hostname}','${kernel}','${load1}','${load2}','${load3}','${root}','${home}','${data}','${totalmem}','${usedmem}')"
        
