<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Seznam knih</h1>
    <!-- formular -->
    <a href="inputKnih.php">Vlozeni knihy knih</a>
    <a href="./seznamKnih.php">Seznam knih</a>
    <a href="vyhledavac.php">Vyhledat knihu</a>
    <?php 
    // connection
    include "dbLogin.php";
    
    $con = mysqli_connect($host,$user,$password, $db);
    if (!$con){
        die("Nelze se pripojit k db serveru</body></html>");
    } 
    // dotaz

    $query = "SELECT * FROM knihy";
    $result = mysqli_query($con,$query);
    if(!$result){
        die("Spatny dotaz". mysqli_connect_error());
    }
?>
<!-- vypis tabulky  -->
<table border="1">

        <?php while(($row=mysqli_fetch_array($result)) != 0){
            echo "<tr><td>" .$row["ISBN"] ."</td><td>" . $row["autor_jmeno"] . "</td><td>" . $row["autor_prijmeni"] ."</td><td>" .$row["nazev_knihy"] ."</td><td>" . $row["popis"] . "</td><td></tr>";
        };
        mysqli_free_result($result);
        mysqli_close($con);
        ?>
    </table>



</body>
</html>