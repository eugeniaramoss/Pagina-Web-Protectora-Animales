<?php
    class DatabaseEstado{
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
            $sql = "SELECT * FROM estado";
            $resultados = self::conectar()->query($sql);
            return $resultados;
        }

        public function delete($tabla, $id){
            $sql = "BEGIN;
                    UPDATE animales SET estado_id = NULL WHERE estado_id = $id;
                    DELETE FROM $tabla WHERE id = $id;
                    COMMIT";
            self::conectar()->query($sql);
        }

        public function guardar($valores){
            $sql = "INSERT INTO estado (nombre) VALUES ('$valores[0]')";
            self::conectar()->exec($sql);
        }

        public function getId($id){
            $sql = "SELECT * FROM estado WHERE id = $id";
            $resultados = self::conectar()->query($sql);
            return $resultados->fetch(PDO::FETCH_ASSOC);
        }

        public function actualizar($valores){
            $sql = "UPDATE estado SET nombre = '$valores[1]' WHERE id = $valores[0]";
            self::conectar()->exec($sql);
        }
    }
?>