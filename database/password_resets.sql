CREATE TABLE password_resets (
    id int NOT NULL AUTO_INCREMENT,
    token varchar(255) NOT NULL UNIQUE,
    user_id int NOT NULL,
    expires int NOT NULL,
    created datetime NOT NULL,
    updated datetime NOT NULL,

    PRIMARY KEY(id)
)