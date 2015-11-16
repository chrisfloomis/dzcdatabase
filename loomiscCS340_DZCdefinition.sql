-- Author:		Chris Loomis
-- Filename:	loomiscCS340_DZCdefinition.sql
-- Created:		11/15/2015
-- Last Mod:	11/05/2015

-- Creates table for faction_dzc  
-- id - an auto incrementing integer which is the primary key
-- name - a varchar of maximum length 255, cannot be null
-- hallmarks - a varchar of maximum length 255; a brief description of the faction playstyle
-- every unit and weapon belong to a faction
-- I believe making this it's own table will be helpful in the long run

CREATE TABLE faction_dzc (
	id int(3) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	hallmarks varchar(255),
	PRIMARY KEY (id)
) ENGINE=InnoDB;

INSERT INTO faction_dzc (name,hallmarks) values ("UCM","combined arms, specialized units");
INSERT INTO faction_dzc (name,hallmarks) values ("Scourge","fast, deadly, light armor");
INSERT INTO faction_dzc (name,hallmarks) values ("PHR","slow, durable, powerful firepower");
INSERT INTO faction_dzc (name,hallmarks) values ("Shaltari","flexible, versatile, weaker firepower");

-- Creates table for category_dzc  
-- id - an auto incrementing integer which is the primary key
-- name - a varchar of maximum length 255, cannot be null
-- specialrules - a varchar of maximum length 255; some categories have additional rules to remember
-- every unit has a category
-- I believe making this it's own table will be helpful in the long run

CREATE TABLE category_dzc (
	id int(3) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	specialrules varchar(255),
	PRIMARY KEY (id)
) ENGINE=InnoDB;

INSERT INTO category_dzc (name,specialrules) values ("Command","if commander taken, projects SoI at full value");
INSERT INTO category_dzc (name) values ("Standard");
INSERT INTO category_dzc (name,specialrules) values ("Troops","may be forward air observer");
INSERT INTO category_dzc (name,specialrules) values ("Scout","projects commander's SoI; spots for indirect fire");
INSERT INTO category_dzc (name) values ("Heavy");
INSERT INTO category_dzc (name) values ("Support");
INSERT INTO category_dzc (name,specialrules) values ("Air","typically starts in reserves; roll for attack runs and intercepts");
INSERT INTO category_dzc (name) values ("Exotic");
INSERT INTO category_dzc (name,specialrules) values ("Transport","never taken by themselves; must use full capacity");
INSERT INTO category_dzc (name,specialrules) values ("Gate","Shaltari only; many special rules, see main rulebook p.134");

-- Creates table for squadsize_dzc  
-- id - an integer which is the primary key
-- min - an integer that cannot be null
-- max - an integer
-- fixed - a bool not null; whether the squad has fixed squad sizes such as 3/6/9
-- mid - an integer; if fixed is true it may have a middle value such as the example above
-- sstext - a varchar of maximum length 255; the squad size in string form such as "1-9" or "2/4/6"
-- every unit has a squad size
-- so far there are no fixed squad sizes that are 4 ints
-- I believe making this it's own table will be helpful in the long run

