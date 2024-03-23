CREATE TABLE placements (
    player  INT     REFERENCES users(id),
    ladder  INT     REFERENCES ladders(id),
    wins    INT     DEFAULT 0,
    draws   INT     DEFAULT 0,
    losses  INT     DEFAULT 0,
    points  INT     DEFAULT 0 
);
