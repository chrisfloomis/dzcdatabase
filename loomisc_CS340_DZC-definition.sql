-- Author:		Chris Loomis
-- Filename:	loomiscCS340_DZCdefinition.sql
-- Created:		11/15/2015
-- Last Mod:	11/28/2015

-- Creates table for dzc_faction  
-- id - an auto incrementing integer which is the primary key
-- name - a varchar of maximum length 255, cannot be null
-- hallmarks - a varchar of maximum length 255; a brief description of the faction playstyle
-- every unit and weapon belong to a faction

CREATE TABLE dzc_faction (
	id int(4) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	hallmark varchar(255),
	PRIMARY KEY (id),
	UNIQUE KEY (name)
) ENGINE=InnoDB;

INSERT INTO dzc_faction (name,hallmark) values ("UCM","combined arms, specialized units");
INSERT INTO dzc_faction (name,hallmark) values ("Scourge","fast, deadly, light armor");
INSERT INTO dzc_faction (name,hallmark) values ("PHR","slow, durable, powerful firepower");
INSERT INTO dzc_faction (name,hallmark) values ("Shaltari","flexible, versatile, weaker firepower");

-- Creates table for dzc_category  
-- id - an auto incrementing integer which is the primary key
-- name - a varchar of maximum length 255, cannot be null
-- specialrules - a varchar of maximum length 255; some categories have additional rules to remember
-- every unit has a category

CREATE TABLE dzc_category (
	id int(4) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	special varchar(255),
	PRIMARY KEY (id),
	UNIQUE KEY (name)
) ENGINE=InnoDB;

INSERT INTO dzc_category (name,special) values ("Command","if commander taken, projects SoI at full value");
INSERT INTO dzc_category (name) values ("Standard");
INSERT INTO dzc_category (name,special) values ("Troops","may be forward air observer");
INSERT INTO dzc_category (name,special) values ("Scout","projects commander's SoI; spots for indirect fire");
INSERT INTO dzc_category (name) values ("Heavy");
INSERT INTO dzc_category (name) values ("Support");
INSERT INTO dzc_category (name,special) values ("Air","typically starts in reserves; roll for attack runs and intercepts");
INSERT INTO dzc_category (name) values ("Exotic");
INSERT INTO dzc_category (name,special) values ("Transport","never taken by themselves; must use full capacity");
INSERT INTO dzc_category (name,special) values ("Gate","Shaltari only; many special rules, see main rulebook p.134");

-- Creates table for dzc_squadsize  
-- id - an auto incrementing integer which is the primary key
-- min - an integer that cannot be null
-- max - an integer
-- fixed - a bool not null; whether the squad has fixed squad sizes such as 3/6/9
-- mid - an integer; if fixed is true it may have a middle value such as the example above
-- sstext - a varchar of maximum length 255; the squad size in string form such as "1-9" or "2/4/6"
-- every unit has a squad size

CREATE TABLE dzc_squadsize (
	ssmin int(3) NOT NULL,
	ssmax int(3) NOT NULL,
	ssfixed BOOLEAN NOT NULL,
	mid int(3),
	sstext varchar(255) NOT NULL,
	PRIMARY KEY (ssmin,ssmax,ssfixed)
) ENGINE=InnoDB;

INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (1,1,true,"1");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (2,2,true,"2");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (3,3,true,"3");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (4,4,true,"4");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (5,5,true,"5");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (6,6,true,"6");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (7,7,true,"7");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (8,8,true,"8");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (9,9,true,"9");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (10,10,true,"10");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (11,11,true,"11");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (12,12,true,"12");

INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,mid,sstext) values (2,6,true,4,"2/4/6");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,mid,sstext) values (3,9,true,6,"3/6/9");

INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (1,2,false,"1-2");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (1,3,false,"1-3");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (1,6,false,"1-6");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (1,9,false,"1-9");
INSERT INTO dzc_squadsize (ssmin,ssmax,ssfixed,sstext) values (3,9,false,"3-9");

-- Create a table called dzc_unit with the following properties:
-- id - an auto incrementing integer which is the primary key
-- fid - an integer which is a foreign key reference to dzc_faction
-- name - a varchar of maximum length 255, cannot be null
-- armor - an integer that cannot be null
-- mv - movement - an integer that cannot be null
-- cm - counter measuers - a varchar max length 25
-- dp - damage points - an integer that cannot be null
-- pts - points - an integer
-- utype - unit type - a varchar max length 25 cannot be null
-- catid - an integer which is a foreign key reference to dzc_category
-- ssid - an integer which is a foreign key reference to dzc_squadsize
-- coherency - a varchar of maximum length 25 that cannot be null
-- special - a varchar of maximum length 255

