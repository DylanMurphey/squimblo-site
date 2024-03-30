CREATE TABLE users (
	id 				SERIAL 		PRIMARY KEY,
	username 		VARCHAR(20) UNIQUE NOT NULL,
	display_name 	VARCHAR(64),
	email 			VARCHAR(64) UNIQUE,
	passhash 		TEXT 		NOT NULL
);
