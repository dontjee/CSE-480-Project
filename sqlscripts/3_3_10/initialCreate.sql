CREATE TABLE IF NOT EXISTS users (
  userID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  loginID VARCHAR(32) NOT NULL,
  passwd VARCHAR(32) NOT NULL,
  PRIMARY KEY(userID),
  UNIQUE INDEX SECONDARY(loginID)
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS employees (
  users_userID INTEGER UNSIGNED NOT NULL,
  fname VARCHAR(32) NOT NULL,
  mname VARCHAR(32) NULL,
  lname VARCHAR(32) NOT NULL,
  dob VARCHAR(16) NULL,
  email VARCHAR(64) NULL,
  education ENUM('High School','College','Postgraduate') NULL,
  resumefile VARCHAR(64) NULL,
  PRIMARY KEY(users_userID),
  INDEX employees_FKIndex1(users_userID),
  FOREIGN KEY(users_userID)
    REFERENCES users(userID)
      ON DELETE CASCADE
      ON UPDATE NO ACTION
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS employers (
  users_userID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY(users_userID),
  INDEX employers_FKIndex1(users_userID),
  UNIQUE INDEX SECONDARY(name),
  FOREIGN KEY(users_userID)
    REFERENCES users(userID)
      ON DELETE CASCADE
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS employeecategory (
  categoryID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employeeID INTEGER UNSIGNED NOT NULL,
  name VARCHAR(32) NOT NULL,
  PRIMARY KEY(categoryID),
  INDEX employeecategory_FKIndex1(employeeID),
  FOREIGN KEY(employeeID)
    REFERENCES employees(users_userID)
      ON DELETE CASCADE
      ON UPDATE NO ACTION
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS admins (
  users_userID INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(users_userID),
  INDEX admins_FKIndex1(users_userID),
  FOREIGN KEY(users_userID)
    REFERENCES users(userID)
      ON DELETE CASCADE
      ON UPDATE NO ACTION
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS employeekeywords (
  keywordID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employeeID INTEGER UNSIGNED NOT NULL,
  keyword VARCHAR(32) NOT NULL,
  PRIMARY KEY(keywordID),
  INDEX employeekeywords_FKIndex1(employeeID),
  FOREIGN KEY(employeeID)
    REFERENCES employees(users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS employeeskills (
  skillID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employeeID INTEGER UNSIGNED NOT NULL,
  name VARCHAR(32) NOT NULL,
  PRIMARY KEY(skillID),
  INDEX Skills_FKIndex1(employeeID),
  FOREIGN KEY(employeeID)
    REFERENCES employees(users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS comments (
  commentID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employerID INTEGER UNSIGNED NOT NULL,
  employeeID INTEGER UNSIGNED NOT NULL,
  message TEXT NULL,
  postedTime TIMESTAMP NULL,
  PRIMARY KEY(commentID),
  INDEX employers_has_employees_FKIndex1(employerID),
  INDEX employers_has_employees_FKIndex2(employeeID),
  FOREIGN KEY(employerID)
    REFERENCES employers(users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(employeeID)
    REFERENCES employees(users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS jobannouncement (
  jobID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  employerID INTEGER UNSIGNED NOT NULL,
  title VARCHAR(32) NULL,
  posted TIMESTAMP NULL,
  closingDate TIME NULL,
  location VARCHAR(64) NULL,
  jobType ENUM('Full Time','Temporary','Contract') NULL,
  description TEXT NULL,
  education ENUM('High School','College','Postgraduate') NULL,
  PRIMARY KEY(jobID),
  INDEX Job_FKIndex1(employerID),
  FOREIGN KEY(employerID)
    REFERENCES employers(users_userID)
      ON DELETE CASCADE
      ON UPDATE NO ACTION
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS jobkeywords (
  jobKeywordID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  jobID INTEGER UNSIGNED NOT NULL,
  name VARCHAR(32) NOT NULL,
  PRIMARY KEY(jobKeywordID),
  INDEX jobkeywords_FKIndex1(jobID),
  FOREIGN KEY(jobID)
    REFERENCES jobannouncement(jobID)
      ON DELETE CASCADE
      ON UPDATE NO ACTION
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS jobskills (
  jobskillsID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  jobID INTEGER UNSIGNED NOT NULL,
  name VARCHAR(32) NOT NULL,
  PRIMARY KEY(jobskillsID),
  INDEX jobskills_FKIndex1(jobID),
  FOREIGN KEY(jobID)
    REFERENCES jobannouncement(jobID)
      ON DELETE CASCADE
      ON UPDATE NO ACTION
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS bookmarks (
  employeeID INTEGER UNSIGNED NOT NULL,
  jobID INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(employeeID, jobID),
  INDEX employees_has_Job_FKIndex1(employeeID),
  INDEX employees_has_Job_FKIndex2(jobID),
  FOREIGN KEY(employeeID)
    REFERENCES employees(users_userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(jobID)
    REFERENCES jobannouncement(jobID)
      ON DELETE CASCADE
      ON UPDATE NO ACTION
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS notification (
  jobID INTEGER UNSIGNED NOT NULL,
  toID INTEGER UNSIGNED NOT NULL,
  fromID INTEGER UNSIGNED NOT NULL,
  timeSent TIMESTAMP NULL,
  PRIMARY KEY(jobID, toID, fromID),
  INDEX users_has_users_FKIndex1(fromID),
  INDEX users_has_users_FKIndex2(toID),
  INDEX notification_FKIndex3(jobID),
  FOREIGN KEY(fromID)
    REFERENCES users(userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(toID)
    REFERENCES users(userID)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(jobID)
    REFERENCES jobannouncement(jobID)
      ON DELETE CASCADE
      ON UPDATE NO ACTION
) ENGINE=INNODB;
 
CREATE TABLE IF NOT EXISTS jobcategory (
  jobcategoryID INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  jobID INTEGER UNSIGNED NOT NULL,
  name VARCHAR(32) NOT NULL,
  PRIMARY KEY(jobcategoryID),
  INDEX jobcategory_FKIndex1(jobID),
  FOREIGN KEY(jobID)
    REFERENCES jobannouncement(jobID)
      ON DELETE CASCADE
      ON UPDATE NO ACTION
) ENGINE=INNODB;
