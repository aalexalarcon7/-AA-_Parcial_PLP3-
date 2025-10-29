CREATE DATABASE IF NOT EXISTS quizmaster CHARSET utf8mb4;
USE quizmaster;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL
);

CREATE TABLE questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT NOT NULL,
  difficulty ENUM('easy','medium','hard') NOT NULL,
  question TEXT NOT NULL,
  opt_a VARCHAR(255) NOT NULL,
  opt_b VARCHAR(255) NOT NULL,
  opt_c VARCHAR(255) NOT NULL,
  opt_d VARCHAR(255) NOT NULL,
  correct ENUM('A','B','C','D') NOT NULL,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE scores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  player VARCHAR(80) NOT NULL,
  category_id INT NOT NULL,
  difficulty ENUM('easy','medium','hard') NOT NULL,
  score INT NOT NULL,
  max_score INT NOT NULL,
  time_seconds INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

INSERT INTO categories(name) VALUES ('Tecnología'),('Historia'),('Ciencia');


INSERT INTO questions(category_id,difficulty,question,opt_a,opt_b,opt_c,opt_d,correct) VALUES
(1,'easy','¿Qué significa HTML?','HyperText Markup Language','HighText Machine Language','HyperTransfer Markup Line','Home Tool Markup Language','A'),
(1,'medium','¿Qué puerto por defecto usa HTTP?','21','80','22','443','B'),
(1,'hard','¿Cuál NO es un tipo de dato primitivo en JS?','number','string','map','boolean','C'),
(1,'medium','¿Qué comando de git crea una nueva rama?','git branch nombre','git new nombre','git init nombre','git start nombre','A'),
(1,'easy','¿Qué hace CSS?','Define estructura','Define estilos','Procesa en servidor','Ejecuta consultas SQL','B'),

(2,'easy','¿En qué año fue la Revolución Francesa?','1492','1789','1917','1810','B'),
(2,'medium','¿Quién fue el primer emperador romano?','Nerón','Augusto','Julio César','Trajano','B'),
(2,'hard','La Guerra de los Treinta Años terminó en…','1648','1494','1715','1815','A'),
(2,'medium','¿Qué tratado puso fin a la I Guerra Mundial?','Utrecht','Versalles','Tordesillas','París','B'),
(2,'easy','¿Qué civilización construyó Machu Picchu?','Aztecas','Mayas','Incas','Olmecas','C'),

(3,'easy','¿Cuál es el planeta más grande?','Tierra','Marte','Júpiter','Saturno','C'),
(3,'medium','La unidad del SI para energía es…','Julio','Watt','Newton','Pascal','A'),
(3,'hard','¿Qué partícula tiene carga negativa?','Protón','Neutrón','Electrón','Positrón','C'),
(3,'medium','El agua hierve a 100°C a…','1 atm','0.5 atm','2 atm','vacío','A'),
(3,'easy','¿Cuál es la fórmula del agua?','CO2','H2O','O2','NaCl','B');
