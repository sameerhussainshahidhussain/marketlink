# MarketLink (eGreen Basket) 🌿
**Local Farmers Market & Harvest Pre-Order Platform**  
*TechWiz Software Competition 2026 Project Submission*

---

## What is MarketLink?

When you buy vegetables and fruits from big supermarkets, they've usually spent days in cold storage and supply trucks. They lose flavor, cost more, and the farmer who grew them gets only a small fraction of what you paid.

Weekend farmers markets are the best place to get real, fresh produce directly from local growers. But they come with two everyday problems:
1. Shoppers don't know what will be in stock before leaving home, and the best produce often sells out early.
2. Farmers have trouble estimating demand, leading to either unsold waste or running out too quickly.

**MarketLink** solves this with a simple pre-order and pickup system. During the week, customers see what local farmers are harvesting, add items to their basket, and pick a collection slot for Saturday or Sunday morning. The farmer harvests and packs the exact order, and the customer simply stops by the stall on market day, checks the crate, and pays cash in person.

---

## Core Rules & How It Works

- **100% Pay-at-Pickup**: There are no digital payment gateways, credit cards, or online processing fees. Buyers check the produce with their own eyes at the stall and pay the farmer in cash.
- **Strictly In-Person Collection**: We don't do home delivery. The platform is designed specifically to support local weekend farmers markets in cities like Lahore, Karachi, and Islamabad.
- **Per-Farmer Order Splitting**: If you add spinach from Ahmed Ali and mountain honey from Hassan Raza into the same cart, MarketLink automatically splits them into two distinct orders with their own pickup windows and status tracking.
- **Harvest Cutoff Times**: Farmers set a cutoff deadline (for example, Friday 8:00 PM for Saturday morning market). Once the cutoff hits, orders lock so the grower has time to harvest, wash, and pack without last-minute chaos.
- **Live Market Map**: Built using Leaflet.js and OpenStreetMap so shoppers can quickly find market locations, opening hours, and attending growers.

---

## Development Team

| Name | Role | Core Contribution |
| :--- | :--- | :--- |
| **Sameer Hussain** | Team Lead & Full-Stack | System architecture, Laravel core setup, controller flows |
| **Anas** | Frontend & UI/UX | eGreen design system, Blade layouts, responsive components |
| **Hammadullah** | Backend Developer | Multi-farmer cart logic, slot calculations, order lifecycle |
| **Muhammar** | Database Architect | Database schema, Eloquent relationships, migrations & seeds |
| **Umer** | QA & Testing Lead | Map geolocation integration, role testing, form validation |

---

## 🔐 Test Accounts & Login Credentials

> **⚠️ All accounts share the same password: `1234567890`**

Every account is pre-seeded with realistic sample data including orders, products, reviews, and market slots.  
Login URL: **`http://127.0.0.1:8000/login`**

---

### 🚀 Quick Reference — All Logins at a Glance

| Role | Email | Password | Dashboard |
| :--- | :--- | :--- | :--- |
| **Admin** | `sameer@gmail.com` | `1234567890` | `/admin/dashboard` |
| **Farmer** | `ahmed@gmail.com` | `1234567890` | `/farmer/dashboard` |
| **Farmer** | `fatima@gmail.com` | `1234567890` | `/farmer/dashboard` |
| **Farmer** | `hassan@gmail.com` | `1234567890` | `/farmer/dashboard` |
| **Farmer** | `sara@gmail.com` | `1234567890` | `/farmer/dashboard` |
| **Customer** | `customer@gmail.com` | `1234567890` | `/customer/dashboard` |
| **Customer** | `amina@gmail.com` | `1234567890` | `/customer/dashboard` |
| **Customer** | `zainab@gmail.com` | `1234567890` | `/customer/dashboard` |
| **Customer** | `bilal@gmail.com` | `1234567890` | `/customer/dashboard` |

---

### 1. ⚙️ System Administrator

| Field | Value |
| :--- | :--- |
| **Email** | `sameer@gmail.com` |
| **Password** | `1234567890` |
| **Access** | Full platform oversight, farmer verifications, market locations, announcements, category management |

---

### 2. 🚜 Verified Farmers (Vendors)

**Password for all farmer accounts: `1234567890`**

