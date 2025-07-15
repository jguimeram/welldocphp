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
  services/     # Business logic and caching
  views/        # HTML templates
index.php       # Entry point and route registration
```

### Core components

- **Router** – Minimal routing system supporting REST verbs. Internally it uses
  factories to create immutable Request and Response objects.
- **Request / Response** – Abstractions for HTTP requests and responses.
- **View** – Renders PHP templates from the `views` directory.
- **Database** – PDO-based singleton (not used by default). Modify models to use it for real databases.

### Controllers

`HomeController` renders a simple welcome page. `ItemsController` provides CRUD actions for items via JSON responses.

### Services

The service layer encapsulates business logic. `ItemsService` optionally caches model data using implementations of `CacheInterface` such as `ArrayCache`.

### Models

`ItemsModel` stores an in-memory list of items. `BaseModel` is a blueprint that provides common CRUD query methods for database-backed models. `HomeModel` returns a welcome message for the home page.

### Views

Located in `app/views`. The `home.php` template displays the message passed by the controller.

## API endpoints

- `GET /` – Home page.
- `GET /items` – List all items.
- `GET /items/{id}` – Retrieve a single item.
- `POST /items` – Create an item (expects form data).
- `PUT /items/{id}` – Update an item.
- `DELETE /items/{id}` – Delete an item.

## Extending

Use the provided core classes as a starting point for a custom MVC application. Create additional controllers and views as needed. Models can extend `BaseModel` to work with the `Database` class. Business logic can live in services and take advantage of optional caching.
