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

## Running with Docker

### Prerequisites
- Docker
- Docker Compose

### Environment Setup
1. Create a `.env` file in the root directory with the following variables:
```env
# Database Configuration
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=spa_intentions
DB_USERNAME=spa_user
DB_PASSWORD=spa_password

# PostgreSQL Configuration
POSTGRES_DB=spa_intentions
POSTGRES_USER=spa_user
POSTGRES_PASSWORD=spa_password

# Vite Configuration
VITE_PORT=5173
```

### Running the Application
1. Build and start the containers:
```bash
docker-compose up -d
```

2. Install PHP dependencies:
```bash
docker-compose exec laravel composer install
```

3. Generate application key:
```bash
docker-compose exec laravel php artisan key:generate
```

4. Run database migrations:
```bash
docker-compose exec laravel php artisan migrate
```

The API will be available at:
- API: http://localhost:8000
- Vite Dev Server: http://localhost:5173

### Container Information
- **API Container (spa_web)**
  - PHP 8.2 with FPM
  - Laravel application
  - Node.js and npm for frontend assets
  - Exposed ports: 8000 (API), 5173 (Vite)

- **Database Container (spa_db)**
  - PostgreSQL 15 (Alpine)
  - Persistent volume for data storage
  - Exposed port: 5432

### Development Commands
```bash
# Access Laravel container shell
docker-compose exec laravel bash

# Run Laravel commands
docker-compose exec laravel php artisan <command>

# Run Composer commands
docker-compose exec laravel composer <command>

# View logs
docker-compose logs -f

# Stop containers
docker-compose down
```

### Stopping the Application
```bash
# Stop and remove containers
docker-compose down

# Stop and remove containers with volumes
docker-compose down -v
```

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
