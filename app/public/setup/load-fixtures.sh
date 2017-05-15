#!/usr/bin/env bash

php /var/www/html/bin/console doctrine:mongodb:fixtures:load
php /var/www/html/bin/console fos:user:create admin admin@fishiri admin --super-admin
php /var/www/html/bin/console fos:oauth:create-client --name=adminClient --redirect-uri=http://fishiri.sysla.no/ --grant-type=client_credentials --grant-type=password --grant-type=refresh_token
