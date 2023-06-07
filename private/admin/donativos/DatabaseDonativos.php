<?php
    class DatabaseDonativos{
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
                // echo 'Conectado correctamente';
            } catch (PDOException $e) {
                echo 'Fallo la conexion: ' . $e->getMessage();
            }

            return $gbd;
        }

        public function getAll(){
            $sql = "SELECT donativos.id, donativos.fecha, donativos.cantidad, usuarios.nombre AS 'nomUser', usuarios.apellidos AS 'nomApell'
            FROM donativos
            LEFT JOIN usuarios ON donativos.usuarios_id = usuarios.id";
            $resultados = self::conectar()->query($sql);
            return $resultados;
        }

        public function delete($tabla, $id){
            $sql = "DELETE FROM $tabla WHERE id = $id";
            self::conectar()->query($sql);
        }

        public function getId($id){
            $sql = "SELECT * FROM donativos WHERE id = $id";
            $resultados = self::conectar()->query($sql);
            return $resultados->fetch(PDO::FETCH_ASSOC);
        }

        public function actualizar($valores){
            $sql = "UPDATE donativos SET fecha = '$valores[1]', cantidad = $valores[2], usuarios_id = $valores[3] WHERE id = $valores[0]";
            self::conectar()->exec($sql);
        }
    }
?>