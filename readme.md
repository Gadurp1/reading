# Laravel / Vue Reading List App


![enter image description here](http://g.recordit.co/AqIqf76pL6.gif)
A simple reading list app created with Laravel and VueJs.  
-   Add or remove books from a list
-   Drag & drop order of the books in the list
-   Sort the list of books by their author
-   Detail page with  of author, publication date, and title, and related books
-   Search Google Books API for new books to add to list

## Installation
Clone the repository

    https://github.com/Gadurp1/reading.git

cd into repository install composer

    composer install
Publish vendor files

    php artisan vendor:publish

Rename `.env.example` to `.env`  and set up your enviroment then set up database

    php artisan migrate

Serve the project

    php artisan serve

## Add or remove books from the list
Use the search bar in the top navigation to search for new titles.  Click on a book that interests you and from the book details screen you can save and remove books.

## Change the order of the books in the list

Simply drag and drop books into your preferred order on the "My List" page.  When the order is adjusted a "Save Current Order" will appear,  once clicked the order will be saved.

![enter image description here](https://preview.ibb.co/hupJ3c/Screen_Shot_2018_04_24_at_9_53_05_PM.png)

## Authentication

Using basic laravel authentication
https://laravel.com/docs/5.6/authentication

## Packages Used
php-google-books
https://github.com/scriptotek/php-google-books

Laravel Debugbar
https://github.com/barryvdh/laravel-debugbar

Vue Draggable
 https://github.com/SortableJS/Vue.Draggable
