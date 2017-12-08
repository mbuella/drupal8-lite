#!/usr/bin/env bash

# clear /sync folder
# cd ..
rm -rf web/sites/default/files/config/sync/*

# extract migration/config/sync.tar.gz to /sync folder
tar -xzf migration/config/sync.tar.gz -C web/sites/default/files/config/sync

# import the extracted settings
cd web
../vendor/bin/drush cim sync -y

# clear cache
../vendor/bin/drush cr
