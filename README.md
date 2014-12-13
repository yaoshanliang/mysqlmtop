#MySQL企业监控系统 MySQL MTOP 



MySQL MTOP是一个由Python+PHP开发的开源MySQL企业监控系统。系统由Python实现多进程数据采集和告警，PHP实现WEB展示和管理。MySQL服务器无需安装任何Agent，只需在监控WEB界面配置相关数据库信息，启动监控进程后，即可对上百台MySQL数据库的状态、连接数、QTS、TPS、数据库流量、复制、性能慢查询等进行时时监控。并能在数据库偏离设定的正常运行阀值(如连接异常，复制异常，复制延迟) 时发送告警邮件通知到DBA进行处理。并对历史数据归档，通过图表展示出数据库近期状态，以便DBA和开发人员能对遇到的问题进行分析和诊断。

由于本人水平有限，在使用过程中遇到的问题和bug希望大家理解并能反馈。谢谢大家的支持。

备注：git上面的源码主要为了以方便开发，下载软件最好通过官网下载，以确保完整性。

官方网站：http://www.mtop.cc
交流社区：http://www.mtop.cc/forum
Geekwolf Blog: www.linuxhonker.com
