DROP TABLE IF EXISTS "User" CASCADE;
DROP TABLE IF EXISTS "Role" CASCADE;
DROP TABLE IF EXISTS "Media" CASCADE;
DROP TABLE IF EXISTS "Product" CASCADE;
DROP TABLE IF EXISTS "ProductImages" CASCADE;
DROP TABLE IF EXISTS "Comment" CASCADE;
DROP TABLE IF EXISTS "Sale" CASCADE;
DROP TABLE IF EXISTS "Category" CASCADE;
DROP TABLE IF EXISTS "Transaction" CASCADE;
DROP TABLE IF EXISTS "ResetToken" CASCADE;

CREATE EXTENSION IF NOT EXISTS pgcrypto;



CREATE TABLE "Role" (
    id           SERIAL         NOT NULL,
    name         VARCHAR(64)    NOT NULL, 
    PRIMARY KEY (id)
);

-- CREATE TABLE "Media" (
--     id    SERIAL                 NOT NULL,
--     url   VARCHAR(64)            NOT NULL,
--     type  BOOLEAN                NOT NULL,
--     PRIMARY KEY (id),
--     UNIQUE (url)
-- );


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
    is_verified  BOOLEAN        NOT NULL DEFAULT FALSE, 
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
    token_hash   VARCHAR(256)   DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_role) REFERENCES "Role"(id)
);

CREATE TABLE "Product" (
    id              SERIAL         PRIMARY KEY,
    id_categorie    INTEGER        NOT NULL,
    id_seller       INTEGER        NOT NULL,
    is_verified  BOOLEAN           NOT NULL DEFAULT FALSE, 
    title           VARCHAR(255)   NOT NULL,
    description     TEXT           NOT NULL,
    thumbnail       VARCHAR(64)    DEFAULT NULL, 
    trokos          INTEGER        NOT NULL,
    FOREIGN KEY (id_seller) REFERENCES "User"(id),
    FOREIGN KEY (id_categorie) REFERENCES "Category"(id)
);

CREATE TABLE "Transaction" (
    id                  SERIAL         PRIMARY KEY,
    id_receiver         INTEGER        NOT NULL,
    id_seller           INTEGER        NOT NULL,
    id_item_receiver    INTEGER        NOT NULL,
    id_item_seller      INTEGER        NOT NULL,
    is_validate         BOOLEAN        NOT NULL DEFAULT FALSE, 
    quality             INTEGER        NOT NULL, 
    FOREIGN KEY (id_receiver) REFERENCES "User"(id),
    FOREIGN KEY (id_seller) REFERENCES "User"(id)
);

CREATE TABLE "ProductImages" (
    id              SERIAL         PRIMARY KEY,
    product_id      INTEGER        NOT NULL,
    image_path      VARCHAR(255)   NOT NULL,
    FOREIGN KEY (product_id) REFERENCES "Product"(id)
);

CREATE TABLE "Comment" (
    id           SERIAL         NOT NULL,
    content      VARCHAR(256)   NOT NULL, 
    date         DATE           NOT NULL,
    id_user      INTEGER        NOT NULL, 
    PRIMARY KEY (id),
    FOREIGN KEY (id_user) REFERENCES "User"(id)
);

CREATE TABLE "ResetToken" (
    id           SERIAL         NOT NULL,
    user_id      INTEGER        NOT NULL,
    token        VARCHAR(256)   NOT NULL,
    expiration   TIMESTAMP      NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES "User"(id)
);

