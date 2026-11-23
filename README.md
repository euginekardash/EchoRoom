# 📰 EchoRoom

> A news portal with authentication, article management, and an admin panel.  
> A Laravel pet project — from idea to Docker deployment.

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?logo=docker&logoColor=white)
![Nginx](https://img.shields.io/badge/Nginx-009639?logo=nginx&logoColor=white)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-06B6D4?logo=tailwindcss&logoColor=white)
![License](https://img.shields.io/badge/license-MIT-green)

---

## 📖 About

**EchoRoom** is a news portal where visitors can read articles, and registered users can publish and manage their own content. The project was built as a pet project to practice backend development with Laravel: authentication, database design, CRUD operations, responsive UI, and containerization.

**Features:**
- ✅ Registration, login, logout (Laravel Breeze)
- ✅ Role-based access: guest / user / admin
- ✅ Full CRUD for news articles
- ✅ Pagination and search by title
- ✅ Responsive UI with Tailwind CSS
- ✅ Fully containerized with Docker Compose
- ✅ Migrations and seeders with demo data

---

## 🛠️ Tech Stack

| Layer | Technologies |
|-------|-------------|
| **Backend** | PHP 8.2, Laravel 12 (MVC, Eloquent ORM, Blade) |
| **Database** | MySQL |
| **Frontend** | Blade, Tailwind CSS, Bootstrap, JavaScript (DOM, fetch) |
| **Infrastructure** | Docker, Docker Compose, Nginx, PHP-FPM |
| **Tooling** | Git, Composer, npm |

---

## 🚀 Quick Start

### Requirements
- [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/)

### Run in 4 steps

```bash
# 1. Clone the repository
git clone https://github.com/your-username/echoroom.git
cd echoroom

# 2. Copy the environment file
cp .env.example .env

# 3. Build and start containers
docker compose up -d --build

# 4. Run migrations and seed the database
docker compose exec app php artisan migrate --seed
