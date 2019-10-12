-- Create the database structure for Garbage CMS
-- Ez pz lemon squeezy
CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    role_id int NOT NULL DEFAULT 0,
    
    PRIMARY KEY (id)
);

CREATE TABLE roles (
    id int NOT NULL AUTO_INCREMENT,
    label varchar(255) NOT NULL, --Display name
    name var(255) NOT NULL, --Code friendly name (a-zA-Z0-9), no spaces, and '-_' allowed

    PRIMARY KEY(id)
)

