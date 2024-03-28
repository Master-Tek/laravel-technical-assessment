# Laravel Livewire Technical Assessment App

This Laravel Livewire application serves as a technical assessment tool, featuring two primary forms related to personal and marital status information. The first form gathers basic personal details, and upon completion, users can proceed to the second form by clicking the "Next" button. The second form collects additional information regarding marital status. After submitting the second form, users are redirected to a new page displaying all the entered data for review.

## Technical Stack
- **PHP Version:** 8.3.4
- **Laravel Framework Version:** 11.1.0
- **Livewire Version:** 3.4.9

## Resources
For installation and setup of the necessary technologies, refer to these resources:

- **PHP Installation:** [PHP: Installation and Configuration](https://www.php.net/manual/en/install.php)
- **Laravel Installation:** [Laravel: Getting Started](https://laravel.com/docs/9.x/installation)
- **Livewire Installation:** [Livewire: Installation](https://laravel-livewire.com/docs/2.x/quickstart)

## Features
- Simple and intuitive two-step form process.
- Live form validation and state management with Laravel Livewire.
- Data review page showcasing all user-submitted information.

## Installation

1. **Clone the Repository**
   ```
   git clone https://your-repository-url.git
   cd your-project-directory
   ```

2. **Install Dependencies**
   Use Composer to install the PHP dependencies.
   ```
   composer install
   ```

3. **Environment Configuration**
   Copy the `.env.example` file to a new `.env` file and configure your environment settings.
   ```
   cp .env.example .env
   ```

4. **Generate Application Key**
   Generate a new application key with Artisan. This will be used for session and cache encryption.
   ```
   php artisan key:generate
   ```

5. **Start the Application**
   Use Laravel's built-in server to start your application.
   ```
   php artisan serve
   ```
   The application will be accessible at `http://localhost:8000`.

## Deployment
The application is deployed on Heroku and can be accessed at the following URL:
[https://laravel-livewire-test-993ca7a42ba4.herokuapp.com/](https://laravel-livewire-test-993ca7a42ba4.herokuapp.com/)
