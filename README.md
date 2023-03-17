# Bloomex Assignment

## About

**Bloomex assignment** is a project assigned to a candidate to check his skills

Requirements:
- Implement a basic customer list page using a Laravel framework backend and a Vue frontend. 
- The backend should provide an endpoint that returns json data for a list of customers to be presented by the frontend. 
- The frontend should call the endpoint with AJAX to display the data and provide basic sorting, filtering and searching of the list of customers. 

Customer data consists of: 
- first name 
- last name 
- email address 
- full street address (street, city, country, zip/postal, etc) – not all customers will supply this (0 – 1) 
- phone numbers (number and type i.e. home, cell, fax, etc) – customer will supply a variable number of them (0 – many) 

The solution should include: 
- Git repository with real informational git history 
- A composer.json file that contains all backend dependencies 
- Working backend Laravel controller that returns customer data as json 
- A package.json (or equivalent) that contains all frontend dependencies 
- Working frontend that calls the json endpoint with AJAX 
- Database with test data (MySQL preferred)  
- README file with documentation on how to get the app running 
- Proper code styling
- Feel free to leave any nonworking code if you think it is relevant 

Great to haves: 
- Phpunit tests (1 functional test, 1 unit test if you can) 
- Nicely styled interface using some css preprocessor (sass, less, etc) - feel free to use a framework of your choice. 
- Responsive layout 
- Dockerfile to fully provision and setup the app for use 
- Docker compose file to have separate container for database (MySQL)

## Installation  
Access to an Ubuntu 22.04 (Can be installed on WSL2 on Windows as well - [instruction](https://ubuntu.com/tutorials/install-ubuntu-on-wsl2-on-windows-11-with-gui-support#1-overview)) local machine as a non-root user with sudo privileges.

Install Docker on your server following Steps 1 and 2 of [How To Install and Use Docker on Ubuntu 22.04](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-22-04).

Clone the project: 
```
git clone git@github.com:elita001/bloomex-assignment.git
```

Navigate to the project directory:
```
cd bloomex-assignment
```

Build and run docker containers
```
docker-compose build app
docker-compose up -d
```

Install composer dependencies:
```
docker-compose exec app rm -rf vendor composer.lock
docker-compose exec app composer install
```

Generate key, run migration and seeders:
```
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

Install npm dependencies and build the project:
```
docker-compose exec app npm install
docker-compose exec app npm install vue@next vue-loader@next
docker-compose exec app npm i @vitejs/plugin-vue
docker-compose exec app npm run build
```

The project is available now, visit http://localhost:8000/

# Sass
npm install -D sass-loader sass

# Unit tests
Run unit tests with the following command
```
docker-compose exec app php artisan test
```
