<?php
// Tabel substitusi karakter
$encryptionTable = [
    'A' => 'Y', 'B' => 'U', 'C' => 'N', 'D' => 'I', 'E' => 'T',
    'F' => 'A', 'G' => 'B', 'H' => 'C', 'I' => 'D', 'J' => 'E',
    'K' => 'F', 'L' => 'G', 'M' => 'H', 'N' => 'J', 'O' => 'K',
    'P' => 'L', 'Q' => 'M', 'R' => 'O', 'S' => 'P', 'T' => 'Q',
    'U' => 'R', 'V' => 'S', 'W' => 'V', 'X' => 'W', 'Y' => 'X',
    'Z' => 'Z'
];

// Fungsi untuk mengenkripsi teks
function encryptText($text, $table) {
    $encryptedText = "";
    $text = strtoupper($text);

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if (array_key_exists($char, $table)) {
            $encryptedText .= $table[$char];
        } else {
            $encryptedText .= $char;
        }
    }

    return $encryptedText;
}

// Fungsi untuk mendekripsi teks
function decryptText($text, $table) {
    $decryptedText = "";
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        $originalChar = array_search($char, $table);
        if ($originalChar !== false) {
            $decryptedText .= $originalChar;
        } else {
            $decryptedText .= $char;
        }
    }

    return $decryptedText;
}

$text = "";
$processedText = "";
$operation = "encrypt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $operation = $_POST["operation"];

    if ($operation == "encrypt") {
        $processedText = encryptText($text, $encryptionTable);
    } elseif ($operation == "decrypt") {
        $processedText = decryptText($text, $encryptionTable);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caesar Cipher</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Caesar Cipher</h1>
        <form method="post" action="">
            <textarea name="text" placeholder="Masukkan teks di sini..."><?php echo htmlspecialchars($text); ?></textarea>
            <div>
                <label class="radio-inline"><input type="radio" name="operation" value="encrypt" <?php if ($operation == "encrypt") echo "checked"; ?>> Enkripsi</label>
                <label class="radio-inline"><input type="radio" name="operation" value="decrypt" <?php if ($operation == "decrypt") echo "checked"; ?>> Dekripsi</label>
            </div>
            <button type="submit" class="btn-primary">Proses</button>
        </form>

        <?php if (!empty($processedText)) : ?>
            <div class="result">
                <h2>Hasil:</h2>
                <p><?php echo htmlspecialchars($processedText); ?></p>
            </div>
        <?php endif; ?>

        <a href="vigenere.php"><button class="btn-default">Enkripsi Tahap Kedua</button></a>
    </div>
</body>
</html>
