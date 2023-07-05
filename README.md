# Laravel API Backend for User and Role Configuration

This repository contains a Laravel API backend that focuses on user and role configuration. It provides essential features such as login, forgot password, update password, profile management, and logout. The authentication mechanism employed in this system utilizes JWT Bearer Token for secure communication.

### Features

-   User Management: The API enables user registration, authentication, and authorization.
-   Role Configuration: Users can be assigned different roles with specific permissions.
-   Login: Users can securely log in using their credentials and obtain a JWT Bearer Token.
-   Forgot Password: Users can request a password reset email if they forget their password.
-   Update Password: Users can update their password securely.
-   Profile Management: Users can manage their profile information.
-   Logout: Users can log out of the system, invalidating their JWT Bearer Token.

### Prerequisites

-   PHP >= 8.1 or new
-   Composer
-   Node JS last version
-   NPM last version
-   MySQL or MariaDB last version

### Technology Stack

The project is built using the following technologies:

-   Laravel 10 (latest version): A powerful PHP framework for building web applications.
-   JWT Bearer Token: JSON Web Token-based authentication for secure API communication.

### Getting Started

To set up the project locally, please follow these steps:

1. Clone this repository: `https://github.com/fhmiibrhimdev/backend-laravel`
2. Install the required dependencies: `composer install`, then `cp .env.example .env`
3. Configure your database settings in the `.env` file.
4. Generate the application key: `php artisan key:generate`
5. Run database migrations: `php artisan migrate:fresh --seed`
6. Run JWT Secret and Storage Link: `php artisan jwt:secret && php artisan storage:link`
7. Start the development server for the Laravel project: `php artisan serve`

Make sure you have Laravel 10 and its dependencies installed on your machine before proceeding with the setup.

### Contributions

Contributions are welcome! If you find any issues or have suggestions for improvements, please feel free to submit a pull request or open an issue.

### License

This project is licensed under the MIT License. See the [LICENSE](https://github.com/fhmiibrhimdev/backend-laravel/blob/main/LICENSE) file for more details.
