CREATE TABLE invites (
  id        INT         PRIMARY KEY,
  sender    INT         REFERENCES users(id),
  recipient INT         REFERENCES users(id),
  ladder    INT         REFERENCES ladders(id)
);
