#!/usr/bin/env bash

# export current site settings
cd web
../vendor/bin/drush cim sync -y

# remove existing sync.tar.gz file
cd ..
rm migration/config/sync.tar.gz

# compress /sync folder
tar -czf migration/config/sync.tar.gz -C web/sites/default/files/config/sync .             
