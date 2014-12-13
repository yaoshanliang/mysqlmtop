#!/usr/bin/env python
#coding:utf-8
import os
import sys
import string
import time
import datetime
import MySQLdb
import global_functions as func
from multiprocessing import Process;


def admin_mysql_kill_process(host,port,user,passwd,pid):
    datalist=[]
    try:
        connect=MySQLdb.connect(host=host,user=user,passwd=passwd,port=int(port),connect_timeout=2,charset='utf8')
        cur=connect.cursor()
        #kill pid
        cur.execute("kill %s"%eval('pid'));
        print  "mysql pid %s been killed"%eval('pid')

    except MySQLdb.Error,e:
        pass
        print "Mysql Error %d: %s" %(e.args[0],e.args[1])


def main():

    user = func.get_config('mysql_db','username')
    passwd = func.get_config('mysql_db','password')
    killed_pids=func.mysql_query("select p.pid,s.host,s.port from mysql_process_killed p left join servers s on p.server_id=s.id;")
    if killed_pids:
         print("%s: admin_mysql_kill_process controller started." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),));
         plist = []
         for row in killed_pids:
             pid=row[0]
             host=row[1]
             port=row[2]
             p = Process(target = admin_mysql_kill_process, args = (host,port,user,passwd,pid))
             plist.append(p)
             p.start()

         for p in plist:
             p.join()
         print("%s: admin_mysql_kill_process controller finished." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),))
         func.mysql_exec("delete from mysql_process_killed",'')


if __name__=='__main__':
    main()
