USE history;

INSERT INTO Service(service_name, location)
 VALUE
	("tour", "UK"),
    ("tour", "India"),
    ("GR and FT", "virtual"),
    ("GR and FT", "Colombo"),
    ("HD and BL", "Colombo"),
    ("HD and BL", "Kandy"),
	("workshop", "Colombo"),
    ("workshop", "Kandy"),
    ("course", "Colombo"),
    ("course", "Kandy")
    ;
    
 INSERT INTO Tour(T_id,T_date, T_time)  
 VALUE
 (1,"2022/02/10","03:00:00"),
 (2,"2022/03/10","03:00:00");
 
 
 INSERT INTO gr_and_ft(serv_id, type)
 VALUE 
 (3,"GR"),
 (4,"both");
 
 INSERT INTO hd_and_bl(D_id, Name, Type, Doc_Location)
 VALUES
 (5,"The Constitution", "book", "Yokshire"),
 (6,"Magna Carta", "document", "Bristol");
 
INSERT INTO Workshop(W_id, Name)
VALUES
(7,"Portals to the Past | Inspiring history workshops for schools"),
(8,"World History Workshop");

INSERT INTO Course(C_id, Name, Type)
VALUES
(9,"Forensic Archaeology and Anthropology","On Premises"),
(10,"Genealogy: Researching Your Family Tree","On Premises");


INSERT INTO Product(Type) 
VALUES ("book"),("book"),("book"),("magazine"),("magazine");

INSERT INTO Book(Book_id,Book_name,Author,Price) 
VALUES
(1,"The Ottomans: Khans, Caesars and Caliphs","Marc David Baer","800"),
(2,"The First World War","Michael Howard","900"),
(3,"The Greeks and the Irrational","E R Dodds","750");

INSERT INTO HM_subs(Mag_id, Title, Price, issue_date, Type)
VALUES
(4, "England History", 200, "2022/07/10", "Online"),
(5, "Step Into Past", 300, "2022/08/10", "Online");

INSERT INTO Customer(Fname,Lname,Email,Bday,Address,Phone_number)
VALUES
 ("Sanath","Kumara","sanath@gmail.com","1988/12/15","26/8,Katubadda, Moratuwa","0774589641"),
 ("Nadun","Silva","nadun@gmail.com","1998/12/25","26/7,Weera Mavatha, Gampaha","0774589641"),
  ("Nimesh","Silva","nimesh@gmail.com","1999/10/25","25/7,Sahana Mavatha, Gampaha","0785689641");

INSERT INTO Destination(T_id,Destination)
VALUES
(1,"Edinburgh"),
(1,"Ancient Stonehenge and Medieval Salisbury"),
(1,"Idyllic England: The Cotswolds"),
(2,"Shimla, Himachal Pradesh"),
(2,"Nainital, Uttarakhand");

INSERT INTO Lecturer(FName, LName, Email, B_day, C_id, W_id)
VALUES
("John","Edmon","john@gmail.com","1985/05/12", 9,7),
("Anna","Silvia","anna@gmail.com","1975/02/16", 10,7),
("Semon","Silva","semon@gmail.com","1986/08/26", 9,8);

INSERT INTO purchase(customer_id, product_id, date)
VALUES
(1,2,"2022/10/18"),
(2,3,"2022/10/18");

INSERT INTO register(customer_id, service_id, date)
VALUES
(1,3,"2022/10/18"),
(2,4,"2022/10/17"),
(1,9,"2022/10/17"),
(3,10,"2022/10/17");





