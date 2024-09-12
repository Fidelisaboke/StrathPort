# StrathPort: A Web-based School Transport Scheduling and Vehicle Allocation System

![GitHub Created At][github-created-at] ![GitHub contributors][github-contributors] ![GitHub last commit (branch)][github-last-commit-main] ![GitHub Actions Workflow Status][github-actions-workflow-status]

[github-created-at]: https://img.shields.io/github/created-at/Fidelisaboke/StrathPort
[github-contributors]: https://img.shields.io/github/contributors/Fidelisaboke/StrathPort
[github-last-commit-main]: https://img.shields.io/github/last-commit/Fidelisaboke/StrathPort/main
[github-actions-workflow-status]: https://img.shields.io/github/actions/workflow/status/Fidelisaboke/StrathPort/laravel.yml

## About StrathPort

This project aims to create a web application for school transport scheduling and vehicle allocation at Strathmore University. It includes modules for transport requests, transport schedules, carpool drivers, and admin functions. The goal is to provide reliable transportation and efficient communication within the school. The system will centralize the management of transport and improve daily operations and extracurricular activities.

## Table of Contents

- Setup and Installation
- Steps for project setup
- Usage Instructions
- Project Structure
- Known Issues
- Acknowledgements
- Contact Information
- License

## Setup and Installation

### Installation Requirements

Before installing and setting up this project in your local storage you must have the following:

