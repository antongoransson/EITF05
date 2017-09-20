SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Items;

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
  orderid int NOT NULL,
  itemid int NOT NULL,
  username varchar(50) NOT NULL,
  timedate DATETIME NOT NULL,
  nbrofitems int NOT NULL,
  -- delivered BOOLEAN,
  PRIMARY KEY(orderid),
  -- FOREIGN KEY(itemid) REFERENCES Items(itemid)
  FOREIGN KEY(itemid) REFERENCES Items(itemid),
  FOREIGN KEY(username) REFERENCES Users(username)
);
--

-- instock BOOLEAN,
-- description varchar(200,

INSERT INTO Items(name, price)
VALUES( "Lycka", 50),
( "Déjà vu", 100),
( "Sömn", 150);
