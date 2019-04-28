-- Created by Sebastian Byczkowski
-- Created 9/12/2017

-- Drops and creates tables.

-- DROP removes tables and data from the WP Database.
-- Will only drop tables if they actually exist; hence the IF EXIST clause.

-- CREATE will create the necessary tables for the WP Database.
-- Script will create Department, Employee, Project and Assignment tables along
-- with all the necessary constraints.

-- Last Mod: 03/31/2019

DROP TABLE IF EXISTS ASSIGNMENT;
DROP TABLE IF EXISTS EMPLOYEE;
DROP TABLE IF EXISTS PROJECT;
DROP TABLE IF EXISTS DEPARTMENT;

COMMIT;

CREATE TABLE DEPARTMENT (
                DepartmentName CHAR(35) NOT NULL,
                BudgetCode CHAR(30) NOT NULL,
                OfficeNumber CHAR(15) NOT NULL,
                DepartmentPhone CHAR(12) NOT NULL,
                CONSTRAINT Department_PK PRIMARY KEY (DepartmentName)
);


CREATE TABLE Employee (
                EmployeeNumber INT AUTO_INCREMENT NOT NULL,
                FirstName CHAR(25) NOT NULL,
                LastName CHAR(25) NOT NULL,
                Department CHAR(35) NOT NULL DEFAULT "Human Resources",
                Position CHAR(35),
                Supervisor CHAR(35),
                OfficePhone CHAR(12),
                EmailAddress VARCHAR(100) NOT NULL,
                Username VARCHAR(15) NOT NULL,
                Password VARCHAR(15) NOT  NULL,
                CONSTRAINT Employee_Num_PK PRIMARY KEY (EmployeeNumber)
);


CREATE UNIQUE INDEX employee_idx
 ON Employee
 ( EmailAddress );

CREATE TABLE Project (
                ProjectID INT NOT NULL,
                ProjectName CHAR(50) NOT NULL,
                Department CHAR(35) NOT NULL,
                MaxHours NUMERIC(8,2) DEFAULT 100 NOT NULL,
                StartDate DATE,
                EndDate DATE,
                CONSTRAINT Project_ID_PK PRIMARY KEY (ProjectID)
);


CREATE TABLE Assignment (
                ProjectID INT NOT NULL,
                EmployeeNumber INT NOT NULL,
                HoursWorked NUMERIC(6,2),
                CONSTRAINT Assignment_PK PRIMARY KEY (ProjectID, EmployeeNumber)
);


ALTER TABLE Project ADD CONSTRAINT department_project_fk
FOREIGN KEY (Department)
REFERENCES DEPARTMENT (DepartmentName)
ON DELETE NO ACTION
ON UPDATE CASCADE;

ALTER TABLE Employee ADD UNIQUE(Username);

ALTER TABLE Employee ADD CONSTRAINT department_employee_fk
FOREIGN KEY (Department)
REFERENCES DEPARTMENT (DepartmentName)
ON DELETE NO ACTION
ON UPDATE CASCADE;

ALTER TABLE Employee ADD CONSTRAINT employee_employee_fk
FOREIGN KEY (Supervisor)
REFERENCES Employee (EmployeeNumber)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Assignment ADD CONSTRAINT employee_assignment_fk
FOREIGN KEY (EmployeeNumber)
REFERENCES Employee (EmployeeNumber)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Assignment ADD CONSTRAINT project_assignment_fk
FOREIGN KEY (ProjectID)
REFERENCES Project (ProjectID)
ON DELETE CASCADE
ON UPDATE NO ACTION;


/*****   DEPARTMENT DATA   ******************************************************/

INSERT INTO DEPARTMENT VALUES('Administration', 'BC-100-10', 'BLDG01-210', '360-285-8100');
INSERT INTO DEPARTMENT VALUES('Legal', 'BC-200-10', 'BLDG01-220', '360-285-8200');
INSERT INTO DEPARTMENT VALUES('Human Resources', 'BC-300-10', 'BLDG01-230', '360-285-8300');
INSERT INTO DEPARTMENT VALUES('Finance', 'BC-400-10', 'BLDG01-110', '360-285-8400');
INSERT INTO DEPARTMENT VALUES('Accounting', 'BC-500-10', 'BLDG01-120', '360-285-8405');
INSERT INTO DEPARTMENT VALUES('Sales and Marketing', 'BC-600-10', 'BLDG01-250', '360-287-8500');
INSERT INTO DEPARTMENT VALUES('InfoSystems', 'BC-700-10', 'BLDG02-210', '360-287-8600');
INSERT INTO DEPARTMENT VALUES('Research and Development', 'BC-800-10', 'BLDG02-250', '360-287-8700');
INSERT INTO DEPARTMENT VALUES('Production', 'BC-900-10', 'BLDG02-110', '360-287-8800');

