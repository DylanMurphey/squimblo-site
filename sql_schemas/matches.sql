CREATE TABLE matches (
    id      SERIAL  PRIMARY KEY,
    player1 INT     REFERENCES users(id),
    player2 INT     REFERENCES users(id),
    ladder  INT     REFERENCES ladders(id),
    round   INT     NOT NULL
);
