pipeline {
    agent any

    environment {
        IMAGE_NAME = "aplikasi-tiket-bioskop"
        CONTAINER_NAME = "aplikasi-tiket-bioskop-container"
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
                    if (isUnix()) {
                        // Generate key and run tests
                        sh 'docker run --rm ${IMAGE_NAME} sh -c "php artisan key:generate && php artisan test"'
                    } else {
                        bat 'docker run --rm %IMAGE_NAME% sh -c "php artisan key:generate && php artisan test"'
                    }
                }
            }
        }

        stage('Deploy') {
            steps {
                script {
                    echo 'Deploying Application Container...'
                    // Remove existing container if it exists (ignore error if not exists)
                    if (isUnix()) {
                        sh 'docker rm -f ${CONTAINER_NAME} || true'
                        sh 'docker run -d -p 8000:80 -p 8080:8080 --name ${CONTAINER_NAME} ${IMAGE_NAME}'
                        // Check if running
                         sh 'docker ps | grep ${CONTAINER_NAME}'
                    } else {
                        bat 'docker rm -f %CONTAINER_NAME% || exit 0'
                        bat 'docker run -d -p 8000:80 -p 8080:8080 --name %CONTAINER_NAME% %IMAGE_NAME%'
                        bat 'docker ps | findstr %CONTAINER_NAME%'
                    }
                }
            }
        }

        stage('Verify') {
            steps {
                script {
                    echo 'Waiting for user verification...'
                    // Wait for user verification
                     timeout(time: 10, unit: 'MINUTES') { 
                        input(
                            id: 'UserInput', 
                            message: 'App is running at http://localhost:8000. Click "Proceed" to cleanup and finish.', 
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