CREATE TABLE dzc_unit (
	id int(4) NOT NULL AUTO_INCREMENT,
	fid int(4),
	name varchar(255) NOT NULL,
	armor int(3) NOT NULL,
	mv int(3) NOT NULL,
	cm varchar(25),
	dp int(3) NOT NULL,
	pts int(4),
	utype varchar(25) NOT NULL,
	catid int(4),
	fkssmin int(3),
	fkssmax int(3),
	fkssfixed BOOL,
	coherency varchar(25) NOT NULL,
	special varchar(255),
	PRIMARY KEY (id),
	UNIQUE KEY (name),
	FOREIGN KEY (fid) REFERENCES dzc_faction (id) ON DELETE SET NULL ON UPDATE CASCADE,
	FOREIGN KEY (catid) REFERENCES dzc_category (id) ON DELETE SET NULL ON UPDATE CASCADE,
	FOREIGN KEY (fkssmin,fkssmax,fkssfixed) REFERENCES dzc_squadsize (ssmin,ssmax,ssfixed) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO dzc_unit (fid,name,armor,mv,cm,dp,pts,utype,catid,fkssmin,fkssmax,fkssfixed,coherency,special) values ((SELECT id FROM dzc_faction WHERE name="Shaltari"),"Tomahawk",7,9,"A, P5+",1,38,"vehicle",(SELECT id FROM dzc_category WHERE name="Standard"),(SELECT ssmin FROM dzc_squadsize WHERE ssmin=3 AND ssmax=9 AND ssfixed=false),(SELECT ssmax FROM dzc_squadsize WHERE ssmin=3 AND ssmax=9 AND ssfixed=false),(SELECT ssfixed FROM dzc_squadsize WHERE ssmin=3 AND ssmax=9 AND ssfixed=false),"standard","skimmer, mass-1");
INSERT INTO dzc_unit (fid,name,armor,mv,cm,dp,pts,utype,catid,fkssmin,fkssmax,fkssfixed,coherency,special) values ((SELECT id FROM dzc_faction WHERE name="Shaltari"),"Kukri",7,9,"A, P5+",1,45,"vehicle",(SELECT id FROM dzc_category WHERE name="Support"),(SELECT ssmin FROM dzc_squadsize WHERE ssmin=3 AND ssmax=3 AND ssfixed=true),(SELECT ssmax FROM dzc_squadsize WHERE ssmin=3 AND ssmax=3 AND ssfixed=true),(SELECT ssfixed FROM dzc_squadsize WHERE ssmin=3 AND ssmax=3 AND ssfixed=true),"wide","skimmer, mass-1");
INSERT INTO dzc_unit (fid,name,armor,mv,cm,dp,pts,utype,catid,fkssmin,fkssmax,fkssfixed,coherency,special) values ((SELECT id FROM dzc_faction WHERE name="Shaltari"),"Jaguar",9,4,"A, P5+",4,110,"vehicle",(SELECT id FROM dzc_category WHERE name="Heavy"),(SELECT ssmin FROM dzc_squadsize WHERE ssmin=1 AND ssmax=3 AND ssfixed=false),(SELECT ssmax FROM dzc_squadsize WHERE ssmin=1 AND ssmax=3 AND ssfixed=false),(SELECT ssfixed FROM dzc_squadsize WHERE ssmin=1 AND ssmax=3 AND ssfixed=false),"standard","walker, mass-3");

-- Create a table called dzc_weapon with the following properties:
-- id - an auto incrementing integer which is the primary key
-- fid - an integer which is a foreign key reference to dzc_faction
-- name - a varchar of maximum length 255, cannot be null
-- energy - an integer
-- sh - shots - an integer that cannot be null
-- ac - accuracy - an integer that cannot be null
-- rf - range full - an integer
-- rc - range countered - an integer
-- special - a varchar of maximum length 255

CREATE TABLE dzc_weapon (
	id int(4) NOT NULL AUTO_INCREMENT,
	fid int(4),
	name varchar(255) NOT NULL,
	energy int(3),
	sh int(3) NOT NULL,
	ac int(3) NOT NULL,
	rf int(3),
	rc int(3),
	special varchar(255),
	PRIMARY KEY (id),
	UNIQUE KEY (name),
	FOREIGN KEY (fid) REFERENCES dzc_faction (id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO dzc_weapon (fid,name,energy,sh,ac,rf,rc) values ((SELECT id FROM dzc_faction WHERE name="Shaltari"),"Gauss Cannon",10,1,2,99,24);
INSERT INTO dzc_weapon (fid,name,energy,sh,ac,rf,rc) values ((SELECT id FROM dzc_faction WHERE name="Shaltari"),"Twin Ion Cannons",6,4,3,18,18);

-- Create a table called dzc_unit_weapon with the following properties:
-- uid - an integer which is a foreign key reference to dzc_unit
-- wid - an integer which is a foreign key reference to dzc_weapon
-- mf - move and fire - an integer that cannot be null
-- arc - a varchar maximum length 25 that cannot be null

CREATE TABLE dzc_unit_weapon (
	uid int(4),
	wid int(4),
	mf int(3) NOT NULL,
	arc varchar(25) NOT NULL,
	PRIMARY KEY (uid,wid,arc),
	FOREIGN KEY (uid) REFERENCES dzc_unit (id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (wid) REFERENCES dzc_weapon (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO dzc_unit_weapon (uid,wid,mf,arc) values ((SELECT id FROM dzc_unit WHERE name="Tomahawk"),(SELECT id from dzc_weapon WHERE name="Gauss Cannon"),6,"F/S/R");
INSERT INTO dzc_unit_weapon (uid,wid,mf,arc) values ((SELECT id FROM dzc_unit WHERE name="Kukri"),(SELECT id from dzc_weapon WHERE name="Twin Ion Cannons"),6,"F/S/R");
INSERT INTO dzc_unit_weapon (uid,wid,mf,arc) values ((SELECT id FROM dzc_unit WHERE name="Jaguar"),(SELECT id from dzc_weapon WHERE name="Gauss Cannon"),4,"F/S(Left)");
INSERT INTO dzc_unit_weapon (uid,wid,mf,arc) values ((SELECT id FROM dzc_unit WHERE name="Jaguar"),(SELECT id from dzc_weapon WHERE name="Gauss Cannon"),4,"F/S(Right)");
INSERT INTO dzc_unit_weapon (uid,wid,mf,arc) values ((SELECT id FROM dzc_unit WHERE name="Jaguar"),(SELECT id from dzc_weapon WHERE name="Twin Ion Cannons"),4,"F/S/R");