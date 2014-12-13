#!/usr/bin/env python
#coding:utf-8
import os, sys, string, time, datetime, traceback;
from multiprocessing import Process;
import global_functions as func  

  


def job_run(script_name,times):
    while True:
        os.system("python "+script_name)
        time.sleep(int(times))



def main():
    print("%s: controller started." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),))
    monitor = func.get_option('monitor')
    monitor_status = func.get_option('monitor_status')
    monitor_replication = func.get_option('monitor_replication')
    monitor_process = func.get_option('monitor_process')
    alarm = func.get_option('alarm')
    frequency_monitor = func.get_option('frequency_monitor')
    frequency_alarm = func.get_option('frequency_alarm')
    kill_process = func.get_option('kill_process')

    joblist = []
    if monitor=="1":
        if monitor_status=="1":
            job = Process(target = job_run, args = ('check_mysql_status_ext.py',frequency_monitor))
            joblist.append(job)
            job.start()
            job = Process(target = job_run, args = ('check_mysql_status.py',frequency_monitor))
            joblist.append(job)
            job.start()
        if monitor_replication=="1":
            job = Process(target = job_run, args = ('check_mysql_replication.py',frequency_monitor))
            joblist.append(job)
            job.start()
        if monitor_process=="1":
            job = Process(target = job_run, args = ('check_mysql_process.py',4))
            joblist.append(job)
            job.start()
        if alarm=="1":
            job = Process(target = job_run, args = ('alarm_mysql.py',frequency_alarm))
            joblist.append(job)
            job.start()    
        if kill_process=="1":
            job = Process(target = job_run, args = ('admin_mysql_kill_process.py',3))
            joblist.append(job)
            job.start()

        for job in joblist:
            job.join();
    print("%s: controller finished." % (time.strftime('%Y-%m-%d %H:%M:%S', time.localtime()),))
    

  
if __name__ == '__main__':  
    main()
