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

def check_mysql_widget(host,port,user,passwd,server_id):
    try:
        connect=MySQLdb.connect(host=host,user=user,passwd=passwd,port=int(port),connect_timeout=2,charset='utf8')
        cur=connect.cursor()
        connect.select_db('information_schema')
        try:
           bigtable=cur.execute("SELECT table_schema as 'DB',table_name as 'TABLE',CONCAT(ROUND(( data_length + index_length ) / ( 1024 * 1024 * 1024 ), 2), '') 'TOTAL' , table_comment as COMMENT FROM information_schema.TABLES ORDER BY data_length + index_length DESC ;");
           big_table_size = func.get_option('big_table_size')
           if bigtable:
               for row in cur.fetchall():
                   datalist=[]
                   for r in row:
                      datalist.append(r)
                   result=datalist
                   if result:
                       table_size = float(string.atof(result[2]))
                       if table_size >= int(big_table_size):
                          sql="insert into mysql_widget_bigtable(server_id,db_name,table_name,table_size,table_comment) values(%s,%s,%s,%s,%s);"
                          param=(server_id,result[0],result[1],result[2],result[3])
                          func.mysql_exec(sql,param)
        except :
           pass

        cur.close()
        connect.close()
        exit

    except MySQLdb.Error,e:
        pass
        print "Mysql Error %d: %s" %(e.args[0],e.args[1])


def main():

    func.mysql_exec("truncate table mysql_widget_bigtable",'')
    #get mysql servers list
    user = func.get_config('mysql_db','username')
    passwd = func.get_config('mysql_db','password')
    servers=func.mysql_query("select id,host,port,status from servers where is_delete=0;")
    if servers:
        print("%s: check_mysql_widget_bigtable controller started." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),));
        plist = []
        for row in servers:
            server_id=row[0]
            host=row[1]
            port=row[2]
            p = Process(target = check_mysql_widget, args = (host,port,user,passwd,server_id))
            plist.append(p)
            p.start()

        for p in plist:
            p.join()
        print("%s: check_mysql_widget_bigtable controller finished." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),))
                     

if __name__=='__main__':
    main()
