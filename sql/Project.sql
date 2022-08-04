DROP DATABASE IF EXISTS Project;
CREATE DATABASE IF NOT EXISTS Project;
USE Project;

create table Customer (
	CustomerID INT AUTO_INCREMENT PRIMARY KEY,
	Name VARCHAR(35),
	Phone NUMERIC(10),
	Email VARCHAR(35),
    password VARCHAR(255)
) Engine=InnoDB;

insert into Customer (CustomerID, Name, Phone, Email, password) values (1000, 'Chelsy', 2366658956, 'chelsy@student.douglascollege.ca', '12345');

create table Orders (
	OrderID INT AUTO_INCREMENT PRIMARY KEY,
    CustomerID INT,
    Date date,
    FOREIGN KEY (CustomerID) REFERENCES Customer (CustomerID) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB;

create table Food (
    FoodID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(30),
    SmallPrice DOUBLE,
    MediumPrice DOUBLE,
    LargePrice DOUBLE

) Engine=InnoDB;

insert into Food (FoodID, Name, SmallPrice, MediumPrice, LargePrice) values (1, 'Pizza', 8, 12, 18);
insert into Food (FoodID, Name, SmallPrice, MediumPrice, LargePrice) values (2, 'Brownie', 4, 6, 8);
insert into Food (FoodID, Name, SmallPrice, MediumPrice, LargePrice) values (3, 'Burger', 10, 13.5, 15.5);
insert into Food (FoodID, Name, SmallPrice, MediumPrice, LargePrice) values (4, 'Pasta', 13.5, 17.6, 24.8);
insert into Food (FoodID, Name, SmallPrice, MediumPrice, LargePrice) values (5, 'Sandwich', 6, 10.5, 12.7);
insert into Food (FoodID, Name, SmallPrice, MediumPrice, LargePrice) values (6, 'Wraps', 5, 8, 12.2);
insert into Food (FoodID, Name, SmallPrice, MediumPrice, LargePrice) values (7, 'Potato Fries', 5, 7.9, 12.3);
insert into Food (FoodID, Name, SmallPrice, MediumPrice, LargePrice) values (8, 'Taco', 3.5, 6.8, 10.7);
insert into Food (FoodID, Name, SmallPrice, MediumPrice, LargePrice) values (9, 'Spaghetti', 10, 15, 21);
insert into Food (FoodID, Name, SmallPrice, MediumPrice, LargePrice) values (10, 'Hotdogs', 5.5, 7.6, 10);


create table OrderDetails (
    RecordID INT AUTO_INCREMENT PRIMARY KEY,
    OrderID INT,
    FoodID INT,
    Size DOUBLE,
    Quantity INT, 
    Price DOUBLE,   
    FOREIGN KEY (OrderID) REFERENCES Orders (OrderID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (FoodID) REFERENCES Food (FoodID) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB;

-- insert into OrderDetails (RecordID, OrderID, SmallPrice, MediumPrice, LargePrice) values (1, 'Pizza', 8, 12, 18);

