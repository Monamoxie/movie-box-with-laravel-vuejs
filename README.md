<p align="center"><img src="resources/images/logo.png"></p>

## Circle CI Test
[![CircleCI](https://circleci.com/gh/Monamoxie/movie-box-with-laravel-vuejs.svg?style=svg)](https://circleci.com/gh/Monamoxie/movie-box-with-laravel-vuejs)


## Technology Stack and Tools
 
 - Laravel 
 - Vue JS
 - MySQL
 - Twitter Bootsrap
 - Axios HTTP Client
 - PHPUnit
 - Circle CI

## Features

  - Pagination
  - Login/Register System
  - Movie Rating
  - 
  
## Set up Instruction
  - Clone the repo
  - CD into the directory you just cloned and type *touch .env* to create a new .env file
  - After that, copy all contents within the .env.example file into the newly created .env file and save
  - Install composer by running *composer install*
  - After that, Run
        <p> *php artisan key:generate*  to generate a new key for development purposes. </p>
  - Open PHPMyAdmin or whichever tool you use and create a new mysql database
  - Open .env file and add the settings for the database in the appropriate section
  - To avoid issues due to cache, you can run *php artisan cache:clear* and *php artisab config:clear* to clear off any cached files.
  - Run database migrations with *php artisan migrate*
  - Install Laravel passport by running *php artisan passport:install*
  - Run the database seeder with *php artisan db:seed*
## Please Note:
  - Instead of using the default faker Image class to generate images, I used a custom class I created. The server generating the images for Faker is sometimes down or very slow. Faker by default uses http://lorempixel.com/ for fetching images on the fly. I am generating mine from https://picsum.photos. It's sharper and faster. 
  - I injected the implementation into a Helper Class called Utility and referenced it whenever I need to generate a new image. You may decide to abstract it or use it as a trait if you wish.
- If everything works fine, then run *php artisan serve*
- Copy the url and visit it on your web browser.

 
## Credit
- Pexels.com -Stock photos 
- Pixabay.com -Stock photos

## PHP Unit Test
<p align="center"><img src="resources/images/circle_ci_test.png"></p>

<p align="center"><img src="resources/images/home_snapshot.png"></p>
 
## License

This software is open-sourced software and licensed under the [MIT license](https://opensource.org/licenses/MIT).
