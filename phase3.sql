CREATE TABLE Users
(
F_name char(25) NOT NULL,
L_name char(25) NOT NULL,
Uids int NOT NULL AUTO_INCREMENT,
Gender char(10) NOT NULL,
Utype char(25) NOT NULL,
Password char(50) NOT NULL,
PRIMARY KEY (Uids),
CHECK (Gender IN ('male', 'female'))
)AUTO_INCREMENT=1;
CREATE TABLE U_Address
(
Street char(25) NOT NULL,
House char(25) NOT NULL,
Zip integer NOT NULL,
City char(25) NOT NULL,
Uids int NOT NULL,
PRIMARY KEY (Uids)
);
CREATE TABLE Contact
(
Uids int NOT NULL,
Mobile char(25) NOT NULL,
PRIMARY KEY (Uids, Mobile),
FOREIGN KEY (Uids) 
        REFERENCES users(Uids)
        ON DELETE CASCADE
);
CREATE TABLE Email
(
Uids int NOT NULL,
Emailids char(25) NOT NULL,
PRIMARY KEY (Uids, Emailids),
FOREIGN KEY (Uids) 
        REFERENCES users(Uids)
        ON DELETE CASCADE
);
CREATE TABLE Sell
(
AdId int NOT NULL  AUTO_INCREMENT,
AdType char(25) NOT NULL,
Uids int NOT NULL,
PRIMARY KEY (AdId),
FOREIGN KEY (Uids) 
        REFERENCES users(Uids)
        ON DELETE CASCADE
)AUTO_INCREMENT=1;
CREATE TABLE Buy
(
AdId int NOT NULL,
Uids int NOT NULL,
PRIMARY KEY (AdId, Uids),
FOREIGN KEY (Uids) 
        REFERENCES users(Uids)
        ON DELETE CASCADE,
FOREIGN KEY (AdId) 
        REFERENCES Sell(AdId)
        ON DELETE CASCADE
);
CREATE TABLE Estate
(
Eids int NOT NULL AUTO_INCREMENT,
Area char(25) NOT NULL,
Price integer NOT NULL,
Etype char(25) NOT NULL,
Surface char(25) NOT NULL,
Room integer NOT NULL,
Bathroom integer NOT NULL,
Additional char(25) NOT NULL,
PRIMARY KEY (Eids)
)AUTO_INCREMENT=1;
CREATE TABLE Placed_For
(
AdId int NOT NULL,
Eids int NOT NULL,
PRIMARY KEY (AdId),
FOREIGN KEY (AdId) 
        REFERENCES Sell(AdId)
        ON DELETE CASCADE,
FOREIGN KEY (Eids) REFERENCES Estate(Eids) ON DELETE CASCADE
);
CREATE TABLE Location
(
City char(25) NOT NULL,
House char(25) NOT NULL,
Street char(25) NOT NULL,
Zip integer NOT NULL,
Eids int NOT NULL,
PRIMARY KEY (Eids),
FOREIGN KEY (Eids) REFERENCES Estate(Eids) ON DELETE CASCADE
);
CREATE TABLE Upload
(
Iids int NOT NULL AUTO_INCREMENT,
Idata char(25) NOT NULL,
Ititle char(25) NOT NULL,
Eids int NOT NULL,
PRIMARY KEY (Iids),
FOREIGN KEY (Eids) REFERENCES Estate(Eids) ON DELETE CASCADE
)AUTO_INCREMENT=1;
