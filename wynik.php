<?php
// 1. Dane do logowania (zmień na swoje)
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "moja_baza";

$conn = new mysqli($host, $user, $pass, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// 2. Pobranie i zabezpieczenie słowa kluczowego
$szukaj = isset($_GET['fraza']) ? $conn->real_escape_string($_GET['fraza']) : '';

echo "<h2>Wyniki dla: " . htmlspecialchars($szukaj) . "</h2>";

// 3. Zapytanie SQL z operatorem LIKE
$sql = "SELECT * FROM artykuly WHERE tytul LIKE '%$szukaj%' OR tresc LIKE '%$szukaj%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row['tytul'] . "</h3>";
        echo "<p>" . $row['tresc'] . "</p>";
        echo "</div><hr>";
    }
} else {
    echo "Niestety, nic nie znaleziono.";
}

$conn->close();
?>
