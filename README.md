# StrathPort: A Web-based School Transport Scheduling and Vehicle Allocation System

![GitHub Created At][github-created-at] ![GitHub contributors][github-contributors] ![GitHub last commit (branch)][github-last-commit-main] ![GitHub Actions Workflow Status][github-actions-workflow-status]

[github-created-at]: https://img.shields.io/github/created-at/Fidelisaboke/StrathPort
[github-contributors]: https://img.shields.io/github/contributors/Fidelisaboke/StrathPort
[github-last-commit-main]: https://img.shields.io/github/last-commit/Fidelisaboke/StrathPort/main
[github-actions-workflow-status]: https://img.shields.io/github/actions/workflow/status/Fidelisaboke/StrathPort/laravel.yml

## About StrathPort

This project aims to create a web application for school transport scheduling and vehicle allocation at Strathmore University. It includes modules for transport requests, transport schedules, carpool drivers, and admin functions. The goal is to provide reliable transportation and efficient communication within the school. The system will centralize the management of transport and improve daily operations and extracurricular activities.

## Table of Contents

1. [Installation and Setup](#installation-and-setup)
    - [Installation Requirements](#installation-requirements)
2. [Steps for project setup](#steps-for-project-setup)
3. [Usage Instructions](#usage-instructions)
    - [Running the web application](#running-the-web-application)
4. [Project Structure](#project-structure)
5. [Known Issues](#known-issues)
6. [Acknowledgements](#acknowledgements)
7. [Contact Information](#contact-information)
8. [License](#license)

## Installation and Setup

### Installation Requirements

Before installing and setting up this project in your local storage you must have the following:

-   **Composer** - An open source dependency management tool for PHP programming language that helps in managing the libraries and dependencies that this project relies on. It can be installed through the [Composer Website](https://getcomposer.org/)

-   **Apache XAMPP Server** - It is a free and open-source cross-platform web server solution that assists in running the application. It can be installed [here](https://www.apachefriends.org/).

-   **PHP Version 8.2+** - It is a general-purpose scripting language mostly used in web development. It can be installed in the [PHP Website](https://www.php.net/). If you've installed XAMPP, there's no need to install PHP separately as XAMPP comes with it.

-   **Visual Studio Code** - It is a source-code editor developed by Microsoft. It can be installed [here](https://code.visualstudio.com/).

## Steps for project setup

-   Once you have the specified requirements above, clone the project repository to your desired directory by running the command:

```bash
git clone https://github.com/Fidelisaboke/StrathPort.git
```

- Navigate to the project directory:
```bash
cd StrathPort
```

-   Install Composer dependencies

```bash
composer install
```

-   Install node dependencies

```bash
npm install
```

-   Copy the .env.example file to .env

```bash
cp .env.example .env
```

-   You then update the .env file to include your databse details and email credentials

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=NAME OF YOUR DATABASE
DB_USERNAME=YOUR USERNAME
DB_PASSWORD=YOUR PASSWORD

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=YOUR_EMAIL_ADDRESS
MAIL_PASSWORD=YOUR_APP_PASSWORD
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=YOUR_EMAIL_ADDRESS
MAIL_FROM_NAME="${APP_NAME}"
```

-   To get the `MAIL_PASSWORD`, go to your Google account's 'Manage Password' setting, then in the 'Security' menu, search for 'App password'.

-   Afterwards, run the database migrations to include the database tables that would be needed for the application

```bash
php artisan migrate
```

-   Generate an application key:

```bash
php artisan key:generate
```

-   Create a symbolic link with the storage folder:
This is important since the image upload features make use of the storage folder
```bash
php artisan storage:link
```


## Usage Instructions

### Running the web application

-   Compile the Front-end assets

```bash
npm run dev
```

-   Start the development server

```bash
php artisan serve
```

## Project Structure

### Tree Structure

```
.
├── app
│   ├── Actions
│   │   ├── Fortify
│   │   └── Jetstream
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Admin
│   │   │   │   └── Report
│   │   │   └── CarpoolDriver
│   │   └── Middleware
│   ├── Listeners
│   ├── Livewire
│   │   └── Profile
│   ├── Models
│   ├── Notifications
│   ├── Providers
│   └── View
│       └── Components
│           └── Tables
├── bootstrap
│   └── cache
├── config
├── database
│   ├── factories
│   ├── migrations
│   └── seeders
├── .github
│   └── workflows
├── public
│   └── images
├── resources
│   ├── css
│   ├── js
│   ├── markdown
│   └── views
│       ├── admin
│       │   ├── carpool_drivers
│       │   ├── carpool_vehicles
│       │   ├── school_drivers
│       │   ├── school_vehicles
│       │   ├── transport_requests
│       │   ├── transport_schedules
│       │   └── users
│       ├── api
│       ├── auth
│       ├── components
│       │   ├── svg
│       │   └── tables
│       ├── driver
│       │   ├── carpooling_details
│       │   ├── carpool_requests
│       │   └── carpool_vehicles
│       ├── emails
│       ├── layouts
│       ├── livewire
│       │   └── profile
│       ├── profile
│       ├── user
│       │   ├── carpooling_details
│       │   ├── carpool_requests
│       │   ├── transport_requests
│       │   └── transport_schedules
│       └── vendor
│           └── pagination
├── routes
├── storage
│   ├── app
│   │   └── public
│   ├── framework
│   │   ├── cache
│   │   │   └── data
│   │   ├── sessions
│   │   ├── testing
│   │   └── views
│   └── logs
└── tests
    ├── Feature
    └── Unit
```

The file tree is generated using the command `git ls-tree -r --name-only HEAD | tree --fromfile -d`

## Known Issues

The following limitations or bugs are present in the project

1. **Transport Request Limiting**
- At the moment, it is limited by school vehicle availability, which is not reliable in handling the potential of many requests
2. **Admin Monthly Report Generation**
- The functionality is present in the code, but was isolated and replaced with a link to the view of the report
3. **High Latency Issues**
- Some functionalities, especially involving email notifications, take longer than the recommended 500ms response time, which could lead to a poor user experience

## Acknowledgements

We would like to thank the developers of the following tools, languages, and frameworks which streamlined the web application development process:

-   [![Tailwind][tailwind-shield]][tailwind-link]
-   [![AlpineJS][alpinejs-shield]][alpinejs-link]
-   [![Laravel][laravel-shield]][laravel-link]
-   [![Livewire][livewire-shield]][livewire-link]
-   [![ChartJS][chartjs-shield]][chartjs-link]
-   [![MySQL][mysql-shield]][mysql-link]

[tailwind-shield]: https://img.shields.io/badge/tailwindcss-0F172A?style=for-the-badge&logo=tailwindcss
[tailwind-link]: https://tailwindcss.com/
[laravel-shield]: https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white
[laravel-link]: https://laravel.com/
[alpinejs-shield]: https://img.shields.io/badge/Alpine.js-663399?style=for-the-badge&logo=alpine.js&logoColor=white
[alpinejs-link]: https://alpinejs.dev/
[livewire-shield]: https://img.shields.io/badge/livewire-4e56a6?style=for-the-badge&logo=livewire&logoColor=white
[livewire-link]: https://livewire.laravel.com/
[chartjs-shield]: https://img.shields.io/badge/chart.js-F5788D.svg?style=for-the-badge&logo=chart.js&logoColor=white
[chartjs-link]: https://www.chartjs.org/
[mysql-shield]: https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white
[mysql-link]: https://www.mysql.com/

## Contact Information

For any inquiries, please contact us at:

https://github.com/Lynn-Wahito - Lynn Wahito

https://github.com/Fidelisaboke - Fidel Isaboke

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/license/MIT).

[![MIT License][mit-shield]][mit-license]

[mit-shield]: https://img.shields.io/badge/License-MIT-blue.svg
[mit-license]: https://opensource.org/licenses/MIT
