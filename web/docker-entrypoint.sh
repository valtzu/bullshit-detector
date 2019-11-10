#!/bin/bash

USER_NAME="node"
GROUP_NAME="node"

DIR=/home/node/app
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

export HOME=/home/${USER_NAME}

exec sudo -E -u ${USER_NAME} -g ${GROUP_NAME} "$@"
