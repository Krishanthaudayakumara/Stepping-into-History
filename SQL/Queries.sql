#basic query
SELECT * FROM Customer WHERE Fname = "Sanath";

#Renaming columnhd_and_bl
ALTER TABLE Course CHANGE Name Course_name VARCHAR(255);

#join 3 tables to find the customers registered for courses
SELECT course.C_id,Customer.Fname, Customer.Lname, Customer.Email,Customer.Address,Customer.Phone_number, course.Course_name, Course.Type
FROM customer
INNER JOIN register ON register.customer_id = Customer.C_id
INNER JOIN course ON course.C_id = register.service_id;

 
#join 4 tables and subqueries 
SELECT destination.T_id,Customer.Fname, Customer.Email,Customer.Address,Customer.Phone_number,destination.Destination, service.location
FROM ((destination
INNER JOIN register ON destination.T_id = register.service_id)
INNER JOIN Customer ON register.customer_id = Customer.C_id)
INNER JOIN service ON service.id = register.service_id;


#order by ASC
 SELECT * FROM Book ORDER BY Price ASC;
 
 #count
SELECT COUNT(C_id)
FROM Customer;

#Max
SELECT MAX(Price),Book_name,Author FROM Book;


#union and SQL Aliases
SELECT W_id AS id, Name FROM Workshop
UNION ALL
SELECT C_id, Course_name AS id FROM Course;

#lecture details
SELECT CONCAT(FName," ",Lname) AS Lecturer_name, Email 
FROM Lecturer;

#The customers who got John as him/her lecturer in course
SELECT CONCAT(Customer.FName," ",Customer.Lname) AS Customer_name, Lecturer.FName, Lecturer.Email AS Lecturer_mail, Course.Course_name
FROM(
Customer
INNER JOIN Lecturer ON Lecturer.FName = "John")
INNER JOIN register ON register.customer_id = Customer.C_id
INNER JOIN Course ON Course.C_id = register.Service_id;


#select workshop with lecturer and location
SELECT service.id, workshop.Name as name,lecturer.L_id, CONCAT(lecturer.FName,' ',lecturer.LName) AS lecturer, service.location
FROM
service
INNER JOIN Lecturer ON Lecturer.W_id = service.id
INNER JOIN workshop ON workshop.W_id = service.id;

#course with locaion
SELECT service.id, course.Course_name as name, course.Type, service.location
FROM
service
JOIN course ON course.C_id = service.id;

#Select purchase details
SELECT product.Product_id,purchase.date , CONCAT(customer.Fname, ' ' , customer.Lname) AS customer, customer.Email, product.Type
FROM purchase
JOIN customer ON customer.C_id = purchase.customer_id
JOIN product ON product.Product_id = purchase.product_id;

#select all products
SELECT Mag_id AS ID,Title,Price FROM hm_subs
UNION
SELECT Book_id, Book_name, Price FROM book;

