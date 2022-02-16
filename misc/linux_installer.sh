#!/bin/sh

echo " "
echo '########################################################'
echo '#                                                      #'
echo '# 1/4: Install requirments with composer.              #'
echo '#                                                      #'
echo '########################################################'
echo " "

TEST="$(composer --version)"
echo " "
if [ "$TEST" == "" ]
then
    >&2 echo '########################################################'
    >&2 echo '# ERROR: Composer is not installed.                    #'
    >&2 echo '# Installer will do it.                                #'
    >&2 echo '########################################################'

    curl -sS https://getcomposer.org/installer -o composer-setup.php
    HASH="$(wget -q -O - https://composer.github.io/installer.sig)"
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer
    rm composer-setup.php
fi

cd ../
composer install

echo " "
echo '########################################################'
echo '#                                                      #'
echo '# 2/4: Install VueJS & Nuxt requirments                #'
echo '#                                                      #'
echo '########################################################'
echo " "

TEST="$(npm -v)"
echo " "
if [ "$TEST" == "" ]
then
    >&2 echo '########################################################'
    >&2 echo '# ERROR: NPM is not installed.                         #'
    >&2 echo '# Installer will do it.                                #'
    >&2 echo '########################################################'

    apt update
    apt-get install curl software-properties-common
    curl -sL https://deb.nodesource.com/setup_12.x | bash -
    apt install nodejs
fi

cd ./web/
npm install

echo " "
echo '########################################################'
echo '#                                                      #'
echo '# 3/4: Install migrations                              #'
echo '#                                                      #'
echo '########################################################'
echo " "

cd ../
php artisan migrate

echo " "
echo '########################################################'
echo '#                                                      #'
echo '# 4/4: Launch Nuxt server                              #'
echo '#                                                      #'
echo '########################################################'
echo " "

cd ./dev/
npm run dev