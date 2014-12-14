#MySQL监控系统
由开源项目MYSQLMTOP及linux-dash修改而来，实时MySQL健康监控、复制监控、进程监控、性能监控、实时告警、慢查询分析、服务器资源监控等。

###安装说明 (以ubuntu14.04为例)
####1、安装LAMP环境

	sudo apt-get install lamp-server^

####2、安装python环境
系统已经安装python2.7，需要安装mysql-python，采用pip进行安装

	sudo apt-get install python-pip python-dev

	sudo pip install mysql-python

####3、监控机配置
（1）监控机创建监控数据库，并授予权限,导入SQL文件

mysql> create database mysqlmtop default character set utf8;

mysql> grant select,insert,update,delete,create on mysqlmtop.* to 'mtop_user'@'localhost' identified by 'password';

mysql> flush privileges;

导入sql文件夹里的SQL文件(表结构和数据文件)

mysql -uroot -p mysqlmtop < mysqlmtop.sql

mysql -uroot -p mysqlmtop < mysqlmtop_data.sql

（2）对被监控的数据库进行授权

备注：在python采集数据的过程中，需要连接到需要监控的数据库服务器采集数据，我们为了安全考虑，在WEB管理里面只要求录入主机和端口，没有录入账号和密码。所有需要监控的数据库请授予相同的用户密码记录在配置文件中。授权如下所示：

grant select,super,process on *.* to 'monitor'@'ip' identified by 'monitor';

###4、被监控服务器配置
（1）将mysqlmtop文件夹上传至被监控服务器的/usr/local/下

（2）修改被监控服务器配置文件
	cd /usr/local/mysqlmtop/

	vim etc/config.ini 

	###监控机MySQL数据库连接地址###
	[monitor_server]
	host="localhost"
	port=3306
	user="mtop_user"
	passwd="password"
	dbname="mysqlmtop"

	###被监控MySQL数据库的用户密码###
	[mysql_db]
	username="monitor"
	password="monitor"

	###邮件报警服务器地址###
	[mail_server]
	mail_host="smtp.126.com"
	mail_user="alarm@126.com"
	mail_pass="password"
	mail_postfix="126.com"

	###Linux系统资源监控###
	[linux_server]
	server_ip=""

（3）授予可执行文件执行权限

	chmod a+x  *.py 

	chmod a+x  *.sh 

	chmod a+x  mtopctl

	ln -s /usr/local/mysqlmtop/mtopctl /usr/local/bin/

（4）测试MySQL连接(可选)

提示MySQLDB OK即为正常状态。

	./test_mysql.py 
	MySQLDB OK!
 

（5）启动监控系统(注意：只有监控进程运行时系统才会进行监控和报警)

	mtopctl  start

###5、安装web管理界面
将frontweb文件夹下的文件上传至监控机服务器
打开application\config\database.php文件，修改PHP连接监控服务器的数据库信息

	$db['default']['hostname'] = 'localhost';
	$db['default']['username'] = 'mtop_user';
	$db['default']['password'] = 'password';
	$db['default']['database'] = 'mysqlmtop';
	$db['default']['dbdriver'] = 'mysql';

通过浏览器输入IP地址或域名，例如http://localhost打开监控界面，即可登录系统.

默认管理员账号密码admin/admin 登录后请修改密码，增加普通账号
以管理员用户登录系统后在管理中心添加应用和服务器

点击 管理中心-》应用管理 添加应用

点击 管理中心-》服务器管理 添加MySQL服务器
