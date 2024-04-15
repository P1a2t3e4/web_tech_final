
-- Table: Users
CREATE TABLE students (
  User_id INT AUTO_INCREMENT PRIMARY KEY,
  FirstName VARCHAR(50) NOT NULL,
  LastName VARCHAR(50) NOT NULL,
  Major VARCHAR(10),
  Email VARCHAR(100) NOT NULL,
  PhoneNumber VARCHAR(15) NOT NULL,
  psw VARCHAR(15) NOT NULL
);



CREATE TABLE admins (
  admin_id INT AUTO_INCREMENT PRIMARY KEY,
  FirstName VARCHAR(50) NOT NULL,
  LastName VARCHAR(50) NOT NULL,
  department VARCHAR(10),
  Email VARCHAR(100) NOT NULL,
  PhoneNumber VARCHAR(15) NOT NULL,
  psw VARCHAR(15) NOT NULL

);

-- Table: Events
CREATE TABLE Events (
  EventID INT AUTO_INCREMENT PRIMARY KEY,
  Title VARCHAR(100) NOT NULL,
  CreatedBy INT NOT NULL,
  Description TEXT NOT NULL,
  Speaker VARCHAR(100),
  Date DATE NOT NULL,
  Time TIME NOT NULL,
  Location VARCHAR(100) NOT NULL,
  FOREIGN KEY (CreatedBy) REFERENCES admins(admin_id)
);



-- Table: Jobs
CREATE TABLE Jobs (
  JobID INT AUTO_INCREMENT PRIMARY KEY,
  Title VARCHAR(100) NOT NULL,
  Department VARCHAR(100) NOT NULL,
  Description TEXT NOT NULL,
  Status ENUM('Open', 'Closed') NOT NULL
);












