CREATE TABLE IF NOT EXISTS roles (
    id int NOT NULL AUTO_INCREMENT,
    label varchar(255) NOT NULL, --Display name
    name var(255) NOT NULL, --Code friendly name (a-zA-Z0-9), no spaces, and '-_' allowed
    position INT NOT NULL,
    created_at timestamp NOT NULL,
    updated_at timestamp NOT NULL,

    PRIMARY KEY(id)
)