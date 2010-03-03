CREATE TABLE Users (
  userID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  loginID VARCHAR NOT NULL,
  passwd VARCHAR NOT NULL,
  PRIMARY KEY(userID),
  UNIQUE INDEX SECONDARY(loginID)
);

CREATE TABLE Prospective Employees (
  Users_userID INTEGER UNSIGNED NOT NULL,
  fname VARCHAR NOT NULL,
  mname VARCHAR NULL,
  lname VARCHAR NOT NULL,
  dob VARCHAR NULL,
  email VARCHAR NULL,
  education ENUM NULL,
  resumefile VARCHAR() NULL,
  PRIMARY KEY(Users_userID),
  INDEX Employees_FKIndex1(Users_userID),
  FOREIGN KEY(Users_userID)
    REFERENCES Users(userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Employers (
  Users_userID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR NOT NULL,
  streetNumber VARCHAR NULL,
  city VARCHAR NULL,
  state VARCHAR NULL,
  zip INTEGER UNSIGNED NULL,
  email VARCHAR NULL,
  phone VARCHAR NULL,
  website VARCHAR NULL,
  companyType VARCHAR NULL,
  description TEXT NULL,
  PRIMARY KEY(Users_userID),
  INDEX Employers_FKIndex1(Users_userID),
  UNIQUE INDEX SECONDARY(name),
  FOREIGN KEY(Users_userID)
    REFERENCES Users(userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE EmployeeCategory (
  categoryID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employeeID INTEGER UNSIGNED NOT NULL,
  name VARCHAR NOT NULL,
  PRIMARY KEY(categoryID),
  INDEX EmployeeCategory_FKIndex1(employeeID),
  FOREIGN KEY(employeeID)
    REFERENCES Prospective Employees(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Admins (
  Users_userID INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(Users_userID),
  INDEX Admins_FKIndex1(Users_userID),
  FOREIGN KEY(Users_userID)
    REFERENCES Users(userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE EmployeKeywords (
  keywordID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employeeID INTEGER UNSIGNED NOT NULL,
  keyword VARCHAR NOT NULL,
  PRIMARY KEY(keywordID),
  INDEX EmployeKeywords_FKIndex1(employeeID),
  FOREIGN KEY(employeeID)
    REFERENCES Prospective Employees(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE EmployeeSkills (
  skillID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employeeID INTEGER UNSIGNED NOT NULL,
  name VARCHAR NOT NULL,
  PRIMARY KEY(skillID),
  INDEX Skills_FKIndex1(employeeID),
  FOREIGN KEY(employeeID)
    REFERENCES Prospective Employees(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Comments (
  employerID INTEGER UNSIGNED NOT NULL,
  employeeID INTEGER UNSIGNED NOT NULL,
  message TEXT NULL,
  postedTime TIMESTAMP NULL,
  PRIMARY KEY(employerID, employeeID),
  INDEX Employers_has_Employees_FKIndex1(employerID),
  INDEX Employers_has_Employees_FKIndex2(employeeID),
  FOREIGN KEY(employerID)
    REFERENCES Employers(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(employeeID)
    REFERENCES Prospective Employees(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Job Announcement (
  jobID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employerID INTEGER UNSIGNED NOT NULL,
  title VARCHAR NULL,
  posted TIMESTAMP NULL,
  closingDate TIME NULL,
  location VARCHAR NULL,
  jobType ENUM NULL,
  description TEXT NULL,
  education ENUM NULL,
  PRIMARY KEY(jobID, employerID),
  INDEX Job_FKIndex1(employerID),
  FOREIGN KEY(employerID)
    REFERENCES Employers(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE JobKeywords (
  jobKeywordID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employerID INTEGER UNSIGNED NOT NULL,
  jobID INTEGER UNSIGNED NOT NULL,
  name VARCHAR NOT NULL,
  PRIMARY KEY(jobKeywordID),
  INDEX JobKeywords_FKIndex1(jobID, employerID),
  FOREIGN KEY(jobID, employerID)
    REFERENCES Job Announcement(jobID, employerID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE JobSkills (
  jobskillsID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employerID INTEGER UNSIGNED NOT NULL,
  jobID INTEGER UNSIGNED NOT NULL,
  name VARCHAR NOT NULL,
  PRIMARY KEY(jobskillsID),
  INDEX JobSkills_FKIndex1(jobID, employerID),
  FOREIGN KEY(jobID, employerID)
    REFERENCES Job Announcement(jobID, employerID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Bookmarks (
  employeeID INTEGER UNSIGNED NOT NULL,
  jobID INTEGER UNSIGNED NOT NULL,
  Job Announcement_employerID INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(employeeID, jobID, Job Announcement_employerID),
  INDEX Employees_has_Job_FKIndex1(employeeID),
  INDEX Employees_has_Job_FKIndex2(jobID, Job Announcement_employerID),
  FOREIGN KEY(employeeID)
    REFERENCES Prospective Employees(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(jobID, Job Announcement_employerID)
    REFERENCES Job Announcement(jobID, employerID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Notification (
  notificationID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  jobID INTEGER UNSIGNED NOT NULL,
  to INTEGER UNSIGNED NOT NULL,
  from INTEGER UNSIGNED NOT NULL,
  Job Announcement_employerID INTEGER UNSIGNED NOT NULL,
  message TEXT NULL,
  timestamp TIMESTAMP NULL,
  PRIMARY KEY(notificationID, jobID, to, from),
  INDEX Users_has_Users_FKIndex1(from),
  INDEX Users_has_Users_FKIndex2(to),
  INDEX Notification_FKIndex3(jobID, Job Announcement_employerID),
  FOREIGN KEY(from)
    REFERENCES Users(userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(to)
    REFERENCES Users(userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(jobID, Job Announcement_employerID)
    REFERENCES Job Announcement(jobID, employerID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE JobCategory (
  jobcategoryID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employerID INTEGER UNSIGNED NOT NULL,
  jobID INTEGER UNSIGNED NOT NULL,
  name VARCHAR NOT NULL,
  PRIMARY KEY(jobcategoryID),
  INDEX JobCategory_FKIndex1(jobID, employerID),
  FOREIGN KEY(jobID, employerID)
    REFERENCES Job Announcement(jobID, employerID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);


