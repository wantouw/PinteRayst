# Pinterayst
A Laravel web application inspired by Pinterest. Uses local database.

## How to run
- change the .env file's database information according to your local database information (connection, host, port, database, username, password).
- start your local server provider (XAMPP for example).
- make a new database with the same name as the one stated in the .env file.
- open command prompt in the project's folder.
- type the command ```php artisan migrate:fresh --seed``` to seed the database.
- type the folloeing commands to make a link to the storage where we store the images:
  - ```cd public```
  - ```rm storage```
  - ```cd ..```
  - ```php artisan storage:link```
- type the command ```php artisan serve``` to run the app on the local server.

# Previews
