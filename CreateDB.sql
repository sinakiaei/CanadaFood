-- CREATE TABLES

-- HINT: Before create directional table (Second table), you need to copy fgcat_id column from "foodgroups-en_ONPP.csv" file
-- to "fg_directional_satements-en_ONPP.csv" file.

-- First line: Delete possible existing table in database.
-- Second line: Create table based on .csv file columns.

DROP TABLE IF EXISTS foodgroups;
CREATE TABLE foodgroups(fgid varchar(2), foodgroup varchar(32), fgcat_id integer, fgcat varchar(64));

DROP TABLE IF EXISTS directional;
CREATE TABLE directional(fgid varchar(2), directional varchar(256), fgcat_id integer);

DROP TABLE IF EXISTS serving;
CREATE TABLE serving(fgid varchar(2), gender varchar(6), ages varchar(16), servings varchar(16));

DROP TABLE IF EXISTS foods;
CREATE TABLE foods(fgid varchar(2), fgcat_id integer, srvg_sz varchar(64), food varchar(256), ID varchar(2));

-- FEED DATA INTO DATABASE 

-- HINT: Files path needs to change based on files location.

COPY foodgroups FROM 'C:/Others/SinaKiaei/signal-master/data/foodgroups-en_ONPP.csv' DELIMITERS ',' CSV HEADER;

COPY directional FROM 'C:/Others/SinaKiaei/signal-master/data/fg_directional_satements-en_ONPP.csv' DELIMITERS ',' CSV HEADER;

COPY serving FROM 'C:/Others/SinaKiaei/signal-master/data/servings_per_day-en_ONPP.csv' DELIMITERS ',' CSV HEADER;

COPY foods FROM 'C:/Others/SinaKiaei/signal-master/data/foods-en_ONPP_rev.csv' DELIMITERS ',' CSV HEADER ENCODING 'ISO-8859-1';
ALTER TABLE foods DROP COLUMN ID;
