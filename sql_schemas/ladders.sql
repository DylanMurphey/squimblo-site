CREATE TABLE ladders (
  id            SERIAL      PRIMARY KEY,
  title         VARCHAR(40),
  owner_id      INT         REFERENCES users(id),
  current_round INT         DEFAULT 0
);
