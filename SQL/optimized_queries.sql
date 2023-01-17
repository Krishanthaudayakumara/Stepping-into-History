use history;
#basic query
CREATE INDEX Customer_asc ON Customer(Fname ASC);
SELECT CONCAT(Fname, " ", Lname) AS Name, Email,Phone_number FROM Customer WHERE Fname = "Sanath";

#join 3 tables to find the customers registered for courses

SELECT co.C_id,cu.Fname, cu.Lname, cu.Email,cu.Address,cu.Phone_number, co.Course_name, co.Type
FROM customer cu
INNER JOIN register ON register.customer_id = cu.C_id
INNER JOIN course co ON co.C_id = register.service_id;

 
#join 4 tables and subqueries 
SELECT d.T_id,c.Fname, c.Email,c.Address,c.Phone_number,d.Destination, s.location
FROM ((destination d
INNER JOIN register ON d.T_id = register.service_id)
INNER JOIN Customer c ON register.customer_id = c.C_id)
INNER JOIN service s ON s.id = register.service_id;


#order by ASC
CREATE INDEX Book_price_asc ON Book(Price ASC);
SELECT Book_name, Price FROM Book ORDER BY Price ASC;
 

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
CREATE INDEX Lecturer_names ON Lecturer(Fname ASC, Lname ASC);
SELECT CONCAT(cu.FName," ",cu.Lname) AS Customer_name, l.FName, l.Email AS Lecturer_mail, co.Course_name
FROM(
Customer cu
INNER JOIN Lecturer l ON l.FName = "John")
INNER JOIN register r ON r.customer_id = cu.C_id
INNER JOIN Course co ON co.C_id = r.Service_id;


#select workshop with lecturer and location
SELECT s.id, w.Name as name,l.L_id, CONCAT(l.FName,' ',l.LName) AS lecturer, s.location
FROM
service s
INNER JOIN Lecturer l ON l.W_id = s.id
INNER JOIN workshop w ON w.W_id = s.id;

#course with locaion
SELECT s.id, c.Course_name as name, c.Type, s.location
FROM
service s
JOIN course c ON c.C_id = s.id;

#Select purchase details
SELECT pr.Product_id,p.date , CONCAT(c.Fname, ' ' , c.Lname) AS customer, c.Email, pr.Type
FROM purchase p
JOIN customer c ON c.C_id = p.customer_id
JOIN product pr ON pr.Product_id = p.product_id;

#select all products
SELECT Mag_id AS ID,Title,Price FROM hm_subs
UNION
SELECT Book_id, Book_name, Price FROM book;
