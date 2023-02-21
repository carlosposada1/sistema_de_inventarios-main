<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Busqueda</title>
    <style></style>
    <link href="estiloshome.css" rel="stylesheet" >
</head>
<body>
    
    <br>
    <?php
        $db = new PDO("mysql:host=localhost;dbname=sistemainventarios1","root","");
    ?>
    <div class="container container-table-edit">
        <div class="row table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <label>Documento</label>
                        <label>Nombres</label>
                        <label>Apellidos</label>
                        <label>Cargo</label>
                        <label>Género</label>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($db->query("SELECT * FROM usuarios WHERE documento=$_REQUEST[documento]") as $row){?>
                    <tr>
                        <td><?php echo $row['documento'] ?></td>
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['apellidos'] ?></td>
                        <td><?php echo $row['cargo'] ?></td>
                        <td><?php echo $row['genero'] ?></td>
                    
                        <td>
                            <a 
                                class="btn btn-primary" 
                                href="busqueda.php" 
                            >
                               Volver
                            </a>
                        </td>
                
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
                
        </div>

    </div>
    
</body>
</html>