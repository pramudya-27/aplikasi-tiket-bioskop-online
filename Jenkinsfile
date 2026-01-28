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

        stage('Deploy & Verification') {
            agent {
                docker {
                    image 'laravelsail/php84-composer:latest'
                    args '-u root -v /var/run/docker.sock:/var/run/docker.sock -p 8000:8000' 
                }
            }
            steps {
                script {
                    echo 'Deploying with deliver.sh...'
                    if (isUnix()) {
                         sh 'chmod +x deliver.sh'
                         sh './deliver.sh'
                    } else {
                         bat 'deliver.sh' 
                    }

                    // Wait for user verification
                    timeout(time: 5, unit: 'MINUTES') { 
                        def userInput = input(
                            id: 'UserInput', 
                            message: 'App is running at http://localhost:8000. Do you want to stop it?', 
                            parameters: [string(defaultValue: 'yes', description: 'Type "yes" to stop the app and cleanup', name: 'Confirm')]
                        )
                        
                        if (userInput.toLowerCase() == 'yes') {
                            echo 'Stopping application...'
                            if (isUnix()) {
                                sh 'chmod +x kill.sh'
                                sh './kill.sh'
                            } else {
                                bat 'kill.sh'
                            }
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
