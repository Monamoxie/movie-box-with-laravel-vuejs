<p align="center"><img src="public/images/logo2.png"></p>

## Circle CI Test
[![CircleCI](https://circleci.com/gh/Monamoxie/movie-box.svg?style=svg)](https://circleci.com/gh/Monamoxie/movie-box)


## About Movie Box

Movie Box is a web based movie showcase platform for clowns built with 
 - Laravel 
 - Vue JS
 - MySQL
 - Twitter Bootsrap
 - Axios HTTP Client
  
## Set up Instruction
  - Clone the repo
  - Open the env file and geneate an app key for development purposes.
  - Open PHPMyAdmin and create a new database
  - Add database name and settings
  - Run database migrations
  - Run composer to install dependencies
  - Instead of using faker class to generate images, use a custom class I created. The server generating the images for now is down. http://lorempixel.com/. I am generatin mine from 
https://picsum.photos. It's sharper and faster.
 - Run the Movie Seeder Class
 - 

Ina a live setting, I would return JSON data to the JS and allow it worry about rendering.
But for ease and speed, I chose to follow a different route. 

The API will compile the View files and send to JS to insert into the DOM. 

It's faster that way.
 
 The movie table is sitting behind an API Class... via the Laravel Passport 

## PHP Unit Test
<p align="center"><img src="public/images/circle_ci_test.png"></p>
 
## Contributing

 

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

This software is open-sourced software and licensed under the [MIT license](https://opensource.org/licenses/MIT).

<p align="center"><img src="public/images/home_snapshot.png"></p>
