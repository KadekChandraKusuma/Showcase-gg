<?php
require_once 'koneksi.php';

// Ambil game_id dari URL
$game_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mendapatkan detail game
$query_game = "SELECT * FROM games WHERE id = $game_id";
$result_game = mysqli_query($conn, $query_game);

// Jika game tidak ditemukan, redirect ke halaman utama
if (!$result_game || mysqli_num_rows($result_game) == 0) {
    header("Location: index.php");
    exit;
}

// Ambil data game
$game = mysqli_fetch_assoc($result_game);

// Ambil data screenshot
$query_screenshots = "SELECT image_path FROM photos WHERE game_id = ?";
$stmt_screenshots = $conn->prepare($query_screenshots);
$stmt_screenshots->bind_param("i", $game_id);
$stmt_screenshots->execute();
$result_screenshots = $stmt_screenshots->get_result();

// Simpan data screenshot
$screenshots = [];
while ($row = $result_screenshots->fetch_assoc()) {
    $screenshots[] = $row['image_path'];
}

// Jika game tidak ditemukan
if (!$game) {
    echo "<h1>Game tidak ditemukan.</h1>";
    exit;
}

// Query untuk mendapatkan system requirements
$query_requirements = "SELECT * FROM system_requirements WHERE game_id = $game_id";
$result_requirements = mysqli_query($conn, $query_requirements);
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo $game['title']; ?> - Detail Game</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon-32x32.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="bg-gray-900 text-white">
    <header class="bg-gray-800 py-4 navbar-admin">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="flex items-center space-x-4">
                <img alt="Logo" class="logo" height="40" src="assets/img/Logo-01.png" width="40"/>
                <nav class="navbartga">
                    <a href="index.php" class="text-white">Home</a>
                    <a href="admin/admin.php" class="text-white">Admin</a>
                    <a href="community.html" class="text-white">Community</a>
                    <a href="aboutus.html" class="text-white">About Us</a>
                </nav>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8" style="padding-top: 50px; margin-bottom: 100px">
        <div class="container-trailer">
        <iframe 
          width="560" 
          height="315" 
          src="<?php echo htmlspecialchars($game['trailer_url'], ENT_QUOTES, 'UTF-8'); ?>"
          title="YouTube video player" 
          frameborder="0" 
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
          allowfullscreen>
        </iframe>

            <div class="text-deskripsi-game mt-8">
                <h1 style="font-size: 60px; font-weight: bold;"><?php echo $game['title']; ?></h1>
                <p><?php echo $game['description']; ?></p>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-4">Foto Game</h2>
        <?php if (!empty($screenshots)): ?>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php foreach ($screenshots as $screenshot): ?>
                <div class="screenshot">
                    <img src="<?= htmlspecialchars($screenshot); ?>" alt="Screenshot" class="w-full h-auto rounded">
                </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p>Tidak ada screenshot untuk game ini.</p>
        <?php endif; ?>
        </div>
    </main>

    <div class="footer">
        <img src="assets/img/Logo Long-02.png" alt="logo long">
        <img src="assets/img/Logo Sport Academy Wide-02.png" alt="MySport.ID">
        <img src="assets/img/Logo text-02.png" alt="NGNL">
        <img src="assets/img/ByteSpace Logo Long-putih 03-03.png" alt="Ekik">
        <img src="assets/img/Ruminity-03.png" alt="Ruminity">
    </div>
</body>
</html>
