<?php
// Fungsi enkripsi Vigenere Cipher
function vigenereEncrypt($text, $key) {
    $text = strtoupper($text);
    $key = strtoupper($key);
    $encryptedText = '';
    $keyLength = strlen($key);
    $keyIndex = 0;

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];

        if (!ctype_alpha($char)) {
            $encryptedText .= $char;
            continue;
        }

        $charOffset = ord($char) - 65;
        $keyCharOffset = ord($key[$keyIndex % $keyLength]) - 65;
        $encryptedChar = chr((($charOffset + $keyCharOffset) % 26) + 65);

        $encryptedText .= $encryptedChar;
        $keyIndex++;
    }

    return $encryptedText;
}

// Fungsi dekripsi Vigenere Cipher
function vigenereDecrypt($text, $key) {
    $text = strtoupper($text);
    $key = strtoupper($key);
    $decryptedText = '';
    $keyLength = strlen($key);
    $keyIndex = 0;

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];

        if (!ctype_alpha($char)) {
            $decryptedText .= $char;
            continue;
        }

        $charOffset = ord($char) - 65;
        $keyCharOffset = ord($key[$keyIndex % $keyLength]) - 65;
        $decryptedChar = chr(((($charOffset - $keyCharOffset) + 26) % 26) + 65);

        $decryptedText .= $decryptedChar;
        $keyIndex++;
    }

    return $decryptedText;
}

$text = "";
$key = "YUNITA";
$encryptedText = "";
$decryptedText = "";
$operation = "encrypt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $operation = $_POST["operation"];

    if ($operation == "encrypt") {
        $encryptedText = vigenereEncrypt($text, $key);
    } elseif ($operation == "decrypt") {
        $decryptedText = vigenereDecrypt($text, $key);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenere Cipher</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Vigenere Cipher</h1>
        <form method="post" action="">
            <input type="text" name="text" placeholder="Masukkan teks di sini..." value="<?php echo htmlspecialchars($text); ?>">
            <div class="operation-buttons">
                <button type="submit" class="btn-primary" name="operation" value="encrypt">Enkripsi</button>
                <button type="submit" class="btn-primary" name="operation" value="decrypt">Dekripsi</button>
            </div>
        </form>

        <?php if (!empty($encryptedText) || !empty($decryptedText)) : ?>
            <div class="result">
                <?php if ($operation == "encrypt"): ?>
                    <h2>Hasil Enkripsi</h2>
                    <p>Input: <?php echo htmlspecialchars($text); ?></p>
                    <p>Output: <?php echo htmlspecialchars($encryptedText); ?></p>
                <?php elseif ($operation == "decrypt"): ?>
                    <h2>Hasil Dekripsi</h2>
                    <p>Input: <?php echo htmlspecialchars($text); ?></p>
                    <p>Output: <?php echo htmlspecialchars($decryptedText); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <a href="caesar.php"><button class="btn-default">Enkripsi Tahap Pertama</button></a>
    </div>
</body>
</html>
