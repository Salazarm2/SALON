<?php
    namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

    class LoginController {
        public static function login(Router $router) {
            $alertas = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $auth = new Usuario($_POST);
                $alertas = $auth->validarlogin();
                if(empty($alertas)) {
                    $usuario = Usuario::where('email', $auth->email);
                    if($usuario) {
                        // verificar el password
                        if($usuario->comprobarPasswordYVeridicado($auth->password)) {
                            ///autenticar el usuario
                            session_start();

                            $_SESSION['id'] = $usuario->id;
                            $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                            $_SESSION['email'] = $usuario->email;
                            $_SESSION['login'] = true;

                            //redireccion
                            if($usuario->admin === "1") {
                                $_SESSION['admin'] = $usuario->admin ?? null;

                                header('Location: /admin');
                            } else {
                                header('Location: /cita');
                            }
                        }

                    } else {
                        Usuario::setAlerta('error', 'Usuario No Encontrado');
                    }
                }
            }
            $alertas = Usuario::getAlertas();

            $router->render('auth/login', [
                'alertas' => $alertas
               // 'auth' => $auth
            ]);
        }


        public static function logout() {
            $_SESSION = [];
            header('Location: /');

        }

        public static function olvide(Router $router) {
            $alertas = [];
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $auth = new Usuario($_POST);
                $alertas = $auth->validarEmail();
                if(empty($alertas)) {
                    $usuario = Usuario::where('email', $auth->email);
                    if($usuario && $usuario->confirmado === "1") {
                        // genera r un toque
                        $usuario->crearToken();
                        $usuario->guardar(); 
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token );
            
                        $email->enviarInstrucciones();



                        Usuario::setAlerta('exito', 'Se Le A Eviado Un Correo, Revise Para Confirmar');
                    } else {
                        Usuario::setAlerta('error', 'Usuario No Existe o No Esta Confirmado');
                    }
                }
            }
            $alertas = Usuario::getAlertas();
            $router->render('auth/olvide',[
                'alertas' => $alertas
            ]);

        }

        public static function recuperar(Router $router) {
            $alerta = [];
            $token = s($_GET['token']);
            $error = false;

            //buscar usuario
            $usuario = Usuario::where('token', $token);
            if(empty($usuario)) {
                Usuario::setAlerta('error', 'Token No Valido');
                $error = true;
            }

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                // leer y guardar nuevo password
                $password = new Usuario(($_POST));
                $alertas = $password->validarPassword($password->password);
                
                if(empty($alertas)) {
                    $usuario->password = $password->password;
                    $usuario->hashpassword();
                    $usuario->token = '';
                    $resultado = $usuario->guardar();
                    if($resultado) {
                        header('Location:/');
                    }
                }
            
            }

            $alertas = Usuario::getAlertas();
            $router->render('auth/recuperar',[
                'alertas' => $alertas,
                'error' => $error
            ]);
        }

        public static function crearCuenta(Router $router) {
            
            $usuario = new Usuario();
            $alertas = [];
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario->sincronizar($_POST);                
                $alertas = $usuario->validadNuevaCuenta();                
                if(empty($alertas)) {
                    // verificar que el usuaruioo no este regustrado
                    $resultado = $usuario->existeUsuario();
                    if($resultado->num_rows) {
                        $alertas = Usuario::getAlertas();
                    } else {
                        // hashear el password
                        $usuario->hashpassword();

                        //crear token unico
                        $usuario->crearToken();

                        // enviar email
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token );
            
                        $email->enviarEmail();
                        //Crear el usuario
                        $resultado = $usuario->guardar();
                        if($resultado) {
                            header('Location:/mensaje');
                        }

                    }
                }

            }
                
            $router->render('auth/crear-cuenta',[
                'usuario' => $usuario,
                'alertas' => $alertas
            ]);
        }
        public static function mensaje(Router $router) {
            $router->render('auth/mensaje');
        }

        public static function confirmar( Router $router) {
            $alertas = [];
            $token = s($_GET['token']);
            

            $usuario = Usuario::where('token',$token);
            if(empty($usuario)) {
                Usuario::setAlerta('error', 'Token No Valido');
            } else {
                $usuario->confirmado = "1";
                $usuario->token = "";
                $usuario->guardar();
                Usuario::setAlerta('exito', "Cuenta Comprobada Correctamente...");
            }
            // obtener la alerta para mostrarla en pantall
            $alertas = Usuario::getAlertas();
            $router->render('auth/confirmar-cuenta', [
                'alertas' => $alertas
            ]);
        }
    }