CREATE TABLE squadsize_dzc (
	id int(4) NOT NULL,
	ssmin int(3) NOT NULL,
	ssmax int(3),
	fixed BOOL NOT NULL,
	mid int(3)
	sstext varchar(25) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB;

INSERT INTO squadsize_dzc (id,ssmin,fixed,sstext) values ("1","1","true","1");
INSERT INTO squadsize_dzc (id,ssmin,fixed,sstext) values ("2","2","true","2");
INSERT INTO squadsize_dzc (id,ssmin,fixed,sstext) values ("3","3","true","3");
INSERT INTO squadsize_dzc (id,ssmin,fixed,sstext) values ("4","4","true","4");
INSERT INTO squadsize_dzc (id,ssmin,fixed,sstext) values ("5","5","true","5");
INSERT INTO squadsize_dzc (id,ssmin,fixed,sstext) values ("6","6","true","6");
INSERT INTO squadsize_dzc (id,ssmin,fixed,sstext) values ("7","7","true","7");
INSERT INTO squadsize_dzc (id,ssmin,fixed,sstext) values ("8","8","true","8");
INSERT INTO squadsize_dzc (id,ssmin,fixed,sstext) values ("9","9","true","9");
INSERT INTO squadsize_dzc (id,ssmin,fixed,sstext) values ("10","10","true","10");
INSERT INTO squadsize_dzc (id,ssmin,fixed,sstext) values ("11","11","true","11");
INSERT INTO squadsize_dzc (id,ssmin,fixed,sstext) values ("12","12","true","12");

INSERT INTO squadsize_dzc (id,ssmin,ssmax,fixed,mid,sstext) values ("246","2","6","true","4","2/4/6");
INSERT INTO squadsize_dzc (id,ssmin,ssmax,fixed,mid,sstext) values ("369","3","9","true","6","3/6/9");

INSERT INTO squadsize_dzc (id,ssmin,ssmax,fixed,sstext) values ("120","1","2","false","1-2");
INSERT INTO squadsize_dzc (id,ssmin,ssmax,fixed,sstext) values ("130","1","3","false","1-3");
INSERT INTO squadsize_dzc (id,ssmin,ssmax,fixed,sstext) values ("160","1","6","false","1-6");
INSERT INTO squadsize_dzc (id,ssmin,ssmax,fixed,sstext) values ("190","1","9","false","1-9");

-- Create a table called operating_system with the following properties:
-- id - an auto incrementing integer which is the primary key
-- name - a varchar of maximum length 255, cannot be null
-- version - a varchar of maximum length 255, cannot be null
-- name version combinations must be unique

CREATE TABLE operating_system (
	id int(11) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	version varchar(255) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY (name,version)
) ENGINE=InnoDB;


-- Create a table called device with the following properties:
-- id - an auto incrementing integer which is the primary key
-- cid - an integer which is a foreign key reference to the category_tbl table
-- name - a varchar of maximum length 255 which cannot be null
-- received - a date type (you can read about it here http://dev.mysql.com/doc/refman/5.0/en/datetime.html)
-- isbroken - a boolean

CREATE TABLE device (
	id int(11) NOT NULL AUTO_INCREMENT,
	cid int(11),
	name varchar(255) NOT NULL,
	received DATE,
	isbroken BOOL,
	PRIMARY KEY (id),
	FOREIGN KEY (cid) REFERENCES category_tbl (id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;


-- Create a table called os_support with the following properties, this is a table representing a many-to-many relationship
-- between devices and operating systems:
-- did - an integer which is a foreign key reference to device
-- osid - an integer which is a foreign key reference to operating_system
-- notes - a text type
-- The primary key is a combination of did and osid

CREATE TABLE os_support (
	did int(11),
	osid int(11),
	notes TEXT,
	PRIMARY KEY (did,osid),
	FOREIGN KEY (did) REFERENCES device (id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (osid) REFERENCES operating_system (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;


-- insert the following into the category_tbl table:

-- name: phone
-- subcategory: maybe a tablet?

INSERT INTO category_tbl (name,subcategory) values ("phone","maybe a tablet?");

-- name: tablet
-- subcategory: but kind of a laptop

INSERT INTO category_tbl (name,subcategory) values ("tablet","but kind of a laptop");

-- name: tablet
-- subcategory: ereader

INSERT INTO category_tbl (name,subcategory) values ("tablet","ereader");


-- insert the folowing into the operating_system table:
-- name: Android
-- version: 1.0

INSERT INTO operating_system (name,version) values ("Android","1.0");

-- name: Android
-- version: 2.0

INSERT INTO operating_system (name,version) values ("Android","2.0");

-- name: iOS
-- version: 4.0

INSERT INTO operating_system (name,version) values ("iOS","4.0");


-- insert the following devices instances into the device table (you should use a subquery to set up foriegn keys referecnes, no hard coded numbers):
-- cid - reference to name: phone subcategory: maybe a tablet?
-- name - Samsung Atlas
-- received - 1/2/1970
-- isbroken - True

INSERT INTO device (cid,name,received,isbroken) values ((SELECT id FROM category_tbl WHERE name="phone" AND subcategory="maybe a tablet?"),"Samsung Atlas","1970-01-02",true);

-- cid - reference to name: tablet subcategory: but kind of a laptop
-- name - Nokia
-- received - 5/6/1999
-- isbroken - False

INSERT INTO device (cid,name,received,isbroken) values ((SELECT id FROM category_tbl WHERE name="tablet" AND subcategory="but kind of a laptop"),"Nokia","1999-05-06",false);

-- cid - reference to name: tablet subcategory: ereader
-- name - jPad
-- received - 11/18/2005
-- isbroken - False

INSERT INTO device (cid,name,received,isbroken) values ((SELECT id FROM category_tbl WHERE name="tablet" AND subcategory="ereader"),"jPad","2005-11-08",false);


-- insert the following into the os_support table using subqueries to look up data as needed:
-- device: Samsung Atlas
-- os: Android 1.0
-- notes: Works poorly

INSERT INTO os_support (did,osid,notes) values ((SELECT id FROM device WHERE name="Samsung Atlas"),(SELECT id FROM operating_system WHERE name="Android" AND version="1.0"),"Works poorly");

-- device: Samsung Atlas
-- os: Android 2.0
-- notes: NULL

INSERT INTO os_support (did,osid,notes) values ((SELECT id FROM device WHERE name="Samsung Atlas"),(SELECT id FROM operating_system WHERE name="Android" AND version="2.0"),NULL);

-- device: jPad
-- os: iOS 4.0
-- notes: NULL

INSERT INTO os_support (did,osid,notes) values ((SELECT id FROM device WHERE name="jPad"),(SELECT id FROM operating_system WHERE name="iOS" AND version="4.0"),NULL);