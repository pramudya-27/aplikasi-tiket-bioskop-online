pipeline {
    agent {
        docker {
            image 'laravelsail/php84-composer:latest'
            args '-v /var/run/docker.sock:/var/run/docker.sock'
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

       stage('Install Node.js') {
            steps {
                sh '''
                apt-get update
                apt-get install -y curl ca-certificates
                curl -fsSL https://deb.nodesource.com/setup_current.x | bash -
                apt-get install -y nodejs
                node -v
                npm -v
                '''
            }
        }

        stage('Install Dependencies') {
            steps {
                script {
                    echo 'Installing PHP and Node dependencies...'
                    if (isUnix()) {
                        sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                        sh 'npm install'
                    } else {
                        bat 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                        bat 'npm install'
                    }
                }
            }
        }

        stage('Build Assets') {
            steps {
                script {
                    echo 'Building frontend assets...'
                    if (isUnix()) {
                        sh 'npm run build'
                    } else {
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
                        // Set permissions for storage if likely Linux
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

        stage('Deploy') {
            steps {
                script {
                    echo 'Deploying with Docker...'
                    if (isUnix()) {
                         sh 'docker-compose down || true'
                         sh 'docker-compose up -d --build'
                         
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
            steps {
                script {
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

    post {
        failure {
            echo 'Build or Deployment Failed.'
        }
    }
}
