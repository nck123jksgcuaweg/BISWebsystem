<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $households = $_POST["households"];
    $families = $_POST["families"];
    $population = $_POST["population"];
    $males = $_POST["males"];
    $females = $_POST["females"];
    $elementary = $_POST["elementary"];
    $secondary = $_POST["secondary"];
    $tertiary = $_POST["tertiary"];
    $out_of_school = $_POST["out_of_school"];
    $govEmployee = $_POST["govEmployee"];
    $casEmployee = $_POST["casEmployee"];
    $selfEmployed = $_POST["selfEmployed"];
    $fishing = $_POST["fishing"];
    $fishVendor = $_POST["fishVendor"];
    $farmers = $_POST["farmers"];
    $laborer = $_POST["laborer"];
    $sarisari = $_POST["sarisari"];
    $business = $_POST["business"];
    $pdCab = $_POST["pdCab"];
    $triDriver = $_POST["tricycle"];
    $habalhabal = $_POST["habalhabal"];
    $jeepneyDriver = $_POST["jeepneyDriver"];
    $carpenter = $_POST["carpenter"];
    $seafarer = $_POST["seafarer"];
    $ofw = $_POST["ofw"];

    // Prepare the SQL query with placeholders
    $sql = "UPDATE `statistics` SET `households`=?, `families`=?, `population`=?, `males`=?, `females`=?, `elementary`=?, `secondary`=?, `tertiary`=?, `out_of_school`=?, `govEmployee`=?, `casEmployee`=?, `selfEmployed`=?, `fishing`=?, `fishVendor`=?, `farmers`=?, `laborer`=?, `sarisari`=?, `business`=?, `pdCab`=?, `triDriver`=?, `habalhabal`=?, `jeepneyDriver`=?, `carpenter`=?, `seaFarers`=?, `ofw`=? WHERE id=1";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("iiiiiiiiiiiiiiiiiiiiiiiii", $households, $families, $population, $males, $females, $elementary, $secondary, $tertiary, $out_of_school, $govEmployee, $casEmployee, $selfEmployed, $fishing, $fishVendor, $farmers, $laborer, $sarisari, $business, $pdCab, $triDriver, $habalhabal, $jeepneyDriver, $carpenter, $seafarer, $ofw );
    
    // Execute the statement
    $stmt->execute();
    
    // Redirect to the admin statistics page
    header("Location: admin-statistics.php");
    exit();
}
?>
