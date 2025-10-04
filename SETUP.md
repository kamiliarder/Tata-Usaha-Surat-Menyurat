# Setup Instructions for Team Members

## Environment Configuration

When you clone this project for the first time, follow these steps:

### 1. Copy the environment file
```bash
cp .env.example .env
```

### 2. Generate application key
```bash
php artisan key:generate
```

### 3. Configure your database
Edit the `.env` file and update these variables according to your local setup:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tata_usaha
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

### 4. Run migrations
```bash
php artisan migrate
```

### 5. Seed the database (optional)
```bash
php artisan db:seed
```

## Important Notes

- **Never commit your `.env` file** - it contains sensitive information like database passwords
- Each team member should have their own `.env` file with their local configuration
- If you need to add new environment variables, update `.env.example` and inform the team
- The `.env.example` file serves as a template for all team members

## Database Setup

Each team member should:
1. Create a MySQL database named `tata_usaha`
2. Set their own database password in their local `.env` file
3. Run migrations to set up the database structure
