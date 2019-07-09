# 使用文档
> 初始账户密码: admin  admin

### 步骤
    git clone  git@github.com:lei-jinlei/laravel-admin-layui.git
    composer install
    composer dump-autoload
    php artisan migrate --seed



### 注意事项

配置本地域名指向到项目目录的public里面

    DocumentRoot "D:\Projects\项目名\public"

如果访问出现任何问题:

nginx 配置

>如果你使用的是 Nginx，在你的站点配置中加入以下内容，它将会将所有请求都引导到 index.php 前端控制器：

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

Apache

> 如果 Laravel 附带的 .htaccess 文件不起作用，就尝试用下面的方法代替：

    Options +FollowSymLinks
    RewriteEngine On

    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]