<?php
function konversiSuhu($celcius) {
    $fahrenheit = ($celcius * 9/5) + 32;
    return "Suhu " . $celcius . "°C dalam Fahrenheit adalah " . $fahrenheit . "°F";
}

// Input suhu dalam Celcius
$celcius = 30;
echo konversiSuhu($celcius);
?>
