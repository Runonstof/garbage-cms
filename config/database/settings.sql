CREATE TABLE IF NOT EXISTS settings (
    id int NOT NULL AUTO_INCREMENT,
    key varchar(255) NOT NULL,
    value TEXT,

    PRIMARY KEY(id)
)