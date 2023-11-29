CREATE DATABASE farmermarket;

USE farmermarket;

CREATE TABLE Users (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  Username VARCHAR(25) UNIQUE,
  Password VARCHAR(64),
  Type CHAR(1),
  Name VARCHAR(35),
  Contact VARCHAR(10),
  Email VARCHAR(60),
  Location VARCHAR(60)
);

CREATE TABLE Category (
  CatID INT PRIMARY KEY,
  Category VARCHAR(35)
);

CREATE TABLE Product (
  ProductID INT PRIMARY KEY,
  ProductName VARCHAR(35),
  CatID INT,
  Price INT,
  Quantity_avail INT,
  FarmerID INT,
  FOREIGN KEY(FarmerID) REFERENCES Users(ID),
  FOREIGN KEY(CatID) REFERENCES Category(CatID)
);

CREATE TABLE Orders (
  OrderID INT PRIMARY KEY AUTO_INCREMENT,
  OrderDate DATE,
  CustID INT,
  FOREIGN KEY(CustID) REFERENCES Users(ID)
);

CREATE TABLE OrderProducts (
  OrderID INT,
  ProductID INT,
  Quantity INT,
  Amount INT,
  PRIMARY KEY (OrderID, ProductID),
  FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
  FOREIGN KEY (ProductID) REFERENCES Product(ProductID)
);


-- Add Vegetables
INSERT INTO Category (CatID, Category) VALUES (1, 'Vegetables');

-- Add Fruits
INSERT INTO Category (CatID, Category) VALUES (2, 'Fruits');

-- Add Dry Fruits
INSERT INTO Category (CatID, Category) VALUES (3, 'Dry Fruits');


-- Insert Farmers
INSERT INTO Users (Username, Password, Type, Name, Contact, Email, Location)
VALUES
  ('farmerRaj', 'raj123', 'F', 'Raj Kumar', '1234567890', 'raj.kumar@gmail.com', 'Central Delhi'),
  ('farmerNeha', 'neha456', 'F', 'Neha Sharma', '9876543210', 'neha.sharma@yahoo.co.in', 'East Delhi');

-- Insert Vendors
INSERT INTO Users (Username, Password, Type, Name, Contact, Email, Location)
VALUES
  ('vendorAnkit', 'ankit789', 'V', 'Ankit Verma', '3456789012', 'ankit.verma@gmail.com', 'North Delhi'),
  ('vendorPooja', 'pooja012', 'V', 'Pooja Singh', '5678901234', 'pooja.singh@yahoo.co.in', 'North East Delhi');

-- Insert Customers
INSERT INTO Users (Username, Password, Type, Name, Contact, Email, Location)
VALUES
  ('customerVivek', 'vivek345', 'C', 'Vivek Yadav', '7890123456', 'vivek.yadav@gmail.com', 'South Delhi'),
  ('customerAisha', 'aisha678', 'C', 'Aisha Khan', '9012345678', 'aisha.khan@yahoo.co.in', 'South West Delhi');

  -- Insert Farmers
INSERT INTO Users (Username, Password, Type, Name, Contact, Email, Location)
VALUES
  ('farmerVijay', 'vijay789', 'F', 'Vijay Singh', '9876543212', 'vijay.singh@gmail.com', 'West Delhi'),
  ('farmerPriya', 'priya012', 'F', 'Priya Verma', '9876543213', 'priya.verma@yahoo.co.in', 'North Delhi'),
  ('farmerAnjali', 'anjali345', 'F', 'Anjali Yadav', '9876543214', 'anjali.yadav@gmail.com', 'South Delhi');

-- Insert Vendors
INSERT INTO Users (Username, Password, Type, Name, Contact, Email, Location)
VALUES
  ('vendorSuresh', 'suresh789', 'V', 'Suresh Kumar', '9876543217', 'suresh.kumar@gmail.com', 'South West Delhi'),
  ('vendorMeera', 'meera012', 'V', 'Meera Kapoor', '9876543218', 'meera.kapoor@yahoo.co.in', 'Central Delhi'),
  ('vendorRahul', 'rahul345', 'V', 'Rahul Sharma', '9876543219', 'rahul.sharma@gmail.com', 'East Delhi');

