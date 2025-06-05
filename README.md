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
http://your-domain/api
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
- **Description**: Authenticate user with name and PIN
- **Request Body**:
```json
{
    "name": "string (required)",
    "pin": "string (required, exactly 5 digits)"
}
```
- **Validation Messages**:
  - Required fields: "O campo :attribute é obrigatório."
  - PIN format: "O campo pin deve ter, no máximo, 5 caracteres."
- **Response**:
```json
{
    "success": true,
    "message": "Usuário autenticado!",
    "data": {
        "user": {
            "id": "uuid",
            "name": "string",
            "role": {
                "id": "uuid",
                "role_name": "string"
            }
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
- **Access**: Admin and regular users
- **Response**:
```json
{
    "success": true,
    "data": [
        {
            "id": "uuid",
            "name": "string"
        }
    ]
}
```

#### Intentions

##### Create Intention
- **POST** `/intentions`
- **Description**: Register a new mass intention
- **Headers**: Requires authentication
- **Access**: Admin and regular users
- **Request Body**:
```json
{
    "mass_date": "date (required, YYYY-MM-DD, must be today or future)",
    "mass_hour": "time (required, HH:mm format)",
    "contents": "array (required) of strings",
    "church_id": "uuid (required, must exist)"
}
```
- **Validation Messages**:
  - Mass date: "A data da missa deve ser igual ou posterior a hoje."
  - Mass hour: "O formato do horário deve ser HH:mm."
  - Contents: "Suas intenções devem ser informadas."
  - Church: "A igreja selecionada não existe."
- **Response**:
```json
{
    "success": true,
    "message": "Intenção registrada!",
    "data": {
        "id": "uuid",
        "mass_date": "datetime",
        "contents": ["string"],
        "church": {
            "id": "uuid",
            "name": "string"
        },
        "user": {
            "id": "uuid",
            "name": "string"
        }
    }
}
```

##### List Intentions
- **GET** `/intentions`
- **Description**: Get all mass intentions
- **Headers**: Requires authentication
- **Access**: Admin only
- **Response**:
```json
{
    "success": true,
    "data": {
        "YYYY-MM-DD": [
            {
                "id": "uuid",
                "mass_date": "datetime",
                "contents": ["string"],
                "church": {
                    "id": "uuid",
                    "name": "string"
                },
                "user": {
                    "id": "uuid",
                    "name": "string"
                }
            }
        ]
    }
}
```

### Data Models

#### User
- UUID primary key
- Fields:
  - name (string)
  - pin (string, 5 digits)
  - role_id (uuid, foreign key)
- Relationships:
  - hasMany Intentions
  - belongsTo Role

#### Church
- UUID primary key
- Fields:
  - name (string)
- Relationships:
  - hasMany Intentions

#### Intention
- UUID primary key
- Fields:
  - contents (array of strings)
  - user_id (uuid, foreign key)
  - mass_date (datetime)
  - church_id (uuid, foreign key)
- Relationships:
  - belongsTo User
  - belongsTo Church

#### Role
- UUID primary key
- Fields:
  - role_name (string)
- Relationships:
  - hasMany Users

### Features

#### User Management
- UUID-based user identification
- PIN-based authentication system (5 digits)
- Role-based access control (Admin and regular users)
- Secure token-based session management using Laravel Sanctum
- User profile management

#### Mass Intentions
- Register mass intentions with specific dates and times
- Multiple intentions can be registered for a single mass
- Validation for mass dates (must be current or future dates)
- Group intentions by date for better organization
- Church-specific intention tracking
- Contents stored as array of strings

#### Church Management
- Support for multiple churches
- Church-specific intention tracking
- Church selection during intention registration

### Security Features
- PIN-based authentication
- Token-based session management using Laravel Sanctum
- Input validation with custom error messages
- Role-based access control
- UUID-based primary keys for all models
- Form request validation
- Resource transformation for API responses
