# How to install
You can use default Laravel installation documentation to install this application.

### TL;DR;
- Download the project
- Run composer install
- Run npm install && npm run dev

After running these commands all you have to do is to run a custom command:
`php artisan setup --email=your_email_here`

This command will:
- Migrate all the tables
- Run seeders
- Run factories with dummy data
- Create an account so you can easily access the application
 
By the way, the password is "contratado!".

The **PHP version** that this project was tested is **8.1.2**.