CREATE TABLE Users (
	user_id SERIAL PRIMARY KEY,
	username VARCHAR(20) NOT NULL,
	display_name VARCHAR(64),
	email VARCHAR(64),
	passhash TEXT NOT NULL
);