# The Best Quiz

### Setup
```
docker build -t php-base php/
docker build -t nginx-base nginx/

cd code
cp .env.example .env
composer install
yarn dev
```

### Seeding DB with more questions
Get an API key from https://quizapi.io/ and add it to `.env` as `QUIZ_API_TOKEN`

Every time you run this all four quizzes get 30 more questions per difficulty added to the DB.
```
php artisan db:seed --class=QuestionSeeder
```

### Running the application
Run this from the project root
```
docker-compose up
```
