CREATE TABLE models (
    id int NOT NULL AUTO_INCREMENT,
    type varchar(255) NOT NULL,
    name varchar(255) NOT NULL,
    position INT,
    created datetime NOT NULL,
    updated datetime NOT NULL,


    PRIMARY KEY(id)
)