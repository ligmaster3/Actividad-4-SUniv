-- Crear la base de datos
CREATE DATABASE Registros_academicos;
USE Registros_academicos;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `edad` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
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
