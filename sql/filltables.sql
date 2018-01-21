INSERT INTO `logtrack`.`user_type` (id, name)
VALUES(1, "admin");
INSERT INTO `logtrack`.`user_type` (id, name)
VALUES(2, "employee");
INSERT INTO `logtrack`.`users` 
VALUES(1, "admin",MD5("admin"),"admin@logtrack.com",1,"Admin","Admin","Admin", null);
INSERT INTO `logtrack`.`users` 
VALUES(2, "employee",MD5("employee"),"employee@logtrack.com",2,"Employee","Employee","Employee", null);
INSERT INTO `logtrack`.`item_status`
VALUES(1,"dostupno");
INSERT INTO `logtrack`.`item_status`
VALUES(2,"nedostupno");
INSERT INTO `logtrack`.`item_type`
VALUES(1,"razno", null);
INSERT INTO `logtrack`.`item_type`
VALUES(2,"ručni alat", null);
INSERT INTO `logtrack`.`item_type`
VALUES(3,"električni alat", null);
INSERT INTO `logtrack`.`item_type`
VALUES(4,"elektronika", null);
INSERT INTO `logtrack`.`locations`
VALUES(1,"Skladište", null);
INSERT INTO `logtrack`.`locations`
VALUES(2,"Čakovec", null);
INSERT INTO `logtrack`.`locations`
VALUES(3,"Nedifinirano", null);
INSERT INTO `logtrack`.`message_status`
VALUES(1,"unread");
INSERT INTO `logtrack`.`message_status`
VALUES(2,"read");
INSERT INTO `logtrack`.`items`
VALUES(1,"Bušilica","Boshova bušilica udarna",1,1,1,10.56,"123asd456",NULL);
INSERT INTO `logtrack`.`items`
VALUES(2,"Kosilica","Kosilica samohodna",1,2,2,10.56,"987654asd",NULL);




