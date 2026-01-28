pipeline {
    agent {
        dockerfile {
            filename 'Dockerfile'
            args '-u root' 
        }
    }

    environment {
        APP_ENV = 'testing'
    }

    stages {
        stage('Preparation') {
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

        stage('Install Dependencies') {
            steps {
                script {
                    echo 'Installing PHP & Node dependencies...'
                    // We run install again to ensure the bind-mounted workspace is populated
                    if (isUnix()) {
                        sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                        sh 'npm install'
                        sh 'npm run build'
                    } else {
                        bat 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                        bat 'npm install'
                        bat 'npm run build'
                    }
                }
            }
        }

        stage('Setup Application') {
            steps {
                script {
                    echo 'Generating Application Key...'
                    if (isUnix()) {
                        sh 'php artisan key:generate'
                        sh 'chmod -R 777 storage bootstrap/cache'
                    } else {
                        bat 'php artisan key:generate'
                    }
                }
            }
        }

        stage('Run Tests') {
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
