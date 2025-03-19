# LaraMart | Laravel based marketplace

###### Version: 2025.03.19.7

LaraMart web application is an online marketplace management tool based on Laravel PHP framework made by @harkalygergo. All rights reserved!

## Functions

- visitor can create user account
- user can upload ads
- merchant accounts can be added via adminstration area (dashboard)
- registered merchants can bulk import and syncronize products / ads from external link as JSON

---

## How to install?

1. Copy code from GitHub
2. Run `npm install`
3. Copy `env.example` to `.env` and modify content
4. Generate key: `php artisan key:generate`
5. Clear cache: `php artisan config:cache`
6. Migrate database tables with `php artisan migrate` command
7. Build CSS with `npm run build`
7. Register a new user profile and make it admin in database with changing `is_admin` column.
8. Add cron job for `php artisan schedule:run` command

---

All rights reserved! &copy; Copyright Harkály Gergő (https://github.com/harkalygergo)
