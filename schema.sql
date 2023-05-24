DROP TABLE IF EXISTS "User" CASCADE;

CREATE TABLE "User" (
    id           SERIAL         NOT NULL,
    vip          BOOLEAN        NOT NULL DEFAULT FALSE, 
    firstname    VARCHAR(256)   NOT NULL, 
    lastname     VARCHAR(64)    NOT NULL, 
    email        VARCHAR(128)   NOT NULL,
    phone        VARCHAR(10)    NOT NULL,
    birth_date   DATE           NOT NULL,
    country      CHAR(3)        NOT NULL, 
    thumbnail    VARCHAR(256)   NOT NULL, 
    pwd          VARCHAR(256)    NOT NULL,

    PRIMARY KEY (id)
);