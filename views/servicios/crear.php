<h3 class="nombre-pagina">NUEVO SERVICIOS</h3>
<p class="descripcion-pagina" >Llena Todos Los Campos Para Anadir Un Nuevo Servicios</p>
<?php
    include_once  __DIR__ . '/../templates/barra.php';
    include_once  __DIR__ . '/../templates/alertas.php';
?>

<form action="/servicios/crear" method="POST" class="formulario">
    <?php
        include_once  __DIR__ . '/formulario.php';
     ?>
    <input type="submit" value="Guardar Servicio" class="boton">
</form>