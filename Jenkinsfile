pipeline {
    agent {
        dockerfile {
            filename 'Dockerfile.ci'
            args '-u root -v /var/run/docker.sock:/var/run/docker.sock'
            reuseNode true
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
                        // Configure .env for SQLite
                        sh "sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/g' .env"
                        sh "sed -i 's/DB_DATABASE=aplikasi_tiket_bioskop/DB_DATABASE=\\/var\\/www\\/html\\/database\\/database.sqlite/g' .env"
                        // Change DB_HOST to avoid confusion, though ignored by sqlite driver usually
                        sh "sed -i 's/DB_HOST=127.0.0.1/DB_HOST=/g' .env"
                        
                        // Create SQLite database file
                        sh 'touch database/database.sqlite'
                        sh 'chmod 777 database/database.sqlite'
                        sh 'chmod 777 database'
                    } else {
                        bat 'copy .env.example .env'
                        // Windows bat support for sed is limited, assuming linux agent as per user context usually
                        // But if running on windows, we might need powershell or just append. 
                        // For now, focusing on the unix/docker path as agent is dockerfile.
                    }
                }
            }
        }

        stage('Install PHP Dependencies') {
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