-- Insert Customers
INSERT INTO Users (Username, Password, Type, Name, Contact, Email, Location)
VALUES
  ('customerRajat', 'rajat789', 'C', 'Rajat Verma', '9876543222', 'rajat.verma@gmail.com', 'North Delhi'),
  ('customerNeha', 'neha012', 'C', 'Neha Singh', '9876543223', 'neha.singh@yahoo.co.in', 'North East Delhi'),
  ('customerPreeti', 'preeti345', 'C', 'Preeti Kapoor', '9876543224', 'preeti.kapoor@gmail.com', 'Central Delhi');



-- Insert Products for FarmerID 1
INSERT INTO Product (ProductID, ProductName, CatID, Price, Quantity_avail, FarmerID)
VALUES
  (1, 'Tomato', 1, 10, 100, 1),
  (2, 'Potato', 1, 15, 80, 1),
  (5, 'Carrot', 1, 18, 70, 1),
  (10, 'Mango', 2, 35, 30, 1);

-- Insert Products for FarmerID 2
INSERT INTO Product (ProductID, ProductName, CatID, Price, Quantity_avail, FarmerID)
VALUES
  (3, 'Apple', 2, 25, 50, 2),
  (4, 'Banana', 2, 20, 60, 2),
  (6, 'Orange', 2, 30, 40, 2);

ALTER TABLE Product
ADD COLUMN Image VARCHAR(255);

UPDATE Product SET Image = 'images/tomato.jpg' WHERE ProductID = 1;
UPDATE Product SET Image = 'images/potato.jpg' WHERE ProductID = 2;
UPDATE Product SET Image = 'images/apple.jpg' WHERE ProductID = 3;
UPDATE Product SET Image = 'images/banana.jpg' WHERE ProductID = 4;
UPDATE Product SET Image = 'images/carrot.jpg' WHERE ProductID = 5;
UPDATE Product SET Image = 'images/orange.jpeg' WHERE ProductID = 6;
UPDATE Product SET Image = 'images/mango.jpg' WHERE ProductID = 10;

-- Insert Almond
INSERT INTO Product (ProductName, CatID, Price, Quantity_avail, FarmerID, Image)
VALUES (7,'Almond', 3, 15, 50, 1, 'images/almond.jpg');

-- Insert Cashew
INSERT INTO Product (ProductName, CatID, Price, Quantity_avail, FarmerID, Image)
VALUES (8,'Cashew', 3, 20, 40, 2, 'images/cashew.jpeg');

-- Insert Raisin
INSERT INTO Product (ProductName, CatID, Price, Quantity_avail, FarmerID, Image)
VALUES (9,'Raisin', 3, 10, 60, 1, 'images/raisin.jpg');

USE farmermarket;
-- Insert Products for FarmerID 3
INSERT INTO Product
VALUES
  (11,'Potato', 1, 22, 45, 3, 'images/potato.jpg'),
  (12,'Carrot', 1, 40, 25, 3, 'images/carrot.jpg'),
  (13,'Orange', 2, 18, 30, 3, 'images/orange.jpeg');

-- Insert Products for FarmerID 4
INSERT INTO Product
VALUES
  (14,'Cashew', 3, 12, 60, 4, 'images/cashew.jpeg'),
  (15,'Almond', 3, 28, 35, 4, 'images/almond.jpg'),
  (16,'Raisin', 3, 25, 20, 4, 'images/raisin.jpg');

-- Insert Products for FarmerID 5
INSERT INTO Product
VALUES
  (17,'Banana', 2, 15, 40, 5, 'images/banana.jpg'),
  (18,'Apple', 2, 30, 30, 5, 'images/apple.jpg');

CREATE TABLE ProductImages (
  ProductName VARCHAR(35) PRIMARY KEY,
  Image VARCHAR(255)
);

INSERT INTO ProductImages (ProductName, Image)
VALUES
  ('Tomato', 'images/tomato.jpg'),
  ('Potato', 'images/potato.jpg'),
  ('Apple', 'images/apple.jpg'),
  ('Banana', 'images/banana.jpg'),
  ('Carrot', 'images/carrot.jpg'),
  ('Orange', 'images/orange.jpeg'),
  ('Mango', 'images/mango.jpg'),
  ('Almond', 'images/almond.jpg'),
  ('Cashew', 'images/cashew.jpeg'),
  ('Raisin', 'images/raisin.jpg');

CREATE TABLE Cart (
  CustomerID INT,
  ProductID INT,
  Quantity INT,
  PRIMARY KEY(CustomerID, ProductID, Quantity),
  FOREIGN KEY(CustomerID) REFERENCES Users(ID),
  FOREIGN KEY(ProductID) REFERENCES Product(ProductID)
);