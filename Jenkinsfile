pipeline {
    agent any

    environment {
        IMAGE_NAME = "aplikasi-tiket-bioskop"
        CONTAINER_NAME = "aplikasi-tiket-bioskop-container"
        
        // Database Configuration (Using host.docker.internal to access host MySQL)
        DB_CONNECTION = "mysql"
        DB_HOST = "mysql"
        DB_PORT = "3306"
        DB_DATABASE = "aplikasi_tiket_bioskop"
        DB_USERNAME = "root"
        DB_PASSWORD = ""
    }

    stages {
        stage('Build Docker Image') {
            steps {
                script {
                    echo 'Building Docker Image...'
                    if (isUnix()) {
                        sh 'docker build -t ${IMAGE_NAME} .'
                    } else {
                        bat 'docker build -t %IMAGE_NAME% .'
                    }
                }
            }
        }

        stage('Test') {
            steps {
                script {
                    echo 'Running Tests inside Container...'
                    // Note: Tests might need DB access too, adding env vars just in case
                    if (isUnix()) {
                        sh 'docker run --rm -e DB_CONNECTION=${DB_CONNECTION} -e DB_HOST=${DB_HOST} -e DB_PORT=${DB_PORT} -e DB_DATABASE=${DB_DATABASE} -e DB_USERNAME=${DB_USERNAME} -e DB_PASSWORD=${DB_PASSWORD} ${IMAGE_NAME} sh -c "php artisan key:generate && php artisan test"'
                    } else {
                        bat 'docker run --rm -e DB_CONNECTION=%DB_CONNECTION% -e DB_HOST=%DB_HOST% -e DB_PORT=%DB_PORT% -e DB_DATABASE=%DB_DATABASE% -e DB_USERNAME=%DB_USERNAME% -e DB_PASSWORD=%DB_PASSWORD% %IMAGE_NAME% sh -c "php artisan key:generate && php artisan test"'
                    }
                }
            }
        }

        stage('Migrate Database') {
            steps {
                script {
                    echo 'Running Database Migrations...'
                    // Run a temporary container to execute migrations
                    if (isUnix()) {
                        sh 'docker run --rm -e DB_CONNECTION=${DB_CONNECTION} -e DB_HOST=${DB_HOST} -e DB_PORT=${DB_PORT} -e DB_DATABASE=${DB_DATABASE} -e DB_USERNAME=${DB_USERNAME} -e DB_PASSWORD=${DB_PASSWORD} ${IMAGE_NAME} php artisan migrate --force'
                    } else {
                        bat 'docker run --rm -e DB_CONNECTION=%DB_CONNECTION% -e DB_HOST=%DB_HOST% -e DB_PORT=%DB_PORT% -e DB_DATABASE=%DB_DATABASE% -e DB_USERNAME=%DB_USERNAME% -e DB_PASSWORD=%DB_PASSWORD% %IMAGE_NAME% php artisan migrate --force'
                    }
                }
            }
        }

        stage('Deploy') {
            steps {
                script {
                    echo 'Deploying Application Container...'
                    if (isUnix()) {
                        sh 'docker rm -f ${CONTAINER_NAME} || true'
                        sh 'docker run -d -p 8000:80 -p 8080:8080 -e DB_CONNECTION=${DB_CONNECTION} -e DB_HOST=${DB_HOST} -e DB_PORT=${DB_PORT} -e DB_DATABASE=${DB_DATABASE} -e DB_USERNAME=${DB_USERNAME} -e DB_PASSWORD=${DB_PASSWORD} --name ${CONTAINER_NAME} ${IMAGE_NAME}'
                        sh 'docker ps | grep ${CONTAINER_NAME}'
                    } else {
                        bat 'docker rm -f %CONTAINER_NAME% || exit 0'
                        bat 'docker run -d -p 8000:80 -p 8080:8080 -e DB_CONNECTION=%DB_CONNECTION% -e DB_HOST=%DB_HOST% -e DB_PORT=%DB_PORT% -e DB_DATABASE=%DB_DATABASE% -e DB_USERNAME=%DB_USERNAME% -e DB_PASSWORD=%DB_PASSWORD% --name %CONTAINER_NAME% %IMAGE_NAME%'
                        bat 'docker ps | findstr %CONTAINER_NAME%'
                    }
                }
            }
        }

        stage('Verify') {
            steps {
                script {
                    echo 'Waiting for user verification...'
                     timeout(time: 10, unit: 'MINUTES') { 
                        input(
                            id: 'UserInput', 
                            message: 'App is running at http://localhost:8000 with DB connection. Click "Proceed" to cleanup and finish.', 
                            ok: 'Cleanup & Finish'
                        )
                    }
                }
            }
        }
    }

    post {
        always {
            script {
                echo 'Cleaning up...'
                if (isUnix()) {
                    sh 'docker rm -f ${CONTAINER_NAME} || true'
                } else {
                    bat 'docker rm -f %CONTAINER_NAME% || exit 0'
                }
            }
        }
        success {
            echo 'Pipeline successfully completed.'
        }
        failure {
            echo 'Pipeline failed.'
        }
    }
}
