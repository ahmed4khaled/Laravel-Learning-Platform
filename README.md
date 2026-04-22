# Teacher Course & Exam Management Platform

Laravel 10 application for managing a teacher's public course website, student access, lecture sales, QR-based enrollment, and online exams.

This project is not a generic LMS. It is a custom platform built around a real teacher workflow: publishing lectures by grade, redeeming access codes, opening protected course content, managing students from an admin dashboard, and tracking exam results.

## Overview

The codebase combines two layers:

- A public-facing website for the teacher profile and lecture browsing
- An authenticated dashboard for admin operations and exam management

The project also includes a recent refactor in several modules where controllers delegate business logic to service classes and request validation is moved into Form Request classes.

## Main Features

- Public landing page for the teacher and available lecture categories
- Lecture browsing by grade and lecture type
- Authenticated access to purchased or redeemed course content
- QR code redemption flow for unlocking lectures or subscription-based access
- Admin dashboard for users, QR codes, lectures, and sales records
- Exam management dashboard with:
  - exam CRUD
  - question CRUD
  - question import from CSV
  - exam, question, and result export to CSV
  - exam duplication
  - question reordering
  - result details and simple statistics
- Assistant question workflow for collecting student questions and answers
- Assignment submission via Livewire with an admin-facing assignment dashboard
- Authentication based on Laravel Jetstream, Fortify, and Sanctum

## Tech Stack

- PHP 8.1+
- Laravel 10
- MySQL
- Laravel Jetstream
- Laravel Fortify
- Laravel Sanctum
- Livewire 3
- Blade templates
- Vite
- Tailwind CSS

## Project Structure

Important application areas:

- `app/Http/Controllers/`
  Public pages, QR redemption, admin dashboard, exams, assignments, and assistant questions
- `app/Services/`
  Refactored business logic for admin actions, exams, questions, QR flow, lectures, and assignments
- `app/Http/Requests/`
  Validation classes for newer/refactored modules
- `app/Models/`
  Core entities such as `Lecture`, `Exam`, `Question`, `ExamResult`, `QrCode`, and `Sale`
- `resources/views/`
  Blade views for the public site, dashboard pages, and Livewire components
- `routes/web.php`
  Main web routes for public pages, admin tools, exams, QR access, and course pages

## Key Domain Areas

### Lectures and Access

- Lectures are organized by grade and role/type
- Course pages are protected by authentication
- QR codes are used to redeem access and create sale records
- Monthly and term-based access flows are supported in the routing and QR logic

### Exams

- Exams belong to lectures
- Questions belong to exams
- Results are stored per user and attempt
- Admin users can review results, export them, and generate a JSON detailed report

### Admin Operations

- Search users
- Manage lecture entries
- Generate and search QR codes
- View student QR and sales history

## Setup

```bash
git clone <repository-url>
cd <project-folder>
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build
php artisan serve
```

Then configure database and application settings in `.env`.

## Running Tests

```bash
php artisan test
```

## Current State

This repository reflects an active real-world project, so it contains a mix of:

- legacy naming in some routes, views, and model fields
- newer service-based refactored modules
- custom business rules tied to one teacher workflow rather than a reusable SaaS product

That makes it useful as a portfolio project for showing practical Laravel work, especially around:

- working with existing codebases
- incremental refactoring
- dashboard CRUD
- business-rule implementation
- relational data modeling

## Notes

- The application uses custom role checks and route structures instead of a generic permissions package
- Some UI text and business labels are in Arabic because the target users are Arabic-speaking students and admins
- The repository is best presented as a custom education management system, not as a fully generalized learning platform

## License

No license file is currently included in this repository.
