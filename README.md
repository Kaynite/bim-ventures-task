# BIM Ventures Task

## Table of Contents

- [Getting Started](#getting-started)
  - [Installation](#installation)
- [What to Improve](#what-to-improve)

## Getting Started

### Installation

```bash
# Clone the repository
git clone https://github.com/Kaynite/bim-ventures-task.git

# Navigate to the project directory
cd bim-ventures-task

# Install dependencies
composer install

# Configure environment variables
cp .env.example .env
php artisan key:generate

# Run migrations and seeders
php artisan migrate --seed

# Start the development server
php artisan serve
```

## What to Improve

1. **Refinement of Database Structure:**
   The current implementation involves separate tables for categories and subcategories. A potential enhancement is to merge the two tables into one table, with adding a new column that references theparent category id in the same table.

2. **Validation Rule for Payment Amounts:**
   If the business requirements indicates that the payments amounts must not exceed the amount of the transaction, then a validation rule must be added to validate just that.
