CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    password_salt var(255) NOT NULL,
    role_id int NOT NULL DEFAULT 0,
    created datetime NOT NULL,
    updated datetime NOT NULL,
    
    PRIMARY KEY (id)
);