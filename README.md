# Test scripts for MySQL in App

MySQL in-app enables running MySql within the site itself. One does not need to provision a database explicitly, and the data is always backed up along with the site contents. The key benefit is the ease of use/setup and network performance (MySql running locally within site). The limitation is it does not support multiple instances, auto scale nor slots. Should only be used in Dev environments - do use Azure Database for MySql for production scenarios. 

Please visit the following for more details on the feature.
- [MySQL in app · projectkudu/kudu Wiki (github.com)](https://github.com/projectkudu/kudu/wiki/MySQL-in-app) 
- [Troubleshooting FAQ for MySQL in-app - Azure App Service](https://azure.github.io/AppService/2016/09/08/Troubleshooting-FAQ-for-MySQL-in-app.html)


#Repository Contents
All files included are for testing purposes with MySQL-in-App on Azure App Service Windows.

| Files             |  Content                                   |
|----------------------|--------------------------------------------|
| `localdb_connstr.php`           | Will return connection string to browser. Script reads from the database connection string "MYSQLCONNSTR_localdb" & connects to mysql.|
| `querytimer.php`       | Allows user to run mysql queries from browser & track execution time. Requires updating the connection string on line 4. Intended for testing purposes.                |
| `potatowind.sql`               | Dummy data for purchase order database to be used for testing imports from cli,kudu or phpmyadmin. |

1. Deploy PHP Windows Application
2. Enabled My-SQL-in-App
3. Copy files to wwwroot.
4. Open phpMyAdmin & Import the database file. "potatowind.sql"
5. Visit the localdb_connstr from the browser to confirm the connection string is returned. Sitename.azurewebsites.net/localdb_connstr.php
    - The default connection string is stored in D:\home\data\mysql\MYSQLCONNSTR_localdb.txt 
    - If you want to customize the database, username and password, after you have created a new database, add new username or update password, simply modify D:\home\data\mysql\MYSQLCONNSTR_localdb.ini , remove D:\home\data\mysql\MYSQLCONNSTR_localdb.txt and restart the WebApps.
    - Azure will only backup the database from the connection string. 
6. Updated querytimer.php with the correct user,server,pass, & database & test from browser. Sitename.azurewebsites.net/querytimer.php
