# Time Table Management System  
A web application built with Laravel to manage college timetable data in one place. The system covers the day-to-day work around subjects, faculty, students, lecture requirements, timetable generation, reports, file uploads and email communication.

This project was developed as a practical college management application rather than as a simple demo. The main idea was to reduce the amount of manual work involved in preparing and sharing class timetables.

What the project does
The application has two main sides:

Student side – student registration/login, profile handling and access to available timetables and uploaded information.

Admin side – manage academic data, configure faculty/subject combinations, generate timetables, create reports, upload timetable files and communicate with users.

The timetable generator uses custom PHP logic and database records to place lectures into time slots for divisions. It considers values such as remaining lectures, minimum/daily lecture settings and existing timetable entries while trying to avoid assigning the same subject/faculty entry to conflicting slots.

Main features
Timetable management
Generate timetables for divisions A, B, C and D

Create time slots programmatically

Track remaining lecture counts for each division

Check existing timetable entries before placing another lecture

Confirm/regenerate generated schedules

Export generated timetables as PDF

Academic data management
Add, edit and delete subjects

Add, edit and delete faculty records

Store faculty and subject mapping

Configure lecture-related rules such as:

minimum lectures

maximum lectures

daily lecture setting

total lectures

room number

class type

View faculty, subjects, students and faculty-set records

Student management
Student registration

Student login

Profile update

Student listing and administration

Student report generation

Reports and exports
Generate student reports

Generate combined student reports

Generate course/faculty reports

Download reports as PDF

Export faculty data to CSV

Download subject/course information

File and communication features
Upload existing timetable PDFs

View uploaded timetables

Send emails to administrators/faculty and users

Send attachments with email messages

Manage basic services/information displayed to users

Technology stack
Part	Technology
Backend	PHP 8.2+, Laravel 11
Database	MySQL
Frontend	Blade, HTML, CSS, JavaScript
CSS tooling	Tailwind CSS
Asset bundler	Vite
PDF generation	barryvdh/laravel-dompdf
Spreadsheet/CSV	maatwebsite/excel
Dependency management	Composer, npm
Session/cache/queue	Laravel database drivers
How the timetable generation works
The scheduling code is implemented in the Laravel controllers rather than using a separate AI/ML model.

At a high level, the generator:

Reads subject/faculty assignments from the database.

Separates timetable generation by division.

Tracks remaining lectures for divisions A–D.

Selects subjects according to the stored lecture settings.

Creates lecture time slots.

Checks existing entries before placing a lecture where a conflict may occur.

Stores the generated entries in the temptimetable table.

Uses the stored timetable data to build the final PDF.

The project contains more than one timetable-generation controller because the scheduling logic evolved during development. The main generation-related files include:

app/Http/Controllers/ttm_generate_controller.php

app/Http/Controllers/maketimetable.php

app/Http/Controllers/temptimetablecontroller.php

Project structure
time_table_management_app/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   ├── Mail/
│   ├── Models/
│   └── Providers/
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── public/
│   └── assets/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── admin/
│       └── user/
├── routes/
│   └── web.php
├── composer.json
├── package.json
├── vite.config.js
└── .env.example
Database tables
The project uses separate tables for the major parts of the system, including:

student_singup_models

subject_models

add_faculty_models

set_sub_fac_stu

temptimetable

services

admin

user_email

upload_time_table

Laravel's cache/job tables

The migrations in database/migrations/ contain the schema definitions.

Requirements
Before running the project locally, install:

PHP 8.2 or newer

Composer

MySQL

Node.js and npm

A PHP environment such as XAMPP, Laragon or a native PHP setup

Installation
1. Clone the repository

2. Install PHP dependencies
composer install
3. Install frontend dependencies
npm install
4. Create the environment file

5. Generate the Laravel application key
php artisan key:generate

7. Configure MySQL
Create a MySQL database and update the following values in .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=time_table_management_app
DB_USERNAME=root
DB_PASSWORD=

7. Run migrations
php artisan migrate
Project note: The current source contains duplicate table-creation migrations for some older tables, and a few migration down() methods are incomplete. For a clean installation, review and consolidate the duplicate migrations before running migrate on a fresh database.

8. Start the application
In one terminal:

php artisan serve
In another terminal:

npm run dev
Then open:

http://127.0.0.1:8000
Email configuration
The application contains mail features for sending messages and attachments.

For local testing, configure the mail section in .env with your own SMTP provider. Do not commit real SMTP usernames, passwords, API keys or app passwords to GitHub.

Why I built it
The project started from a practical college problem: timetable information is usually spread across different files and a lot of the work is done manually. I wanted one application where the academic data could be entered first and the timetable, reports and downloadable files could then be managed from the same place.

License: MIT


Built as a Laravel-based college timetable management project.

