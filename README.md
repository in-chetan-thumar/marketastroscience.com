
1. Database 
	A. create database
	B. run command -> php artisan migrate:fresh --seed 
	it will create default tables with data
	
2. Migration 
	A. php artisan migrate:generate --tables="table1,table2"
	
3. Seeder 
	A. php artisan iseed table1,table2

4. Migration for the specific table 
    A. php artisan migrate --path=/database/migrations/your_migration_file.php

5. Email smtp
	A. set this in .env file
		#MAIL_DRIVER=smtp
		#MAIL_HOST=smtp.gmail.com
		#MAIL_PORT=465
		#MAIL_FROM_NAME="website name"
		#MAIL_FROM_ADDRESS=email id
		#MAIL_USERNAME=email id
		#MAIL_PASSWORD=password
		#MAIL_ENCRYPTION=ssl
	B. set local and staging email address in constant.php file
	C. set email template color

6. Captch key
	A. Take captch key from the PM.
	
7. Message templates 
	A. Go to constant.php file and message templates make it true according your requirement.
		Ex. 'EMAIL_TEMPLATE'=>true,

8. Log Viewer Setup
   A. Publish the Front-End Assets:
      php artisan log-viewer:publish
   B. Access the Log Viewer:
      a.The package is now ready to use!
      b.Visit the /log-viewer route in your browser.


