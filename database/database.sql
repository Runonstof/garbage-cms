-- Create the database structure for Garbage CMS
-- Ez pz lemon squeezy
CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    role_id int NOT NULL DEFAULT 0,
    created datetime NOT NULL,
    updated datetime NOT NULL,
    
    PRIMARY KEY (id)
);

CREATE TABLE roles (
    id int NOT NULL AUTO_INCREMENT,
    label varchar(255) NOT NULL, --Display name
    name var(255) NOT NULL, --Code friendly name (a-zA-Z0-9), no spaces, and '-_' allowed
    created datetime NOT NULL,
    updated datetime NOT NULL,

    PRIMARY KEY(id)
)

CREATE TABLE remember_tokens (
    id int NOT NULL AUTO_INCREMENT,
    token varchar(255) NOT NULL UNIQUE,
    user_id int NOT NULL,
    expires int NOT NULL,
    created datetime NOT NULL,
    updated datetime NOT NULL,

    PRIMARY KEY(id)
)

CREATE TABLE password_resets (
    id int NOT NULL AUTO_INCREMENT,
    token varchar(255) NOT NULL UNIQUE,
    user_id int NOT NULL,
    expires int NOT NULL,
    created datetime NOT NULL,
    updated datetime NOT NULL,

    PRIMARY KEY(id)
)

CREATE TABLE settings (
    id int NOT NULL AUTO_INCREMENT,
    key varchar(255) NOT NULL,
    value TEXT,

    PRIMARY KEY(id)
)

CREATE TABLE models (
    id int NOT NULL AUTO_INCREMENT,
    type varchar(255) NOT NULL,
    name varchar(255) NOT NULL,
    created datetime NOT NULL,
    updated datetime NOT NULL,


    PRIMARY KEY(id)
)

CREATE TABLE model_meta (
    id int NOT NULL AUTO_INCREMENT,
    model_id int NOT NULL,
    key varchar(255) NOT NULL,
    type ENUM('string','int','float','double','boolean') NOT NULL,
    value TEXT,

    PRIMARY KEY(id)
)