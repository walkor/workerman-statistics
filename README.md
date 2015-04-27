所需环境
========

需要PHP版本不低于5.3，只需要安装PHP的Cli即可，无需安装PHP-FPM、nginx、apache
不能运行在Window平台

示例
========
[Live Demo](http://monitor.workerman.net/)

安装
=========

以ubuntu为例

安装PHP Cli  
`sudo apt-get install php5-cli`

启动停止
=========

以ubuntu为例

启动  
`php start.php start -d`

重启启动  
`php start.php restart`

平滑重启/重新加载配置  
`php start.php reload`

查看服务状态  
`php start.php status`

停止  
`php start.php stop`

权限验证
=======

  *  管理员用户名密码默认都为空，即不需要登录就可以查看监控数据
  *  如果需要登录验证，在applications/Statistics/Config/Config.php里面设置管理员密码


 [更多请访问www.workerman.net](http://www.workerman.net/workerman-statistics)
