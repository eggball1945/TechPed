# TechPed - Modern Electronics Marketplace

TechPed is a premium e-commerce platform built with Laravel and Tailwind CSS, specifically designed for electronics and technology products. It offers a seamless shopping experience for customers and a robust management suite for administrators and staff.

## 🚀 Key Features

### 🛒 Customer Experience
- **Responsive Interface**: Optimized for mobile, tablet, and desktop viewing.
- **Flash Sales & Categories**: Interactive flash sale countdowns and organized product categories.
- **Advanced Sorting**: Sort products by Popularity (Sales), Newest, or Price.
- **Smart Product Search**: Real-time product search and results.
- **Rich Product Detail**: Multi-image galleries, detailed specifications, and related product suggestions.
- **Photo Reviews**: Share and view product feedback with photos and a full-screen image viewer.
- **Complete Checkout Flow**: Shopping cart, address management, shipping selection, and payment proof upload.
- **Order Tracking**: Detailed order history with real-time status updates and receipt downloads.

### 📊 Management (Admin & Staff)
- **Revenue Dashboard**: Monthly revenue charts and key performance metrics (Total Sales, Orders, Avg Rating).
- **Inventory Management**: Real-time stock tracking with low-stock alerts.
- **Order Processing**: Update order statuses, manage tracking numbers (Resi), and verify payments.
- **Review Moderation**: View customer photos and manage product feedback.
- **Promo System**: Manage promotional banners and discount codes.
- **Advanced Reports**: Export sales and inventory data to PDF or Excel.

---

## 🛠️ Tech Stack

- **Framework**: [Laravel 11](https://laravel.com)
- **Styling**: [Tailwind CSS](https://tailwindcss.com)
- **Database**: MySQL / SQLite
- **Icons**: Lucide Icons / Font Awesome
- **Reporting**: DomPDF & Laravel Excel
- **Notifications**: SweetAlert2

---

## 📦 Installation Guide

Follow these steps to set up the project locally:

### 1. Prerequisites
Ensure you have the following installed:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL or SQLite

### 2. Clone the Repository
```bash
git clone https://github.com/your-username/techped.git
cd techped
```

### 3. Install Dependencies
```bash
composer install
npm install
```

### 4. Environment Configuration
Copy the `.env.example` file to `.env`:
```bash
cp .env.example .env
```
Generate the application key:
```bash
php artisan key:generate
```
Configure your database connection in the `.env` file.

### 5. Database Setup
Run the migrations and seed the database with initial data:
```bash
php artisan migrate --seed
```

### 6. Storage Link
Create a symbolic link from `public/storage` to `storage/app/public` to make uploaded images accessible:
```bash
php artisan storage:link
```

### 7. Compile Assets
For development:
```bash
npm run dev
```
For production:
```bash
npm run build
```

### 8. Start the Server
```bash
php artisan serve
```
The application will be accessible at `http://localhost:8000`.

---

## 🔑 Access Roles
*If using default seeders:*
- **Customer**: Create a new account via Registration.
- **Admin**: Login via `/admin/login`.
- **Staff (Petugas)**: Login via `/petugas/login`.

---

## 📝 License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
