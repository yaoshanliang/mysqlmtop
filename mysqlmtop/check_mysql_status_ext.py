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


def check_mysql_status_ext(host,port,user,passwd,server_id):
    datalist=[]
    try:
        connect=MySQLdb.connect(host=host,user=user,passwd=passwd,port=int(port),connect_timeout=2,charset='utf8')
        cur=connect.cursor()
        connect.select_db('information_schema')

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Queries';");
        result = cur.fetchone()
        Queries=result[0]

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Com_commit';");
        result = cur.fetchone()
        Com_commit=result[0]

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Com_rollback';");
        result = cur.fetchone()
        Com_rollback=result[0]

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Bytes_received';");
        result = cur.fetchone()
        Bytes_received=result[0]

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Bytes_sent';");
        result = cur.fetchone()
        Bytes_sent=result[0]

        time.sleep(1)

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Queries';");
        result = cur.fetchone()
        Queries_2=result[0]

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Com_commit';");
        result = cur.fetchone()
        Com_commit_2=result[0]

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Com_rollback';");
        result = cur.fetchone()
        Com_rollback_2=result[0]

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Bytes_received';");
        result = cur.fetchone()
        Bytes_received_2=result[0]

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Bytes_sent';");
        result = cur.fetchone()
        Bytes_sent_2=result[0]

        QPS=int(Queries_2) - int(Queries)
        TPS=(int(Com_commit_2)+int(Com_rollback_2)) - (int(Com_commit)+int(Com_rollback))
        Bytes_received=(int(Bytes_received_2) - int(Bytes_received))/1024
        Bytes_sent=(int(Bytes_sent_2) - int(Bytes_sent))/1024
      
        cur.close()
        connect.close()
        sql="insert into mysql_status_ext(server_id,QPS,TPS,Bytes_received,Bytes_sent) values(%s,%s,%s,%s,%s)"
        param=(server_id,QPS,TPS,Bytes_received,Bytes_sent)
        func.mysql_exec(sql,param)
    except MySQLdb.Error,e:
        print "Mysql Error %d: %s" %(e.args[0],e.args[1])
        sql="insert into mysql_status_ext(server_id,QPS,TPS,Bytes_received,Bytes_sent) values(%s,%s,%s,%s,%s)"
        param=(server_id,0,0,0,0)
        func.mysql_exec(sql,param)


def main():
    func.mysql_exec("insert into mysql_status_ext_history(server_id,QPS,TPS,Bytes_received,Bytes_sent,create_time,YmdHi) select server_id,QPS,TPS,Bytes_received,Bytes_sent,create_time,LEFT(REPLACE(REPLACE(REPLACE(create_time,'-',''),' ',''),':',''),12) from mysql_status_ext;",'')
    func.mysql_exec("delete from  mysql_status_ext",'')
    #get mysql servers list
    user = func.get_config('mysql_db','username')
    passwd = func.get_config('mysql_db','password')
    servers=func.mysql_query("select id,host,port,status from servers where is_delete=0;")
    if servers:
        print("%s: check_mysql_status_ext controller started." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),));
        plist = []
        for row in servers:
            server_id=row[0]
            host=row[1]
            port=row[2]
            status=row[3]
            if status <> 0:
                p = Process(target = check_mysql_status_ext, args = (host,port,user,passwd,server_id))
                plist.append(p)
                p.start()

        for p in plist:
            p.join()
        print("%s: check_mysql_status_ext controller finished." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),))
                     

if __name__=='__main__':
    main()
