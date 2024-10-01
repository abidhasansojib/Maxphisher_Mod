<?php
// Get current date and time for a unique filename
$date = date('dMYHis');
$imageData = $_POST['cat'];

if (!empty($imageData)) {
    // Log the received image data
    error_log("Received image: " . $date . "\r\n", 3, "log.txt");

    // Extract the base64 data (ignore the "data:image/png;base64," part)
    $filteredData = substr($imageData, strpos($imageData, ",") + 1);
    $unencodedData = base64_decode($filteredData);

    // Create a new PNG file and write the image data to it
    $fileName = 'CamCapture-' . $date . '.png';
    $fp = fopen($fileName, 'wb');
    if ($fp) {
        fwrite($fp, $unencodedData);
        fclose($fp);
        error_log("Image saved as: " . $fileName . "\r\n", 3, "log.txt");
    } else {
        error_log("Failed to write image file.\r\n", 3, "log.txt");
    }
}

// Respond with success status for the AJAX call
echo json_encode(['status' => 'success']);
?>

