# Kira Music Manager 

Kira is a music library management tool built for the completionist. Use Kira to catalog your existing library, manage files and folders including metadata updates 

## Quick Guide

If you want to very quckly get the application running for testing or demonstration then this is your guide. This is not for long term use, for that you want to get something much more robust setup (don't worry, its not hard).

You'll need to have PHP, Composer and NPM installed for this to work smoothly. 

First, pull the repo down, install dependencies and build resources:

```
$ git clone https://github.com/indemnity83/kira
$ cd kira
$ composer install
$ npm install
$ gulp
```

Next, setup a demo environment, generate an application key, populate a local sqlite database and set the path to your music folder

```
$ cp .env.demo .env
$ touch database/database.sqlite
$ php artisan key:generate
$ php artisan migrate
$ php artisan media:root <path to your music folder>
```

Finally, start the application

```
php artisan serve
```

Now you have a local running version of the application. Some of the actions will take a long time to post; thats because this is running everything synchronously as opposed to letting Kira queue up background processing for lengthy tasks. As well, if you close your command prompt the application will shut down (you can simply run php artisan serve again to start it back up though).  