-   **Composer** - An open source dependency management tool for PHP programming language that helps in managing the libraries and dependencies that this project relies on. It can be installed through the [Composer Website](https://getcomposer.org/)

-   **Apache XAMPP Server** - It is a free and open-source cross-platform web server solution that assists in running the application. It can be installed [here](https://www.apachefriends.org/).

-   **PHP Version 8.2+** - It is a general-purpose scripting language mostly used in web development. It can be installed in the [PHP Website](https://www.php.net/). If you've installed XAMPP, there's no need to install PHP separately as XAMPP comes with it.

-   **Visual Studio Code** - It is a source-code editor developed by Microsoft. It can be installed [here](https://code.visualstudio.com/).

## Steps for project setup

-   Once you have the specified requirements above, clone the project repository to your desired directory by running the command:

```
git clone https://github.com/Fidelisaboke/StrathPort.git
```

-   Install Composer dependencies

```
composer install
```

-   Install node dependencies

```
npm install
```

-   Copy the .env.example file to .env

```
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

```
php artisan migrate
```

-   Generate an application key

```
php artisan key:generate
```

## Usage Instructions

### Running the web application

-   Compile the Front-end assets

```
npm run dev
```

-   Start the development server

```
php artisan serve
```

## Project Structure

### Tree Structure

```
C:.
|   .env.example
|   artisan
|   composer.json
|   composer.lock
|   LICENSE
|   package-lock.json
|   package.json
|   phpunit.xml
|   postcss.config.js
|   README.md
|   tailwind.config.js
|   treestructure.txt
|   vite.config.js
|
+---.github
|   \---workflows
|           laravel.yml
|
+---app
|   +---Actions
|   |   +---Fortify
|   |   |       CreateNewUser.php
|   |   |       ...
|   |   |
|   |   \---Jetstream
|   |           DeleteUser.php
|   |
|   +---Http
|   |   +---Controllers
|   |   |   |   CarpoolingDetailsController.php
|   |   |   |   ...
|   |   |   |
|   |   |   +---Admin
|   |   |   |   |   CarpoolDriverController.php
|   |   |   |   |   ...
|   |   |   |   |
|   |   |   |   \---Report
|   |   |   |           TransportRequestReportController.php
|   |   |   |
|   |   |   \---CarpoolDriver
|   |   |           CarpoolingDetailsController.php
|   |   |           ...
|   |   |
|   |   \---Middleware
|   |           CheckIfActive.php
|   |           CheckIfAdmin.php
|   |           CheckIfLocked.php
|   |
|   +---Listeners
|   |       UserRegisteredNotification.php
|   |       ...
|   |
|   +---Livewire
|   |   |   DeleteConfirmationModal.php
|   |   |   ...
|   |   |
|   |   \---Profile
|   |           UpdateCarpoolDriverInformationForm.php
|   |           ...
|   |
|   +---Models
|   |       CarpoolDriver.php
|   |       ...
|   |
|   +---Notifications
|   |       AccountActivatedNotification.php
|   |       CarpoolRequestApprovedNotification.php
|   |       CarpoolRequestDeclinedNotification.php
|   |       ...
|   |
|   +---Providers
|   |       AppServiceProvider.php
|   |       FortifyServiceProvider.php
|   |       JetstreamServiceProvider.php
|   |
|   \---View
|       \---Components
|           |
|           \---Tables
|
+---bootstrap
|   |   app.php
|   |   providers.php
|   |
|   \---cache
|           .gitignore
|           packages.php
|           services.php
|
+---config
|       app.php
|       ...
|
+---database
|   |   .gitignore
|   |   database.sqlite
|   |
|   +---factories
|   |       UserFactory.php
|   |
|   +---migrations
|   |       0001_01_01_000000_create_users_table.php
|   |       ...
|   |
|   \---seeders
|           CarpoolDriverSeeder.php
|           CarpoolingDetailsSeeder.php
|           CarpoolRequestSeeder.php
|           ...
|
+---node_modules
|
+---public
|   |   .htaccess
|   |   favicon.ico
|   |   index.php
|   |   robots.txt
|   |
|   +---build
|   |   |   manifest.json
|   |   |
|   |   \---assets
|   |           app-BTmiF04Y.js
|   |           app-CHKmmfF4.css
|   |
|   +---images
|   |       car_placeholder.png
|   |       school_bus_3d.png
|   |
|   \---storage
|
+---resources
|   +---css
|   |       app.css
|   |
|   +---js
|   |       app.js
|   |       bootstrap.js
|   |       lock-screen.js
|   |       tailwind.config.js
|   |
|   +---markdown
|   |       policy.md
|   |       terms.md
|   |
|   \---views
|       |   about.blade.php
|       |   dashboard.blade.php
|       |   home.blade.php
|       |   lock.blade.php
|       |   ...
|       |
|       +---admin
|       |   +---carpool_drivers
|       |   |       create.blade.php
|       |   |       ...
|       |   |
|       |   +---carpool_vehicles
|       |   |       create.blade.php
|       |   |       ...
|       |   |
|       |   +---school_drivers
|       |   |       create.blade.php
|       |   |       ...
|       |   |
|       |   +---school_vehicles
|       |   |       create.blade.php
|       |   |       ...
|       |   |
|       |   +---transport_requests
|       |   |       create.blade.php
|       |   |       ...
|       |   |
|       |   +---transport_schedules
|       |   |       create.blade.php
|       |   |       ...
|       |   |
|       |   \---users
|       |           create.blade.php
|       |           ...
|       |
|       +---api
|       |       api-token-manager.blade.php
|       |       index.blade.php
|       |
|       +---auth
|       |       confirm-password.blade.php
|       |       ...
|       |
|       +---components
|       |   |
|       |   +---svg
|       |   |
|       |   \---tables
|       |
|       +---driver
|       |   +---carpooling_details
|       |   |       index.blade.php
|       |   |       ...
|       |   |
|       |   +---carpool_requests
|       |   |       index.blade.php
|       |   |       ...
|       |   |
|       |   \---carpool_vehicles
|       |           create.blade.php
|       |           ...
|       |
|       +---emails
|       |       team-invitation.blade.php
|       |
|       +---layouts
|       |       app.blade.php
|       |       guest.blade.php
|       |
|       +---livewire
|       |   |   delete-confirmation-modal.blade.php
|       |   |   home-nav-menu.blade.php
|       |   |   ...
|       |   |
|       |   \---profile
|       |           update-carpool-driver-information-form.blade.php
|       |           ...
|       |
|       +---profile
|       |       delete-user-form.blade.php
|       |       ...
|       |
|       +---user
|       |   +---carpooling_details
|       |   |       index.blade.php
|       |   |       ...
|       |   |
|       |   +---carpool_requests
|       |   |       create.blade.php
|       |   |       ...
|       |   |
|       |   +---transport_requests
|       |   |       create.blade.php
|       |   |       ...
|       |   |
|       |   \---transport_schedules
|       |           index.blade.php
|       |           ...
|       |
|       \---vendor
|           \---pagination
|
+---routes
|       api.php
|       console.php
|       web.php
|
+---storage
|   +---app
|   |
|   +---framework
|   |
|   \---logs
|
+---tests
|   |   TestCase.php
|   |
|   +---Feature
|   |       ApiTokenPermissionsTest.php
|   |       ...
|   |
|   \---Unit
|           ExampleTest.php
```

The file tree is generated using the command `tree /F /A > treestructure.txt`

## Known Issues

The following limitations or bugs are present in the project

1. **Carpool Schedules 'Search' feature**
- Returns all records for users and carpool drivers instead of filtering based on specific user.
2. **Transport Request Limiting**
- At the moment, it is limited by school vehicle availability, which is not reliable in handling the potential of many requests
3. **Admin Monthly Report Generation**
- The functionality is present in the code, but was isolated and replaced with a link to the view of the report
4. **High Latency Issues**
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
