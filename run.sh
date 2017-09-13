#!/usr/bin/env bash
composer update
DBCONFIG="./config/db.php"
if [ -a $DBCONFIG ]
then
    echo "$DBCONFIG file exists, can proceed"
    php yii migrate/up --migrationPath=@vendor/nkostadinov/yii2-user/migrations
    php yii rbac/init
    php yii migrate
    php yii seed 100
    php yii seed/users
else
    cp ./config/db.example.php $DBCONFIG
    echo "Don't forget to update $DBCONFIG and run this script again"
fi