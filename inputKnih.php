<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="inputKnih.php">Vlozeni knihy </a>
    <a href="./seznamKnih.php">Seznam knih</a>
    <a href="vyhledavac.php">Vyhledat knihu</a>
    <h1>Vlozeni knihy</h1>
    <form action="inputKnih.php" method="POST" >
        <input type="text" name="ISBN" placeholder="ISBN"><br>
        <input type="text" name="jmeno" placeholder="Jmeno autora"><br>
        <input type="text" name="prijmeni" placeholder="Prijmeni autora"><br>
        <input type="text" name="nazev" placeholder="Nazev knihy"><br>
        <textarea name="popis" id="" cols="30" rows="10" placeholder="Popis"></textarea>
        
        <input type="submit" value="Odeslat">
    </form>
    <?php 

    include "dbLogin.php";
    $con = mysqli_connect($host,$user,$password, $db);
    if (!$con){
        die("Nelze se pripojit k db serveru</body></html>");
    } 
    
    $isbn = isset($_POST["ISBN"]) ? addslashes($_POST["ISBN"]) : '';
    $jmeno = isset($_POST["jmeno"]) ? addslashes($_POST["jmeno"]) : '';
    $prijmeni = isset($_POST["prijmeni"]) ? addslashes($_POST["prijmeni"]) : '';
    $nazev = isset($_POST["nazev"]) ? addslashes($_POST["nazev"]) : '';
    $popis = isset($_POST["popis"]) ? addslashes($_POST["popis"]) : '';
    
    
    
    $query = "INSERT INTO knihy(ISBN,autor_jmeno,autor_prijmeni,nazev_knihy,popis) VALUES('$isbn','$jmeno','$prijmeni','$nazev','$popis')";

    
    $result = mysqli_query($con,$query);
    if ($result)
    {
        echo "Uspesne vlozeno";
    }else{
        echo "Nelze vykonat". mysqli_error($con);
    }
    mysqli_close($con);
    ?>
</body>
</html>