COMMIT;

/*****   EMPLOYEE DATA   ********************************************************/

INSERT INTO EMPLOYEE (FirstName, LastName, Department, Position, Supervisor, OfficePhone, EmailAddress,username,password)
	VALUES('Mary', 'Jacobs', 'Administration', 'El Presidente', 'Arthur Blank', '360-285-8110', 'Mary.Jacobs@WP.com', 'maryj1', 'mary');
INSERT INTO EMPLOYEE (FirstName, LastName, Department, Position, Supervisor, OfficePhone, EmailAddress,username,password)
	VALUES('Rosalie', 'Jackson', 'Administration', 'Admin Assistant', 'Dick Wolf', '360-285-8120', 'Rosalie.Jackson@WP.com', 'rosaliej1', 'rosalie');
INSERT INTO EMPLOYEE (FirstName, LastName, Department, Position, Supervisor, OfficePhone, EmailAddress,username,password)
	VALUES('Richard', 'Bandalone', 'Legal', 'Attorney', 'Chads Deans', '360-285-8210', 'Richard.Bandalone@WP.com', 'richardb1', 'richard');
INSERT INTO EMPLOYEE (FirstName, LastName, Department, Position, Supervisor, OfficePhone, EmailAddress,username,password)
	VALUES('George', 'Smith', 'Human Resources', 'HR Rep', 'Larry Bird', '360-285-8310', 'George.Smith@WP.com', 'georges1', 'george');
INSERT INTO EMPLOYEE (FirstName, LastName, Department, Position, Supervisor, OfficePhone, EmailAddress,username,password)
	VALUES('Alan', 'Adams', 'Research and Development', 'Developer', 'Jerry Jones', '360-285-8320', 'Alan.Adams@WP.com', 'alana1', 'alan');
INSERT INTO EMPLOYEE (FirstName, LastName, Department, Position, Supervisor, OfficePhone, EmailAddress,username,password)
	VALUES('Ken', 'Evans', 'Finance', 'Chief Finanical Officer', 'Donald the Ronald', '360-285-8410', 'Ken.Evans@WP.com', 'kene1', 'ken');
INSERT INTO EMPLOYEE (FirstName, LastName, Department, Position, Supervisor, OfficePhone, EmailAddress,username,password)
	VALUES('Mary', 'Abernathy', 'Finance', 'Financial Officer', 'Billy The Hood', '360-285-8420', 'Mary.Abernathy@WP.com', 'marya1', 'marya');
INSERT INTO EMPLOYEE (FirstName, LastName, Department, Position, Supervisor, OfficePhone, EmailAddress,username,password)
	VALUES('Tom', 'Caruthers', 'Accounting', 'Database Admin', 'Homer Simpson', '360-285-8430', 'Tom.Caruthers@WP.com', 'tomc1', 'tom');
INSERT INTO EMPLOYEE (FirstName, LastName, Department, Position, Supervisor, OfficePhone, EmailAddress,username,password)
	VALUES('Heather', 'Jones', 'Sales and Marketing', 'Project Manager', 'Tom Brady', '360-285-8440', 'Heather.Jones@WP.com', 'heatherj1', 'heather');
INSERT INTO EMPLOYEE (FirstName, LastName, Department, Position, Supervisor, OfficePhone, EmailAddress,username,password)
	VALUES('SuperAdmin', 'SuperAdmin', 'InfoSystems', 'Admin', 'Robert Kraft', '360-285-8440', 'admin@WP.com', 'admin', 'password');


COMMIT;

/*****   PROJECT DATA   *********************************************************/

INSERT INTO PROJECT VALUES(1000,
	'2017 Q3 Production Plan', 'InfoSystems', 100.00, '2017-05-10', '2017-06-15');
INSERT INTO PROJECT VALUES(1100,
	'2017 Q3 Marketing Plan', 'Sales and Marketing', 135.00, '2017-05-10', '2017-06-15');
INSERT INTO PROJECT VALUES(1200,
	'2017 Q3 Portfolio Analysis', 'Finance', 120.00, '2017-07-05', '2017-07-25');
INSERT INTO PROJECT VALUES(1300,
	'2017 Q3 Tax Preparation', 'Accounting', 145.00, '2017-08-10', '2017-10-15');
