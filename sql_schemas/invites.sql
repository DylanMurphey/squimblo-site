CREATE TABLE invites (
  id            INT         PRIMARY KEY,
  sender_id     INT         REFERENCES users(id),
  recipient_id  INT         REFERENCES users(id),
  ladder        INT         REFERENCES ladders(id)
);
