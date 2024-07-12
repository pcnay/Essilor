#!/bin/bash
#
USER="usuario_essilor"
PASSWORD="essilor-Mar-04-2020"
DATABASE="bd_essilor"
date=$(date +"%Y-%m-%d")
PATH_OUTPUT="/var/www/html/Proyectos/Essilor/resp_bd/backup"
mysqldump --user=$USER --password=$PASSWORD $DATABASE > $PATH_OUTPUT/$DATABASE-$date.sql
gzip $PATH_OUTPUT/$DATABASE-$date.sql

find $PATH_OUTPUT/* -mtime +30 -exec rm {} \;
