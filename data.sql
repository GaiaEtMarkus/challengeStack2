-- Insert roles
INSERT INTO "Role" (name) VALUES ('admin');
INSERT INTO "Role" (name) VALUES ('moderator');
INSERT INTO "Role" (name) VALUES ('user');

-- Insert categories
INSERT INTO "Category" (name) VALUES ('Electronique');
INSERT INTO "Category" (name) VALUES ('Enfants');
INSERT INTO "Category" (name) VALUES ('Sports');
INSERT INTO "Category" (name) VALUES ('Jardinage');
INSERT INTO "Category" (name) VALUES ('Livres');
INSERT INTO "Category" (name) VALUES ('Autom-moto');
INSERT INTO "Category" (name) VALUES ('Décorations d intérieurs');
INSERT INTO "Category" (name) VALUES ('Mode');
INSERT INTO "Category" (name) VALUES ('Outils');
INSERT INTO "Category" (name) VALUES ('Collection');

-- Insertion des utilisateurs
-- Utilisation de la fonction de hachage "SHA256" pour les mots de passe
INSERT INTO "User" (id_role, is_verified, firstname, lastname, pseudo, birth_date, email, phone, country, thumbnail, zip_code, address, pwd)
VALUES
(1, true, 'Nelson', 'Mandela', 'nelsonmandela', '1918-07-18', 'nelsonmandela@example.com', '0123456789', 'FRA', 'thumbnail.jpg', '75001', '1 Rue de la Liberté', digest('aaa', 'sha256')),
(1, true, 'Fidel', 'Castro', 'fidelcastro', '1926-08-13', 'fidelcastro@example.com', '9876543210', 'FRA', 'thumbnail.jpg', '69002', '12 Avenue de la Révolution', digest('aaa', 'sha256')),
(1, true, 'Karl', 'Marx', 'karlmarx', '1818-05-05', 'karlmarx@example.com', '6543210987', 'FRA', 'thumbnail.jpg', '33000', '8 Rue de la Révolution', digest('aaa', 'sha256')),
(1, true, 'Abbé', 'Pierre', 'abbepierre', '1912-08-05', 'abbepierre@example.com', '0123456789', 'FRA', 'thumbnail.jpg', '44000', '10 Place des Droits de l''Homme', digest('aaa', 'sha256')),
(1, true, 'Thomas', 'Sankara', 'thomassankara', '1949-12-21', 'thomassankara@example.com', '9876543210', 'FRA', 'thumbnail.jpg', '75003', '2 Avenue de la Révolution', digest('aaa', 'sha256'));

INSERT INTO "Product" (id_categorie, id_seller, titre, description, trokos) 
VALUES 
(1, 1, 'Product 1', 'This is product 1', 10),
(2, 1, 'Product 2', 'This is product 2', 10),
(3, 1, 'Product 3', 'This is product 3', 10),
(3, 2, 'Product 4', 'This is product 4', 28),
(3, 3, 'Product 5', 'This is product 5', 5),
(3, 3, 'Product 6', 'This is product 6', 4),
(3, 4, 'Product 7', 'This is product 7', 100),
(3, 5, 'Product 8', 'This is product 8', 45),
(3, 5, 'Product 9', 'This is product 9', 45);