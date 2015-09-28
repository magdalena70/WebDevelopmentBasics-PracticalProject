
CREATE DATABASE ShoppingCart;
USE ShoppingCart

CREATE TABLE Users(
	Id int NOT NULL AUTO_INCREMENT,
	Username varchar(50) NOT NULL UNIQUE,
	Password char(96) NOT NULL,
	FirstName varchar(50) NOT NULL,
	SecondName varchar(50) NOT NULL,
	Email varchar(50),
	InitialCash decimal,
	Reg_date TIMESTAMP,
	ShoppingCartId int,
	PromotionId int,
	PRIMARY KEY(Id)
);

GRANT SELECT ON ShoppingCart.Users
TO loginform@localhost
IDENTIFIED BY 'fghjudighfduishgiufdsw';

CREATE TABLE Products(
	Id int NOT NULL AUTO_INCREMENT,
	ProductName varchar(100) NOT NULL,
	ProductPrice decimal NOT NULL,
	IsSold boolean DEFAULT false,
	CategoryId int NOT NULL ,
	UserId int NOT NULL,
	PromotionId int,
	PRIMARY KEY(Id) 
);

CREATE TABLE Categories(
	Id int NOT NULL AUTO_INCREMENT,
	CategoryName varchar(100) NOT NULL,
	PromotionId int,
	PRIMARY KEY(Id),
	FOREIGN KEY(PromotionId) REFERENCES Promotions(Id)
);

CREATE VIEW [Categories List] AS
SELECT CategoryName,
FROM Categories

--SELECT * FROM [Categories List]

CREATE TABLE ShoppingCarts(
	Id int NOT NULL AUTO_INCREMENT,
	UserId int NOT NULL,
	ProductId int,
	ProductPrice decimal,
	TotalSum decimal DEFAULT SUM(ProductPrice)
	PRIMARY KEY(Id),
	FOREIGN KEY(ProductId) REFERENCES Products(Id), 
	FOREIGN KEY(UserId) KEY REFERENCES Users(Id)
)

CREATE TABLE Promotions(
	Id int NOT NULL AUTO_INCREMENT,
	Discount  decimal NOT NULL,
	FromDate date NOT NULL DEFAULT CURDATE(),
	ToDate date NOT NULL DEFAULT DATE_ADD(FromDate,INTERVAL 3 DAY),
	UserId int,
	ProductId int,
	CategoryId int,
	PRIMARY KEY(Id),
	FOREIGN(UserId) KEY REFERENCES Users(Id),
	FOREIGN KEY(ProductId) REFERENCES Products(Id),
	FOREIGN KEY(CategoryId) REFERENCES Categories(Id),
);

CREATE VIEW [Promotions List] AS
SELECT Id, Discount,
FROM Promotions

--SELECT * FROM [Promotions List]

CREATE TABLE UserPurchases(
	Id int NOT NULL AUTO_INCREMENT,
	ShoppingCartId int NOT NULL,
	ShoppingCartTotalSum decimal NOT NULL,
	PurchasesSum decimal NOT NULL DEFAULT SUM(ShoppingCartsTotalSum)
	UserId int NOT NULL,
	PRIMARY KEY(Id), 
	FOREIGN KEY(UserId) KEY REFERENCES Users(Id),
	FOREIGN KEY(ShoppingCartId) KEY REFERENCES ShoppingCarts(Id)
)