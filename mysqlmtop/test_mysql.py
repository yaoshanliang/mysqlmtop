#!//bin/env python
#coding:utf-8
import os
import sys
import string
import MySQLdb
import global_functions as func



def main():

    #get mysql servers list
    user = func.get_config('mysql_db','username')
    passwd = func.get_config('mysql_db','password')
    servers=func.mysql_query("select id,host,port,application_id,status from servers where is_delete=0;")
    if servers:
        for row in servers:
           print row
    else:
        print "MySQLDB OK!"

if __name__=='__main__':
    main()
