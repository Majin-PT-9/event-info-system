## Event Information System

Welcome to my solution for the assignment Event Information System
To set up the project, please follow the following steps:

- Create a local database for the project. The default name is event_info_db.
- Create a .env file following the .env.example.  
    * When filling the information for smtp, make sure to use a valid email in the field MAIL_TO_ADDRESS. We will be using this email address to test the received emails
    * I used mailtrap.io to test the emails feature
- Run the command php artisan:migrate --seed to populate the database
- Run the server with php artisan serve
- For the emails feature, use the command php artisan app:send-event-alert to queue the emails
- Run php artisan queue:work to send out the emails
- The postman collection for testing the routes is included on the root of the project


