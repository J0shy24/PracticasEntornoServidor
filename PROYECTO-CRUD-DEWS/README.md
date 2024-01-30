# ♦ Desarrollo Entorno Servidor ( Proyecto 2023-2024 ) ♦



 ##  Instrucciones : 🔻

> Partiendo de la aplicación que Implementar un CRUD con paginación sobre la base de datos que incluye la tabla Clientes con datos del portal Mockaroo realizaremos distintas mejoras.


> La idea de esta tarea es enfrentarnos a una aplicación funcional que implemente modelo Vista Controlador (MVC) al que debemos añadir distintas mejoras. Algunos de los cambios sólo afectarán a las vistas, otros a los controladores, o los modelos y en algunos casos deberemos incluir nuevos campos en la BD. Se trata de implementar las mejoras sin afectar al resto del funcionamiento de la aplicación.


> Este proyecto es de entrega obligatoria y su calificación vendrá dada por el número de funcionalidades correctamente implementadas. El alumno puede elegir cualquiera de ellas y realizarlas en cualquier orden, siendo necesario realizar 5 para aprobar la tarea.



## 🚩 Mejoras Hechos  🚩

 <div align="justify">🟢 Mostrar en detalles y en modificar la opción de siguiente y anterior.</div> <br/>


 <div align="justify">🟢 Mostrar la lista de clientes con distintos modos de ordenación: nombre, apellido, correo electrónico, género o IP y poder navegar por ella.</div><br/>


 <div align="justify">🟢 Mejorar las operaciones de Nuevo y Modificar para que chequee que los datos son correctos:  correo electrónico (no repetido), IP y  teléfono con formato 999-999-9999.</div><br/>


 <div align="justify">🟢 Mostrar una imagen asociada al cliente almacenada previamente en uploads o una imagen por defecto aleatoria generada por https://robohasp.org.  sin no existe. En nombre de las fotos tiene el formato 00000XXX.jpg para el cliente con id XXX.</div><br/>


 <div align="justify">🟢 Permitir subir o cambiar la foto del cliente en modificar y en nuevo (La imagen no es obligatoria). Hay que controlar que el fichero subido sea una imagen jpg  o png de un tamaño inferior a 500 Kbps.</div><br/>


 <div align="justify">🟢 Mostrar en detalles una bandera del país asociado a la IP ( utilizar https://ip-api.com/  y  https://flagpedia.net/ ).</div><br/>


 <div align="justify">🟢 Generar un PDF con los todos detalles de un cliente ( Incluir un botón que indique imprimir).</div><br/>


 <div align="justify">🟢 Crear una nueva tabla en la BD de usuarios de la aplicación (User)  con tres campos: login, password( encriptada )  y rol (0/1), definir varios usuarios y controlar el acceso a la aplicación sólo si se introduce el login y el password correctos. Si se realizan más de tres intentos erróneos se solicitará que se reinicie el navegador.</div><br/>


 <div align="justify">🟢 Controlar el acceso a la aplicación en función del rol, si es 0 solo puede acceder a visualizar los datos: lista y detalles. Si el rol es 1 podrá además modificar, borrar y eliminar usuarios.</div><br/>


 <div align="justify">🟢 Utilizar geoip y el api para javascript https://openlayers.org o similar para mostrar la localización geográfica del cliente  en un mapa en función de su IP.</div>

