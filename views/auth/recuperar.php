<h1 class="nombre-pagina">Reestablecer Password</h1>
<p class="descripcion-pagina"> Llena El Siguiente Formulario Para Reestablecer su Password</p>

<?php include_once __DIR__ . "/../templates/alertas.php";?>

<?php if($error) return; ?>

<form class="formulario" method="POST" >
    <div class="campo">
        <label for="password">Password:</label>
        <input type="password" id="pasword" placeholder="Tu Nuevo Password" name="password" />
    </div>
        <input type="submit" class="boton" value="Guardar PassWord">
</form>

<div class="acciones">
    <a href="/">Ya Tienes Cuenta? Iniciar Sesion</a>
    <a href="/crear-cuenta">Aun No Tienes Cuenta? Obtener Una</a>
</div>