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

def check_mysql_replication(host,port,user,passwd,server_id,application_id):
    try:
        connect=MySQLdb.connect(host=host,user=user,passwd=passwd,port=int(port),connect_timeout=2,charset='utf8')
        cur=connect.cursor()
        connect.select_db('information_schema')
        master_thread=cur.execute("select * from information_schema.processlist where COMMAND = 'Binlog Dump' or COMMAND = 'Binlog Dump GTID';")
        slave_status=cur.execute('show slave status;')
        datalist=[]
        if master_thread >= 1:
            datalist.append(int(1))
            if slave_status <> 0:
                datalist.append(int(1))
            else:
                datalist.append(int(0))
        else:
            datalist.append(int(0))
            if slave_status <> 0:
                datalist.append(int(1))
            else:
                datalist.append(int(0))
        
    
        if slave_status <> 0:
            read_only=cur.execute("select * from information_schema.global_variables where variable_name='read_only';")
            result=cur.fetchone()
            datalist.append(result[1])
            slave_info=cur.execute('show slave status;')
            result=cur.fetchone()
            master_server=result[1]
            master_port=result[3]
            slave_io_run=result[10]
            slave_sql_run=result[11]
            delay=result[32]
            current_binlog_file=result[9]
            current_binlog_pos=result[21]
            master_binlog_file=result[5]
            master_binlog_pos=result[6]
     
            datalist.append(master_server)
            datalist.append(master_port)
            datalist.append(slave_io_run)
            datalist.append(slave_sql_run)
            datalist.append(delay)
            datalist.append(current_binlog_file)
            datalist.append(current_binlog_pos)
            datalist.append(master_binlog_file)
            datalist.append(master_binlog_pos)

        elif master_thread >= 1:
            read_only=cur.execute("select * from information_schema.global_variables where variable_name='read_only';")
            result=cur.fetchone()
            datalist.append(result[1])
            datalist.append('---')
            datalist.append('---')
            datalist.append('---')
            datalist.append('---')
            datalist.append('---')
            datalist.append('---')
            datalist.append('---')
            master=cur.execute('show master status;')
            master_result=cur.fetchone()
            datalist.append(master_result[0])
            datalist.append(master_result[1])

        else:
            datalist=[]
            
        cur.close()
        connect.close()
        result=datalist
        if result:
            sql="insert into mysql_replication(server_id,application_id,is_master,is_slave,read_only,master_server,master_port,slave_io_run,slave_sql_run,delay,current_binlog_file,current_binlog_pos,master_binlog_file,master_binlog_pos) values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
            param=(server_id,application_id,result[0],result[1],result[2],result[3],result[4],result[5],result[6],result[7],result[8],result[9],result[10],result[11])
            func.mysql_exec(sql,param)
    except MySQLdb.Error,e:
        pass
        print "Mysql Error %d: %s" %(e.args[0],e.args[1])


def main():
    func.mysql_exec("insert into mysql_replication_history(server_id,application_id,is_master,is_slave,read_only,master_server,master_port,slave_io_run,slave_sql_run,delay,current_binlog_file,current_binlog_pos,master_binlog_file,master_binlog_pos,create_time,YmdHi) select server_id,application_id,is_master,is_slave,read_only,master_server,master_port,slave_io_run,slave_sql_run,delay,current_binlog_file,current_binlog_pos,master_binlog_file,master_binlog_pos,create_time, LEFT(REPLACE(REPLACE(REPLACE(create_time,'-',''),' ',''),':',''),12) from mysql_replication;",'')
    func.mysql_exec("delete from  mysql_replication",'')
    #get mysql servers list
    user = func.get_config('mysql_db','username')
    passwd = func.get_config('mysql_db','password')
    servers=func.mysql_query("select id,host,port,application_id,status from servers where is_delete=0;")
    if servers:
        print("%s: check_mysql_replication controller started." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),));
        plist = []
        for row in servers:
            server_id=row[0]
            host=row[1]
            port=row[2]
            application_id=row[3]
            status=row[4]
            if status <> 0:
                p = Process(target = check_mysql_replication, args = (host,port,user,passwd,server_id,application_id))
                plist.append(p)
                p.start()

        for p in plist:
            p.join()
        print("%s: check_mysql_replication controller finished." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),))


if __name__=='__main__':
    main()
