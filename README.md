# SaaSProducts

#Set up PHP dependencies

curl -sS https://getcomposer.org/installer | php

php composer.phar install

#Run the test
php bin/phpunit

#Execute Commands

php bin/console import:product capterra

php bin/console import:product softwareadvice
