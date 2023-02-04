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