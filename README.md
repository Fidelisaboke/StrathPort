# StrathPort
-------------------------------------------------------------------
A School Transport and Vehicle Allocation System for Strathmore University built using the Laravel Framework.

# About StrathPort
-------------------------------------------------------------------
This IS Project focuses on creating a web application for school transport scheduling and vehicle allocation for students, club heads and staff members of Strathmore University in the aim of ensuring there is reliable transportation provided by the school and that there is an efficient means of communicating transportation status and information within the school.This project includes modules like Transport Requests, Transport Schedules, Carpool Driver and Admin Module whereby in the Transport Requests Module, a student head or club head can make a transport request that would require the admin to review it depending on certain criteria like the number of people being requested for a vehicle, availability status of a bus at the time one has requested among others by either approving or rejecting. For the Transport Scheduling Module, the admin gets to update the status of different fixed-route buses that help commuting staff and students everyday. For the Carpool Driver Module, incase of rejection of a transport request, one can opt for carpooling as an option whereby carpooling drivers register and get to accept or decline requests made for certain trips. On the Admin module, they get to carry out advanced CRUD operations such as user management, reviewing of transport requests, update school driver and vehicle details, review the different drivers that register as carpool drivers as well as their carpool vehicle details and update transport schedules for the week.Development of this web application system project is so as to solve the current approach taken into the school transport and vehicle allocation process which lacks a centralized system for managing reliability of such a process causing a significant obstacle to the functioning of daily operations and extracurricular activities.

# Setup and Installation
-------------------------------------------------------------------
## Installation Requirements

