# LaraMart | Laravel based marketplace

###### Version: 2025.05.22.2

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
9. Add database settings keys: HEAD_CODE_LOGGED_IN_NOT_ADMIN
10. Update Composer dependencies with `composer update` command

## Documentation

```bash
# Clear Application Cache:  
php artisan cache:clear
# Clear Route Cache:  
php artisan route:clear
# Clear Configuration Cache:  
php artisan config:clear
# Clear Compiled Views Cache:  
php artisan view:clear
# Clear Event Cache:  
php artisan event:clear
# Clear All Cache:
php artisan optimize:clear
# Clear All Cache (Laravel 8+):
php artisan optimize
# migrate
php artisan migrate
```

## How to install?

---

All rights reserved! &copy; Copyright Harkály Gergő (https://github.com/harkalygergo)
