#!//bin/env python
#coding:utf-8
import os
import sys
import string
import time
import datetime
import MySQLdb
import global_functions as func
from multiprocessing import Process;


def check_server_resource(ip):
    command="./check_linux_resource.sh"
    os.system("%s %s"%(command,ip))

def main():
    func.mysql_exec("insert into linux_resource_history select *  from  linux_resource",'')
    func.mysql_exec("delete from  linux_resource",'')
    linux_servers_ip = func.get_config('linux_server','server_ip')
    servers=linux_servers_ip.split("|")
    if servers:
         print("%s: check_server_resource controller started." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),));
         plist = []
         for ip in servers:
             if ip <> '':
                 print ip
		 p = Process(target = check_server_resource, args=(ip,))
                 plist.append(p)
                 p.start()

         for p in plist:
             p.join()
         print("%s: check_server_resource controller finished." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),))


if __name__=='__main__':
     main()
