# SPA Intentions

A modern Single Page Application built with Laravel 11, Livewire 3, and Tailwind CSS.

## 🚀 Tech Stack

- **Backend Framework:** Laravel 11.x
- **Frontend Framework:** Livewire 3.x
- **CSS Framework:** Tailwind CSS 3.x
- **UI Components:** Flowbite
- **Build Tool:** Vite
- **Testing:** Pest PHP
- **PHP Version:** ^8.2

## 📋 Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and NPM
- Docker and Docker Compose (for containerized development)

## 🛠️ Installation

1. Clone the repository:
   ```bash
   git clone [repository-url]
   cd spa-intentions
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install Node.js dependencies:
   ```bash
   npm install
   ```

4. Create environment file:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Configure your database in `.env` file

6. Run migrations:
   ```bash
   php artisan migrate
   ```

## 🏗️ Development

### Using Docker

1. Start the Docker containers:
   ```bash
   docker-compose up -d
   ```

2. Access the application at `http://localhost:8000`

### Local Development

1. Start the development server:
   ```bash
   composer dev
   ```

This command will concurrently run:
- Laravel development server
- Queue listener
- Log watcher
- Vite development server

## 🧪 Testing

Run tests using Pest PHP:
```bash
php artisan test
```

## 🏭 Production Build

1. Build assets:
   ```bash
   npm run build
   ```

2. Optimize Laravel:
   ```bash
   php artisan optimize
   ```

## 📦 Project Structure

```
├── app/              # Application core code
├── bootstrap/        # Framework bootstrap files
├── config/          # Configuration files
├── database/        # Database migrations and seeders
├── public/          # Publicly accessible files
├── resources/       # Frontend resources
├── routes/          # Application routes
├── storage/         # Application storage
├── tests/           # Test files
└── vendor/          # Composer dependencies
```

## 🔧 Configuration

Key configuration files:
- `.env` - Environment variables
- `config/app.php` - Application configuration
- `tailwind.config.js` - Tailwind CSS configuration
- `vite.config.js` - Vite configuration

## 📝 Code Style

The project uses Laravel Pint for code style enforcement. Run:
```bash
./vendor/bin/pint
```

## 🔐 Security

- Keep your `.env` file secure and never commit it to version control
- Regularly update dependencies using `composer update` and `npm update`
- Follow Laravel's security best practices

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📞 Support

For support, please [open an issue](repository-issues-url) in the repository.
