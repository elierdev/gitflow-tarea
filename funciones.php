<?php
    require_once 'db_configs.php';
    

    function getCantidad(){
        global $conexion;
        $sql = "SELECT COUNT(*) FROM personajes";
        $result = mysqli_query($conexion, $sql);

        if ($result) {
            $row = mysqli_fetch_row($result);
            return $row[0];

        }
    }

    function getPersonajes() {
        global $conexion;
        $sql = "SELECT * FROM personajes";
        $result = mysqli_query($conexion, $sql);
        
        $personajes = [];
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $personajes[] = $row; 
            }
        }
    
        return $personajes; 
    }
        
        
    
?>
    

