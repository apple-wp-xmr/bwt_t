# Laravel Application

This is a Laravel application for a test task.

## Setup Instructions

> **Note**: The `.env` file is included in the repository for testing purposes only.  
> In production, it is **not recommended** to commit the `.env` file to version control.

### Requirements

-   PHP 8.x
-   Composer
-   Node.js and NPM
-   MySQL or compatible database

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/your-repository.git
    cd your-repository
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install JavaScript dependencies:

    ```bash
    npm install
    ```

4. Run database migrations and seeders:

    ```bash
    php artisan migrate:fresh --seed
    ```

5. (Optional) Start the local development server:

    ```bash
    php artisan serve
    ```

### Notes

-   The `.env` file is already set up.
-   Database credentials must match your local environment or Docker container setup.
-   This project is for testing and learning purposes.
