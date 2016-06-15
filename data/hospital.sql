DROP DATABASE hospital;
CREATE DATABASE hospital;
USE hospital;
/*
DROP TABLE ChecksIn;
DROP TABLE ManagedBy;
DROP TABLE MedicalRecord_Has;
DROP TABLE Prescribes;
DROP TABLE Prescription;
DROP TABLE Oversees;
DROP TABLE Room_Assignedto;
DROP TABLE Patient_Attendedby;
DROP TABLE Receptionist;
DROP TABLE Nurse;
DROP TABLE Doctor;
DROP TABLE Employee;
*/

create table Employee(fname TEXT,
  lname TEXT,
  email VARCHAR(40) NOT NULL,
  eid INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  UNIQUE (email));
insert into Employee(fname, lname, email) values ("jr", "kim", "drkim@hospital.com");
insert into Employee(fname, lname, email) values ("vin", "chan", "vchan@hospital.com");
insert into Employee(fname, lname, email) values ("yves", "chan", "ychan@hospital.com");
insert into Employee(fname, lname, email) values ("hai", "hoang", "hhoang@hospital.com");
insert into Employee(fname, lname, email) values ("oscar", "lu", "olu@hospital.com");
insert into Employee(fname, lname, email) values ("yushen", "zu", "yzu@hospital.com");
insert into Employee(fname, lname, email) values ("tingting", "tai", "tttai@hospital.com");
insert into Employee(fname, lname, email) values ("haip", "hoangp", "hhoangp@hospital.com");
insert into Employee(fname, lname, email) values ("steve", "lim", "slim@hospital.com");
insert into Employee(fname, lname, email) values ("will", "smith", "wsmith@hospital.com");
insert into Employee(fname, lname, email) values ("james", "harden", "jharden@hospital.com");

insert into Employee(fname, lname, email) values ("roger", "lee", "rlee@hospital.com");
insert into Employee(fname, lname, email) values ("ha", "nguyen", "hnguyen@hospital.com");
insert into Employee(fname, lname, email) values ("tina", "fan", "tfan@hospital.com");
insert into Employee(fname, lname, email) values ("ferris", "bueler", "fbueler@hospital.com");
insert into Employee(fname, lname, email) values ("matt", "damon", "mdamon@hospital.com");


create table Doctor(eid INTEGER NOT NULL PRIMARY KEY,
    specialization TEXT,
    FOREIGN KEY fk_employee(eid) REFERENCES Employee(eid));

insert into Doctor values (1, "Neurosurgeon");
insert into Doctor values (2, "Cardiologist");
insert into Doctor values (3, "Gynecologist");
insert into Doctor values (4, "Internal Medicine");
insert into Doctor values (5, "Gynecologist");

create table Nurse(eid INTEGER NOT NULL PRIMARY KEY,
    FOREIGN KEY fk_employee(eid) REFERENCES Employee(eid));

insert into Nurse values (6);
insert into Nurse values (7);
insert into Nurse values (8);
insert into Nurse values (9);
insert into Nurse values (10);

create table Receptionist(eid INTEGER PRIMARY KEY,
    FOREIGN KEY fk_employee(eid) REFERENCES Employee(eid));

insert into Receptionist values (11);
insert into Receptionist values (12);
insert into Receptionist values (13);
insert into Receptionist values (14);
insert into Receptionist values (15);

create table Patient_Attendedby(fname TEXT,
    lname TEXT,
    age INTEGER,
    address TEXT,
    sex TEXT,
    carecardnum INTEGER PRIMARY KEY,
    eid INTEGER,
    FOREIGN KEY fk_employee(eid) REFERENCES Employee(eid),
    CHECK(carecardnum < 10000 AND carecardnum > 999));

insert into Patient_Attendedby values ("drizzy", "drake", '18', '123 fake st', 'male', '1234', '1');
insert into Patient_Attendedby values ("jessica", "alba", '25', '13 some st', 'female', '2345', '1');
insert into Patient_Attendedby values ("sansa", "stark", '12', '23 another st', 'female', '8204', '2');
insert into Patient_Attendedby values ("jon", "snow", '13', '1 wall st', 'male', '2920', '3');
insert into Patient_Attendedby values ("kate", "beckinsale", '69', '45 dewd st', 'female', '5620', '5');

create table Room_Assignedto(floornum INTEGER,
    roomnum INTEGER,
    carecardnum INTEGER,
    PRIMARY KEY (floornum, roomnum),
    FOREIGN KEY fk_patient(carecardnum) REFERENCES Patient_Attendedby(carecardnum)
    ON DELETE SET NULL,
    CHECK (carecardnum < 10000 AND carecardnum > 999),
    CHECK (roomnum >= 1 AND roomnum <= 30),
    CHECK (floornum>= 1 AND floornum <= 20));

insert into Room_Assignedto values (1, 1, null);
insert into Room_Assignedto values (1, 2, null);
insert into Room_Assignedto values (1, 3, null);
insert into Room_Assignedto values (2, 1, 1234);
insert into Room_Assignedto values (2, 2, 2345);
insert into Room_Assignedto values (2, 3, null);
insert into Room_Assignedto values (3, 1, 8204);
insert into Room_Assignedto values (3, 2, 2920);
insert into Room_Assignedto values (3, 3, null);

