CREATE TABLE remember_tokens (
    id int NOT NULL AUTO_INCREMENT,
    token varchar(255) NOT NULL UNIQUE,
    user_id int NOT NULL,
    expires int NOT NULL,
    created_at timestamp NOT NULL,
    updated_at timestamp NOT NULL,

    PRIMARY KEY(id)
)