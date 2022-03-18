<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesion Con Tus Datos</p>

<?php include_once __DIR__ . "/../templates/alertas.php";?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">E-mail:</label>
        <input type="email" id="email" placeholder="Tu e-mail" name="email"  />
        <!-- value="<?php echo s($auth->email); ?>" -->
    </div>
    <div class="campo">
        <label for="password">Password:</label>
        <input type="password" id="pasword" placeholder="Tu password" name="password" />
    </div>
        <input type="submit" class="boton" value="Iniciar Sesion">
</form>

<div class="acciones">
    <a href="/crear-cuenta">Aun No Tienes Una Cuenta? Crear Una</a>
    <a href="/olvide">Olvidaste tu Password?</a>
</div>