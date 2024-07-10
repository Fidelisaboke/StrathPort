# StrathPort
------------------------------------------------------------------------------------------------------------
A School Transport and Vehicle Allocation System for Strathmore University built using the Laravel Framework.

# About StrathPort
------------------------------------------------------------------------------------------------------------
This IS Project focuses on creating a web application for school transport scheduling and vehicle allocation for students, club heads and staff members of Strathmore University in the aim of ensuring there is reliable transportation provided by the school and that there is an efficient means of communicating transportation status and information within the school.This project includes modules like Transport Requests, Transport Schedules, Carpool Driver and Admin Module whereby in the Transport Requests Module, a student head or club head can make a transport request that would require the admin to review it depending on certain criteria like the number of people being requested for a vehicle, availability status of a bus at the time one has requested among others by either approving or rejecting. For the Transport Scheduling Module, the admin gets to update the status of different fixed-route buses that help commuting staff and students everyday. For the Carpool Driver Module, incase of rejection of a transport request, one can opt for carpooling as an option whereby carpooling drivers register and get to accept or decline requests made for certain trips. On the Admin module, they get to carry out advanced CRUD operations such as user management, reviewing of transport requests, update school driver and vehicle details, review the different drivers that register as carpool drivers as well as their carpool vehicle details and update transport schedules for the week.Development of this web application system project is so as to solve the current approach taken into the school transport and vehicle allocation process which lacks a centralized system for managing reliability of such a process causing a significant obstacle to the functioning of daily operations and extracurricular activities.

# Setup and Installation
------------------------------------------------------------------------------------------------------------
## Installation Requirements

Before installing and setting up this project in your local storage you must have the following:
- Composer- An open source dependency management tool for PHP programming language that helps in managing the libraries and dependencies that this project relies on. It can be installed through the [Composer Website](https://getcomposer.org/) or through using the command 
'composer install'

- Apache XAMPP Server- It is a free and open-source cross-platform web server solution that assists in connection to the database through MariaDB. It can be installed [here](https://www.apachefriends.org/).

- PHP >=8.2 - It is a general-purpose scripting language mostly used in web development. It can be installed in the [PHP Website](https://www.php.net/).

- Visual Studio Code- It is a source-code editor developed by Microsoft for building web, desktop and movile applications. It can be installed [here](https://code.visualstudio.com/).

- Postmark- It is a fast and reliable email delivery service used in this project for sedning emails and notifications.You can get its API key from [here](https://postmarkapp.com/).

## Steps for project setup

- Once you have the specified requirements above, clone the project repository to your desired directory by running the command:
'git clone https://github.com/Fidelisaboke/StrathPort.git'

- Install node dependencies
'npm install'

- Copy the .env.example file to .env
'cp .env.example .env'

- You then update the .env file to include your databse details and email credentials
'DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=NAME OF YOUR DATABASE
DB_USERNAME=YOUR USERNAME
DB_PASSWORD=YOUR PASSWORD'

'MAIL_MAILER=postmark
MAIL_HOST=smtp.postmarkapp.com
MAIL_PORT=2525
MAIL_USERNAME=YOUR API KEY
MAIL_PASSWORD=YOUR API KEY
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="YOUR EMAIL ADDRESS"
MAIL_FROM_NAME="${APP_NAME}"'

- Afterwards, you run the database migrations to include the database tables that would be needed for the application by using the command
'php artisan migrate'

- Generate an application key
'php artisan key:generate'

# Usage
------------------------------------------------------------------------------------------------------------
## Running the web application

- Compile the Front-end assets
'npm run dev'

- Start the development server
'php artisan serve'

# Project Structure
------------------------------------------------------------------------------------------------------------
## Tree Structure

