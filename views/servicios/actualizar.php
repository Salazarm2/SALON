<h3 class="nombre-pagina">ACTUALIZAR SERVICIOS</h3>
<p class="descripcion-pagina" >Realiza Los Cambio de los Servicios</p>
<?php
    include_once  __DIR__ . '/../templates/barra.php';
    include_once  __DIR__ . '/../templates/alertas.php';
?>
<form method="POST" class="formulario">
    <?php
        include_once  __DIR__ . '/formulario.php';
    ?>    
    <input type="submit" value="Actualizar" class="boton">
</form>
