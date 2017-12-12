CREATE TABLE tracker (
    `Request_Date` DATETIME,
    `Delivery_Date` DATETIME,
    `Targeted_Delivery_Date` DATETIME,
    `Eng_Number` INT,
    `Code` VARCHAR(3) CHARACTER SET utf8,
    `Revison` INT,
    `Client` VARCHAR(13) CHARACTER SET utf8,
    `Site_Information` VARCHAR(44) CHARACTER SET utf8,
    `FA_Number` VARCHAR(15) CHARACTER SET utf8,
    `Result` VARCHAR(4) CHARACTER SET utf8,
    `Revenue` NUMERIC(6, 2),
    `Project_Type` VARCHAR(7) CHARACTER SET utf8,
    `PACE_Number` INT,
    `Internal_Client` VARCHAR(3) CHARACTER SET utf8,
    `Status` VARCHAR(14) CHARACTER SET utf8,
    `Team_Member` VARCHAR(3) CHARACTER SET utf8,
    `Additional_Notes` VARCHAR(206) CHARACTER SET utf8,
    `PO_Contact_Information` VARCHAR(2) CHARACTER SET utf8,
    `PO_issued` DATETIME,
    `PO_Received` VARCHAR(2) CHARACTER SET utf8,
    `Week_Complete` INT,
    `Month_Complete` INT,
    `Year_Complete` INT
);
INSERT INTO tracker VALUES ('2017-03-24 00:00:00','2017-03-27 00:00:00',NULL,10002,'RIG',1,'City','Class IV Rigging Plan','2297937','PASS',866,'1805',NULL,'JH','SENT TO CLIENT','RM',NULL,NULL,NULL,NULL,13,3,2017);
INSERT INTO tracker VALUES ('2017-04-04 00:00:00',NULL,NULL,10004,'SAR',1,'Safety','Structural Analysis - Specialty',NULL,NULL,0,'Waivers',NULL,'CI','CANCELLED','TBD','Awaiting mapping',NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO tracker VALUES ('2017-04-26 00:00:00','2017-05-05 00:00:00',NULL,10007,'SAR',1,'Isle of Palms','Structural Analysis',NULL,'FAIL',2000,'1805',NULL,'MK','SENT TO CLIENT','BM',NULL,NULL,NULL,NULL,18,5,2017);
INSERT INTO tracker VALUES ('2017-04-26 00:00:00','2017-07-06 00:00:00',NULL,10007,'MOD',1,'Isle of Palms','Water Tank Modification and Passing Analysis',NULL,'PASS',750,'1805',NULL,'MK','SENT TO CLIENT','BM','Awaiting Input: On Hold waiting to direction from Andy Tillman on replacement part. Sent to Utility Service for approval, 6/22. Sent signed copies 7/6 to Brad for Utiltiy Service review. ',NULL,NULL,NULL,27,7,2017);
INSERT INTO tracker VALUES ('2017-08-24 00:00:00','2017-08-30 00:00:00','2017-08-31 00:00:00',10007,'MOD',2,'Isle of Palms','IOPWSC 150K Modifications',NULL,'Pass',375,'1805',NULL,'BT','SENT TO CLIENT','BM','10007-MOD2 ',NULL,NULL,NULL,35,8,2017);
INSERT INTO tracker VALUES ('2017-04-27 00:00:00','2017-05-17 00:00:00','2017-05-31 00:00:00',10008,'SAR',1,'TowerCo','High Capex Guyed Tower',NULL,'FAIL',1000,'1805',NULL,'SR','SENT TO CLIENT','JH',NULL,NULL,NULL,NULL,20,5,2017);
INSERT INTO tracker VALUES ('2017-04-28 00:00:00','2017-06-05 00:00:00','2017-06-08 00:00:00',10009,'SAR',1,'AT&T','Water Tank Analysis','10129890-DUBOIS',NULL,4900,'1805',NULL,'CRM','SENT TO CLIENT','BM','Confirmed full structural analysis required. Mapping received 6/1. ',NULL,NULL,NULL,23,6,2017);
INSERT INTO tracker VALUES ('2017-05-01 00:00:00','2017-05-03 00:00:00',NULL,10010,'RIG',1,'SBA','Class IV Rigging Plan',NULL,NULL,866,'1805',NULL,'RG','SENT TO CLIENT','RM',NULL,NULL,NULL,NULL,18,5,2017);
INSERT INTO tracker VALUES ('2017-05-09 00:00:00','2017-05-12 00:00:00',NULL,10013,'SAR',1,'AT&T','Structural Analysis - ID','10130457-MONIDA','PASS',1400,'1805',NULL,'CRM','SENT TO CLIENT','JH','Confirmed full structural analysis required',NULL,NULL,NULL,19,5,2017);
INSERT INTO tracker VALUES ('2017-09-14 00:00:00','2017-10-05 00:00:00','2017-10-04 00:00:00',10015,'SAR',1,'AT&T','GASC_GRVCL_002',NULL,NULL,114.67,'1802',NULL,'MA','SENT TO CLIENT','AWM','A&E Number: 0207014001-118 9.29 Analyze existing wood pole.  If fails propose new wood pole.',NULL,NULL,NULL,40,10,2017);
INSERT INTO tracker VALUES ('2017-09-14 00:00:00','2017-10-05 00:00:00','2017-10-04 00:00:00',10015,'SAR',1,'AT&T','GASC_GRVCL_007',NULL,NULL,114.67,'1802',NULL,'MA','SENT TO CLIENT','AWM','A&E Number: 0207014001-123; 9.13 Duke Energy owned hold 9.29 Actually AT&T owned. 9.29 Replace existing utility pole with new wooden pole.  Existing loading to be transferred to new pole plus new equipment.',NULL,NULL,NULL,40,10,2017);
INSERT INTO tracker VALUES ('2017-09-14 00:00:00','2017-10-06 00:00:00','2017-10-05 00:00:00',10015,'SAR',1,'AT&T','RCKHL_001',NULL,NULL,114.67,'1802',NULL,'MA','SENT TO CLIENT','AWM','A&E Number: 0207014001-25','SK','2017-09-18 00:00:00','No',40,10,2017);
INSERT INTO tracker VALUES ('2017-09-14 00:00:00','2017-10-06 00:00:00','2017-10-05 00:00:00',10015,'SAR',1,'AT&T','RCKHL_002',NULL,NULL,114.67,'1802',NULL,'MA','SENT TO CLIENT','AWM','A&E Number: 0207014001-26','SK','2017-09-18 00:00:00','No',40,10,2017);
INSERT INTO tracker VALUES ('2017-09-14 00:00:00','2017-10-06 00:00:00','2017-10-05 00:00:00',10015,'SAR',1,'AT&T','RCKHL_003',NULL,NULL,114.67,'1802',NULL,'MA','SENT TO CLIENT','AWM','A&E Number: 0207014001-27','SK','2017-09-18 00:00:00','No',40,10,2017);
INSERT INTO tracker VALUES ('2017-09-14 00:00:00','2017-10-06 00:00:00','2017-10-05 00:00:00',10015,'SAR',1,'AT&T','RCKHL_004',NULL,NULL,114.67,'1802',NULL,'MA','SENT TO CLIENT','AWM','A&E Number: 0207014001-28','SK','2017-09-18 00:00:00','No',40,10,2017);
INSERT INTO tracker VALUES ('2017-09-14 00:00:00','2017-10-06 00:00:00','2017-10-05 00:00:00',10015,'SAR',1,'AT&T','RCKHL_005',NULL,NULL,114.67,'1802',NULL,'MA','SENT TO CLIENT','AWM','A&E Number: 0207014001-29','SK','2017-09-18 00:00:00','No',40,10,2017);
INSERT INTO tracker VALUES ('2017-09-29 00:00:00',NULL,'2017-10-05 00:00:00',10015,'SAR',1,'AT&T','RGSC_GRVGV_008',NULL,NULL,114.67,'1802',NULL,'MA','CANCELLED',NULL,'A&E Number 0207014001-8 9.29 Await PCD w/ light detail replacement.',NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO tracker VALUES ('2017-09-14 00:00:00','2017-10-06 00:00:00','2017-10-05 00:00:00',10015,'SAR',1,'AT&T','RCKHL_006',NULL,NULL,114.67,'1802',NULL,'MA','SENT TO CLIENT','AWM','A&E Number: 0207014001-30','SK','2017-09-18 00:00:00','No',40,10,2017);
INSERT INTO tracker VALUES ('2017-09-14 00:00:00','2017-10-06 00:00:00','2017-10-05 00:00:00',10015,'SAR',1,'AT&T','RCKHL_007',NULL,NULL,114.67,'1802',NULL,'MA','SENT TO CLIENT','AWM','A&E Number: 0207014001-31 9.29 RRUs 2203 placed closer to antenna.','SK','2017-09-18 00:00:00','No',40,10,2017);
INSERT INTO tracker VALUES ('2017-09-29 00:00:00',NULL,'2017-10-05 00:00:00',10015,'SAR',1,'AT&T','RGSC_GRVGV_011',NULL,NULL,114.67,'1802',NULL,'MA','CANCELLED',NULL,'A&E Number: 0207014001-11 9.29 Await PCD w/ light detail replacement.',NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO tracker VALUES ('2017-09-14 00:00:00','2017-10-06 00:00:00','2017-10-05 00:00:00',10015,'SAR',1,'AT&T','RCKHL_008',NULL,NULL,114.67,'1802',NULL,'MA','SENT TO CLIENT','AWM','A&E Number: 0207014001-32','SK','2017-09-18 00:00:00','No',40,10,2017);
INSERT INTO tracker VALUES ('2017-09-14 00:00:00','2017-10-06 00:00:00','2017-10-05 00:00:00',10015,'SAR',1,'AT&T','RCKHL_009',NULL,NULL,114.67,'1802',NULL,'MA','SENT TO CLIENT','AWM','A&E Number: 0207014001-33 9.29 RRUs 2203 placed closer to antenna.','SK','2017-09-18 00:00:00','No',40,10,2017);
INSERT INTO tracker VALUES ('2017-09-14 00:00:00','2017-10-06 00:00:00','2017-10-05 00:00:00',10015,'SAR',1,'AT&T','RCKHL_010',NULL,NULL,114.67,'1802',NULL,'MA','SENT TO CLIENT','AWM','A&E Number: 0207014001-34 ','SK','2017-09-18 00:00:00','No',40,10,2017);
