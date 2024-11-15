# Monorepo for Full-Stack Application

This repository contains the code for a full-stack application with separate frontend and backend projects. The frontend is built using **Next.js 15**, and the backend uses **Laravel 11**. This document explains how to set up the project, the development workflow, and the commit conventions.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Project Structure](#project-structure)
- [Setup Instructions](#setup-instructions)
  - [Backend (Laravel)](#backend-laravel)
  - [Frontend (Next.js)](#frontend-nextjs)
- [Branching Strategy](#branching-strategy)
- [Development Workflow](#development-workflow)
- [Commit Message Conventions](#commit-message-conventions)
- [Branch Protection Rules](#branch-protection-rules)

## Prerequisites

Before working on this repository, make sure you have the following installed:

- **Node.js** (>= 18.x)
- **PHP** (>= 8.2) and Composer
- **Git**
- **Database**:
  - **SQLite** (recommended for development; no additional setup required)
  - **MySQL** (optional, if you plan to use MySQL in production)
- **Laravel Installer** (for backend setup)

## Project Structure

This repository is organized as follows:

- **backend/**: Contains the Laravel backend code.
- **frontend/**: Contains the Next.js frontend code.

## Setup Instructions

### Backend (Laravel)

1. **Navigate to the backend folder**:

   ```bash
   cd backend
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Create a .env file**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Configure the Database**:
   - Edit the `.env` file to match your database configuration.
   - Run the migration to create the necessary tables:
     ```bash
     php artisan migrate
     ```

5. **Run the application**:
   ```bash
   php artisan serve
   ```



### Frontend (Next.js)

1. **Navigate to the frontend folder**:
   ```bash
   cd frontend
   ```

2. **Install dependencies**:
   ```bash
   npm install
   ```

3. **Set up environment variables: Create a .env.local file with environment variables, for example**:
   ```bash
   NEXT_PUBLIC_API_URL=http://localhost:8000/api
   ```

4. **Start the development server**:
   ```bash
   npm run dev
   ```


## Branching Strategy

We use the following branching strategy:

- **main** Production-ready branch.
- **dev** Main branch for ongoing development.
- **dev-frontend** For frontend development.
- **dev-backend** For backend development.

Feature branches should branch off from dev-frontend or dev-backend and be merged into dev after review.



## Development Workflow


1. **Create an Issue for each task or feature**:

   - Open a GitHub issue for each task or feature.
   - Assign the issue to yourself.
   - Label the issue with the appropriate category.


2. **Create a Branch**:
    ```bash
    git checkout -b feature/<issue-title>
    ```

3. **Commit Changes following the Conventional Commits specification**:
    ```bash
    git add .
    git commit -m "feat: <description>"
    ```

4. **Push to GitHub**:
    ```bash
    git push origin feature/<issue-title>
    ```

5. **Create a Pull Request**:
    Create a Pull Request to merge into dev-frontend or dev-backend, then into dev after approval.


## Commit Message Conventions

    feat: New feature (e.g., feat: add login functionality)

    fix: Bug fix (e.g., fix: resolve login bug)

    refactor: Code changes not adding features or fixing bugs (e.g., refactor: improve readability)

    docs: Documentation updates (e.g., docs: update README setup instructions)

    style: Code style changes (e.g., style: format code)

    chore: Maintenance tasks (e.g., chore: update dependencies)


## Branch Protection Rules

    - For main, dev, dev-frontend, and dev-backend branches:
      - Require pull requests for merging.
      - Require at least 2 code reviews
      - Require all checks to pass before merging.
