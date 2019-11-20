CREATE TABLE IF NOT EXISTS model_meta (
    id int NOT NULL AUTO_INCREMENT,
    model_id int NOT NULL,
    key VARCHAR(255) NOT NULL,
    type ENUM('string','text','int','float','double','boolean') NOT NULL,
    value_string VARCHAR(255),
    value_text TEXT,
    value_int INT,
    value_float FLOAT,
    value_double DOUBLE,
    value_boolean TINYINT(1),

    PRIMARY KEY(id)
)