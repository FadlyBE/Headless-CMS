# 🧠 Headless CMS - TALL Stack (Laravel + Livewire)

Technical test submission for Palmcode - Senior Laravel Developer role.

## 🔧 Tech Stack

- **Laravel 12**
- **Livewire (TALL Stack)**
- **Tailwind CSS**
- **Alpine.js**
- **Sanctum (for API authentication)**
- **Spatie Laravel Permission (RBAC)**
- **Localization (EN & ID)**

---

## 📦 Features

- ✅ Admin authentication with Laravel Breeze (Livewire)
- ✅ RBAC: Role and Permission Management
- ✅ Post, Page, and Category CRUD (with Livewire modals)
- ✅ Image upload for posts
- ✅ JSON REST API for Posts, Pages, and Categories
- ✅ Multilingual UI: English 🇺🇸 & Bahasa Indonesia 🇮🇩
- ✅ Admin Dashboard with total counts
- ✅ Clean and modular structure

---

## 🚀 Installation Instructions

### 1. Clone the Repository


git clone https://github.com/your-username/headless-cms-tall.git
cd headless-cms-tall
### 2. Install Dependencies

composer install
npm install && npm run build
### 3. Setup Environment
Copy the .env example:

cp .env.example .env
Edit .env and update the following:

APP_NAME="Headless CMS"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
### 4. Generate App Key & Migrate

php artisan key:generate
php artisan migrate
php artisan db:seed
⚠️ Seeding includes:

Admin user (email: admin@example.com, password: password)

### 5. Serve the App

php artisan serve
Visit: http://localhost:8000


🌍 Localization
Use the dropdown in the navbar to switch between:

EN English
ID Bahasa Indonesia

📡 API Endpoints
Resource	Endpoint
Posts 
List : /api/v1/posts
Detail : /api/v1/posts/{slug}

Pages 
List : /api/v1/pages
Detail : /api/v1/pages/{slug}

Categories: 
List: /api/v1/categories
Detail: /api/v1/categories/{id}

API is public. You can use tools like Postman or cURL to test.
