# PinteRayst
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
  
### Admin Credentials
- username : admin
- password : admin

# Previews
![image](https://github.com/wantouw/Pinterayst/assets/91063309/7bfb9f74-b142-4bcf-8a77-328596919f27)
![image](https://github.com/wantouw/Pinterayst/assets/91063309/c5dd459c-bdcd-46cb-8ba3-91ee272f5f20)
![image](https://github.com/wantouw/Pinterayst/assets/91063309/5c4d137c-cffb-4d07-afab-f938c2051f36)
![image](https://github.com/wantouw/Pinterayst/assets/91063309/debd80ce-83fd-4f11-8629-879ac1c05984)
![image](https://github.com/wantouw/Pinterayst/assets/91063309/081e8b7b-6244-4d04-8e89-a517e989cd21)
![image](https://github.com/wantouw/Pinterayst/assets/91063309/6101df02-158e-45bb-a793-7d60deb2f942)
![image](https://github.com/wantouw/Pinterayst/assets/91063309/98bb732d-e76a-4bbb-80d7-edd4c324a104)


