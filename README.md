1、创建数据库 导入根目录下的 websoftcms.sql数据库文件。
2、配置域名 替换 config/app.php 文件里fang.com 域名为你自己的域名（不要带前辍）
3、更改数据库地址、数据库名和数据库账号密码 config/database.php 文件里
4、模块域名绑定在 route/route.php 若要修改各个模块的访问域名可在此文件修改
5、域名解析 因为城市单独绑定了域名 可泛解析到您的服务器.  域名需绑定到public目录，入口文件 index.php在public目录
6、后台模块目录 /application/manage    二级域名 admin
7、手机模块目录  /application/mobile   二级域名 m
8、小程序接口目录 /application/api     二级域名 api  需安装ssl证书
9、恶意攻击者的ip会主动记录并禁止继续访问该数据文件保存在/data/目录下.
后台默认账号密码为：admin        123456
注：如果未绑定模块域名 请删除/route目录下的路由文件，则可通过目录访问. 进入后台地址为：域名/manage。

目录权限：
/runtime 可写
/public/uploads/可写
/public/static/可写
/application/home/view/ 可写

环境要求：
apache/nginx/iis
php版本 >= 7.0
mysql版本 >= 5.5
php开启php_fileinfo扩展
(如果服务器没有安装此扩展 解决方案一：重新安装。 解决方案二：config/app.php 第123行注释 (不验证文件mime类型))


