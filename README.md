# Blazer SOS - Digital Yearbook System

Blazer SOS is a comprehensive digital yearbook platform built with Laravel and Livewire. It allows students to create profiles, upload photos, subscribe to current yearbooks, purchase past yearbooks, and more.

## Features

- **User Management**: Different roles for students, administrators, and superadministrators
- **Profile Management**: Students can create and update their yearbook profiles
- **Photo Management**: Upload and manage photos for inclusion in the yearbook
- **Subscription System**: Subscribe to current yearbooks or purchase past editions
- **Gift Purchases**: Send yearbooks as gifts to other students
- **Order Management**: Complete order processing system with admin interface
- **Email Verification**: OTP-based email verification for account security

## Installation

### Requirements

- PHP 8.1+
- MySQL 5.7+ or MariaDB 10.3+
- Composer
- Node.js and NPM

### Setup Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/blazer-sos.git
   cd blazer-sos
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install and compile frontend assets:
   ```bash
   npm install
   npm run dev
   ```

4. Copy the example environment file and set up your environment variables:
   ```bash
   cp .env.example .env
   ```

5. Generate an application key:
   ```bash
   php artisan key:generate
   ```

6. Configure your database in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=blazer_sos
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Set up email functionality (required for admin invitations and OTP verification):
   - See detailed instructions in [Email Setup Guide](resources/docs/email-setup.md)

8. Run the database migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

9. Link the storage directory:
   ```bash
   php artisan storage:link
   ```

10. Start the development server:
    ```bash
    php artisan serve
    ```

## User Roles

- **Students**: Can create profiles, upload photos, subscribe to yearbooks
- **Administrators**: Can manage student profiles, yearbook content, and orders
- **Superadministrators**: Have full system access, including user management

## Usage

### Student Workflow:
1. Register and verify email with OTP
2. Complete yearbook profile
3. Upload photos
4. Subscribe to current yearbook or purchase past yearbooks
5. Complete checkout process

### Admin Workflow:
1. Accept invitation or be created by a superadmin
2. Manage student profiles and submissions
3. Process yearbook orders
4. Manage yearbook platforms

### Superadmin Workflow:
1. Invite and manage administrators
2. Configure system settings
3. Access all admin functions

## Shopping System

The platform includes a complete shopping system:
- Browse current and past yearbooks
- Add yearbooks to cart
- Gift yearbooks to other students
- Complete checkout with various payment methods
- Order history and management

## License

[License Name] - See the LICENSE file for details.

## Support

For support, please contact [your support email].

## Contributing

Contributions are welcome! Please see the [CONTRIBUTING.md](CONTRIBUTING.md) file for guidelines. 