✉️ Dearest Valentine - A Vintage Proposal Engine
<p align="center"> <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo"> </p>

<p align="center"> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a> <a href="https://laravel.com"><img src="https://img.shields.io/badge/Stack-TALL-blue.svg" alt="TALL Stack"></a> <a href="https://laravel.com"><img src="https://img.shields.io/badge/Theme-Vintage_Romance-8b0000.svg" alt="Vintage Theme"></a> </p>

🌹 About the Project
Dearest Valentine is an elegant, digital proposal application designed to bring back the charm of 19th-century love letters. Built with the TALL Stack (Tailwind, Alpine.js, Laravel, Livewire), it provides a "blast from the past" experience with modern, interactive twists.

🎭 Key "Wow" Features

The Iron Gate Lock: Every proposal is protected by a swinging iron gate interface that requires a secret word (password) to unlock.

The Runaway Button: An impossible-to-click "Reject" button that physically teleports away from the cursor.

Typewriter Reveal: A handwritten letter effect where text types out in real-time with authentic mechanical sound effects.

Memory Capture: Users can save their proposal as a high-quality PNG image specifically formatted for Instagram Stories or WhatsApp statuses.

Social Intelligence: Deeply optimized SEO and Open Graph tags so that sharing the link in DMs looks like a premium digital invitation.

🛠️ Technical Implementation
This project utilizes advanced browser-side logic to keep the experience snappy and memory-resident:

Alpine.js: Manages the complex animations for the swinging gates, the "runaway" button logic, and the typewriter sequence.

Livewire: Handles the dynamic generation of shareable proposal slugs without full page refreshes.

Html2Canvas: Enables high-fidelity client-side rendering of the vintage parchment for the "Save to Gallery" feature.

Laravel Eloquent: Powers the short-slug system to keep love-links customizable and clean.

🚀 Getting Started
Prerequisites

PHP 8.2+

Composer

Node.js & NPM

Installation

Clone the Repository:

Bash
git clone https://github.com/your-username/dearest-valentine.git
cd dearest-valentine
Install Dependencies:

Bash
composer install
npm install
Environment Setup:

Bash
cp .env.example .env
php artisan key:generate
Database & Migrations:

Bash
touch database/database.sqlite # If using SQLite
php artisan migrate
Compile & Launch:

Bash
npm run dev
php artisan serve
📸 DM Preview (SEO)
When shared, the application displays a beautiful rich-text card:

Title: "Dearest, you have a secret message... ✉️"

Description: "A vintage love letter is waiting for you. Will you open it?"

📜 License
This project is open-sourced software licensed under the MIT license.

Crafted with ❤️ for Valentines 2026.
