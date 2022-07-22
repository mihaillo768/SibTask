<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <form action="#" method="POST" enctype="multipart/form-data">
        <input type="file" name="excel">
        <input type="submit" name="submit">
    </form>

<?php
use Shuchkin\SimpleXLSX;
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/func.php';
$objects = get_objects();
include "SimpleXLSX.php";
global $pdo;
    if(isset($_FILES['excel']['name'])){
        $excel = SimpleXLSX::parse($_FILES['excel']['tmp_name']);
        $array = $excel->rows();
        $i = 0;
        foreach($array as $key => $row){
            $q="";
            foreach($row as $key => $cell){
                if($i != 0){
                    $q.="'".$cell. "',";
                }
            }
            if($i != 0){
                $query = $pdo->query("INSERT INTO tbl_excel (excel_name, excel_number) values (".rtrim($q, ",").");");
            }
            $i++;
        }
    }
?>

<table style="margin: 10px" class="table table-bordered">
    <thead>
        <tr>        
        <th scope="col">Name</th>
        <th scope="col">Number</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($objects)): ?>
            <?php foreach ($objects as $object): ?>
                <tr>
                    <td><?= $object['excel_name'] ?></td>
                    <td><?php echo $object['excel_number']; ?></td>
                 </tr>
            <?php endforeach; ?>        
        <?php endif; ?>
    </tbody>
    </table>
</body>
</html>