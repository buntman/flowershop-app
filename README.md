# rizza-flowershop-management-system

An internal website for Rizza Flower Shop admins to manage inventory, transactions, and orders, along with an external API that powers the mobile app for customer ordering and tracking.
## Technologies Used
- ![Laravel Logo](https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg)
- ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
- ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
- ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
- ![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

## 🚀 Getting Started 
Follow these instructions to set up and run the project locally.

## Prerequisite
- Docker (v20+)
- Docker Compose (v2+)

## Installation

1. Clone the repository

```bash
git clone https://github.com/buntman/flowershop-app.git
cd flowershop-app
```
2. Copy environment file

```bash
cp .env.example .env
```
3. Build and start the containers

```bash
docker compose up -d --build
```
3. Run database migrations

```bash
docker compose exec web php artisan migrate
```
4. Run admin seeder

```bash
docker compose exec web php artisan db:seed --class=AdminSeeder
```
Access the app on http://127.0.0.1:8000
