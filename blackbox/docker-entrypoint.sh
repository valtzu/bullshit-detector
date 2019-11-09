#!/bin/bash

USER_NAME="www-data"
GROUP_NAME="www-data"

DIR=/var/www/html
USER_ID=$(stat -c "%u" ${DIR})
GROUP_ID=$(stat -c "%g" ${DIR})

if [[ $(id -u ${USER_NAME}) != "${USER_ID}" ]]; then
	usermod -u $USER_ID ${USER_NAME}
	echo Changed UID of user ${USER_NAME} to ${USER_ID}
fi

if [[ $(id -g ${GROUP_NAME}) != "${GROUP_ID}" ]]; then
	groupmod -g "${GROUP_ID}" ${GROUP_NAME}
	echo "Changed GID of group ${GROUP_NAME} to ${GROUP_ID}"
fi

source /etc/apache2/envvars
chown -R -L --dereference ${USER_NAME}:${GROUP_NAME} $APACHE_LOCK_DIR $APACHE_RUN_DIR $APACHE_LOG_DIR

export HOME=/home/${USER_NAME}
exec sudo -E -u ${USER_NAME} -g ${GROUP_NAME} "$@"
