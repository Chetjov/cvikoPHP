<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vyhledat knihu</title>
</head>
<body>
    <a href="inputKnih.php">Vlozeni knihy</a>
    <a href="./seznamKnih.php">Seznam knih</a>
    <a href="vyhledavac.php">Vyhledat knihu</a>
    
    <h1>Vyhledat knihu</h1>

    <form action="vyhledavac.php" method="POST" >
        
        <input type="text" name="ISBN" placeholder="ISBN"><br>
        <input type="text" name="jmeno" placeholder="Jmeno autora"><br>
        <input type="text" name="prijmeni" placeholder="Prijmeni autora"><br>
        <input type="text" name="nazev" placeholder="Nazev knihy"><br>

        <input type="submit" value="Vyhledat">
    </form>

    <?php
    // Připojení k databázi
    include "dbLogin.php";
    $con = mysqli_connect($host, $user, $password, $db);
    if (!$con) {
        die("Nelze se pripojit k db serveru");
    }

    // Zpracování formuláře
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Získání hodnot z formuláře
        $ISBN = isset($_POST['ISBN']) ? mysqli_real_escape_string($con, $_POST['ISBN']) : '';
        $jmeno = isset($_POST['jmeno']) ? mysqli_real_escape_string($con, $_POST['jmeno']) : '';
        $prijmeni = isset($_POST['prijmeni']) ? mysqli_real_escape_string($con, $_POST['prijmeni']) : '';
        $nazev = isset($_POST['nazev']) ? mysqli_real_escape_string($con, $_POST['nazev']) : '';

        // Sestavení dotazu
        $query = "SELECT * FROM knihy WHERE 1";
        if (!empty($ISBN)) {
            $query .= " AND ISBN LIKE '%$ISBN%'";
        }
        if (!empty($jmeno)) {
            $query .= " AND autor_jmeno LIKE '%$jmeno%'";
        }
        if (!empty($prijmeni)) {
            $query .= " AND autor_prijmeni LIKE '%$prijmeni%'";
        }
        if (!empty($nazev)) {
            $query .= " AND nazev_knihy LIKE '%$nazev%'";
        }

        // Provedení dotazu
        $result = mysqli_query($con, $query);
        
        // Zobrazení výsledků
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<h1>Nalezené knihy:</h1>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div>";
                echo "<h3>" . $row["nazev_knihy"] . "</h3>";
                echo "Autor: " . $row["autor_jmeno"] . " " . $row["autor_prijmeni"] . "<br>";
                echo "ISBN: " . $row["ISBN"] . "<br>";
                echo "<br>";
                echo "</div>";
            }
        } else {
            echo "Žádné knihy nebyly nalezeny.";
        }
        
        // Uvolnění výsledku a uzavření spojení
        mysqli_free_result($result);
        mysqli_close($con);
    }
    ?>
</body>
</html>
