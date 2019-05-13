# CanadaFood
This project provides the Canada Food Guide as an online service to improve the health of Canadians.
In this project, pgAdmin and XAMPP package have been used. 
pgAdmin is the most popular and features rich Open Source administration and development platform for PostgreSQL,
the most advanced Open Source database in the world.
XAMPP is a completely free, easy to install Apache distribution containing MariaDB, PHP, and Perl.

In order to run this code, it needs to import .csv files to the database. First, the "Food" database requires to create.
"CreateDB.sql" file includes all commands need to run for creating database tables. It needs to change current roots of .csv files in "CreateDB.sql". The 'fgcat_id' column created in 'fg_directional_satements-en_ONPP.csv'.
.
The food.php and getfooddata.php should copy to the htdocs folder (C:\xampp\htdocs). 

Technologies like Javascript, Bootstrap, and Html have been used to develop a friendly client side. For the server side, PHP and SQL, in particular, PostgreSQL used. To connect back-end and front-end AJAX technology have been deployed.
