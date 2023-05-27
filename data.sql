INSERT INTO "Role" (name) VALUES
    ('beatmakers'),
    ('admin'),
    ('moderateur'),
    ('artiste');

INSERT INTO "User" (id_role, is_verified, firstname, lastname, pseudo, birth_date, email, phone, country, thumbnail, zip_code, address, pwd)
VALUES (1, TRUE, 'Leon', 'Trotsky', 'ltrotsky', '1879-11-07', 'ltrotsky@email.com', '1234567890', 'RUS', 'trotsky.jpg', '101000', 'Bolshoi avenue, Moscow', 'password');

INSERT INTO "User" (id_role, is_verified, firstname, lastname, pseudo, birth_date, email, phone, country, thumbnail, zip_code, address, pwd)
VALUES (2, TRUE, 'Rosa', 'Luxemburg', 'rluxemburg', '1871-03-05', 'rluxemburg@email.com', '0987654321', 'GER', 'luxemburg.jpg', '10115', 'Rosa-Luxemburg-Str. Berlin', 'password');

INSERT INTO "User" (id_role, is_verified, firstname, lastname, pseudo, birth_date, email, phone, country, thumbnail, zip_code, address, pwd)
VALUES (3, TRUE, 'Che', 'Guevara', 'cguevara', '1928-06-14', 'cguevara@email.com', '0123456789', 'ARG', 'guevara.jpg', '1060', 'Avenida de la Revolucion, Buenos Aires', 'password');

INSERT INTO "User" (id_role, is_verified, firstname, lastname, pseudo, birth_date, email, phone, country, thumbnail, zip_code, address, pwd)
VALUES (4, TRUE, 'Friedrich', 'Engels', 'fengels', '1820-11-28', 'fengels@email.com', '9012345678', 'GER', 'engels.jpg', '40213', 'Engels-Platz, Düsseldorf', 'password');
