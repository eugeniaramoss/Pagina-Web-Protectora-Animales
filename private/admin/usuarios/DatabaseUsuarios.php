<?php

    class DatabaseUsuarios{

        public function conectar(){

            $driver = "mysql";
            $host = 'localhost';
            $port = '3306';
            $bd = 'protectora';
            $user = 'root';
            $password = "";

            $dsn = "$driver:dbname=$bd;host=$host;port=$port";

            try{
                $gbd = new PDO($dsn, $user, $password);
                //echo 'Conectado correctamente';
            } catch (PDOException $e) {
                echo 'Fallo la conexion: ' . $e->getMessage();
            }

            return $gbd;
        }

        public function getAll(){
            $sql = "SELECT usuarios.id, usuarios.nombre, usuarios.apellidos, usuarios.telefono, usuarios.email, usuarios.fecha, usuarios.dni, rol.nombre AS 'rol'
            FROM usuarios
            LEFT JOIN rol ON rol.id = usuarios.rol_id";
            $resultados = self::conectar()->query($sql);
            return $resultados;
        }

        public function delete($tabla, $id){
            $sql = "BEGIN;
                    UPDATE animales SET usuarios_id = NULL WHERE usuarios_id = $id;
                    UPDATE donativos SET usuarios_id = NULL WHERE usuarios_id = $id;
                    DELETE FROM post WHERE usuarios_id = $id;
                    DELETE FROM $tabla WHERE id = $id;
                    COMMIT";
            self::conectar()->query($sql);
        }

        public function getId($id){
            $sql = "SELECT * FROM usuarios WHERE id = $id";
            $resultados = self::conectar()->query($sql);
            return $resultados->fetch(PDO::FETCH_ASSOC);
        }

        public function actualizar($valores){
            $sql = "UPDATE usuarios SET nombre = '$valores[1]', apellidos = '$valores[2]', telefono = '$valores[3]', email = '$valores[4]', contrasenia = '$valores[5]', fecha = '$valores[6]', dni = '$valores[7]', rol_id = $valores[8] WHERE id = $valores[0]";
            self::conectar()->exec($sql);
        }
    }
?>