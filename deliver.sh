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

# Start server on 0.0.0.0 to be accessible from outside the container, port 8000
# Redirect output to server.log for debugging
php artisan serve --host=0.0.0.0 --port=8000 > server.log 2>&1 &
PID=$!
sleep 3

# Check if process is still running
if kill -0 $PID > /dev/null 2>&1; then
   echo "Server started successfully with PID $PID"
   echo $PID > .pidfile
   
   echo "Verifying internal connectivity..."
   sleep 2
   if curl -s -I http://localhost:8000 | grep "200 OK" > /dev/null; then
       echo "Internal connectivity check passed!"
   else
       echo "Warning: Internal connectivity check failed or returned non-200 status."
       echo "Output of curl:"
       curl -v http://localhost:8000 || echo "Curl failed completely"
   fi
else
   echo "Server failed to start!"
   cat server.log
   exit 1
fi

echo 'Now...'
echo 'Visit http://localhost:8000 to see your Laravel application in action.'
echo '(Ensure your Jenkins agent exposes port 8000 if running inside Docker)'
