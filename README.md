# Using Lumen to create some fetch (Scraping) api for twitter
### This project is only meant to be used as an example of using twitter api and for educational purposes only, this project was also done as a task issued by an emplyer as a test

for setting up:

1. `create a mysql database`

2. rename `.env.example` to `.env`

3. update all mysql sections in the `.env` file

4. run `composer install`

5. run `php artisan migrate`

6. run `php artisan jwt:secret`

7. edit also `.env` with your twitter api keys


## Notes for developers
all twitter api connection was grabbed from [this file](https://raw.githubusercontent.com/J7mbo/twitter-api-php/master/TwitterAPIExchange.php) with little modifications please use the following links if you want to extend and/or discover other methods and features

I placed the library in `app\Library\TwitterAPIExchange.php`

also I planned to use only `username` and `password` for auth, all were done in the `app\Http\Controllers\AuthController.php`

you can check out routes in `routes\web.php`

all files are commented also.


## api doc

1. login: `POST api/login`, accepts `JSON username, password`
2. register: `POST api/register` accepts `JSON username, password, password_confirmation`
3. profile: `GET api/profile`
4. users list: `GET api/users/list`
5. single user: `GET api/users/show/{id}`
6. analyse latest twitter posts: `POST api/twitter/analyse` accepts `JSON words` example `{ "words" : "programming|javascript" }`
7. all stats: `GET api/twitter/stats/all`
8. specific stats: `POST api/twitter/stats/show` accepts accepts `JSON words` example `{ "words" : "programming" }`


### links I've used for twitter api

1. [main repo](https://github.com/J7mbo/twitter-api-php)

2. [useful stackoverflow post](https://stackoverflow.com/questions/12916539/simplest-php-example-for-retrieving-user-timeline-with-twitter-api-version-1-1/15314662#15314662)



Regards

-Navid Dezashibi (Knavels)
