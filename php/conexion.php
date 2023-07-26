    <?php
        $conexion=mysqli_connect("localhost","root","","demurstart");

        if(!$conexion){
            die ("Error a conectar la base de datps" . mysqli_connect_error());
        }else{
            echo "Conexion Exitosa a la base de datos";
        }
    ?>