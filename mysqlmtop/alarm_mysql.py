#!/bin/env python
#-*-coding:utf-8-*-
from datetime import *
import global_functions as func


def get_alarm_mysql_status():
    sql="select a.application_id,a.server_id,a.create_time,a.connect,a.connections,a.active,b.send_mail,b.alarm_connections,b.alarm_active,b.threshold_connections,b.threshold_active from mysql_status a, servers b where a.server_id=b.id;"
    result=func.mysql_query(sql)
    if result <> 0:
        for line in result:
            application_id=line[0]
            server_id=line[1]
            create_time=line[2]
            connect=line[3]
            connections=line[4]
            active=line[5]
            send_mail=line[6]
            alarm_connections=line[7]
            alarm_active=line[8]
            threshold_connections=line[9]
            threshold_active=line[10]

            if connect <> "success":
                    sql="insert into alarm(application_id,server_id,create_time,db_type,alarm_type,alarm_value,level,message,send_mail) values(%s,%s,%s,%s,%s,%s,%s,%s,%s);"
                    param=(application_id,server_id,create_time,'mysql','connect',connect,'error','数据库服务器连接失败',send_mail)    
                    func.mysql_exec(sql,param)
            else:
                if int(alarm_connections)==1:
                    if int(connections)>=int(threshold_connections):
                        sql="insert into alarm(application_id,server_id,create_time,db_type,alarm_type,alarm_value,level,message,send_mail) values(%s,%s,%s,%s,%s,%s,%s,%s,%s);"
                        param=(application,server_id,create_time,'mysql','connections',connections,'warning','数据库总连接数过多',send_mail)                 
                        func.mysql_exec(sql,param)
                if int(alarm_active)==1:
                    if int(active)>=int(threshold_active):
                        sql="insert into alarm(application_id,server_id,create_time,db_type,alarm_type,alarm_value,level,message,send_mail) values(%s,%s,%s,%s,%s,%s,%s,%s,%s);"
                        param=(application,server_id,create_time,'mysql','active',active,'warning','数据库活动连接过多',send_mail)
                        func.mysql_exec(sql,param)
    else:
       pass


def get_alarm_mysql_replcation():
    sql="select a.application_id,a.server_id,a.create_time,a.slave_io_run,a.slave_sql_run,a.delay,b.send_mail,b.alarm_repl_status,b.alarm_repl_delay,b.threshold_repl_delay from mysql_replication a,servers b  where a.server_id=b.id and a.is_slave='1';"
    result=func.mysql_query(sql)
    if result <> 0:
        for line in result:
            application=line[0]
            server_id=line[1]
            create_time=line[2]
            slave_io_run=line[3]
            slave_sql_run=line[4]
            delay=line[5]
            send_mail=line[6]
            alarm_repl_status=line[7]
            alarm_repl_delay=line[8]
            threshold_repl_delay=line[9]
            if alarm_repl_status==1:
                if (slave_io_run== "Yes") and (slave_sql_run== "Yes"):
                    if alarm_repl_delay=="yes":
                        if int(delay)>=int(threshold_repl_delay):
                            sql="insert into alarm(application_id,server_id,create_time,db_type,alarm_type,alarm_value,level,message,send_mail) values(%s,%s,%s,%s,%s,%s,%s,%s,%s);"
                            param=(application,server_id,create_time,'mysql','delay',delay,'warning','数据库备库延时',send_mail)
                            func.mysql_exec(sql,param)
		else:
                    sql="insert into alarm(application_id,server_id,create_time,db_type,alarm_type,alarm_value,level,message,send_mail) values(%s,%s,%s,%s,%s,%s,%s,%s,%s);"
                    param=(application,server_id,create_time,'mysql','replication','IO Thread:'+slave_io_run+',SQL Thread:'+slave_sql_run,'error','数据库同步进程停止',send_mail)
                    func.mysql_exec(sql,param)
    else:
       pass


def send_alarm_mail():
    sql="select alarm.application_id,app.display_name application,alarm.server_id,servers.host,servers.port,alarm.create_time,db_type,alarm_type,alarm_value,level,message,alarm.send_mail from alarm left join servers on alarm.server_id=servers.id left join application app on servers.application_id=app.id;"
    result=func.mysql_query(sql)
    if result <> 0:
        send_alarm_mail = func.get_option('send_alarm_mail')
        mail_to_list = func.get_option('mail_to_list')
        mailto_list=mail_to_list.split(';')
        for line in result:
            application_id=line[0]
            application=line[1]
            server_id=[2]
            host=line[3]
            port=line[4]
            create_time=line[5]
            db_type=line[6]
            alarm_type=line[7]
            alarm_value=line[8]
            level=line[9]
            message=line[10]
            send_mail=line[11]
            if send_alarm_mail=="1":
                if send_mail==1:
                    mail_subject=message+' 当前值:'+alarm_value+' 服务器:'+application+'-'+host+':'+port+' 时间:'+create_time.strftime('%Y-%m-%d %H:%M:%S')
                    mail_content="please check!"
                    result = func.send_mail(mailto_list,mail_subject,mail_content)
                    if result:
                        send_mail_status=1
                    else:
                        send_mail_status=0
                else:
                    send_mail_status=0
            else:
                send_mail_status=0

            if send_mail_status==1:
                func.mysql_exec("insert into alarm_history(application_id,server_id,create_time,db_type,alarm_type,alarm_value,level,message,send_mail,send_mail_status) select application_id,server_id,create_time,db_type,alarm_type,alarm_value,level,message,send_mail,1 from alarm;",'')
            elif send_mail_status==0:
                func.mysql_exec("insert into alarm_history(application_id,server_id,create_time,db_type,alarm_type,alarm_value,level,message,send_mail,send_mail_status) select application_id,server_id,create_time,db_type,alarm_type,alarm_value,level,message,send_mail,0 from alarm;",'')
            func.mysql_exec("delete from alarm",'')

    else:
        pass


if __name__ == '__main__':
    get_alarm_mysql_status()
    get_alarm_mysql_replcation()
    send_alarm_mail()














