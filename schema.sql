DROP TABLE IF EXISTS "user" CASCADE;

CREATE TABLE "user" (
    id           SERIAL         NOT NULL,
    vip          BOOLEAN        NOT NULL DEFAULT FALSE, 
    name         VARCHAR(256)   NOT NULL, 
    surname      VARCHAR(64)    NOT NULL, 
    email        VARCHAR(128)   NOT NULL,
    phone        VARCHAR(10)    NOT NULL,
    birth_date   DATE           NOT NULL,
    country      CHAR(3)        NOT NULL, 
    thumbnail    VARCHAR(256)   NOT NULL, 
    pwd          VARCHAR(32)    NOT NULL,

    PRIMARY KEY (id)
);