Before installing and setting up this project in your local storage you must have the following:
- **Composer** - An open source dependency management tool for PHP programming language that helps in managing the libraries and dependencies that this project relies on. It can be installed through the [Composer Website](https://getcomposer.org/) or through using the command 
'composer install'

- **Apache XAMPP Server** - It is a free and open-source cross-platform web server solution that assists in connection to the database through MariaDB. It can be installed [here](https://www.apachefriends.org/).

- **PHP >=8.2** - It is a general-purpose scripting language mostly used in web development. It can be installed in the [PHP Website](https://www.php.net/).

- **Visual Studio Code** - It is a source-code editor developed by Microsoft for building web, desktop and movile applications. It can be installed [here](https://code.visualstudio.com/).

- **Postmark** - It is a fast and reliable email delivery service used in this project for sedning emails and notifications.You can get its API key from [here](https://postmarkapp.com/).

## Steps for project setup

- Once you have the specified requirements above, clone the project repository to your desired directory by running the command:
`git clone https://github.com/Fidelisaboke/StrathPort.git`

- Install node dependencies
`npm install`

- Copy the .env.example file to .env
`cp .env.example .env`

- You then update the .env file to include your databse details and email credentials
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=NAME OF YOUR DATABASE
DB_USERNAME=YOUR USERNAME
DB_PASSWORD=YOUR PASSWORD

MAIL_MAILER=postmark
MAIL_HOST=smtp.postmarkapp.com
MAIL_PORT=2525
MAIL_USERNAME=YOUR API KEY
MAIL_PASSWORD=YOUR API KEY
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="YOUR EMAIL ADDRESS"
MAIL_FROM_NAME="${APP_NAME}"
```

- Afterwards, you run the database migrations to include the database tables that would be needed for the application by using the command
`php artisan migrate`

- Generate an application key
`php artisan key:generate`

# Usage
-------------------------------------------------------------------
## Running the web application

- Compile the Front-end assets
`npm run dev`

- Start the development server
`php artisan serve`

# Project Structure
-------------------------------------------------------------------
## Tree Structure
```
C:.
ª   .editorconfig
ª   .env
ª   .env.example
ª   .gitattributes
ª   .gitignore
ª   artisan
ª   composer.json
ª   composer.lock
ª   package-lock.json
ª   package.json
ª   phpunit.xml
ª   postcss.config.js
ª   README.md
ª   tailwind.config.js
ª   treestructure.txt
ª   vite.config.js
ª
+---.github
ª   +---workflows
ª           laravel.yml
ª
+---app
ª   +---Actions
ª   ª   +---Fortify
ª   ª   ª       CreateNewUser.php
ª   ª   ª       PasswordValidationRules.php
ª   ª   ª       ResetUserPassword.php
ª   ª   ª       UpdateUserPassword.php
ª   ª   ª       UpdateUserProfileInformation.php
ª   ª   ª
ª   ª   +---Jetstream
ª   ª           DeleteUser.php
ª   ª
ª   +---Http
ª   ª   +---Controllers
ª   ª   ª   ª   CarpoolingDetailsController.php
ª   ª   ª   ª   CarpoolRequestController.php
ª   ª   ª   ª   Controller.php
ª   ª   ª   ª   LockScreenController.php
ª   ª   ª   ª   TransportRequestController.php
ª   ª   ª   ª   TransportScheduleController.php
ª   ª   ª   ª
ª   ª   ª   +---Admin
ª   ª   ª   ª       AdminController.php
ª   ª   ª   ª       CarpoolDriverController.php
ª   ª   ª   ª       CarpoolVehicleController.php
ª   ª   ª   ª       SchoolDriverController.php
ª   ª   ª   ª       SchoolVehicleController.php
ª   ª   ª   ª       StaffController.php
ª   ª   ª   ª       StudentController.php
ª   ª   ª   ª       TransportRequestController.php
ª   ª   ª   ª       TransportScheduleController.php
ª   ª   ª   ª       UserController.php
ª   ª   ª   ª
ª   ª   ª   +---CarpoolDriver
ª   ª   ª           CarpoolingDetailsController.php
ª   ª   ª           CarpoolRequestController.php
ª   ª   ª           CarpoolVehicleController.php
ª   ª   ª
ª   ª   +---Middleware
ª   ª           CheckIfActive.php
ª   ª           CheckIfAdmin.php
ª   ª           CheckIfLocked.php
ª   ª
ª   +---Livewire
ª   ª   ª   DeleteConfirmationModal.php
ª   ª   ª   HomeNavMenu.php
ª   ª   ª   LogoutConfirmationModal.php
ª   ª   ª   TripCancelConfirmationModal.php
ª   ª   ª
ª   ª   +---Profile
ª   ª           UpdateCarpoolDriverInformationForm.php
ª   ª           UpdateStaffInformationForm.php
ª   ª           UpdateStudentInformationForm.php
ª   ª
ª   +---Models
ª   ª       CarpoolDriver.php
ª   ª       CarpoolingDetails.php
ª   ª       CarpoolRequest.php
ª   ª       CarpoolVehicle.php
ª   ª       SchoolDriver.php
ª   ª       SchoolVehicle.php
ª   ª       Staff.php
ª   ª       Student.php
ª   ª       TransportRequest.php
ª   ª       TransportSchedule.php
ª   ª       User.php
ª   ª
ª   +---Providers
ª   ª       AppServiceProvider.php
ª   ª       FortifyServiceProvider.php
ª   ª       JetstreamServiceProvider.php
ª   ª
ª   +---View
ª       +---Components
ª           ª   AdminAppLayout.php
ª           ª   AdminDashboard.php
ª           ª   AdminSidebar.php
ª           ª   AppLayout.php
ª           ª   ButtonLink.php
ª           ª   CarpoolDriverDashboard.php
ª           ª   CarpoolDriverLinks.php
ª           ª   CarpoolDriverResponsiveLinks.php
ª           ª   CarpoolingDetailsView.php
ª           ª   CarpoolRequestsView.php
ª           ª   CarpoolVehicleInfoCard.php
ª           ª   GuestLayout.php
ª           ª   StaffDashboard.php
ª           ª   StudentDashboard.php
ª           ª   StudentStaffLinks.php
ª           ª   StudentStaffResponsiveLinks.php
ª           ª   TransportRequestDoughnut.php
ª           ª   TransportRequestsFilter.php
ª           ª   TransportRequestsView.php
ª           ª   TransportSchedulesView.php
ª           ª   TripStatusBar.php
ª           ª   UpcomingTripsTable.php
ª           ª   UserProfileCard.php
ª           ª
ª           +---Tables
ª                   Table-carpool-drivers-edit.php
ª                   Table-carpool-vehicles-edit.php
ª                   TableSchoolDriversEdit.php
ª                   TableSchoolVehiclesEdit.php
ª                   TableTransportRequestsEdit.php
ª                   TableTransportSchedulesEdit.php
ª                   TableUsersEdit.php
ª
+---bootstrap
ª   ª   app.php
ª   ª   providers.php
ª   ª
ª   +---cache
ª           .gitignore
ª           config.php
ª           packages.php
ª           services.php
ª
+---config
ª       app.php
ª       auth.php
ª       cache.php
ª       database.php
ª       filesystems.php
ª       fortify.php
ª       jetstream.php
ª       logging.php
ª       mail.php
ª       permission.php
ª       queue.php
ª       sanctum.php
ª       services.php
ª       session.php
ª
+---database
ª   ª   .gitignore
ª   ª   database.sqlite
ª   ª
ª   +---factories
ª   ª       UserFactory.php
ª   ª
ª   +---migrations
ª   ª       0001_01_01_000000_create_users_table.php
ª   ª       0001_01_01_000001_create_cache_table.php
ª   ª       0001_01_01_000002_create_jobs_table.php
ª   ª       2024_05_21_114346_add_two_factor_columns_to_users_table.php
ª   ª       2024_05_21_114435_create_personal_access_tokens_table.php
ª   ª       2024_06_12_094828_create_transport_requests_table.php
ª   ª       2024_06_12_100708_create_students_table.php
ª   ª       2024_06_12_100738_create_staff_table.php
ª   ª       2024_06_21_074047_create_school_drivers_table.php
ª   ª       2024_06_21_074111_create_school_vehicles_table.php
ª   ª       2024_06_21_074250_create_carpool_drivers_table.php
ª   ª       2024_06_21_074307_create_carpool_vehicles_table.php
ª   ª       2024_06_21_100224_create_transport_schedules_table.php
ª   ª       2024_06_30_082658_create_carpool_requests_table.php
ª   ª       2024_06_30_083753_create_carpooling_details_table.php
ª   ª       2024_07_02_080143_create_permission_tables.php
ª   ª
ª   +---seeders
ª           CarpoolDriverSeeder.php
ª           CarpoolingDetailsSeeder.php
ª           CarpoolRequestSeeder.php
ª           CarpoolVehicleSeeder.php
ª           DatabaseSeeder.php
ª           RolePermissionSeeder.php
ª           SchoolDriverSeeder.php
ª           SchoolVehicleSeeder.php
ª           StaffSeeder.php
ª           StudentSeeder.php
ª           TransportRequestSeeder.php
ª           TransportScheduleSeeder.php
ª           UserSeeder.php
ª
+---routes
ª       api.php
ª       console.php
ª       web.php
ª
+---tests
ª   ª   TestCase.php
ª   ª
ª   +---Feature
ª   ª       ApiTokenPermissionsTest.php
ª   ª       AuthenticationTest.php
ª   ª       BrowserSessionsTest.php
ª   ª       CreateApiTokenTest.php
ª   ª       DeleteAccountTest.php
ª   ª       DeleteApiTokenTest.php
ª   ª       EmailVerificationTest.php
ª   ª       ExampleTest.php
ª   ª       PasswordConfirmationTest.php
ª   ª       PasswordResetTest.php
ª   ª       ProfileInformationTest.php
ª   ª       RegistrationTest.php
ª   ª       TwoFactorAuthenticationSettingsTest.php
ª   ª       UpdatePasswordTest.php
ª   ª
ª   +---Unit
ª           ExampleTest.php
```
- The tree Structure shown above is generated using the command
`tree /f > treestructure.txt`

# Contact Information
-------------------------------------------------------------------
For any inquiries, please contact us at:

https://github.com/Lynn-Wahito - Lynn Wahito

https://github.com/Fidelisaboke - Fidel Isaboke

# License
---------------------------------------------------------------
This project is open-sourced software licensed under the [MIT license](https://opensource.org/license/MIT). 


