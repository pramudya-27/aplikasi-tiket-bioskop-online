pipeline {
    agent none

    environment {
        APP_ENV = 'testing'
    }

    stages {
        stage('Preparation') {
            agent {
                docker {
                    image 'laravelsail/php84-composer:latest'
                    args '-u root -v /var/run/docker.sock:/var/run/docker.sock'
                }
            }
            steps {
                script {
                    echo 'Preparing Environment...'
                    if (isUnix()) {
                        sh 'cp .env.example .env'
                    } else {
                        bat 'copy .env.example .env'
                    }
                }
            }
        }

        stage('Install PHP Dependencies') {
            agent {
                docker {
                    image 'laravelsail/php84-composer:latest'
                    args '-u root -v /var/run/docker.sock:/var/run/docker.sock'
                }
            }
            steps {
                script {
                    echo 'Installing PHP dependencies...'
                    if (isUnix()) {
                        sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                    } else {
                        bat 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                    }
                }
            }
        }

        stage('Install Node & Build Assets') {
            agent {
                docker {
                    image 'node:latest'
                    args '-u root' 
                }
            }
            steps {
                script {
                    echo 'Installing Node dependencies and building...'
                    if (isUnix()) {
                        sh 'npm install'
                        sh 'npm run build'
                    } else {
                        bat 'npm install'
                        bat 'npm run build'
                    }
                }
            }
        }

        stage('Setup Application') {
            agent {
                docker {
                    image 'laravelsail/php84-composer:latest'
                    args '-u root -v /var/run/docker.sock:/var/run/docker.sock'
                }
            }
            steps {
                script {
                    echo 'Generating Application Key...'
                    if (isUnix()) {
                        sh 'php artisan key:generate'
                        // Set permissions for storage
                        sh 'chmod -R 777 storage bootstrap/cache'
                    } else {
                        bat 'php artisan key:generate'
                    }
                }
            }
        }

        stage('Run Tests') {
            agent {
                docker {
                    image 'laravelsail/php84-composer:latest'
                    args '-u root -v /var/run/docker.sock:/var/run/docker.sock'
                }
            }
            steps {
                script {
                    echo 'Running PHPUnit Tests...'
                    if (isUnix()) {
                        sh 'php artisan test'
                    } else {
                        bat 'php artisan test'
                    }
                }
            }
        }

        stage('Deploy') {
            agent {
                docker {
                    image 'docker:latest'
                    args '-u root -v /var/run/docker.sock:/var/run/docker.sock'
                }
            }
            steps {
                script {
                    echo 'Deploying with Docker...'
                    if (isUnix()) {
                         // Check if docker-compose is available, if not try 'docker compose'
                         sh '''
                            if command -v docker-compose &> /dev/null; then
                                docker-compose down || true
                                docker-compose up -d --build
                            else
                                docker compose down || true
                                docker compose up -d --build
                            fi
                         '''
                         
                         def serverIp = sh(script: "hostname -I | awk '{print \$1}'", returnStdout: true).trim()
                         echo "Application deployed successfully!"
                         echo "Access URL: http://${serverIp}:8080"
                    } else {
                         bat 'docker-compose down || exit 0'
                         bat 'docker-compose up -d --build'
                         echo "Application deployed successfully!"
                         echo "Access URL: http://localhost:8080 (Check your server IP)"
                    }
                }
            }
        }

        stage('Verification & Cleanup') {
            agent {
                docker {
                    image 'laravelsail/php84-composer:latest' // Use PHP container for basic interaction
                }
            }
            steps {
                script {
                    // Interactive input often pauses the pipeline.
                    // If running automatically, you might want to remove this or set a timeout.
                    timeout(time: 5, unit: 'MINUTES') { 
                        def userInput = input(
                            id: 'UserInput', 
                            message: 'App is running. Do you want to continue (and clean workspace)?', 
                            parameters: [string(defaultValue: 'yes', description: 'Type "yes" to finish and clean workspace', name: 'Confirm')]
                        )
                        
                        if (userInput.toLowerCase() == 'yes') {
                            echo 'User chose to continue. Cleaning up workspace...'
                            cleanWs()
                        } else {
                            echo 'User chose to keep workspace.'
                        }
                    }
                }
            }
        }
    }

    post {
        failure {
            echo 'Build or Deployment Failed.'
        }
    }
}
