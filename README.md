# 🎓 Educational Platform System

A full-featured **E-Learning Platform** designed to manage educational content, lectures, and online examinations with a scalable and secure backend architecture.

---

## 🚀 Overview

This project is a **complete educational platform** that provides a powerful system for managing:

* Courses & Lectures
* Users & Roles
* Online Exams
* Student Results & Analytics

Built using **Laravel**, with a strong focus on:

* Scalability
* Clean Architecture
* Secure and maintainable code

---

## 🎯 Core Features

### 📚 Course & Lecture Management

* Manage courses and lectures
* Link exams to specific lectures
* Structured content organization

---

### 📝 Exam Management

* Create, update, and delete exams
* Set start/end time and duration
* Control number of attempts
* Activate/deactivate exams
* Duplicate existing exams

---

### ❓ Question Management

* Supports multiple question types:

  * Multiple Choice
  * True/False
  * Essay
* Upload images for questions
* Assign marks per question
* Reorder questions
* Import/Export via CSV

---

### 📊 Results & Analytics

* View student results
* Calculate percentages and grades
* Recalculate results
* Generate detailed reports
* Export results (CSV / JSON)

---

### 🔍 Search & Filtering

* Advanced search system
* Filter by date, lecture, and status
* Detailed statistics

---

### 📤 Import & Export

* Export:

  * Exams
  * Questions
  * Results
* Import questions from CSV

---

### 🔐 Security

* Authentication using Laravel Jetstream & Fortify
* Role-Based Access Control (RBAC)
* CSRF Protection
* Input validation & sanitization

---

## 🛠 Tech Stack

* **Backend:** PHP, Laravel
* **Database:** MySQL
* **Frontend:** Blade, Livewire, JavaScript
* **Architecture:** MVC
* **Tools:** Git, Composer, NPM

---

## ⚙️ Installation

```bash
git clone 
cd project-name

composer install
npm install

cp .env.example .env

php artisan key:generate
php artisan migrate

npm run build
php artisan serve
```

---

## 🧠 Key Highlights

* Modular and scalable system design
* Clean Code & SOLID principles
* RESTful API-ready architecture
* Optimized database structure
* Real-world backend project

---

## 📌 Future Improvements

* API Documentation (Swagger)
* Cloud deployment (AWS / VPS)
* Payment integration
* Notification system

---

## 👨‍💻 Author

Ahmed Khaled
Backend Developer (Laravel)

---


MIT License
