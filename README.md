# welldocphp

Simple PHP MVC application with a small REST API.

## Installation

1. Ensure PHP 8+ and Composer are installed.
2. Run `composer install` to install dependencies and generate the autoloader.

## Usage

Start the built-in PHP server from the project root:

```bash
php -S localhost:8000 index.php
```

The API will be available at `http://localhost:8000`.

## Project structure

```
app/
  controllers/  # Request handlers
  core/         # Minimal framework classes
  models/       # Data access layer
  views/        # HTML templates
index.php       # Entry point and route registration
```

### Core components

- **Router** – Minimal routing system supporting REST verbs. Internally it uses
  factories to create immutable Request and Response objects.
- **Request / Response** – Abstractions for HTTP requests and responses.
- **View** – Renders PHP templates from the `views` directory.
- **Database** – PDO-based singleton (not used by default). Modify models to use it for real databases.
- **Middleware** – Pipeline for cross-cutting concerns like logging, CORS, and auth.

### Controllers

`HomeController` renders a simple welcome page. `ItemsController` provides CRUD actions for items via JSON responses.

### Models

`ItemsModel` stores an in-memory list of items. It can be replaced with a database-backed model. `HomeModel` returns a welcome message for the home page.

### Views

Located in `app/views`. The `home.php` template displays the message passed by the controller.

### Middleware

Middleware lives in `app/middleware` and is executed before route handlers. The default stack includes:

- `LoggingMiddleware` – logs each request method and path.
- `CorsMiddleware` – adds CORS headers and handles preflight `OPTIONS` requests.
- `AuthMiddleware` – checks for an `Authorization: Bearer secret` header and rejects unauthorized requests.

Register additional middleware in `public/index.php` using `$router->addMiddleware()`.

## API endpoints

- `GET /` – Home page.
- `GET /items` – List all items.
- `GET /items/{id}` – Retrieve a single item.
- `POST /items` – Create an item (expects form data).
- `PUT /items/{id}` – Update an item.
- `DELETE /items/{id}` – Delete an item.

## Extending

Use the provided core classes as a starting point for a custom MVC application. Create additional controllers and views as needed, or update the models to use a database connection via the `Database` class.
