<?php
try {
    $connection = new PDO('mysql:host=localhost;port=3306;dbname=cs370_section2_csquids', 'cs370_section2_csquids', 'sdiuqsc_003');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'Connection error';
    return;
}
?>
