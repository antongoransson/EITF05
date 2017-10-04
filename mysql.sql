SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Items;
DROP TABLE IF EXISTS Reviews;

SET FOREIGN_KEY_CHECKS = 1;


CREATE TABLE Users (
  username varchar(50),
  pwhash varchar(255) NOT NULL,
  address varchar(50) NOT NULL,
  PRIMARY KEY(username)
);

CREATE TABLE Items (
  itemid int NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  price int NOT NULL,
  PRIMARY KEY(itemid)
);

CREATE TABLE Orders (
  ID int NOT NULL AUTO_INCREMENT,
  orderid int NOT NULL,
  itemid int NOT NULL,
  username varchar(50) NOT NULL,
  timedate DATETIME NOT NULL,
  nbrofitems int NOT NULL,
  -- delivered BOOLEAN,
  PRIMARY KEY(ID),
  -- FOREIGN KEY(itemid) REFERENCES Items(itemid)
  FOREIGN KEY(itemid) REFERENCES Items(itemid),
  FOREIGN KEY(username) REFERENCES Users(username)
);
CREATE TABLE Reviews (
  ID int NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  timedate DATETIME NOT NULL,
  subject varchar(100) NOT NULL,
  comment varchar(300) NOT NULL,
  PRIMARY KEY(ID),
	FOREIGN KEY(username) REFERENCES Users(username)
);
--

-- instock BOOLEAN,
-- description varchar(200,

INSERT INTO Items(name, price)
VALUES( "Lycka", 50),
( "Déjà vu", 100),
( "Sömn", 150),
( "Transformation", 450);


INSERT INTO Users(username, pwhash, address)
VALUES( "H4ckerL4rs","daiodhsaiodhaiod1","H4ckert0wn"),
( "Gun-Britt","daiodhsaiodhaio12d12","Lugna staden"),
( "Knugen","daiodhsa2iodhaiod1","Sture-P");

INSERT INTO Reviews(username, timedate, subject, comment)
VALUES( "H4ckerL4rs","2017-10-01","Safest shop ever","Tried to hack this site but
	nothing happened 10/10"),
	( "Gun-Britt","2017-09-07","Best site ever!!","Best site ever, so many great and good items"),
	( "Knugen","2017-09-29","It was ok", "I would visit again");
