<?php

namespace Model;

class Usuario extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];
    
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    // mensaje validacion creacion cuenta

   public function validadNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre Del Cliente Es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido Del Cliente Es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El E-mail Del Cliente Es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password Del Cliente Es Obligatorio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password Debe Tener Al Menos 6 Caracteres';
        }
        if(!$this->telefono) {
            self::$alertas['error'][] = 'El Telefono Del Cliente Es Obligatorio';
        }

        return self::$alertas;
   } 

   public function validarlogin() {
    if(!$this->email) {
        self::$alertas['error'][] = 'El Email Es Obligatorio';
    }
    if(!$this->password) {
        self::$alertas['error'][] = 'El Password Es Obligatorio';
    }

    return self::$alertas;
    }

    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email Es Obligatorio';
        }
        return self::$alertas;

    }

   // revisa si el usuario existe
    public function existeUsuario(){
        $query = "SELECT * FROM ". self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1"; 
        $resultado = self::$db->query($query);
        if($resultado->num_rows){
            self::$alertas['error'][] = 'El Usuario Ya Esta Registrado';
        }
        return $resultado;
    }

    public function hashpassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }

    public function comprobarPasswordYVeridicado($password) {
        $resultado = password_verify($password, $this->password);
        if(!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Password Incorrecto O Cuenta No Confirmada';
        } else {
            return true;
        }
    }
    
    public function validarPassword($password) {
        if(!$this->password) {
            self::$alertas['error'][] = 'El password Es Obligatorio';
        }
        if($this->password<6) {
            self::$alertas['error'][] = 'El Password Debe Tener Al Menos 6 Caracteres';
        }
        return self::$alertas;
        
    }
}