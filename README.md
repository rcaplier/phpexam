#human Booster CDA Symfony test 2021

This is the symfony test we had to do. In order to run the project, just follow the few steps below :

1. Clone the project by running the command :
`git clone https://github.com/rcaplier/phpexam.git`
2. Create a database named like you want (eg. phpexam)
3. Then edit the .env.local file with your database credentials
4. Run :
`composer install`
5. Run :
   `php bin/console doctrine:schema:update --force`
6. Run :
   `symfony serve`