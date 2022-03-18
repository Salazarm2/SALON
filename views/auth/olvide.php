<h1 class="nombre-pagina" >Olvide Password</h1>
<p class="descripcion-pagina">Reestablecer Password. Escribe Tu E-mail A Continuacion</p>

<?php include_once __DIR__ . "/../templates/alertas.php";?>

<form class="formulario" method="POST" action="/olvide">
    <div class="campo">
        <label for="email">E-mail:</label>
        <input type="email" id="email" placeholder="Tu e-mail" name="email" />
    </div>
    <input type="submit" class="boton" value="Enviar Instrucciones">    
</form>

<div class="acciones">
    <a href="/">Ya Tienes Una Cuenta? Iniciar Sesion</a>
    <a href="/crear-cuenta">Aun No Tienes Una Cuenta? Crear Una</a>
</div>
