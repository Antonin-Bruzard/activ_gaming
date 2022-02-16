#!/bin/sh

# Memorise callback directory.
pwd=$(pwd)

# Declare paths
path_api=$pwd/api
path_front=$pwd/_front

# Name screen consoles
dev_screenname='NUXTDEV'
prod_screenname='NUXTPROD'

# FUNCTIONS : START

Aliases () {
   cd ~

   echo "Deleting old ..."

    # Delete old aliases if exist
    sed -i -e '/app/d' ~/.bashrc >> /dev/null
    sed -i -e '/pa/d' ~/.bashrc >> /dev/null
    sed -i -e '/tinker/d' ~/.bashrc >> /dev/null

    echo "Install new ..."

    # Define new aliases
    echo -e "alias app='bash app.sh'" >> ~/.bashrc
    echo -e "alias pa='php api/artisan'" >> ~/.bashrc
    echo -e "alias tinker='php api/artisan tinker'" >> ~/.bashrc

    # Back to good dir.
    cd $pwd

    # Reload bash and aliases.
    source ~/.bashrc

    echo "Aliases has been installed in your ~./.bashrc file."
}

# FUNCTIONS : END

# UX : START
if [ -z "$1" ]
then
   echo "Basic [start | stop | open]"
   echo "Usage: app start dev"
   echo "       app start dev -screen"
   echo " "
   echo "Updater [update]"
   echo "Usage: app update composer"
   echo "       app update npm"
   echo " "
   echo "Database [migrate, mig | seed]"
   echo " "

#############################
#       START ACTION        #
#############################

elif [ $1 = "start" ]
then
    # START: dev
    if [ -z "$2" ]
    then
        echo "You must specify witch mode: [build | dev]"
    elif [ $2 = "dev" ]
    then
        # START: dev in screen mode.
        if [ -z "$3" ]
        then
            cd $path_front
            npm run dev
        # START: dev in windows mode.
        elif [ $3 = "-screen" ]
        then
            cd $path_front            
            screen -A -m -d -S $dev_screenname npm run dev
        else
            echo "Unknow mode \"$3\"."
            echo "Choose one of both: [build | dev]"
        fi
    # START: prod
    elif [ $2 = "prod" ] || [ $2 = "build" ]
    then
        # START: prod in screen mode.
        if [ -z "$3" ]
        then
            cd $path_front
            npm run start
        # START: prod in windows mode.
        elif [ $3 = "-screen" ]
        then
            cd $path_front
            screen -A -m -d -S $prod_screenname npm run build
        else
            echo "Unknow mode \"$3\"."
            echo "Choose one of both: [prod | dev]"
        fi
    fi

############################
#       STOP ACTION        #
############################

elif [ $1 = "stop" ]
then
    if [ -z "$2" ]
    then
        echo "You must specify witch mode: [prod | dev]"
    elif [ $2 = "dev" ]
    then
        screen -X -S $dev_screenname kill
        screen -ls
    elif [ $2 = "prod" ] | [ $2 = "build" ]
    then
        screen -X -S $prod_screenname kill
        screen -ls
    fi


############################
#       OPEN ACTION        #
############################

# Open a back console (screen)

elif [ $1 = "open" ]
then
    if [ $2 = "dev" ]
    then
        screen -r $dev_screenname
    elif [ $2 = "prod" ] | [ $2 = "build" ]
    then
        screen -r $prod_screenname
    fi

##############################
#       UPDATE ACTION        #
##############################

elif [ $1 = "update" ]
then
    # UPDATE ALL
    if [ -z "$2" ]
    then
        echo "All will be updated: composer && npm"
        echo " "
        echo "Use following commands to update in individual mode:"
        echo "app update composer"
        echo "app update npm"
        echo " "
        read -p "Are you sure to update all ? [Y/n]" -n 1 -r
        echo    # (optional) move to a new line
        if [[ $REPLY =~ ^[Yy]$ ]]
        then
            cd $path_api
            composer update

            cd $path_front            
            npm update
        else
            echo " "
            echo "Canceled"
        fi
    # UPDATE COMPOSER
    elif [ $2 = "composer" ] || [ $2 = "api" ] || [ $2 = "laravel" ]
    then
        cd $path_api
        composer update
    # UPDATE NODEJS
    elif [ $2 = "node" ] || [ $2 = "npm" ] || [ $2 = "nuxt" ] || [ $2 = "front" ]
    then
        cd $path_front
        npm update
    fi

###############################
#       INSTALL ACTION        #
###############################

elif [ $1 = "install" ]
then
    Aliases

    cd $path_api
    rm -rf composer.lock
    composer install

    cd $path_front
    rm -rf package-lock.json
    npm install

    echo " "
    echo "################"
    echo "# INFORMATIONS #"
    echo "################"
    echo " "
    echo "Command < app > can manage all your app. Start NodeJS, Installation, Update, ..."
    echo ""
    echo "Example: app start dev     <=>     cd _front && npm run dev"
    echo "Example: app migrate       <=>     php api/artisan migrate"
    echo "Example: app tinker        <=>     php api/artisan tinker"
    echo "Example: app rebase        <=>     git pull --rebase"
    echo ""
    echo "Example: pa route:list (replace remote PHP ARTISAN)"

    echo "Installation complete."
    echo "Don't forget to update your database with an < app migrate --seed > (or not)."

    echo ""
    echo "All installation done!"

###############################
#       MIGRATE ACTION        #
###############################

elif [ $1 = "migrate" ] || [ $1 = "mig" ]
then
    if [ -z $2 ]
    then
        php api/artisan migrate
    elif [ $2 = "-s" ] || [ $2 = "-seed" ] || [ $2 = "--s" ] || [ $2 = "--seed" ] || [ $2 = "seed" ] || [ $2 = "s" ]
    then
        php api/artisan migrate --seed
    fi

###############################
#       REFRESH ACTION        #
###############################

elif [ $1 = "rmigrate" ] || [ $1 = "rmig" ]
then
    if [ -z $2 ]
    then
        echo "[:refresh] option will erase all from your database."
        read -p "Are you sure to refresh all database ? [Y/n]" -n 1 -r
        echo    # (optional) move to a new line
        if [[ $REPLY =~ ^[Yy]$ ]]
        then
            php api/artisan migrate:refresh
        else
            echo " "
            echo "Canceled"
        fi
    elif [ $2 = "-s" ] || [ $2 = "-seed" ] || [ $2 = "--s" ] || [ $2 = "--seed" ] || [ $2 = "seed" ] || [ $2 = "s" ]
    then
        echo "[:refresh --seed] option will erase all from your database."
        read -p "Are you sure to refresh all database ? [Y/n]" -n 1 -r
        echo    # (optional) move to a new line
        if [[ $REPLY =~ ^[Yy]$ ]]
        then
            php api/artisan migrate:refresh --seed
        else
            echo " "
            echo "Canceled"
        fi
    fi

#############################
#       ALIAS ACTION        #
#############################

elif [ $1 = "alias" ]
then
    Aliases

##############################
#       REBASE ACTION        #
##############################

elif [ $1 = "rebase" ]
then
    git pull --rebase 

## END HERE ##
fi
# UX : START