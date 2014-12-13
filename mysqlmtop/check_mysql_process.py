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

def check_mysql_process(host,port,user,passwd,server_id,application_id):
    try:
        datalist=[]
        connect=MySQLdb.connect(host=host,user=user,passwd=passwd,port=int(port),connect_timeout=2,charset='utf8')
        cur=connect.cursor()
        connect.select_db('information_schema')
        processlist=cur.execute('select * from information_schema.processlist where Command !="" and DB !="information_schema";')
        if processlist: 
            for row in cur.fetchall():
                result=row
                sql="insert into mysql_process(server_id,application_id,pid,user,host,db,command,time,status,info) values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
                param=(server_id,application_id,result[0],result[1],result[2],result[3],result[4],result[5],result[6],result[7])
                func.mysql_exec(sql,param)
    except MySQLdb.Error,e:
        pass
        print "Mysql Error %d: %s" %(e.args[0],e.args[1])


def main():
    func.mysql_exec("delete from mysql_process",'')
    #get mysql servers list
    user = func.get_config('mysql_db','username')
    passwd = func.get_config('mysql_db','password')
    servers=func.mysql_query("select id,host,port,application_id,status from servers where is_delete=0;")
    if servers:
         print("%s: check_mysql_process controller started." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),));
         plist = []
         for row in servers:
             server_id=row[0]
             host=row[1]
             port=row[2]
             application_id=row[3]
             status=row[4]
             if status <> 0:
                 p = Process(target = check_mysql_process, args = (host,port,user,passwd,server_id,application_id))
                 plist.append(p)
                 p.start()

         for p in plist:
             p.join()
         print("%s: check_mysql_process controller finished." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),))

if __name__=='__main__':
    main()
