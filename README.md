# SPA Intentions - Church Mass Intentions Management System

## Overview
SPA Intentions is a web application designed to manage and organize mass intentions for churches. The system allows users to register their intentions for specific masses, with features for both regular users and administrators.

## Features

### User Management
- User authentication system using PIN-based login
- Role-based access control (Admin and regular users)
- Secure session management
- User profile management

### Mass Intentions
- Register mass intentions with specific dates and times
- Multiple intentions can be registered for a single mass
- Validation for mass dates (must be current or future dates)
- Group intentions by date for better organization

### Church Management
- Support for multiple churches
- Church-specific intention tracking
- Church selection during intention registration

## Technical Stack
- **Backend Framework**: Laravel (PHP)
- **Database**: MySQL/PostgreSQL (Laravel compatible)
- **Authentication**: Custom PIN-based authentication system
- **Frontend**: Blade templating engine

## System Requirements
- PHP 8.0 or higher
- Composer
- Laravel 8.x or higher
- MySQL/PostgreSQL database
- Web server (Apache/Nginx)

## Installation

1. Clone the repository
```bash
git clone [repository-url]
```

2. Install dependencies
```bash
composer install
```

3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database settings in `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Run migrations
```bash
php artisan migrate
```

6. Start the development server
```bash
php artisan serve
```

## Usage

### User Authentication
1. Access the login page at `/entrar`
2. Enter your name and 5-digit PIN
3. The system will automatically assign appropriate roles based on the PIN

### Registering Mass Intentions
1. Log in to the system
2. Navigate to the home page
3. Select the church
4. Choose the mass date and time
5. Enter your intentions
6. Submit the form

### Admin Features
- Access to all intentions view
- Management of church information
- User management capabilities

## Security Features
- PIN-based authentication
- Session management
- Input validation
- Role-based access control

## Contributing
[Add contribution guidelines here]

## License
[Add license information here]

## Support
[Add support information here]

## API Documentation

### Base URL
```
http://your-domain/api/v1
```

### Authentication
All authenticated endpoints require a Bearer token in the Authorization header:
```
Authorization: Bearer <your_token>
```

### Response Format
All API responses follow this standard format:
```json
{
    "success": true,
    "message": "Operation message",
    "data": {
        // Response data
    }
}
```

Error responses:
```json
{
    "success": false,
    "message": "Error message",
    "errors": {
        // Validation errors or other error details
    }
}
```

### Endpoints

#### Authentication

##### Login
- **POST** `/login`
- **Description**: Authenticate user with PIN
- **Request Body**:
```json
{
    "name": "string",
    "pin": "string (5 digits)"
}
```
- **Response**:
```json
{
    "success": true,
    "message": "Usuário autenticado!",
    "data": {
        "user": {
            "id": "integer",
            "name": "string",
            "role": "string"
        },
        "token": "string"
    }
}
```

##### Logout
- **POST** `/logout`
- **Description**: Logout user and invalidate token
- **Headers**: Requires authentication
- **Response**: 204 No Content

#### Churches

##### List Churches
- **GET** `/churches`
- **Description**: Get list of all churches
- **Headers**: Requires authentication
- **Response**:
```json
{
    "success": true,
    "data": [
        {
            "id": "integer",
            "name": "string",
            "address": "string"
        }
    ]
}
```

#### Intentions

##### Create Intention
- **POST** `/intentions`
- **Description**: Register a new mass intention
- **Headers**: Requires authentication
- **Request Body**:
```json
{
    "mass_date": "date (YYYY-MM-DD)",
    "mass_hour": "time (HH:mm)",
    "contents": "string",
    "church_id": "integer"
}
```
- **Response**:
```json
{
    "success": true,
    "message": "Intenção registrada!",
    "data": {
        "id": "integer",
        "mass_date": "datetime",
        "contents": "string",
        "church": {
            "id": "integer",
            "name": "string"
        },
        "user": {
            "id": "integer",
            "name": "string"
        }
    }
}
```

##### List Intentions
- **GET** `/intentions`
- **Description**: Get all mass intentions (Admin only)
- **Headers**: Requires authentication
- **Response**:
```json
{
    "success": true,
    "data": {
        "YYYY-MM-DD": [
            {
                "id": "integer",
                "mass_date": "datetime",
                "contents": "string",
                "church": {
                    "id": "integer",
                    "name": "string"
                },
                "user": {
                    "id": "integer",
                    "name": "string"
                }
            }
        ]
    }
}
```

### Features

#### User Management
- PIN-based authentication system
- Role-based access control (Admin and regular users)
- Secure token-based session management
- User profile management

#### Mass Intentions
- Register mass intentions with specific dates and times
- Multiple intentions can be registered for a single mass
- Validation for mass dates (must be current or future dates)
- Group intentions by date for better organization
- Church-specific intention tracking

#### Church Management
- Support for multiple churches
- Church-specific intention tracking
- Church selection during intention registration

### Security Features
- PIN-based authentication
- Token-based session management
- Input validation
- Role-based access control
- Sanctum authentication middleware
