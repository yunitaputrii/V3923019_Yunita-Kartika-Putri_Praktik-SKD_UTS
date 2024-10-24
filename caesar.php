<?php
// Tabel substitusi karakter
$encryptionTable = [
    'A' => 'Y',
    'B' => 'U',
    'C' => 'N',
    'D' => 'I',
    'E' => 'T',
    'F' => 'A',
    'G' => 'B',
    'H' => 'C',
    'I' => 'D',
    'J' => 'E',
    'K' => 'F',
    'L' => 'G',
    'M' => 'H',
    'N' => 'J',
    'O' => 'K',
    'P' => 'L',
    'Q' => 'M',
    'R' => 'O',
    'S' => 'P',
    'T' => 'Q',
    'U' => 'R',
    'V' => 'S',
    'W' => 'V',
    'X' => 'W',
    'Y' => 'X',
    'Z' => 'Z'
];

// Fungsi untuk mengenkripsi teks
function encryptText($text, $table) {
    $encryptedText = "";
    $text = strtoupper($text); // Konversi teks ke huruf besar

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        // Periksa apakah karakter ada dalam tabel substitusi
        if (array_key_exists($char, $table)) {
            $encryptedText .= $table[$char];
        } else {
            // Jika karakter tidak ada dalam tabel substitusi, biarkan karakter asli
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
        // Cari karakter asli dalam tabel substitusi
        $originalChar = array_search($char, $table);
        if ($originalChar !== false) {
            $decryptedText .= $originalChar;
        } else {
            // Jika karakter tidak ada dalam tabel substitusi, biarkan karakter asli
            $decryptedText .= $char;
        }
    }

    return $decryptedText;
}

// Inisialisasi variabel
$text = "";
$processedText = "";
$operation = ""; // Default operation is empty

// Memproses input saat formulir dikirim
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
    <title>Enkripsi dan Dekripsi Teks</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #007bff; /* Latar belakang biru */
            font-family: 'Montserrat', sans-serif;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #0056b3; /* Biru lebih gelap untuk container */
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            padding: 30px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #ffdd57; /* Warna cerah untuk kontras */
        }

        textarea {
            width: 100%;
            height: 120px;
            padding: 15px;
            border-radius: 10px;
            border: 2px solid #ffdd57; /* Border cerah */
            background: #0069d9; /* Biru lebih terang untuk textarea */
            color: #fff; /* Teks putih */
            font-size: 16px;
            resize: none;
            transition: border-color 0.3s, background 0.3s;
            margin-bottom: 20px;
        }

        textarea:focus {
            border-color: #ffdd57; /* Border cerah saat fokus */
            background: #007bff; /* Warna background lebih cerah saat fokus */
            outline: none;
        }

        .btn-operation {
            background-color: #ffdd57; /* Tombol berwarna cerah */
            color: #333;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
            transition: background-color 0.3s, transform 0.3s;
            margin: 10px 0;
        }

        .btn-operation:hover {
            background-color: #ffbd39; /* Warna lebih gelap saat hover */
            transform: translateY(-2px);
        }

        .btn-operation:active {
            transform: translateY(0);
        }

        .result {
            background: #004085; /* Biru sangat gelap untuk hasil */
            padding: 15px;
            border-radius: 10px;
            color: #ffdd57; /* Teks cerah untuk hasil */
            border: 2px solid #ffdd57; /* Border cerah */
            margin-top: 20px;
            text-align: left;
        }

        .salam-cinta {
            margin-top: 20px;
            color: #ffdd57; /* Warna cerah */
            font-size: 16px;
            position: relative;
            padding: 10px;
        }

        a {
            text-decoration: none;
        }

        .btn-default {
            background-color: #28a745; /* Tombol hijau cerah */
            padding: 12px;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            text-align: center;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-default:hover {
            background-color: #218838; /* Warna lebih gelap saat hover */
            transform: translateY(-2px);
        }

        .btn-default:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Enkripsi dan Dekripsi Teks</h1>
        <form method="post" action="">
            <textarea class="form-control" id="text" name="text" placeholder="Masukkan teks di sini..."><?php echo htmlspecialchars($text); ?></textarea>
            <button type="submit" name="operation" value="encrypt" class="btn-operation">Enkripsi</button>
            <button type="submit" name="operation" value="decrypt" class="btn-operation">Dekripsi</button>
        </form>

        <?php if (!empty($processedText)) : ?>
            <div class="result">
                <?php if ($operation == "encrypt") : ?>
                    <h2>Hasil Enkripsi:</h2>
                <?php elseif ($operation == "decrypt") : ?>
                    <h2>Hasil Dekripsi:</h2>
                <?php endif; ?>
                <p><?php echo htmlspecialchars($processedText); ?></p>
            </div>
        <?php endif; ?>

        <a href="vigenere.php"><button class="btn-default">Enkripsi Tahap Kedua</button></a>
    </div>

    </div>
</body>
</html>
