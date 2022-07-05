
# Laravel+Vue Point of Sale(POS) & Inventory System

A fully functional Open-Source Point of Sale (POS) and Inventory System made from Laravel8 + Vue2 + AdminLTE 3 based for SPA Application.

[![Alt](https://img.shields.io/badge/Laravel%20-8-F05340)](https://laravel.com/docs/8.x/readme)
[![Alt](https://img.shields.io/badge/Vue-2.6.14-41B883)](https://vuejs.org/guide/quick-start.html)
[![Alt](https://img.shields.io/badge/Admin%20LTE%20-3-lightgrey)](https://adminlte.io/docs/3.0/layout.html)
[![Alt](https://img.shields.io/badge/Bootstrap%20-4-%230099CC)](https://getbootstrap.com/docs/4.0/getting-started/introduction/)
[![Alt](https://img.shields.io/badge/Bootstrapvue%20-2.21.2-blueviolet)](https://bootstrap-vue.org/)
[![Alt](https://img.shields.io/badge/sweetalert2-9.17.2-violet)](https://sweetalert2.github.io/)

## Getting Started

### Installation (without Docker)

- `git clone https://github.com/abi-collab/pos-inventory-laravelvue.git`
- `cd open-pos-inventory-laravelvue/`
- `composer install`
- `cp .env.example .env`
- Update `.env` and set your database credentials
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan passport:install`
- `npm install`
- `npm run dev`
- `php artisan serve`

### Installation (using Docker)

- `git clone https://github.com/abi-collab/pos-inventory-laravelvue.git`
- `cd open-pos-inventory-laravelvue/`
- `cp .env.example .env`
- `vendor/bin/sail up`
- `vendor/bin/sail composer install`
- `vendor/bin/sail artisan key:generate`
- `vendor/bin/sail artisan migrate`
- `vendor/bin/sail artisan db:seed`
- `vendor/bin/sail artisan passport:install`
- `vendor/bin/sail artisan npm install`
- `vendor/bin/sail artisan npm run dev`

## Project Module/Features

- Modal based Create + Edit, List with Pagination, Delete with Sweetalert
- Login, Register, Forget + Reset Password as default auth
- Profile, Update Profile, Change Password, Avatar
- Frontend and Backend User ACL with Gate Policy (type: admin/user)
- Developer Options for OAuth Clients and Personal Access Token
- Build with Docker
- **Simple Dynamic Dashboard:**
  - Displays widgets of sales report
  - Stock indicators
  - Table of sales
  - Filtering options
- **Invoice:**
  - Manage Customer Purchase(Serial number base)
  - Print Invoice
- **Product Management:**
  - Create, display, edit/update & delete an item
- **Product's Serial Number Management:**
  - enter a serial number for every piece of product created
- **Customer Management:**
  - Create, display, edit/update & delete a customer
- **Return Products:**
  - Manage every returned products
- **User Management:**
  - Create, display, edit/update & delete a user
- **Category Management**
  - Create, display & edit/update a product category

## Project Structure

![alt text](https://github.com/abi-collab/pos-inventory-laravelvue/blob/master/public/images/tree.png?raw=true)

## License

[MIT license](https://opensource.org/licenses/MIT).

## Screen shots (Admin Access)

### Dashboard

![alt text](https://github.com/abi-collab/open-pos-inventory-laravelvue/blob/master/public/forMDimgs/dashboard.png?raw=true)

### Invoice

![alt text](https://github.com/abi-collab/open-pos-inventory-laravelvue/blob/master/public/forMDimgs/invoice.png?raw=true)

### Customers

![alt text](https://github.com/abi-collab/open-pos-inventory-laravelvue/blob/master/public/forMDimgs/customers.png?raw=true)

### Items

![alt text](https://github.com/abi-collab/open-pos-inventory-laravelvue/blob/master/public/forMDimgs/items.png?raw=true)

### Serial Numbers

![alt text](https://github.com/abi-collab/open-pos-inventory-laravelvue/blob/master/public/forMDimgs/serialnos.png?raw=true)

### Returns

![alt text](https://github.com/abi-collab/open-pos-inventory-laravelvue/blob/master/public/forMDimgs/returns.png?raw=true)

### Category

![alt text](https://github.com/abi-collab/open-pos-inventory-laravelvue/blob/master/public/forMDimgs/category.png?raw=true)

### Users

![alt text](https://github.com/abi-collab/open-pos-inventory-laravelvue/blob/master/public/forMDimgs/users.png?raw=true)

## Screen shots (Standard User Access)

![alt text](https://github.com/abi-collab/open-pos-inventory-laravelvue/blob/master/public/forMDimgs/users.png?raw=true)
