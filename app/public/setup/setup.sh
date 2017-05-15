#!/usr/bin/env bash

sh /var/www/html/setup/load-fixtures.sh
php /var/www/html/bin/console assets:install /var/www/html/web --symlink --relative
php /var/www/html/bin/console assetic:dump --env=prod --no-debug
sh /var/www/html/setup/fix-acl.sh