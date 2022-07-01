CREATE DATABASE bdviajes; 

CREATE TABLE empresa(
    idempresa INT AUTO_INCREMENT,
    enombre varchar(150),
    edireccion varchar(150),
    PRIMARY KEY (idempresa)
    ); 

CREATE TABLE responsable (
    rnumeroempleado INT AUTO_INCREMENT,
    rnumerolicencia INT,
	rnombre varchar(150), 
    rapellido  varchar(150), 
    PRIMARY KEY (rnumeroempleado)
    );
	
CREATE TABLE viaje (
    idviaje INT AUTO_INCREMENT,
	vdestino varchar(150),
    vcantmaxpasajeros int,
    idempresa INT,
    rnumeroempleado INT,
    vimporte float,
    tipoAsiento varchar(150), /*primera clase o no, semicama o cama*/
    idayvuelta varchar(150), /*si no*/
    PRIMARY KEY (idviaje),
    FOREIGN KEY (idempresa) REFERENCES empresa (idempresa),
	FOREIGN KEY (rnumeroempleado) REFERENCES responsable (rnumeroempleado)
    ON UPDATE CASCADE ON DELETE CASCADE
    ); 
	
CREATE TABLE pasajero (
    rdocumento varchar(15),
    pnombre varchar(150), 
    papellido varchar(150), 
	ptelefono int, 
	idviaje INT,
    PRIMARY KEY (rdocumento),
	FOREIGN KEY (idviaje) REFERENCES viaje (idviaje)
    	
    );
 
  
