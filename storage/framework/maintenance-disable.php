<?php
// Fichier maintenance.php

// Configuration des messages et des options
$maintenance_message = "Le site est actuellement en maintenance. Veuillez revenir plus tard.";
$maintenance_mode = true; // Basculer sur 'false' pour désactiver le mode maintenance

// Fonction pour afficher la page de maintenance
function display_maintenance_page($message) {
    http_response_code(503); // Code HTTP pour Service Indisponible
    echo "<!DOCTYPE html>";
    echo "<html lang='fr'>";
    echo "<head>";
    echo "    <meta charset='UTF-8'>";
    echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "    <title>Maintenance</title>";
    echo "    <style>";
    echo "        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background-color: #f3f3f3; color: #333; }";
    echo "        h1 { color: #ff6347; }";
    echo "    </style>";
    echo "</head>";
    echo "<body>";
    echo "    <h1>Maintenance en cours</h1>";
    echo "    <p>" . htmlspecialchars($message) . "</p>";
    echo "</body>";
    echo "</html>";
    exit;
}

// Vérification du mode maintenance
if ($maintenance_mode) {
    display_maintenance_page($maintenance_message);
}

// Si le mode maintenance est désactivé, vous pouvez inclure le reste de votre application
?>
