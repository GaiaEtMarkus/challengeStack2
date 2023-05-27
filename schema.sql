DROP TABLE IF EXISTS "User" CASCADE;
DROP TABLE IF EXISTS "Role" CASCADE;
DROP TABLE IF EXISTS "Media" CASCADE;
DROP TABLE IF EXISTS "Product" CASCADE;
DROP TABLE IF EXISTS "Comment" CASCADE;
DROP TABLE IF EXISTS "Sale" CASCADE;
DROP TABLE IF EXISTS "Category" CASCADE;

CREATE TABLE "Role" (
    id           SERIAL         NOT NULL,
    name         VARCHAR(64)    NOT NULL, 
    PRIMARY KEY (id)
);

CREATE TABLE "Media" (
    id    SERIAL         NOT NULL,
    url   VARCHAR(64)   NOT NULL,
    type  BOOLEAN        NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (url)
);


CREATE TABLE "Product" (
    id           SERIAL         NOT NULL,
    name         VARCHAR(256)   NOT NULL, 
    description  VARCHAR(256)   NOT NULL,
    price        DECIMAL        NOT NULL, 
    stock        INTEGER        NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE "Category" (
    id           SERIAL         NOT NULL,
    name         VARCHAR(64)    NOT NULL, 
    PRIMARY KEY (id)
);

CREATE TABLE "Sale" (
    id           SERIAL         NOT NULL,
    date         DATE           NOT NULL,
    amount       DECIMAL        NOT NULL, 
    PRIMARY KEY (id)
);

CREATE TABLE "User" (
    id           SERIAL         NOT NULL,
    id_role      INTEGER        NOT NULL,
    is_verified   BOOLEAN        NOT NULL DEFAULT FALSE, 
    firstname    VARCHAR(256)   NOT NULL, 
    lastname     VARCHAR(64)    NOT NULL,
    pseudo       VARCHAR(64)    NOT NULL, 
    birth_date   DATE           NOT NULL,
    email        VARCHAR(128)   NOT NULL,
    phone        VARCHAR(10)    DEFAULT NULL,
    country      CHAR(3)        DEFAULT NULL, 
    thumbnail    VARCHAR(64)    DEFAULT NULL, 
    zip_code     VARCHAR(6)     DEFAULT NULL,
    address      VARCHAR(256)   DEFAULT NULL,
    pwd          VARCHAR(256)   NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_role) REFERENCES "Role"(id),
);

CREATE TABLE "Comment" (
    id           SERIAL         NOT NULL,
    content      VARCHAR(256)   NOT NULL, 
    date         DATE           NOT NULL,
    id_user      INTEGER        NOT NULL, 
    PRIMARY KEY (id),
    FOREIGN KEY (id_user) REFERENCES "User"(id)
);

