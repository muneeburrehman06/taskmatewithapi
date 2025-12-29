# TaskMate – Backend  

TaskMate backend is a REST API built with **Laravel** and **MySQL**.  
It handles authentication, profile management, and task management.

---

## Features

### Authentication
- User Signup
- User Login
- User Logout
- Token-based authentication

### Profile Management
Users can update:
- Username
- Email

### Task Management
- Login with Gmail
- Gogin with Facebook
- Add Task
- View Tasks
- Update Task
- Delete Task

---

## Requirements

Make sure the following are installed:

- PHP 8.1
- Composer
- MySQL / MariaDB
- Git
- XAMPP Server

---

## Project Installation

### Run these commands to install the backend

- composer install
- Create `.env` file from `.env.example` or '.envcopy'
- php artisan key:generate
- Create database in MySQL named: `taskmate`
- php artisan migrate
- php artisan serve

---

## Run Project

Backend will run on:
- http://127.0.0.1:8000
- Test it through Postman
- API-only backend
- Tested using Postman
- Works with Next.js frontend
