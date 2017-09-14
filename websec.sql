PRAGMA foreign_keys=OFF;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Items;

PRAGMA foreign_keys=ON;

CREATE TABLE Users (
username varchar(50) PRIMARY KEY,
pwhash varchar(50) NOT NULL,
address varchar(50) NOT NULL
);

CREATE TABLE Orders (
orderid int PRIMARY KEY,
username varchar(50) NOT NULL,
itemid int NOT NULL,
timedate DATETIME NOT NULL,
-- delivered BOOLEAN,
FOREIGN KEY(itemid) REFERENCES Items(itemid),
FOREIGN KEY(username) REFERENCES Users(username)
);

CREATE TABLE Items (
itemid int PRIMARY KEY,
name varchar(50) NOT NULL,
-- instock BOOLEAN,
-- description varchar(200,
price int NOT NULL
);

INSERT INTO Items(itemdid, name, price)
VALUES(1, "Lycka", 50),
(2, "Déjà vu", 100),
(3, "Sömn", 150);


