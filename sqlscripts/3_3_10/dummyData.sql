TRUNCATE Employees;
TRUNCATE Employers;
TRUNCATE Admins;
TRUNCATE Users;

INSERT INTO Users VALUES (NULL, 'employee','pass');
INSERT INTO Employees VALUES (1, 'John', 'M', 'Doe', '01-01-1979', 'johndoe@example.com', 'College', NULL);

INSERT INTO Users VALUES (NULL, 'employer','pass');
INSERT INTO Employers VALUES (2, 'ABC Corp.', '100 Main St.', 'Springfield', 'MI', '48825', 'jobs@abccorp.com', '555-345-3456', 'www.abccorp.com/jobs', 'Marketing', 'At ABC Corp we market things.');

INSERT INTO Users VALUES (NULL, 'admin','pass');
INSERT INTO Admins VALUES (3);
