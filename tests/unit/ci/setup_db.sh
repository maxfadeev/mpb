#! /bin/sh

DIR=$(readlink -enq $(dirname $0))

mysql -uroot -e 'create database blog charset=utf8 collate=utf8_unicode_ci;' && mysql -uroot blog < "$DIR/../../data/blog.sql"
wait