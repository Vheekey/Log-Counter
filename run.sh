#!/bin/bash

bin/console doc:database:create --no-interaction
bin/console doc:mig:mig --no-interaction
bin/console doc:fix:load --no-interaction
 
exec "$@"