<p align="center">
  <a href="#" target="_blank">
    <img src="public/assets/brand/orangeEvents.png" alt="Laravel Logo" style="max-width: 25%; height: auto;">
  </a>
</p>



## Overview


## Installation

To get started, clone this repository.    

HTTPS
```
git clone https://github.com/belal-shakra/orange_events.git
```

or SSH
```
git clone git@github.com:belal-shakra/orange_events.git
```

Next, copy `.env.example` into `.env` file, then configure your database connection into `.env` file.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR-DATABASE-NAME
DB_USERNAME=YOUR-DATABASE-USERNAME
DB_PASSWORD=YOUR-DATABASE-PASSWROD
```


## Generate new application key

You have to generate new application key as below.

```
php artisan key:generate
```


## Install Dependencies

Install dependencies

```
composer install
```

you may need

```
composer update
```

## Install Packages

Breeze for blade views

```
php artisan migrate
npm install
npm run build
```


Excel to import and export excel sheets

```
composer require maatwebsite/excel 
```


To create link for storage into `public` directory

```
php artisan storage:link
```


Run the `queue`

```
php artisan queue:work
```

Also, run `schedule` to do scheduled custom commands

```
php artisan schedule:work
```
