# Contact Manager - Laravel + VueJS + Modules

A modular Laravel application with VueJS frontend and the CrudTest module.

## Setup

```bash
# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate
```

### Database Setup

**Option 1: Import SQL file (with sample data)**
```bash
# Import the provided SQL file
mysql -u your_username -p your_database_name < test_app.sql
```

**Option 2: Run migrations + seed**
```bash
# Run migrations
php artisan migrate

# Seed module data
php artisan module:seed CrudTest
```

### Start Development

```bash
# Start servers
composer dev
```

## Access the Module

**CrudTest Module:** http://localhost:8000/crudtests

## License

[MIT license](https://opensource.org/licenses/MIT)
