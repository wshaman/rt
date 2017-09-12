#!/usr/bin/env bash
composer update
DBCONFIG="./config/db.php"
if [ -a $DBCONFIG ]
then
    echo "$DBCONFIG file exists, skipping"
else
    cp ./config/db.example.php $DBCONFIG
    echo "Don't forget to update $DBCONFIG"
fi
php yii migrate/up --migrationPath=@vendor/nkostadinov/yii2-user/migrations
php yii rbac/init
php yii migrate
php yii seed 100