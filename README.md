## About the project
This is a simple property search website developed for demonstration purpose.

## Technologies used in the development
- Laravel as a back-end framework
- Vue as a front-end framework
- Element UI as a UI toolkit
- Bootstrap as a CSS framework

## Get started
To set up the project in a local environment, first rename the `.env.example` file to `.env`. Then in the terminal run the following commands one by one after you started a PHP server (e.g. XAMPP):

    composer install
    composer dump-autoload
    npm install
    php artisan key:generate
    php artisan serve

Note that, you do not need to run migrations, as the SQLite database is already included in the project with data.

## Necessary improvements
- Decouple filtering and controller logics
- Paginate search results
- Fix the responsiveness
- Improve UI/UX
- Index the database
- Authorize the API requests

## Notes from the developer
This was the first time I was using Element UI. I learnt the basics of the library as I develop, so it took longer than expected to complete the task.
My usual choice is Vuetify.
