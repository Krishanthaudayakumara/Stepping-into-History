DROP DATABASE IF EXISTS  History;

CREATE DATABASE History;

USE History;

CREATE TABLE Product(
	Product_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Type VARCHAR(255)
);

CREATE TABLE Book(
	Book_id INT NOT NULL,
    Author VARCHAR(255),
    Price VARCHAR(255),
    Book_name VARCHAR(255),
	FOREIGN KEY (Book_id) REFERENCES Product(Product_id)
);

CREATE TABLE HM_Subs(
	Mag_id INT NOT NULL,
    Title VARCHAR(255),
    Price VARCHAR(255),
    issue_date DATE,
    Type VARCHAR(255),
	FOREIGN KEY (Mag_id) REFERENCES Product(Product_id)
);

CREATE TABLE Service (
	 id INT NOT NULL AUTO_INCREMENT,
     service_name VARCHAR(255),
	 location VARCHAR(255),
	 PRIMARY KEY(id)
);

CREATE TABLE Customer(
	C_id INT NOT NULL AUTO_INCREMENT,
    Fname VARCHAR(255),
    Lname VARCHAR(255),
    Email VARCHAR(255),
    Bday DATE,
    Address VARCHAR(255),
    Phone_number VARCHAR(255),
    PRIMARY KEY(C_id)
);

CREATE TABLE GR_and_FT (
	serv_id INT NOT NULL,
	type VARCHAR(255),
	FOREIGN KEY (serv_id) REFERENCES Service(id)
);

CREATE TABLE Tour(
	T_id INT NOT NULL,
	T_date DATE,
	T_time TIME,
	FOREIGN KEY (T_id) REFERENCES service(id)
);

CREATE TABLE Destination(
	T_id INT NOT NULL,
	Destination VARCHAR(255) NOT NULL,
	FOREIGN KEY (T_id) REFERENCES service(id)
);

CREATE TABLE HD_and_BL(
	D_id INT NOT NULL,
	Name VARCHAR(255) NOT NULL,
	Type VARCHAR(255),
	Doc_Location VARCHAR(255),
	FOREIGN KEY (D_id) REFERENCES service(id)
);

CREATE TABLE Doc_Location(
	D_id INT NOT NULL,
	Doc_Location VARCHAR(255) NOT NULL,
	FOREIGN KEY (D_id) REFERENCES service(id)
);

CREATE TABLE Workshop(
	W_id INT NOT NULL,
	Name VARCHAR(255),
	FOREIGN KEY (W_id) REFERENCES service(id)
);

CREATE TABLE Course(
	C_id INT NOT NULL,
	Name VARCHAR(255),
	Type VARCHAR(255),
	FOREIGN KEY (C_id) REFERENCES service(id)
);

CREATE TABLE Lecturer(
	L_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	FName VARCHAR(255),
	LName VARCHAR(255),
	Email VARCHAR(255),
	B_day DATE,
	C_id INT NOT NULL,
	W_id INT NOT NULL,
	FOREIGN KEY (C_id) REFERENCES service(id),
	FOREIGN KEY (W_id) REFERENCES service(id)

);

CREATE TABLE Contact_number(
	L_id INT NOT NULL,
	contact_number VARCHAR(255),
	FOREIGN KEY (L_id) REFERENCES Lecturer(L_id)
);

CREATE TABLE Purchase(
	customer_id INT NOT NULL,
    product_id INT NOT NULL,
    date DATE,
    FOREIGN KEY (customer_id) REFERENCES customer(C_id),
    FOREIGN KEY (product_id) REFERENCES product(Product_id)
);

CREATE TABLE Register(
	customer_id INT NOT NULL,
    service_id INT NOT NULL,
    date DATE,
    FOREIGN KEY (customer_id) REFERENCES customer(C_id),
    FOREIGN KEY (service_id) REFERENCES service(id)
);


/* https://dba.stackexchange.com/questions/35302/er-diagram-translation-to-tables
*/

-- insert into Service(taken_date, taken_time) value('2021/06/10', '17:50:55');
-- Select @last_id := (MAX(id)) From Service;
-- INSERT INTO Course(C_id,Name, Type) VALUES (@last_id,'Fundamentals Of History' , 'Online');
-- INSERT into Service(service_name, location) value('HD and BL', '$Location');

-- INSERT INTO hd_and_bl(D_id,Name, Type, Doc_Location) VALUES ((Select MAX(id) From Service),'$Name' , '$Type', '$Doc_Location');

