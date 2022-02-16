#!/bin/sh

dev_screenname='NUXTDEV'
prod_screenname='NUXTPROD'
is_windows=$('ipconfig')

if [ -z "$1" ]
then
   echo "You must specify a mode: [prod | dev]"
   echo "\"prod\": for production mode."
   echo "\"dev\": for development mode."

# SELECT DEV MODE
elif [ $1 = "dev" ]
then
    if [ -z "$2" ]
    then
        if [ ! -z "$is_windows" ]
        then
            echo "Specify an action: [start]"
        else
            echo "Specify an action: [start | stop | open]"
        fi
    # START OPTION FOR DEV MODE
    elif [ $2 = "start" ]
    then
        echo "######################################################## "
        echo "# Start NodeJS development server ...                  # "
        echo "######################################################## "

        cd web

        # For windows or OS without screen installed
        if [ ! -z "$is_windows" ]
        then
            echo "Windows system detected !"
            echo "Server will start in windows mode."
            npm run dev
        else
            screen -A -m -d -S $dev_screenname npm run dev
            echo " "
            echo "Check for server status ..."
            screen -ls
            echo " "
            echo "Tape \"./rundev dev open\" to enter this screen"
            echo " "
        fi
    # STOP OPTION FOR DEV MODE
    elif [ $2 = "stop" ]
    then
        if [ ! -z "$is_windows" ]
        then
            echo "You are one windows, just press CTRL + C to stop development server."
        else
            echo "######################################################## "
            echo "# Stop NodeJS development server ...                   # "
            echo "######################################################## "
            echo "Try kill to $dev_screenname screen"
            screen -X -S $dev_screenname kill
            screen -ls
            echo "Done!"
        fi
    # OPEN OPTION FOR DEV MODE
    elif [ $2 = "open" ]
    then
        if [ ! -z "$is_windows" ]
        then
            echo "You are one windows, this option is not needed !"
        else
            echo "CTRL + A next to CTRL + D to reduce screen"
            screen -r $dev_screenname
        fi
    fi
# SELECT PROD MODE
elif [ $1 = "prod" ]
then
    echo "prod not wrote yet"
fi