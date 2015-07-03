DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT PRIMARY KEY NOT NULL,
  login CHAR(20) NOT NULL,
  email CHAR(30) NOT NULL,
  password CHAR(80),
  role INT(2) NOT NULL DEFAULT '1',
  banned INT(4) DEFAULT '0',
  suspended INT(4) DEFAULT '0',
  active INT(4) DEFAULT '1'
);

INSERT INTO users VALUES (3, 'admin', 'admin@qwerty.com', '$2a$08$vEsDM0Acexu7BHbs7hKMEuwb1j5ivdFnohHKnBKqUy3mSg/uh1fLS', 1, 0, 0, 1);