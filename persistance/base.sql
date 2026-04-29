CREATE DATABASE IF NOT EXISTS notes;
USE notes;

-- 1. Les matières (ex: INF201, MTH203, etc.)
CREATE TABLE matieres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    codeMatiere VARCHAR(20) NOT NULL, -- ex: INF201 [cite: 1, 4]
    intituleMatiere VARCHAR(150) NOT NULL, -- [cite: 1, 4]
    nombreCredit INT NOT NULL -- 
);

-- 2. Les parcours (ex: Web et Design)
CREATE TABLE parcours (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nomParcours VARCHAR(100) NOT NULL, -- [cite: 2, 5, 7]
    responsableParcours VARCHAR(100) NOT NULL -- [cite: 3, 5, 8]
);

-- 3. Groupes d'options (ex: "Choisir 1 UE parmi 3")
CREATE TABLE groupeOption (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idMatiere INT NOT NULL,
    idParcours INT NOT NULL,
    numSemestre INT NOT NULL, -- ex: 4 [cite: 4, 6, 9]
    FOREIGN KEY (idParcours) REFERENCES parcours(id)
);

-- 4. Programme (Lien Parcours / Matière / Semestre)
CREATE TABLE programmeParcours (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idParcours INT NOT NULL,
    idMatiere INT NOT NULL,
    numSemestre INT NOT NULL, -- ex: Semestre 3 ou 4 [cite: 1, 4, 6, 9]
    idGroupeOption INT DEFAULT NULL, -- Si NULL = Obligatoire. Si ID = Optionnel. [cite: 4, 6, 9]
    FOREIGN KEY (idParcours) REFERENCES parcours(id),
    FOREIGN KEY (idMatiere) REFERENCES matieres(id),
    FOREIGN KEY (idGroupeOption) REFERENCES groupeOption(id)
);

-- 5. Les élèves (liés à un parcours spécifique)
CREATE TABLE eleves (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    ETU INT UNIQUE NOT NULL,
    idParcours INT NOT NULL,
    FOREIGN KEY (idParcours) REFERENCES parcours(id)
);

-- 6. Les notes (Enregistre le choix final de l'élève et son résultat)
CREATE TABLE notesEleves (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idEleve INT NOT NULL,
    idMatiere INT NOT NULL,
    valeurNote DECIMAL(4,2),
    FOREIGN KEY (idEleve) REFERENCES eleves(id),
    FOREIGN KEY (idMatiere) REFERENCES matieres(id)
);


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100),
    password VARCHAR(100)
);