#!/usr/bin/env sh

echo 'The following command runs your Laravel application in'
echo 'development mode and makes the application available for web browsing.'
echo 'The "php artisan serve" command has a trailing ampersand so that the command runs'
echo 'as a background process (i.e. asynchronously). Otherwise, this command'
echo 'can pause running builds of CI/CD applications indefinitely. "php artisan serve"'
echo 'is followed by another command that retrieves the process ID (PID) value'
echo 'of the previously run process (i.e. "php artisan serve") and writes this value to'
echo 'the file ".pidfile".'

# Ensure permissions (optional but good practice)
chmod +x deliver.sh

set -x
# Start server on 0.0.0.0 to be accessible from outside the container, port 8000
php artisan serve --host=0.0.0.0 --port=8000 &
sleep 1
echo $! > .pidfile
set +x

echo 'Now...'
echo 'Visit http://localhost:8000 to see your Laravel application in action.'
echo '(Ensure your Jenkins agent exposes port 8000 if running inside Docker)'
