# Posts App

[![Build Status](https://img.shields.io/badge/status-alpha-orange.svg)](#)

## Requirements

* Command Line Tools
* PHP >= 7.3
* Composer - [Install](https://getcomposer.org/)

## Installation

1. Clone the project:
  `git clone https://github.com/mihaitaranu88/posts-app.git`
  
2. Create `database.sqlite` in `storage` folder

3. Copy `.env.example` to `.env` and update environment variables:
    * `APP_ENV` - App environment
    * `APP_DEBUG` - True for development/ False for production
    * `APP_LOG_LEVEL` - Lowest level of logging
    * `DB_CONNECTION` - Database type (set `sqlite`)
    * `DB_DATABASE` - absolute path to `database.sqlite`
    * `QUEUE_CONNECTION` - set `database`
    
3. Install Dependecies / Requirements

  `cd {projectroot}/` (project root)

  Run:
  * `sudo chmod -R 777 storage/`
  * `composer install`
  * `php artisan key:generate`
  * `php artisan migrate`
  * `php artisan schedule:work`
  
  Open new terminal tab and run:
  * `php artisan queue:listen`
  
  Open new terminal tab and run:
  * `php artisan sync:users`
  * `php artisan sync:posts`
  * `php artisan serve`


