=====================================
            MindQuest
========================================

Welcome to MindQuest! This guide will help you set up the SQL database and install the PHP project on your local machine using XAMPP.

----------------------------------------
1. INSTALL XAMPP
----------------------------------------
If you haven’t installed XAMPP, download it from:
https://www.apachefriends.org/index.html
Follow the installation instructions for your operating system.

----------------------------------------
2. CLONE THE REPOSITORY
----------------------------------------
Clone the project repository from GitHub to your local machine:

git clone https://github.com/your-username/MindQuest.git

----------------------------------------
3. CREATE THE DATABASE
----------------------------------------
1. Start XAMPP: Open the XAMPP Control Panel and start the Apache and MySQL modules.
2. Open phpMyAdmin: In your browser, go to http://localhost/phpmyadmin/
3. Create a New Database:
   - Click on the "Databases" tab.
   - In the "Create database" field, enter the database name: forum
   - Click "Create".

----------------------------------------
4. IMPORT THE SQL FILE
----------------------------------------
1. Navigate to the Import Section:
   - In phpMyAdmin, select the `forum` database you just created.
   - Click on the "Import" tab.
2. Import the SQL File:
   - Click "Choose File" and select the SQL file located at `MindQuest\dataBase\forum.sql`.
   - Click "Go" to import the database structure and data.

----------------------------------------
5. SET UP THE PHP PROJECT
----------------------------------------
1. Move the Project Files:
   - After cloning the repository, move the project files to the `htdocs` directory of XAMPP.
   - The path should be something like: `C:\xampp\htdocs\MindQuest`.

2. Configure the Database Connection:
   - Open the project folder and locate the `C:\xampp\htdocs\MindQuest\particles\connect.php`.
   - Update the database configuration settings:
     // Example configuration
     $servername = "localhost";
     $username = "root";
     $password = ""; // default is empty for XAMPP
     $dbname = "forum";

3. Test the Project:
   - In your browser, navigate to `http://localhost/MindQuest`.
   - The project should now be running with the database connected.

----------------------------------------
6. ADDITIONAL NOTES
----------------------------------------
- Default Credentials: If your project has user authentication, provide default admin or user credentials.
- Troubleshooting: Common issues can include database connection errors or missing extensions. Make sure to enable necessary PHP extensions in the `php.ini` file if required.

----------------------------------------
7. CONTRIBUTING
----------------------------------------
Feel free to fork the repository and make improvements. Pull requests are welcome.

========================================
