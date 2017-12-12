CREATE TABLE uTable (
    `id` INT,
    `table` VARCHAR(12) CHARACTER SET utf8,
    `db_tb` VARCHAR(7) CHARACTER SET utf8,
    `field` VARCHAR(16) CHARACTER SET utf8,
    `name` VARCHAR(22) CHARACTER SET utf8,
    `web` VARCHAR(3) CHARACTER SET utf8,
    `filter` VARCHAR(3) CHARACTER SET utf8,
    `sum` VARCHAR(3) CHARACTER SET utf8,
    `notes` VARCHAR(32) CHARACTER SET utf8
);
INSERT INTO uTable VALUES (1,'Site & Tower','st','id','ID','No','No','No',NULL);
INSERT INTO uTable VALUES (2,'Site & Tower','st','owner','Owner','No','Yes','No',NULL);
INSERT INTO uTable VALUES (3,'Site & Tower','st','site_name','Name','No','No','No',NULL);
INSERT INTO uTable VALUES (4,'Site & Tower','st','site_id','ID','No','No','No',NULL);
INSERT INTO uTable VALUES (5,'Site & Tower','st','site_div','Division','No','No','No','depends on owner, region, market');
INSERT INTO uTable VALUES (6,'Site & Tower','st','street','Street','No','No','No',NULL);
INSERT INTO uTable VALUES (7,'Site & Tower','st','city','City','No','No','No',NULL);
INSERT INTO uTable VALUES (8,'Site & Tower','st','county','County','No','No','No',NULL);
INSERT INTO uTable VALUES (9,'Site & Tower','st','state','State','No','No','No',NULL);
INSERT INTO uTable VALUES (10,'Site & Tower','st','zipcode','Zipcode','No','No','No',NULL);
INSERT INTO uTable VALUES (11,'Site & Tower','st','lat_dec','Latitude','No','No','No',NULL);
INSERT INTO uTable VALUES (12,'Site & Tower','st','lat_dms','Latitude DMS','No','No','No',NULL);
INSERT INTO uTable VALUES (13,'Site & Tower','st','lat_deg','Latitude deg.','No','No','No',NULL);
INSERT INTO uTable VALUES (14,'Site & Tower','st','lat_min','Latitude min','No','No','No',NULL);
INSERT INTO uTable VALUES (15,'Site & Tower','st','lat_sec','Latitude sec.','No','No','No',NULL);
INSERT INTO uTable VALUES (16,'Site & Tower','st','long_dec','Longitude','No','No','No',NULL);
INSERT INTO uTable VALUES (17,'Site & Tower','st','long_dms','Longitude DMS','No','No','No',NULL);
INSERT INTO uTable VALUES (18,'Site & Tower','st','long_deg','Longitude deg.','No','No','No',NULL);
INSERT INTO uTable VALUES (19,'Site & Tower','st','long_min','Longitude min.','No','No','No',NULL);
INSERT INTO uTable VALUES (20,'Site & Tower','st','long_sec','Longitude sec.','No','No','No',NULL);
INSERT INTO uTable VALUES (21,'Site & Tower','st','first_name','First Name','No','No','No',NULL);
INSERT INTO uTable VALUES (22,'Site & Tower','st','last_name','Last Name','No','No','No',NULL);
INSERT INTO uTable VALUES (23,'Site & Tower','st','phone','Phone','No','No','No',NULL);
INSERT INTO uTable VALUES (24,'Site & Tower','st','email','Email','No','No','No',NULL);
INSERT INTO uTable VALUES (25,'Site & Tower','st','str_type','Structural Type','No','No','No',NULL);
INSERT INTO uTable VALUES (26,'Site & Tower','st','str_id','Structural ID','No','No','No',NULL);
INSERT INTO uTable VALUES (27,'Site & Tower','st','twr_type','Tower Type','No','No','No',NULL);
INSERT INTO uTable VALUES (28,'Site & Tower','st','elev_grd','Ground Elevation','No','No','No',NULL);
INSERT INTO uTable VALUES (29,'Site & Tower','st','height','Height','No','No','No',NULL);
INSERT INTO uTable VALUES (30,'Site & Tower','st','agl','AGL','No','No','No',NULL);
INSERT INTO uTable VALUES (31,'Site & Tower','st','amsl','AMSL','No','No','No',NULL);
INSERT INTO uTable VALUES (32,'Site & Tower','st','bta_nbr','BTA #','No','No','No',NULL);
INSERT INTO uTable VALUES (33,'Site & Tower','st','bta_name','BTA Name','No','No','No',NULL);
INSERT INTO uTable VALUES (34,'Site & Tower','st','mta_nbr','MTA #','No','No','No',NULL);
INSERT INTO uTable VALUES (35,'Site & Tower','st','mta_name','MTA Name','No','No','No',NULL);
INSERT INTO uTable VALUES (36,'Site & Tower','st','fcc_nbr','FCC #','No','No','No',NULL);
INSERT INTO uTable VALUES (37,'Site & Tower','st','faa_nbr','FAA #','No','No','No',NULL);
INSERT INTO uTable VALUES (38,'Site & Tower','st','fa_nbr','FA #','No','No','No',NULL);
INSERT INTO uTable VALUES (39,'Site & Tower','st','status','Status','No','No','No',NULL);
INSERT INTO uTable VALUES (40,'Tracker','tracker','id','ID','No','No','No',NULL);
INSERT INTO uTable VALUES (41,'Tracker','tracker','rqst_date','Request Date','Yes','No','No',NULL);
INSERT INTO uTable VALUES (42,'Tracker','tracker','dlvr_date','Delivery Date','Yes','No','No',NULL);
INSERT INTO uTable VALUES (43,'Tracker','tracker','target_dlvr_date','Targeted Delivery Date','Yes','No','No',NULL);
INSERT INTO uTable VALUES (44,'Tracker','tracker','eng_nbr','Eng #','Yes','No','No',NULL);
INSERT INTO uTable VALUES (45,'Tracker','tracker','code','Code','Yes','No','No',NULL);
INSERT INTO uTable VALUES (46,'Tracker','tracker','rev','Revison','Yes','No','No',NULL);
INSERT INTO uTable VALUES (47,'Tracker','tracker','client','Client','Yes','No','No',NULL);
INSERT INTO uTable VALUES (48,'Tracker','tracker','site_info','Site Information','Yes','No','No',NULL);
INSERT INTO uTable VALUES (49,'Tracker','tracker','fa_nbr','FA #','Yes','No','No',NULL);
INSERT INTO uTable VALUES (50,'Tracker','tracker','result','Result','Yes','No','No',NULL);
INSERT INTO uTable VALUES (51,'Tracker','tracker','revenue','Revenue','Yes','No','Yes',NULL);
INSERT INTO uTable VALUES (52,'Tracker','tracker','proj_type','Project Type','Yes','No','No',NULL);
INSERT INTO uTable VALUES (53,'Tracker','tracker','pace_nbr','PACE #','Yes','No','No',NULL);
INSERT INTO uTable VALUES (54,'Tracker','tracker','internal_client','Internal Client','Yes','No','No',NULL);
INSERT INTO uTable VALUES (55,'Tracker','tracker','status','Status','Yes','No','No',NULL);
INSERT INTO uTable VALUES (56,'Tracker','tracker','team_mbr','Team Member','Yes','No','No',NULL);
INSERT INTO uTable VALUES (57,'Tracker','tracker','add_notes','Additional Notes','Yes','No','No',NULL);
INSERT INTO uTable VALUES (58,'Tracker','tracker','po_contact','PO Contact Information','Yes','No','No',NULL);
INSERT INTO uTable VALUES (59,'Tracker','tracker','po_issued_date','PO issued','Yes','No','No',NULL);
INSERT INTO uTable VALUES (60,'Tracker','tracker','po_recvd_date','PO Received ','Yes','No','No',NULL);
INSERT INTO uTable VALUES (61,'Tracker','tracker','wk_complete','Week Complete','No','No','No',NULL);
INSERT INTO uTable VALUES (62,'Tracker','tracker','mo_complete','Month Complete','No','No','No',NULL);
INSERT INTO uTable VALUES (63,'Tracker','tracker','yr_complete','Year Complete','No','No','No',NULL);
