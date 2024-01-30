CREATE TABLE IF NOT EXISTS `clientes` (
  `telefono` int(9) NOT NULL DEFAULT '0',
  `nombre` varchar(30) DEFAULT NULL,
  `puntos` int(4) DEFAULT NULL,
  PRIMARY KEY (`telefono`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `clientes` (`telefono`, `nombre`, `puntos`) VALUES
(918932910, 'Sara López', 30),
(918935910, 'Rosa Gil', 12),
(918935915, 'Pio Pérez', 130),
(919932910, 'Raúl Díez', 30);
