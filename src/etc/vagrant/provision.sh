#!/usr/bin/env bash

echo I am provisioning...
date > vagrant_provisioned_at

sudo -i

yum update

rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm

yum install -y php56w php56w-mysql php56w-fpm
yum replace php-common --replace-with=php56w-common

wget http://repo.mysql.com/mysql-community-release-el7-5.noarch.rpm
rpm -ivh mysql-community-release-el7-5.noarch.rpm
yum install -y mysql-server

yum install -y nginx

touch /etc/nginx/conf.d/mpb.conf
cat >> /etc/nginx/conf.d/mpb.conf <<'EOF'
server {

    listen   3000;
    server_name localhost;

    charset utf-8;

    index index.php index.html index.htm;
    set $root_path '/var/www/mpb/public';
    error_log /var/log/nginx/mpb.error.log;
    access_log /var/log/nginx/mpb.access.log;
    root $root_path;

    try_files $uri $uri/ @rewrite;

    location @rewrite {
        rewrite ^/(.*)$ /index.php?_url=/$1;
    }

    location ~ \.php {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index /index.php;

        include /etc/nginx/fastcgi_params;

        fastcgi_split_path_info       ^(.+\.php)(/.+)$;
        fastcgi_param PATH_INFO       $fastcgi_path_info;
        fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~* ^/(css|img|js|flv|swf|download)/(.+)$ {
        root $root_path;
    }

    location ~ /\.ht {
        deny all;
    }
}
EOF

rm -f /etc/php-fpm.d/www.conf
touch /etc/php-fpm.d/www.conf

cat >> /etc/php-fpm.d/www.conf <<'EOF'
[www]

listen = 127.0.0.1:9000

listen.allowed_clients = 127.0.0.1

user = nginx
group = nginx

pm = dynamic

pm.max_children = 50

pm.start_servers = 5

pm.min_spare_servers = 5

pm.max_spare_servers = 35

pm.max_requests = 1000

slowlog = /var/log/php-fpm/www-slow.log

php_admin_value[error_log] = /var/log/php-fpm/www-error.log
php_admin_flag[log_errors] = on

php_value[session.save_handler] = files
php_value[session.save_path]    = /var/lib/php/session
php_value[soap.wsdl_cache_dir]  = /var/lib/php/wsdlcache
EOF

service nginx start
service php-fpm start