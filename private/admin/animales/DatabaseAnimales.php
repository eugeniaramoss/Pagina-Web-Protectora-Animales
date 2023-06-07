<?php
    class DatabaseAnimales{
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
            $sql = "SELECT animales.id, animales.nombre, animales.edad, animales.fecha_nacimiento, animales.fecha_entrada, estado.nombre AS 'estado', usuarios.nombre AS 'nomUser', usuarios.apellidos AS 'nomApell', tamanio.nombre AS 'tamanio', sexo.tipo AS 'sexo', tipo.nombre AS 'tipo'
            FROM animales
            LEFT JOIN estado ON animales.estado_id = estado.id
            LEFT JOIN usuarios ON animales.usuarios_id = usuarios.id
            LEFT JOIN tamanio ON animales.tamanio_id = tamanio.id
            LEFT JOIN sexo ON animales.sexo_id = sexo.id
            LEFT JOIN tipo ON animales.tipo_id = tipo.id";
            $resultados = self::conectar()->query($sql);
            return $resultados;
        }

        public function delete($tabla, $id){
            $sql = "BEGIN;
                    UPDATE imagenesAnimales SET animales_id = NULL WHERE animales_id = $id;
                    DELETE FROM $tabla WHERE id = $id;
                    COMMIT";
            self::conectar()->query($sql);
        }

        public function guardar($valores){
            $sql = "INSERT INTO animales (nombre, edad, fecha_nacimiento, fecha_entrada, estado_id, usuarios_id, tamanio_id, sexo_id, tipo_id, descripcion) VALUES ('$valores[0]', $valores[1], '$valores[2]', '$valores[3]', $valores[4], $valores[5], $valores[6], $valores[7], $valores[8],'$valores[9]')";
            self::conectar()->exec($sql);
        }

        public function getId($id){
            $sql = "SELECT * FROM animales WHERE id = $id";
            $resultados = self::conectar()->query($sql);
            return $resultados->fetch(PDO::FETCH_ASSOC);
        }

        public function actualizar($valores){
            $sql = "UPDATE animales SET nombre = '$valores[1]', edad = $valores[2], fecha_nacimiento = '$valores[3]', fecha_entrada = '$valores[4]', estado_id = $valores[5], usuarios_id = $valores[6], tamanio_id = $valores[7], sexo_id = $valores[8], tipo_id = $valores[9], descripcion = '$valores[10]' WHERE id = $valores[0]";
            self::conectar()->exec($sql);
        }
    }
?>