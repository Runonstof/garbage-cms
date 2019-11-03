CREATE TABLE models (
    id int NOT NULL AUTO_INCREMENT,
    type varchar(255) NOT NULL,
    name varchar(255) NOT NULL,
    position INT,
    created_at timestamp NOT NULL,
    updated_at timestamp NOT NULL,


    PRIMARY KEY(id)
)