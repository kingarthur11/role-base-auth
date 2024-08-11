# Role base authorisation app
# AB Microfinance Bank Service Repository

Welcome to the AB Microfinance Bank repository. This repository is home to our prototype service built with laravel PHP, which resides in the `role-base-auth` folder.

# Laravel Project Setup

## Prerequisites

Before setting up the Laravel project, ensure the following are installed on your machine:

- **PHP** (>= 8.0)
- **Composer** (dependency manager for PHP)
- **Node.js** and **NPM/Yarn** (for managing frontend dependencies)
- A **web server** (Apache)
- A **database server** (MySQL)

## Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/kingarthur11/role-base-auth.git

2. Navigate to the project folder:

   ```bash
   cd role-base-auth
   ```

3. Install the dependencies:

   ```bash
   composer install
   ```
4. Copy the example env file and make the required configuration changes in the .env file:
   ```bash
   cp .env.example .env
   ```

5. Generate a new application key:
   ```bash
   php artisan key:generate
   ```

6. Generate a new JWT authentication secret key:
   ```bash
   php artisan jwt:generate
   ```

7. Run the database migrations (Set the database connection in .env before migrating):
   ```bash
   php artisan migrate
   ```
   
8. Start the local development server:
   ```bash
   php artisan serve
   ```


## Database seeding

Populate the database with seed data with relationships which includes users, roles, permissions. This can help you to quickly start testing the api and generate roles for super admin, admins and users.

Run the database seeder and you're done:

```bash
    php artisan db:seed
```

`Note` : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command:

```bash
   php artisan migrate:refresh
```