| Business / Stall | Owner | Email | Focus Produce |
| :--- | :--- | :--- | :--- |
| **Ali Organic Farm** | Ahmed Ali | `ahmed@gmail.com` | Organic tomatoes, spinach, seasonal veggies (Lahore) |
| **Khan Fresh Dairy** | Fatima Khan | `fatima@gmail.com` | Farm milk, yogurt, seasonal fruit (Karachi) |
| **Raza Honey Co.** | Hassan Raza | `hassan@gmail.com` | Raw Sidr & Wildflower mountain honey (Islamabad) |
| **Malik Herb Gardens** | Sara Malik | `sara@gmail.com` | Fresh mint, coriander, live potted herbs (Islamabad) |

---

### 3. 🛒 Shoppers (Customers)

**Password for all customer accounts: `1234567890`**

| Customer Name | Email | City | Phone |
| :--- | :--- | :--- | :--- |
| **Tariq Mehmood** | `customer@gmail.com` | Lahore | 0301-1112233 |
| **Amina Tariq** | `amina@gmail.com` | Lahore | 0322-4445566 |
| **Zainab Bibi** | `zainab@gmail.com` | Karachi | 0313-7788990 |
| **Bilal Ahmed** | `bilal@gmail.com` | Islamabad | 0324-9988776 |

---

## Technology Stack

- **Framework**: Laravel 11.x
- **PHP**: 8.2+
- **Database**: MySQL 8.0+ / MariaDB (InnoDB with foreign keys and cascading relationships)
- **Frontend Views**: Laravel Blade templates
- **Styling**: Bootstrap 5.3.3 + Custom CSS Design System (`style.css`, `dashboard.css`, `responsive.css`)
- **Icons**: Bootstrap Icons (v1.11.3)
- **Maps**: Leaflet.js with OpenStreetMap tiles
- **Charts**: Chart.js 4.4 (Farmer revenue & monthly order breakdown)

---

## Getting Started Locally

### 1. Requirements
Make sure you have installed:
- PHP 8.2 or newer with extensions (`pdo_mysql`, `mbstring`, `openssl`, `curl`)
- Composer 2.x
- MySQL server (via XAMPP, Laragon, or standalone service)

### 2. Setup Steps

```bash
# 1. Open project folder in your terminal:
cd "techwiz sameer"

# 2. Install PHP composer packages:
composer install

# 3. Setup environment configuration:
# Ensure your .env has your local MySQL credentials:
# DB_DATABASE=marketlink_db
# DB_USERNAME=root
# DB_PASSWORD=

# 4. Run database migrations and seed realistic records:
php artisan migrate:fresh --seed

# 5. Link local storage for product and profile images:
php artisan storage:link

# 6. Start the development server:
php artisan serve
```

Now open **`http://127.0.0.1:8000`** in your browser.

---

## Walkthrough by Role

### 🛒 For Customers
1. Go to `http://127.0.0.1:8000/login` and sign in with `customer@gmail.com` (or create a new profile).
2. Click **Products** or **Markets** to browse fresh produce available this weekend.
3. Add items to your **Basket**.
4. Head to **Checkout**, pick your pickup window (e.g. Saturday 8:00 AM – 12:00 PM), and confirm your reservation.
5. On market morning, visit the farmer's stall at the specified venue, show your order number, check the quality of your crate, and pay in cash.
6. Return to your dashboard afterwards to rate the produce and leave honest feedback.

### 🚜 For Farmers
1. Sign in with `ahmed@gmail.com` to access the **Farmer Portal**.
2. **Products**: List new produce, set prices per kg/bunch, manage stock numbers, and upload photos.
3. **Pickup Slots**: Create weekend collection windows linked to your market stall with your preferred order cutoff time.
4. **Pre-Orders**: View incoming orders, accept them, pack your crates, and mark them `Ready for Pickup`. When the customer pays and takes their crate at the stall, mark the order `Completed`.
5. **Customer Reviews**: Read reviews left on your stall and post direct replies.

### ⚙️ For System Admin
1. Sign in with `sameer@gmail.com` to enter the **Admin HQ**.
2. Review and approve pending farmer accounts under **Farmer Approvals**.
3. Manage market locations and coordinates under **Markets**.
4. Post emergency or seasonal updates through **Announcements**.
5. Oversee platform-wide metrics and review moderation.

---

## License & Team Note
This project was developed by our 5-member team for **TechWiz 2026**. Built with clean code, dedicated responsive UI themes for every role, and zero dummy arrays—everything is 100% backed by MySQL.
