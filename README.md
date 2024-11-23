# AdminDashboard



# Laravel 10 Project Setup Instructions

## Prerequisites

Before setting up the Laravel 10 project, ensure you have the following installed:

- **PHP** (version 8.1 or higher)
- **Composer** (a dependency manager for PHP)
- **MySQL** (or other supported database systems like PostgreSQL, SQLite)
- **Node.js** (for front-end dependencies like Vue, React, or any JavaScript builds)
- **NPM or Yarn** (for managing JavaScript dependencies)
- **Laravel Installer** (optional but recommended)

---

## Step-by-Step Setup Instructions

### 1. Clone the Repository

First, clone the project repository from GitHub (or your repository host):

```bash
git clone https://github.com/ajarmeh-oroub/AdminDashboard.git
```

Navigate to the project directory:

```bash
cd your-laravel-project
```

### 2. Install Project Dependencies

#### Install PHP dependencies with Composer:

Run the following command to install all PHP dependencies defined in `composer.json`:

```bash
composer install
```

#### Install JavaScript dependencies:

If the project uses frontend tools like Vue or React, install the JavaScript dependencies using either **npm** or **Yarn**:

```bash
npm install
```

Or if you prefer **Yarn**:

```bash
yarn install
```

### 3. Set Up Environment Configuration

Laravel uses an `.env` file to store environment variables, such as database credentials, application keys, etc. If the project doesn’t have an `.env` file already, you can create one from the `.env.example` file:

```bash
cp .env.example .env
```

Now, you need to configure your environment variables:

- **APP_NAME**: Set the name of your application.
- **APP_ENV**: Set the environment (`local`, `production`, etc.).
- **APP_KEY**: Generate an application key (you’ll do this in the next step).
- **DB_CONNECTION**: Set the database connection (`mysql`, `pgsql`, etc.).
- **DB_HOST**: Set the database host (usually `127.0.0.1` for local development).
- **DB_PORT**: Set the database port (usually `3306` for MySQL).
- **DB_DATABASE**: Set your database name (in this project its called arabia).
- **DB_USERNAME**: Set your database username.
- **DB_PASSWORD**: Set your database password.

### 4. Generate Application Key

Run the following command to generate the application key:

```bash
php artisan key:generate
```

This will set the `APP_KEY` in the `.env` file, which is required for encrypting user sessions and other data.

### 5. Set Up the Database

Create a database using your MySQL (or preferred database) management tool, and then run the migrations to set up the necessary tables.

#### Run database migrations:

```bash
php artisan migrate
```

If your project has seed data, you can run the following to populate the database with initial data:

```bash
php artisan db:seed
```

### 6. Configure Permissions (Linux/Unix-based systems)

If you're using a Unix-based system (Linux, macOS), ensure that the `storage` and `bootstrap/cache` directories are writable by the web server:

```bash
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache
```

### 7. Serve the Application

To start the Laravel development server, run the following command:

```bash
php artisan serve
```

This will start the server at `http://127.0.0.1:8000`. You can now open the application in your browser.

### 8. (Optional) Set Up Frontend Assets

If your project uses frontend assets (e.g., Vue.js, React), you may need to compile them.

#### Compile assets using npm:

```bash
npm run dev
```

Or if you're using **Yarn**:

```bash
yarn dev
```

For production builds:

```bash
npm run prod
```

Or for **Yarn**:

```bash
yarn prod
```

---

## Additional Setup

### 9. Configure Mail (Optional)

If your application sends emails, configure the mail settings in the `.env` file. Set the following variables according to your email service provider:

- **MAIL_MAILER**
- **MAIL_HOST**
- **MAIL_PORT**
- **MAIL_USERNAME**
- **MAIL_PASSWORD**
- **MAIL_ENCRYPTION**

### 10. (Optional) Set Up Queue System

If your application uses queues (for jobs, sending emails, etc.), configure the queue settings in the `.env` file and set up a queue driver (e.g., `database`, `redis`, etc.).

Run the queue listener with:

```bash
php artisan queue:work
```

---

## Troubleshooting

If you run into any issues during setup, check the following:

- Ensure all dependencies are installed by running `composer install` and `npm install`.
- Verify your `.env` configuration, especially the database settings.
- If you encounter permission issues, ensure the `storage` and `bootstrap/cache` directories are writable.

---

