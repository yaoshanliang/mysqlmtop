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

def check_mysql_widget(host,port,user,passwd,server_id):
    try:
        connect=MySQLdb.connect(host=host,user=user,passwd=passwd,port=int(port),connect_timeout=2,charset='utf8')
        cur=connect.cursor()
        connect.select_db('information_schema')

        datalist=[]
	cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Qcache_hits';");
        result = cur.fetchone()
        Qcache_hits=result[0]
        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Com_select';");
        result = cur.fetchone()
        Com_select=result[0]
        Query_cache_hits = string.atof(Qcache_hits) / (string.atof(Qcache_hits) + string.atof(Com_select))
        Query_cache_hits =  "%9.2f" %Query_cache_hits
        datalist.append(Query_cache_hits)       

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Key_reads';");
        result = cur.fetchone()
        Key_reads=result[0]
        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Key_read_requests';");
        result = cur.fetchone()
        Key_read_requests=result[0]
        if string.atof(Key_read_requests) <> 0:
            Key_buffer_read_hits = 1 - string.atof(Key_reads) / string.atof(Key_read_requests)       
            Key_buffer_read_hits =  "%9.2f" %Key_buffer_read_hits
        else:
            Key_buffer_read_hits=0
        datalist.append(Key_buffer_read_hits)

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Key_writes';");
        result = cur.fetchone()
        Key_writes=result[0]
        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Key_write_requests';");
        result = cur.fetchone()
        Key_write_requests=result[0]
        if string.atof(Key_write_requests) <> 0:
            Key_buffer_write_hits = 1 - string.atof(Key_writes) / string.atof(Key_write_requests)
            Key_buffer_write_hits =  "%9.2f" %Key_buffer_write_hits
        else:
            Key_buffer_write_hits = 0
        datalist.append(Key_buffer_write_hits)

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Threads_created';");
        result = cur.fetchone()
        Threads_created=result[0]
        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Connections';");
        result = cur.fetchone()
        Connections=result[0]
        Thread_cache_hits = 1 - string.atof(Threads_created) / string.atof(Connections)
        Thread_cache_hits =  "%9.2f" %Thread_cache_hits
        datalist.append(Thread_cache_hits)
 
        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Key_blocks_used';");
        result = cur.fetchone()
        Key_blocks_used=result[0]
        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Key_blocks_unused';");
        result = cur.fetchone()
        Key_blocks_unused=result[0]
        Key_blocks_used_rate = string.atof(Key_blocks_used) / (string.atof(Key_blocks_used)+string.atof(Key_blocks_unused))
        Key_blocks_used_rate =  "%9.2f" %Key_blocks_used_rate
        datalist.append(Key_blocks_used_rate)

        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Created_tmp_disk_tables';");
        result = cur.fetchone()
        Created_tmp_disk_tables=result[0]
        cur.execute("select VARIABLE_VALUE  from GLOBAL_STATUS where VARIABLE_NAME ='Created_tmp_tables';");
        result = cur.fetchone()
        Created_tmp_tables=result[0]
        Created_tmp_disk_tables_rate = string.atof(Created_tmp_disk_tables) / (string.atof(Created_tmp_disk_tables)+string.atof(Created_tmp_tables))
        Created_tmp_disk_tables_rate =  "%9.2f" %Created_tmp_disk_tables_rate
        datalist.append(Created_tmp_disk_tables_rate)

        result=datalist
        if result:
             sql="insert into mysql_widget_hit_rate(server_id,Query_cache_hits,Key_buffer_read_hits,Key_buffer_write_hits,Thread_cache_hits,Key_blocks_used_rate,Created_tmp_disk_tables_rate) values(%s,%s,%s,%s,%s,%s,%s)"
             param=(server_id,result[0],result[1],result[2],result[3],result[4],result[5])
             func.mysql_exec(sql,param)

        cur.close()
        connect.close()
        
    except MySQLdb.Error,e:
        pass
        print "Mysql Error %d: %s" %(e.args[0],e.args[1])


def main():
    func.mysql_exec("truncate table mysql_widget_hit_rate",'')
    #get mysql servers list
    user = func.get_config('mysql_db','username')
    passwd = func.get_config('mysql_db','password')
    servers=func.mysql_query("select id,host,port from servers where is_delete=0;")
    if servers:
         print("%s: check_mysql_widget_hit_rate controller started." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),));
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
         print("%s: check_mysql_widget_hit_rate controller finished." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),))



if __name__=='__main__':
    main()
