CREATE DATABASE Workshop;
USE Workshop;

-- CREATE TABLE Workshop (); foreign key de Reparation?

CREATE TABLE Reparation (
	reparationID VARCHAR(36) PRIMARY KEY NOT NULL,
	workshopID INT(4) NOT NULL,
    workshopName VARCHAR(12) NOT NULL,
    registerDate DATE,
    licensePlate VARCHAR(8)
);

/*INSERT INTO Reparation (reparationID, workshopID, workshopName, registerDate, licensePlate) 
VALUES ("1", 1, 'El taller', '1998-09-29', '1234 ABC');
INSERT INTO Reparation (reparationID, workshopID, workshopName, registerDate, licensePlate) 
VALUES ("2", 1, 'Repareishon', '2012-04-10', '1222 CCC');*/

SELECT * FROM Reparation;