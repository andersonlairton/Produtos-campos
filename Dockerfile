FROM php:7.2
FROM mysql:5.6
ADD dump/initdb.sql /docker-entrypoint-initdb.d