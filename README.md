# Using Lumen to create some fetch (Scraping) api for twitter
## This project is only meant to be used as an example of using twitter api and for educational purposes only, This project also done as a task issued by an emplyer as a test

for setting up:

1.`create a mysql database`

2.rename `.env.example` to `.env`

3.update all mysql sections

4.run `composer install`

5.run `php artisan migrate`

6.run `php artisan jwt:secret`

7.edit also `.env` with your twitter api keys


## notes for developers
all twitter api connection was grabbed from [this file](https://raw.githubusercontent.com/J7mbo/twitter-api-php/master/TwitterAPIExchange.php) with little modifications please use the following links if you want to extend and/or discover other methods and features

1.[main repo](https://github.com/J7mbo/twitter-api-php)

2.[useful stackoverflow post](https://stackoverflow.com/questions/12916539/simplest-php-example-for-retrieving-user-timeline-with-twitter-api-version-1-1/15314662#15314662)



Regards

-Navid Dezashibi (Knavels)
