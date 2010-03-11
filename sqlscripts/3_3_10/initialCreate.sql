CREATE TABLE IF NOT EXISTS Users (
  userID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  loginID VARCHAR(32) NOT NULL,
  passwd VARCHAR(32) NOT NULL,
  PRIMARY KEY(userID),
  UNIQUE INDEX SECONDARY(loginID)
);
 
CREATE TABLE IF NOT EXISTS ProspectiveEmployees (
  Users_userID INTEGER UNSIGNED NOT NULL,
  fname VARCHAR(32) NOT NULL,
  mname VARCHAR(32) NULL,
  lname VARCHAR(32) NOT NULL,
  dob VARCHAR(16) NULL,
  email VARCHAR(64) NULL,
  education ENUM('High School','College','Postgraduate') NULL,
  resumefile VARCHAR(64) NULL,
  PRIMARY KEY(Users_userID),
  INDEX Employees_FKIndex1(Users_userID),
  FOREIGN KEY(Users_userID)
    REFERENCES Users(userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);
 
CREATE TABLE IF NOT EXISTS Employers (
  Users_userID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(64) NOT NULL,
  streetNumber VARCHAR(32) NULL,
  city VARCHAR(32) NULL,
  state VARCHAR(16) NULL,
  zip INTEGER UNSIGNED NULL,
  email VARCHAR(64) NULL,
  phone VARCHAR(16) NULL,
  website VARCHAR(128) NULL,
  companyType VARCHAR(32) NULL,
  description TEXT NULL,
  PRIMARY KEY(Users_userID),
  INDEX Employers_FKIndex1(Users_userID),
  UNIQUE INDEX SECONDARY(name),
  FOREIGN KEY(Users_userID)
    REFERENCES Users(userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);
 
CREATE TABLE IF NOT EXISTS EmployeeCategory (
  categoryID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employeeID INTEGER UNSIGNED NOT NULL,
  name VARCHAR(32) NOT NULL,
  PRIMARY KEY(categoryID),
  INDEX EmployeeCategory_FKIndex1(employeeID),
  FOREIGN KEY(employeeID)
    REFERENCES ProspectiveEmployees(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);
 
CREATE TABLE IF NOT EXISTS Admins (
  Users_userID INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(Users_userID),
  INDEX Admins_FKIndex1(Users_userID),
  FOREIGN KEY(Users_userID)
    REFERENCES Users(userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);
 
CREATE TABLE IF NOT EXISTS EmployeKeywords (
  keywordID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employeeID INTEGER UNSIGNED NOT NULL,
  keyword VARCHAR(32) NOT NULL,
  PRIMARY KEY(keywordID),
  INDEX EmployeKeywords_FKIndex1(employeeID),
  FOREIGN KEY(employeeID)
    REFERENCES ProspectiveEmployees(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);
 
CREATE TABLE IF NOT EXISTS EmployeeSkills (
  skillID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employeeID INTEGER UNSIGNED NOT NULL,
  name VARCHAR(32) NOT NULL,
  PRIMARY KEY(skillID),
  INDEX Skills_FKIndex1(employeeID),
  FOREIGN KEY(employeeID)
    REFERENCES ProspectiveEmployees(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);
 
CREATE TABLE IF NOT EXISTS Comments (
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
    REFERENCES ProspectiveEmployees(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);
 
CREATE TABLE IF NOT EXISTS JobAnnouncement (
  jobID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employerID INTEGER UNSIGNED NOT NULL,
  title VARCHAR(32) NULL,
  posted TIMESTAMP NULL,
  closingDate TIME NULL,
  location VARCHAR(64) NULL,
  jobType ENUM('Full Time','Temporary','Contract') NULL,
  description TEXT NULL,
  education ENUM('High School','College','Postgraduate') NULL,
  PRIMARY KEY(jobID, employerID),
  INDEX Job_FKIndex1(employerID),
  FOREIGN KEY(employerID)
    REFERENCES Employers(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);
 
CREATE TABLE IF NOT EXISTS JobKeywords (
  jobKeywordID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employerID INTEGER UNSIGNED NOT NULL,
  jobID INTEGER UNSIGNED NOT NULL,
  name VARCHAR(32) NOT NULL,
  PRIMARY KEY(jobKeywordID),
  INDEX JobKeywords_FKIndex1(jobID, employerID),
  FOREIGN KEY(jobID, employerID)
    REFERENCES JobAnnouncement(jobID, employerID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);
 
CREATE TABLE IF NOT EXISTS JobSkills (
  jobskillsID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employerID INTEGER UNSIGNED NOT NULL,
  jobID INTEGER UNSIGNED NOT NULL,
  name VARCHAR(32) NOT NULL,
  PRIMARY KEY(jobskillsID),
  INDEX JobSkills_FKIndex1(jobID, employerID),
  FOREIGN KEY(jobID, employerID)
    REFERENCES JobAnnouncement(jobID, employerID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);
 
CREATE TABLE IF NOT EXISTS Bookmarks (
  employeeID INTEGER UNSIGNED NOT NULL,
  jobID INTEGER UNSIGNED NOT NULL,
  JobAnnouncement_employerID INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(employeeID, jobID, JobAnnouncement_employerID),
  INDEX Employees_has_Job_FKIndex1(employeeID),
  INDEX Employees_has_Job_FKIndex2(jobID, JobAnnouncement_employerID),
  FOREIGN KEY(employeeID)
    REFERENCES ProspectiveEmployees(Users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(jobID, JobAnnouncement_employerID)
    REFERENCES JobAnnouncement(jobID, employerID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);
 
CREATE TABLE IF NOT EXISTS Notification (
  notificationID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  jobID INTEGER UNSIGNED NOT NULL,
  toID INTEGER UNSIGNED NOT NULL,
  fromID INTEGER UNSIGNED NOT NULL,
  JobAnnouncement_employerID INTEGER UNSIGNED NOT NULL,
  message TEXT NULL,
  timeSent TIMESTAMP NULL,
  PRIMARY KEY(notificationID, jobID, toID, fromID),
  INDEX Users_has_Users_FKIndex1(fromID),
  INDEX Users_has_Users_FKIndex2(toID),
  INDEX Notification_FKIndex3(jobID, JobAnnouncement_employerID),
  FOREIGN KEY(fromID)
    REFERENCES Users(userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(toID)
    REFERENCES Users(userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(jobID, JobAnnouncement_employerID)
    REFERENCES JobAnnouncement(jobID, employerID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);
 
CREATE TABLE IF NOT EXISTS JobCategory (
  jobcategoryID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employerID INTEGER UNSIGNED NOT NULL,
  jobID INTEGER UNSIGNED NOT NULL,
  name VARCHAR(32) NOT NULL,
  PRIMARY KEY(jobcategoryID),
  INDEX JobCategory_FKIndex1(jobID, employerID),
  FOREIGN KEY(jobID, employerID)
    REFERENCES JobAnnouncement(jobID, employerID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);