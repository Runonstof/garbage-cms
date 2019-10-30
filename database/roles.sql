CREATE TABLE roles (
    id int NOT NULL AUTO_INCREMENT,
    label varchar(255) NOT NULL, --Display name
    name var(255) NOT NULL, --Code friendly name (a-zA-Z0-9), no spaces, and '-_' allowed
    position INT NOT NULL,
    created datetime NOT NULL,
    updated datetime NOT NULL,

    PRIMARY KEY(id)
)