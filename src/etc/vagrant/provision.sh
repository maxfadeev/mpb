#!/usr/bin/env bash

echo I am provisioning...
date > vagrant_provisioned_at

sudo -i

add-apt-repository ppa:ondrej/php5-5.6
apt-get update
apt-get install php5 php5-cli php5-dev php5-fpm php5-mysql -y

apt-get install git -y
git clone -b 2.1.x --depth=1 git://github.com/phalcon/cphalcon.git
cd cphalcon/ext; ./install
echo 'extension=phalcon.so' >> /etc/php5/fpm/conf.d/phalcon.ini
echo 'extension=phalcon.so' >> /etc/php5/cli/conf.d/phalcon.ini

apt-get remove apache2 -y
apt-get install nginx -y

export DEBIAN_FRONTEND=noninteractive
apt-get -q -y install mysql-server

sudo rm /etc/nginx/sites-available/default
sudo touch /etc/nginx/sites-available/default

sudo cat >> /etc/nginx/sites-available/default <<'EOF'
server {
    listen 8080;
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

rm -f /etc/php5/fpm/pool.d/www.conf
touch /etc/php5/fpm/pool.d/www.conf

cat >> /etc/php5/fpm/pool.d/www.conf <<'EOF'
[www]
listen = 127.0.0.1:9000
listen.allowed_clients = 127.0.0.1
user = www-data
group = www-data
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

service nginx restart
service php5-fpm restart

mysql -uroot -e 'create database blog charset=utf8 collate=utf8_unicode_ci;' && mysql -uroot blog < "/var/www/mpb/data/blog.sql"

mysql -uroot -e "GRANT ALL PRIVILEGES ON *.* TO 'blog'@'localhost'"

cd /var/www/mpb
curl -sS https://getcomposer.org/installer | php
php composer.phar update