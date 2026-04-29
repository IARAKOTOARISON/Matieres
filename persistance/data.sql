-- Insertion des parcours [cite: 2, 3, 5, 7, 8]
INSERT INTO parcours (nomParcours, responsableParcours) VALUES 
('Développement', 'Razafinjoelina Tahina'),
('Bases de Données et Réseaux', 'Rakotomalala Vahatriniaina'),
('Web et Design', 'Rabenanahary Rojo');

-- Insertion de quelques matières clés [cite: 1, 4, 9]
INSERT INTO matieres (codeMatiere, intituleMatiere, nombreCredit) VALUES 
('INF201', 'Programmation orientée objet', 6),
('INF209', 'Web dynamique', 6),
('INF212', 'Mini-projet de Web et design', 10),
('MTH203', 'MAO', 4),
('INF204', 'Système d''information géographique', 6),
('INF205', 'Système d''information', 6),
('INF206', 'Interface Homme/Machine', 6),
('MTH204', 'Géométrie', 4),
('MTH206', 'Optimisation', 4);


-- Options Informatique pour Web et Design (S4)
INSERT INTO groupeOption (idMatiere, idParcours, numSemestre) VALUES 
(4, 3, 4), -- INF204
(5, 3, 4), -- INF205
(6, 3, 4); -- INF206

-- Options Mathématiques pour Web et Design (S4)
INSERT INTO groupeOption (idMatiere, idParcours, numSemestre) VALUES 
(7, 3, 4), -- MTH202
(8, 3, 4), -- MTH204
(9, 3, 4); -- MTH206


INSERT INTO eleves (nom, ETU, idParcours) VALUES 
('Randria Luc', 4400, 3), -- Web et Design
('Sitraka Antonio', 4401, 3), -- Web et Design
('Faly Niaina', 4402, 1),    -- Développement
('Naivo Harijaona', 4403, 2),   -- BDR
('Rova Malalatiana', 4404, 3);    -- Web et Design

-- Notes pour 'Randria' (A choisi INF205 et MTH204)
INSERT INTO notesEleves (idEleve, idMatiere, valeurNote) VALUES 
(1, 1, 12.50), -- Web dynamique
(1, 5, 14.00), -- Choix Option INF
(1, 8, 11.00); -- Choix Option MTH

-- Notes pour 'Sitraka' (A choisi INF204 et MTH206)
INSERT INTO notesEleves (idEleve, idMatiere, valeurNote) VALUES 
(2, 1, 10.00), 
(2, 4, 13.50), 
(2, 9, 12.00);

INSERT INTO users (email, password)
VALUES ('admin@sysinfo.mg', 'password');