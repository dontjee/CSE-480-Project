TRUNCATE employees;
TRUNCATE employers;
TRUNCATE admins;
TRUNCATE users;

INSERT INTO users VALUES (NULL, 'employee','pass');
INSERT INTO employees VALUES (1, 'John', 'M', 'Doe', '01-01-1979', 'johndoe@example.com', 'College', NULL);

INSERT INTO users VALUES (NULL, 'employer','pass');
INSERT INTO employers VALUES (2, 'ABC Corp.', '100 Main St.', 'Springfield', 'MI', '48825', 'jobs@abccorp.com', '555-345-3456', 'www.abccorp.com/jobs', 'Marketing', 'At ABC Corp we market things.');

INSERT INTO users VALUES (NULL, 'admin','pass');
INSERT INTO admins VALUES (3);
