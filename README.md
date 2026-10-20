# ABDOUNISM: Stock Management Web App (Laravel)

> A Laravel 9 web application for managing a warehouse's stock: items going in and out, suppliers, categories, and low-stock alerts, with role-based screens for administrators and storekeepers.

![PHP](https://img.shields.io/badge/PHP-%5E8.0.2-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-9.x-FF2D20?logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-triggers-4479A1?logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-06B6D4?logo=tailwindcss&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?logo=alpinedotjs&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-4.x-646CFF?logo=vite&logoColor=white)
![Status](https://img.shields.io/badge/status-academic%20project-lightgrey)

## Overview

This is my end-of-studies project (PFE) for the **Technicien Spécialisé en Développement Digital** diploma at **ISTA Bab Tizimi, Meknès** (2022–2024).

The app digitises a stock register. Each stock movement ("article") records a date, a purchase or issue slip number (*bon de commande / bon de sortie*), the supplier or receiving user, a reference, a quantity, a category, a location and a direction (*entrée* = stock in, *sortie* = stock out). A MySQL trigger keeps a running stock level per item, and the app highlights items that are running low.

The interface is in French and rendered server-side with Blade, Tailwind CSS and Alpine.js on top of Laravel Breeze.

### How this repo relates to the others

This is the **complete, working version** of the project: a single Laravel monolith that contains all the stock-management features. Its last commit is dated 5 April 2024.

Two later repositories started rewriting it as a separate React frontend and Laravel API. Neither of them ports the stock features:

- [FinalV](https://github.com/AbdouniAbdessamad/FinalV) (9 April 2024): a first SPA attempt with a React app and a users REST API.
- [FinalVersionPFE](https://github.com/AbdouniAbdessamad/FinalVersionPFE) (22 April 2024): a second SPA attempt using Laravel Breeze (API) with Sanctum cookie authentication and a Vite + React frontend.

## Key Features

- **Authentication** with Laravel Breeze: register, log in, log out, password reset, email verification and profile management (update details, change password, delete account).
- **Two roles**, chosen at registration: `administrateur` and `magasinier` (storekeeper).
  - Administrators see the user list on the dashboard and get **Edit/Delete** actions on articles, suppliers and categories.
  - Storekeepers see a welcome/free-trial modal with payment-method buttons on the dashboard. The buttons are UI only; no payment is processed.
- **Stock movements (articles)**: full CRUD. Each movement stores its date, slip number, supplier or beneficiary, reference, name, quantity, category, location, in/out status, and the **last user who edited it**.
- **Stock table** with green rows for stock in and red rows for stock out, plus a client-side filter by item name.
- **Suppliers**: full CRUD with name, city, country, address, phone and type, and a paginated list (10 per page).
- **Categories**: full CRUD.
- **Low-stock alert page** (`/alertStock`): shows the running quantity per item and highlights items below 10 units in orange.
- **Database-level stock logic**: MySQL triggers update the running quantity on every insert and block a stock-out with a null quantity.
- **Seeders and factories**: a default admin user and 20 fake suppliers.

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP ^8.0.2, Laravel ^9.19, Laravel Sanctum ^3.0 |
| Auth scaffolding | Laravel Breeze ^1.19 (Blade stack) |
| Views | Blade components, Tailwind CSS ^3.1 with `@tailwindcss/forms`, Alpine.js ^3.4, Sass |
| Asset bundling | Vite ^4 with `laravel-vite-plugin` |
| Database | MySQL (needed for the triggers) |
| Testing | PHPUnit ^9.5 (Breeze auth and profile feature tests) |

## Project Structure

```
pfe/
├── app/
│   ├── Http/Controllers/
│   │   ├── ArticleController.php      # stock movements CRUD
│   │   ├── SupplierController.php     # suppliers CRUD
│   │   ├── CategoryController.php     # categories CRUD
│   │   ├── LowQuantityController.php  # low-stock alert list
│   │   ├── UserController.php         # dashboard (user list)
│   │   └── Auth/                      # Breeze auth controllers
│   └── Models/                        # Article, Supplier, Category, LowQuantity, User
├── database/
│   ├── migrations/                    # schema + MySQL triggers
│   ├── factories/
│   └── seeders/
├── resources/views/
│   ├── articles/  supplier/  category/  alert/   # feature screens
│   ├── auth/  profile/  layouts/  components/    # Breeze UI
│   └── dashboard.blade.php
├── routes/
│   ├── web.php                        # app routes (resource controllers)
│   └── auth.php                       # Breeze auth routes
└── tests/Feature/                     # auth and profile tests
```

The app follows standard Laravel MVC. Each domain (articles, suppliers, categories) has a resource controller, an Eloquent model and its own folder of Blade views. All feature routes sit behind the `auth` middleware.

## Database

| Table | Purpose / key columns |
|---|---|
| `users` | Breeze users plus a `role` column (default `user`; the registration form offers `magasinier` or `administrateur`) |
| `categories` | `name` |
| `suppliers` | `name`, `city`, `country`, `address`, `phone`, `type` |
| `articles` | `date`, `bon_commande`, `supplier_id`, `ref`, `name`, `quantity`, `emplacement`, `status`, `category_id` → `categories`, `last_editor_id` → `users` |
| `low_quantities` | Running stock per item: `ref`, `name`, `quantity`, `status` |
| `password_resets`, `failed_jobs`, `personal_access_tokens` | Laravel defaults |

**Triggers** (migration `2024_02_08_105548_create_trigger_for_low_quantity_articles.php`):

- `after_insert_article`: when an article is inserted, it creates the item's row in `low_quantities` if none exists. Otherwise it adds the quantity for a stock-in or subtracts it for a stock-out.
- `before_insert_prevent_sortie`: rejects a stock-out with a null quantity (`SQLSTATE 45000`).

## Getting Started

### Prerequisites

- PHP 8.0.2 or later and Composer
- Node.js and npm
- MySQL (the trigger migration uses MySQL syntax and will not run on SQLite)

### Installation

```bash
git clone https://github.com/AbdouniAbdessamad/pfe.git
cd pfe

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Create a MySQL database (for example `pfe`) and set `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD` in `.env`. Then run:

```bash
php artisan migrate --seed   # creates tables, triggers, an admin user and 20 suppliers
npm run dev                  # Vite dev server for Tailwind/Alpine assets
php artisan serve            # http://127.0.0.1:8000
```

The seeder creates `admin@example.com` with a demo password (see `database/seeders/DatabaseSeeder.php`). That user has no admin role, so register a new account and pick **Administrateur** to see the admin screens.

### Running tests

```bash
php artisan test
```

## Possible Improvements

- **Enforce roles on the server.** The role is currently picked by the user at sign-up and checked only in Blade views. A policy or middleware should guard the edit and delete routes, and administrators should assign roles.
- **Make the stock logic consistent.** The form submits `entrée` (with an accent) while the trigger compares against `entree`, so stock-in movements are not added to existing totals. Updates and deletions of articles do not adjust stock either. This logic could move into a service class with tests, or into extra triggers.
- **Tidy up the schema.** `articles.supplier_id` is a string rather than a real foreign key. Supplier `city`, `country` and `type` are `NOT NULL` in the database but optional in validation.
- **Add tests and server-side search/pagination** for the stock and category lists.

## Author

**Abdessamad Abdouni**, Information Systems Engineering student at SUPMTI Rabat, Morocco
GitHub: [github.com/AbdouniAbdessamad](https://github.com/AbdouniAbdessamad)
