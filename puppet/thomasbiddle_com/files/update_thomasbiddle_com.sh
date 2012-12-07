SITE_BASE="/srv/www"
SITE_DIRECTORY="ThomasBiddle.com"
GIT_REPO="https://github.com/thomasbiddle/ThomasBiddle.com.git"

if [[ ! -d "${SITE_BASE}/${SITE_DIRECTORY}" ]]
then
	cd ${SITE_BASE} && git clone ${GIT_REPO}
elif [[ ! "$(ls -A ${SITE_BASE}/${SITE_DIRECTORY})" ]]
then
    cd ${SITE_BASE} && git clone ${GIT_REPO}
else
	cd ${SITE_BASE}/${SITE_DIRECTORY} && git pull
fi
