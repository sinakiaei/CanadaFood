-- create tables

DROP TABLE IF EXISTS foodgroups;
CREATE TABLE foodgroups(fgid varchar(2), foodgroup varchar(32), fgcat_id integer, fgcat varchar(64));

DROP TABLE IF EXISTS directional;
CREATE TABLE directional(fgid varchar(2), directional varchar(256), fgcat_id integer);

DROP TABLE IF EXISTS serving;
CREATE TABLE serving(fgid varchar(2), gender varchar(6), ages varchar(16), servings varchar(16));

DROP TABLE IF EXISTS foods;
CREATE TABLE foods(fgid varchar(2), fgcat_id integer, srvg_sz varchar(64), food varchar(256), ID varchar(2));

-- feed data into database

COPY foodgroups FROM 'C:/Others/SinaKiaei/signal-master/data/foodgroups-en_ONPP.csv' DELIMITERS ',' CSV HEADER;

COPY directional FROM 'C:/Others/SinaKiaei/signal-master/data/fg_directional_satements-en_ONPP.csv' DELIMITERS ',' CSV HEADER;

COPY serving FROM 'C:/Others/SinaKiaei/signal-master/data/servings_per_day-en_ONPP.csv' DELIMITERS ',' CSV HEADER;

COPY foods FROM 'C:/Others/SinaKiaei/signal-master/data/foods-en_ONPP_rev.csv' DELIMITERS ',' CSV HEADER ENCODING 'ISO-8859-1';
ALTER TABLE foods DROP COLUMN ID;