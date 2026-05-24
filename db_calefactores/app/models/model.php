<?php

class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    private function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();

        if(count($tables) == 0) {
            $sql = "
                -- Crear tabla modelos
                CREATE TABLE modelos (
                    id_modelo INT(11) NOT NULL AUTO_INCREMENT,
                    nombre VARCHAR(25) NOT NULL,
                    descripcion TEXT,
                    categoria VARCHAR(100) NOT NULL,
                    imagen VARCHAR(255) DEFAULT NULL,
                    PRIMARY KEY (id_modelo)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
                -- Crear tabla calefactores
                CREATE TABLE calefactores (
                    id_calefactor INT(11) NOT NULL AUTO_INCREMENT,
                    id_modelo INT(11) NOT NULL,
                    nombre VARCHAR(25) NOT NULL,
                    tipo VARCHAR(15) NOT NULL,
                    potencia INT(10) UNSIGNED NOT NULL,
                    peso DECIMAL(10,2) UNSIGNED NOT NULL,
                    precio DECIMAL(10,2) UNSIGNED NOT NULL,
                    stock INT(11) NOT NULL,
                    fecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (id_calefactor),
                    KEY fk_modelo (id_modelo),
                    CONSTRAINT fk_modelo FOREIGN KEY (id_modelo) REFERENCES modelos (id_modelo) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
                -- Crear tabla usuarios
                CREATE TABLE usuarios (
                    id_usuario INT(11) NOT NULL AUTO_INCREMENT,
                    nombre VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    contraseña VARCHAR(255) NOT NULL,
                    rol VARCHAR(20) DEFAULT NULL,
                    PRIMARY KEY (id_usuario)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
                -- Insertar registros iniciales en modelos
                INSERT INTO modelos (id_modelo, nombre, descripcion, categoria, imagen) VALUES
                (2, 'Orban plus', 'Linea premium de bajo consumo', 'domestico', 'assets/img/domestico.jpeg'),
                (3, 'inulocal', 'Excelente para espacios modernos', 'comercial', 'assets/img/comercial.jpeg'),
                (4, 'termoblock', 'Pensados para galpones o espacios amplios', 'industrial', 'assets/img/industrial.jpeg');
    
                -- Insertar registros iniciales en calefactores
                INSERT INTO calefactores (id_calefactor, id_modelo, nombre, tipo, potencia, peso, precio, stock, fecha_creacion) VALUES
                (6, 2, 'XLM', 'Gas', 2500, '60.50', '455999.99', 12, '0000-00-00 00:00:00'),
                (7, 2, 'EcoHome', 'Gas', 2000, '8.00', '400000.00', 25, '2026-05-01 00:00:00'),
                (8, 2, 'Domus', 'Electrico', 1500, '7.00', '350000.00', 15, '2026-05-04 00:00:00'),
                (9, 3, 'Comerk', 'Electrico', 1300, '5.00', '270000.00', 17, '2026-05-09 14:15:00'),
                (10, 3, 'OrbanPesado', 'Gas', 2500, '8.00', '400320.00', 6, '2026-05-09 14:16:17'),
                (11, 4, 'CalderaMax', 'Gas', 10000, '45.00', '1000000.00', 3, '2026-05-09 14:17:38'),
                (12, 4, 'IndustrialPro', 'Gas', 10000, '50.00', '1200000.00', 3, '2026-05-09 14:18:44');
    
                -- Insertar usuario administrador inicial
                INSERT INTO usuarios (id_usuario, nombre, email, contraseña, rol) VALUES
                (1, 'webadmin', 'webadmin@gmail', '$2y$10$2DVOET6GnefFcseh0wr3Q.fDEhHhVFLy2eRrZnXs6S6gm1OXrBQUi', 'administrador');
            ";
            $this->db->exec($sql);
        }
    }
}