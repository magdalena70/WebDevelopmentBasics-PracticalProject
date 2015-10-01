
CREATE DATABASE ShoppingCart;
USE ShoppingCart

CREATE TABLE Users(
	Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Username varchar(50) NOT NULL UNIQUE,
	Password char(96) NOT NULL,
	FirstName varchar(50) NOT NULL,
	SecondName varchar(50) NOT NULL,
	Email varchar(50),
	TotalPurchases decimal(15,2),
	Reg_date TIMESTAMP
);

GRANT SELECT ON ShoppingCart.Users
TO loginform@localhost
IDENTIFIED BY 'fghjudighfduishgiufdsw';

CREATE USER 'admin'@'localhost';
GRANT RELOAD,PROCESS ON *.* TO 'admin'@'localhost';
FLUSH PRIVILEGES;

ALTER TABLE `users` ADD UNIQUE(`Password`);

CREATE TABLE Products(
	Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ProductName varchar(20) NOT NULL,
	ProductPrice decimal(15,2) NOT NULL,
	IsSold boolean DEFAULT false,
	CategoryId int NOT NULL ,
	Seller_Id int NOT NULL,
	Quantity int NOT NULL,
	Purchaser_Id int
);

CREATE TABLE Categories(
	Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	CategoryName varchar(50) NOT NULL
);

CREATE TABLE ShoppingCarts(
	Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	UserId int NOT NULL,
	Subtotal decimal(15,2),
	Total decimal(15,2),
	Discount decimal(15,2),
	Purchaser_Id int
)

ALTER TABLE shoppingcarts

ADD CONSTRAINT FK_users_carts
FOREIGN KEY (UserId) REFERENCES users(Id)
ON UPDATE CASCADE
ON DELETE CASCADE;

ALTER TABLE shoppingcarts

ADD CONSTRAINT FK_carts_products_purchaser
FOREIGN KEY (Purchaser_Id) REFERENCES products(Purchaser_Id)
ON UPDATE CASCADE
ON DELETE CASCADE;

CREATE TABLE Promotions(
	Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Content text NOT NULL,
	Discount  decimal(15,2) NOT NULL,
	FromDate date NOT NULL,
	ToDate date NOT NULL,
	PromoType varchar(100) NOt NULL,
	CategoryId int
);

ALTER TABLE Products

ADD CONSTRAINT FK_users_sales
FOREIGN KEY (Seller_Id) REFERENCES users(Id)
ON UPDATE CASCADE
ON DELETE CASCADE;

ALTER TABLE Products

ADD CONSTRAINT FK_users_purchases
FOREIGN KEY (Purchaser_Id) REFERENCES users(Id)
ON UPDATE CASCADE
ON DELETE CASCADE;

ALTER TABLE products

ADD CONSTRAINT FK_roduct_category
FOREIGN KEY (CategoryId) REFERENCES categories(Id)
ON UPDATE CASCADE
ON DELETE CASCADE;

--Create view products for purchase
CREATE VIEW ProductsFromOtherSellers AS
SELECT ProductName, ProductPrice, Quantity, isSold FROM products 
JOIN users ON users.id!=products.Seller_Id
ORDER BY ProductPrice;

--SELECT * FROM ProductsFromOtherSellers WHERE isSold = false --

--Create view from current promotion--
CREATE VIEW CurrentPromotion AS
SELECT Content, Discount, FromDate, ToDate, PromoType
FROM Promotions
WHERE FromDate <= CURRENT_DATE()
AND ToDate >= CURRENT_DATE()
ORDER BY Discount DESC LIMIT 1;

--SELECT * FROM CurrentPromotion--