INSERT INTO PROJECT VALUES(1400,
	'2017 Q4 Production Plan', 'Production', 100.00, '2017-08-10', '2017-09-15');
INSERT INTO PROJECT VALUES(1500,
	'2017 Q4 Marketing Plan', 'Sales and Marketing', 135.00, '2017-08-10', '2017-09-15');
INSERT INTO PROJECT
	VALUES(1600,										
	'2017 Q4 Portfolio Analysis', 'Finance', 140.00, '2017-10-05', '2017-12-05');	
INSERT INTO PROJECT VALUES(1700,
	'2017 Q3 Data Analysis', 'Production', 110.00, '2017-05-10', '2017-06-15');
INSERT INTO PROJECT VALUES(1800,
	'2017 Q3 QA Testing', 'Human Resources', 135.00, '2017-05-10', '2017-06-15');
INSERT INTO PROJECT VALUES(1900,
	'2018 Q2 Framework Analysis', 'InfoSystems', 450.00, '2018-03-28', NULL);
INSERT INTO PROJECT VALUES(2000,
	'2017 Q3 Develop Software', 'Research and Development', 600.00, '2017-07-04', NULL);
INSERT INTO PROJECT VALUES(2100,
	'2017 Q2 Develop Database', 'Research and Development', 600.00, '2017-05-10', NULL);
INSERT INTO PROJECT VALUES(2200,
	'2018 Q1 Enhance User Interface', 'Legal', 345.00, '2018-01-20', NULL);
INSERT INTO PROJECT VALUES(2300,
	'2019 Q1 Research New Technologies', 'Research and Development', 145.00, '2019-02-11', NULL);
    

COMMIT;		

/*****   ASSIGNMENT DATA   ******************************************************/

INSERT INTO ASSIGNMENT VALUES(1000, 1, 30.0);
INSERT INTO ASSIGNMENT VALUES(2200, 2, 50.0);
INSERT INTO ASSIGNMENT VALUES(1000, 3, 50.0);
INSERT INTO ASSIGNMENT VALUES(1000, 4, 75.0);
INSERT INTO ASSIGNMENT VALUES(1700, 5, 75.0);
INSERT INTO ASSIGNMENT VALUES(2000, 6, 30.0);
INSERT INTO ASSIGNMENT VALUES(1100, 7, 75.0);
INSERT INTO ASSIGNMENT VALUES(1100, 8, 55.0);
INSERT INTO ASSIGNMENT VALUES(1800, 9, 55.0);
INSERT INTO ASSIGNMENT VALUES(1200, 11, 20.0);
INSERT INTO ASSIGNMENT VALUES(2300, 12, 40.0);
INSERT INTO ASSIGNMENT VALUES(1200, 13, 45.0);
INSERT INTO ASSIGNMENT VALUES(1900, 14, 45.0);
INSERT INTO ASSIGNMENT VALUES(1300, 1, 25.0);
INSERT INTO ASSIGNMENT VALUES(1300, 2, 40.0);
INSERT INTO ASSIGNMENT VALUES(2000, 12, 50.0);
INSERT INTO ASSIGNMENT VALUES(1300, 4, 50.0);
INSERT INTO ASSIGNMENT VALUES(1400, 5, 30.0);
INSERT INTO ASSIGNMENT VALUES(2100, 6, 50.0);
INSERT INTO ASSIGNMENT VALUES(1400, 7, 50.0);
INSERT INTO ASSIGNMENT VALUES(1400, 8, 75.0);
INSERT INTO ASSIGNMENT VALUES(1400, 9, 75.0);
INSERT INTO ASSIGNMENT VALUES(1500, 11, 30.0);
INSERT INTO ASSIGNMENT VALUES(2100, 1, 75.0);
INSERT INTO ASSIGNMENT VALUES(1500, 2, 55.0);
INSERT INTO ASSIGNMENT VALUES(2000, 3, 55.0);
INSERT INTO ASSIGNMENT VALUES(1800, 4, 20.0);
INSERT INTO ASSIGNMENT VALUES(1600, 5, 40.0);
INSERT INTO ASSIGNMENT VALUES(1700, 6, 68.0);
INSERT INTO ASSIGNMENT VALUES(1600, 7, 38.0);
INSERT INTO ASSIGNMENT VALUES(2300, 8, 49.0);
INSERT INTO ASSIGNMENT VALUES(2100, 9, 81.0);

COMMIT;

