# CanadaFood
This project provides the Canada Food Guide as an online service to improve the health of Canadians.
In this project, pgAdmin and XAMPP package have been used. 
pgAdmin is the most popular and features rich Open Source administration and development platform for PostgreSQL,
the most advanced Open Source database in the world.
XAMPP is a completely free, easy to install Apache distribution containing MariaDB, PHP, and Perl.

In order to run this code, first, it needs to import .csv files to the database. In CreateDB.sql file, the current roots of .csv files need to be changed. I also added 'fgcat_id' column to 'fg_directional_satements-en_ONPP' file to facilitate my code.
In addition to that, food.php and getfooddata.php should copy to the htdocs folder (C:\xampp\htdocs) of Apache file. 

Technologies like Javascript, Bootstrap, and Html have been used to develop a friendly client side. For the server side, PHP and SQL, in particular, PostgreSQL used. To connect back-end and front-end AJAX technology have been deployed.
