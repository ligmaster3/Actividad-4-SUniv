-- Crear la base de datos
CREATE DATABASE Registros_academicos;
USE Registros_academicos;

CREATE TABLE `usuario` (
  `user_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `last_user` varchar(100) NOT NULL,
  `edad_user` varchar(255) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Tabla de estudiantes
CREATE TABLE Estudiantes (
    id_estudiante INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    fecha_nacimiento DATE,
    correo VARCHAR(100),
    carrera VARCHAR(20) -- carrera única del estudiante
);

-- Tabla de profesores
CREATE TABLE Profesores (
    id_profesor INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    correo VARCHAR(100)
);

-- Tabla de cursos (materias)
CREATE TABLE Cursos (
    id_curso INT PRIMARY KEY AUTO_INCREMENT,
    nombre_curso VARCHAR(100), -- El nombre del curso (por ejemplo, "Matemáticas")
    descripcion TEXT,
    codigo_curso VARCHAR(10), -- Código único para el curso (ej. "MAT101")
    id_profesor INT, -- Relación con la tabla de profesores
    FOREIGN KEY (id_profesor) REFERENCES Profesores(id_profesor) ON DELETE CASCADE
);

-- Tabla de inscripciones (relaciona estudiantes con cursos)
CREATE TABLE Inscripciones (
    id_inscripcion INT PRIMARY KEY AUTO_INCREMENT,
    id_estudiante INT, -- Relación con la tabla de estudiantes
    id_curso INT, -- Relación con la tabla de cursos
    anio_curso INT, -- El año en que el estudiante cursa la materia
    fecha_inscripcion DATE,
    FOREIGN KEY (id_estudiante) REFERENCES Estudiantes(id_estudiante) ON DELETE CASCADE,
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso) ON DELETE CASCADE
);

-- Tabla de evaluaciones (relaciona evaluaciones con cursos y estudiantes)
CREATE TABLE Evaluaciones (
    id_evaluacion INT PRIMARY KEY AUTO_INCREMENT,
    tipo_evaluacion VARCHAR(50), -- Tipo de evaluación (por ejemplo: 'Examen', 'Trabajo')
    descripcion TEXT,
    fecha DATE,
    id_curso INT, -- Relación con la tabla de cursos
    id_estudiante INT, -- Relación con la tabla de estudiantes (quién realiza la evaluación)
    nota DECIMAL(5, 2), -- Nota obtenida en la evaluación
    anio_evaluacion INT, -- Año en el que el estudiante realizó la evaluación
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso) ON DELETE CASCADE,
    FOREIGN KEY (id_estudiante) REFERENCES Estudiantes(id_estudiante) ON DELETE CASCADE
);

INSERT INTO usuario (user_name, last_user, edad_user, email_user, password_user) VALUES
('Juan', 'Pérez', '25', 'juan.perez@example.com', 'password123'),
('Ana', 'Gómez', '30', 'ana.gomez@example.com', 'password456'),
('Luis', 'Martínez', '22', 'luis.martinez@example.com', 'password789'),
('María', 'López', '28', 'maria.lopez@example.com', 'password321'),
('Carlos', 'Hernández', '35', 'carlos.hernandez@example.com', 'password654'),
('Sofía', 'Ramírez', '27', 'sofia.ramirez@example.com', 'password987'),
('Javier', 'Torres', '29', 'javier.torres@example.com', 'password159');

INSERT INTO Estudiantes (nombre, apellido, fecha_nacimiento, correo, carrera) VALUES
('Pedro', 'Sánchez', '2000-05-15', 'pedro.sanchez@example.com', 'Ingeniería'),
('Lucía', 'Fernández', '1999-08-20', 'lucia.fernandez@example.com', 'Medicina'),
('Andrés', 'García', '2001-03-10', 'andres.garcia@example.com', 'Arquitectura'),
('Claudia', 'Mora', '1998-12-30', 'claudia.mora@example.com', 'Derecho'),
('Miguel', 'Salazar', '2002-07-25', 'miguel.salazar@example.com', 'Biología'),
('Elena', 'Cruz', '1997-11-05', 'elena.cruz@example.com', 'Química'),
('Diego', 'Reyes', '2000-04-18', 'diego.reyes@example.com', 'Física');

INSERT INTO Profesores (nombre, apellido, correo) VALUES
('Roberto', 'Díaz', 'roberto.diaz@example.com'),
('Patricia', 'Méndez', 'patricia.mendez@example.com'),
('Fernando', 'Vargas', 'fernando.vargas@example.com'),
('Laura', 'Paredes', 'laura.paredes@example.com'),
('Julio', 'Caldos', 'julio.caldos@example.com'),
('Verónica', 'Ríos', 'veronica.rios@example.com'),
('Sergio', 'Núñez', 'sergio.nunez@example.com');

INSERT INTO Cursos (nombre_curso, descripcion, codigo_curso, id_profesor) VALUES
('Matemáticas', 'Curso de matemáticas básicas.', 'MAT101', 1),
('Biología', 'Introducción a la biología.', 'BIO101', 2),
('Física', 'Fundamentos de la física.', 'FIS101', 3),
('Química', 'Curso de química general.', 'QUI101', 4),
('Historia', 'Historia universal.', 'HIS101', 5),
('Literatura', 'Análisis de obras literarias.', 'LIT101', 6),
('Programación', 'Introducción a la programación.', 'PROG101', 7);

INSERT INTO Inscripciones (id_estudiante, id_curso, anio_curso, fecha_inscripcion) VALUES
(1, 1, 2023, '2023-09-01'),
(2, 2, 2023, '2023-09-02'),
(3, 3, 2023, '2023-09-03'),
(4, 4, 2023, '2023-09-04'),
(5, 5, 2023, '2023-09-05'),
(6, 6, 2023, '2023-09-06'),
(7, 7, 2023, '2023-09-07');

INSERT INTO Evaluaciones (tipo_evaluacion, descripcion, fecha, id_curso, id_estudiante, nota, anio_evaluacion) VALUES
('Examen', 'Examen final de Matemáticas.', '2023-12-15', 1, 1, 85.50, 2023),
('Trabajo', 'Trabajo práctico de Biología.', '2023-12-20', 2, 2, 90.00, 2023),
('Examen', 'Examen de Física.', '2023-12-25', 3, 3, 78.00, 2023),
('Trabajo', 'Trabajo de Química.', '2023-12-30', 4, 4, 88.00, 2023),
('Examen', 'Evaluación de Historia.', '2023-12-10', 5, 5, 92.00, 2023),
('Trabajo', 'Análisis literario.', '2023-12-05', 6, 6, 95.00, 2023),
('Examen', 'Prueba de Programación.', '2023-12-01', 7, 7, 80.00, 2023);


DELIMITER //

CREATE PROCEDURE InsertarDatosCompletos(
    IN p_nombre_estudiante VARCHAR(100),
    IN p_apellido_estudiante VARCHAR(100),
    IN p_fecha_nacimiento DATE,
    IN p_correo_estudiante VARCHAR(100),
    IN p_carrera VARCHAR(20),
    IN p_nombre_profesor VARCHAR(100),
    IN p_apellido_profesor VARCHAR(100),
    IN p_correo_profesor VARCHAR(100),
    IN p_nombre_curso VARCHAR(100),
    IN p_descripcion_curso TEXT,
    IN p_id_profesor INT,
    IN p_id_estudiante INT,
    IN p_fecha_inscripcion DATE,
    IN p_tipo_evaluacion VARCHAR(50),
    IN p_descripcion_evaluacion TEXT,
    IN p_fecha_evaluacion DATE,
    IN p_nota DECIMAL(5,2)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Revertir todas las inserciones si hay un error
        ROLLBACK;
    END;

    -- Iniciar la transacción
    START TRANSACTION;

    -- Insertar el estudiante
    INSERT INTO Estudiantes (nombre, apellido, fecha_nacimiento, correo,carrera)
    VALUES (p_nombre_estudiante, p_apellido_estudiante, p_fecha_nacimiento, p_correo_estudiante, p_carrera);
    
    -- Insertar el profesor
    INSERT INTO Profesores (nombre, apellido, correo)
    VALUES (p_nombre_profesor, p_apellido_profesor, p_correo_profesor);
    
    -- Insertar el curso
    INSERT INTO Cursos (nombre_curso, descripcion, id_profesor)
    VALUES (p_nombre_curso, p_descripcion_curso, LAST_INSERT_ID()); -- Usar LAST_INSERT_ID() para obtener el ID del último profesor insertado
    
    -- Insertar la inscripción
    INSERT INTO Inscripciones (id_estudiante, id_curso, fecha_inscripcion)
    VALUES (LAST_INSERT_ID(), LAST_INSERT_ID(), p_fecha_inscripcion); -- Usar LAST_INSERT_ID() para el último curso insertado
    
    -- Insertar la evaluación
    INSERT INTO Evaluaciones (tipo_evaluacion, descripcion, fecha, id_curso, id_estudiante, nota)
    VALUES (p_tipo_evaluacion, p_descripcion_evaluacion, p_fecha_evaluacion, LAST_INSERT_ID(), LAST_INSERT_ID(), p_nota);

    -- Confirmar la transacción
    COMMIT;
END //

DELIMITER ;