create table Oversees(eid INTEGER,
    floornum INTEGER,
    roomnum INTEGER,
    PRIMARY KEY (eid, roomnum, floornum),
    FOREIGN KEY fk_employee(eid) REFERENCES Employee(eid),
    FOREIGN KEY fk_room(floornum, roomnum) REFERENCES Room_Assignedto(floornum, roomnum));


insert into Oversees values (6, 1, 1);
insert into Oversees values(7, 1, 1);
insert into Oversees values (8, 2, 1);
insert into Oversees values (6, 2, 1);
insert into Oversees values (10, 1, 3);
insert into Oversees values (9, 3, 3);

create table Prescription(type TEXT NOT NULL,
    prescriptionID INTEGER PRIMARY KEY,
    drugID INTEGER NOT NULL,
    dosage INTEGER);

insert into Prescription values ("viagra", 0, 123, 2);
insert into Prescription values ("meth", 1, 343, 4);
insert into Prescription values ("cocaine", 2, 193, 1);
insert into Prescription values ("insulin", 3, 483, 5);
insert into Prescription values ("aspirin", 4, 579, 2);

create table Prescribes(eid INTEGER,
    prescriptionID INTEGER,
    carecardnum INTEGER,
    loggedDate DATE,
    PRIMARY KEY (eid, prescriptionID, carecardnum),
    FOREIGN KEY fk_employee(eid) REFERENCES Employee(eid),
    FOREIGN KEY fk_prescription(prescriptionID) REFERENCES Prescription(prescriptionID) 
    ON DELETE CASCADE,
    FOREIGN KEY fk_patient(carecardnum) REFERENCES Patient_Attendedby(carecardnum)
    ON DELETE CASCADE,
    CHECK (carecardnum < 10000 AND carecardnum > 999));

insert into Prescribes values (1, 0, 1234, '2015-04-13 11:11:11');
insert into Prescribes values (1, 1, 1234, '2015-04-14 11:11:03');
insert into Prescribes values (1, 2, 1234, '2015-04-11 11:11:01');
insert into Prescribes values (1, 3, 1234, '2015-02-13 11:10:03');    
insert into Prescribes values (1, 4, 1234, '2015-03-13 11:10:02');    
insert into Prescribes values (1, 1, 2345, '2015-06-13 11:11:09');
insert into Prescribes values (2, 3, 8204, '2015-05-13 11:11:10');
insert into Prescribes values (3, 4, 2920, '2015-07-13 11:11:12');
insert into Prescribes values (5, 2, 5620, '2015-04-17 11:11:13');

create table MedicalRecord_Has(mid INTEGER, medicalStatus TEXT, carecardnum INTEGER,
    PRIMARY KEY (mid, carecardnum), 
    UNIQUE (mid),
    FOREIGN KEY fk_patient(carecardnum) REFERENCES Patient_Attendedby(carecardnum)
    ON DELETE CASCADE);

Insert into MedicalRecord_Has values(1, "diarrhea", 1234);
Insert into MedicalRecord_Has values(2, "heart burn", 2345);
Insert into MedicalRecord_Has values(3, "pregnancy", 2920);
Insert into MedicalRecord_Has values(4, "broke foot", 5620);
Insert into MedicalRecord_Has values(5, "coughing too much", 8204);

create table ChecksIn(eid INTEGER,
    carecardnum INTEGER,
    PRIMARY KEY (eid, carecardnum),
    FOREIGN KEY fk_employee(eid) REFERENCES Employee(eid),
    FOREIGN KEY fk_patient(carecardnum) REFERENCES Patient_Attendedby(carecardnum)
    ON DELETE CASCADE,
    CHECK (carecardnum < 10000 AND carecardnum>999)); 

insert into ChecksIn values (11, 1234);
insert into ChecksIn values (12, 2345);
insert into ChecksIn values (13, 8204);
insert into ChecksIn values (14, 2920);
insert into ChecksIn values (14, 5620);

create table ManagedBy(loggedDate TIMESTAMP, mid INTEGER, carecardnum INTEGER, eid INTEGER,
    PRIMARY KEY (mid, carecardnum, eid),
    FOREIGN KEY fk_medicalrecord(mid) REFERENCES MedicalRecord_Has(mid)
    ON DELETE CASCADE,
    FOREIGN KEY fk_patient(carecardnum) REFERENCES Patient_Attendedby(carecardnum)
    ON DELETE CASCADE,
    FOREIGN KEY fk_employee(eid) REFERENCES Employee(eid),
    CHECK (carecardnum<10000 AND carecardnum > 999));

Insert into ManagedBy values ('2015-04-13 11:11:11', 1, 1234, 1);
Insert into ManagedBy values ('2015-06-13 11:11:09', 2, 2345, 2);
Insert into ManagedBy values ('2015-05-13 11:11:10', 3, 2920, 3);
Insert into ManagedBy values ('2015-07-13 11:11:12', 4, 5620, 4);
Insert into ManagedBy values ('2015-04-17 11:11:13', 5, 8204, 5);

show tables;
/*
select fname from Doctor d, Employee e where e.eid = d.eid and specialization="Neurosurgeon";
*/
