# welldocphp
Simple PHP MVC application with a small REST API.

## Usage

Run `composer install` to generate the autoloader.
Then serve the application with PHP's built-in server:

```
php -S localhost:8000 index.php
```

Available routes:

- `GET /` - Home page.
- `GET /items` - List all items.
- `GET /items/{id}` - Show single item.
- `POST /items` - Create item.
- `PUT /items/{id}` - Update item.
- `DELETE /items/{id}` - Delete item.
