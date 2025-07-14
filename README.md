# Laravel 12 – Quick Setup Instructions

## 🛠️ Quick Steps to Set Up Locally

```bash
# 1. Clone the repository
git clone https://github.com/Abdo0-bit/My-Blog.git
cd My-Blog

# 2. Install dependencies
composer install

# 3. Create .env file
cp .env.example .env

# 4. Update the .env file with your DB info:
# (open the file and change these values manually)
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=blog_db
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Generate app key
php artisan key:generate

# 6. Import the database (if provided)
mysql -u root -p your_db_name < project.sql

# 7. Run Laravel dev server
php artisan serve

# Visit:
# http://127.0.0.1:8000

# (Optional) If you use migrations and seeders
php artisan migrate
php artisan db:seed
