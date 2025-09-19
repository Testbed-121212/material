# db setup

demo 1 
    - basic sqli
    - return all coffee regardless of stock

demo 2 - challenge
    - union select from users table

demo 3
    - nosqli login bypass

challenge - (in other app)
    - crapi

demo 4
    - command inj
    - basic command whoami

demo 5 - challenge
    - command inj

demo 6
    - basic xxe

demo 7 - challenge
    - xxe

```
create database api_injection;

CREATE TABLE coffee (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    roast int,
    PRIMARY KEY (id)
);

CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO coffee VALUES (1, 'Revival', 5);
INSERT INTO coffee VALUES (2, 'Jitters', 4);
INSERT INTO coffee VALUES (3, 'Rise and shine', 4);

INSERT INTO users VALUES (1, 'admin', 'TCM{25e4ee4e9229397b6b17776bfceaf8e7}');
INSERT INTO users VALUES (2, 'jeremy', 'jeremyspassword');

CREATE USER 'apiInjection'@'localhost' IDENTIFIED BY 'iAmAWeakPassword';
GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT  on api_injection.* TO 'apiInjection'@'localhost';
```

Mongo

```
sudo apt install php-mongodb
```

```
db.createUser(
  {
    user: "injectionUser",
    pwd:  "injectionUserPass",
    roles: [ { role: "readWrite", db: "coffee" } ]
  }
)

db.bean.insertOne({"name":"Jitters","Origin":"Ethiopia"})
db.bean.insertOne({"name":"Dream bean","Origin":"Brazil"})
```