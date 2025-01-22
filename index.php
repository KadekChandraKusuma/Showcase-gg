<?php
require_once 'koneksi.php';

$sql = "SELECT id, title, image, release_date, developer FROM games";

$result = $conn->query($sql);
?>


<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Unggulan Game List</title>
  <link rel="icon" type="image/x-icon" href="asset/favicon-32x32.png">
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="assets/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">

 </head>


 <body class="bg-gray-900 text-white">
  <header class="bg-gray-800 py-4">
   <div class="container mx-auto flex justify-between items-center px-4">
    <div class="flex items-center space-x-4">
     <img alt="Logo" class="logo" height="40" src="assets/img/Logo-01.png" width="40"/>
     <nav class="navbartga">
      <a href="index.php" class="text-white" href="#">Home</a>
      <a href="admin/admin.php" class="text-white" href="#">Admin</a>
      <a href="community.html" class="text-white" href="#">Community</a>
      <a href="aboutus.html" class="text-white" href="#">About Us</a>
     </nav>
    </div>
   </div>
  </header>
  <main class="container mx-auto px-4 py-8" style="padding-top: 200px; margin-bottom: 200px;">
   <section class="text-center mb-8">
    <h1 class="text-4xl font-bold text-white-500" style="text-align: left; font-size: 50px; margin-bottom: 20px;">
     BARUDAK UNGGULAN
    </h1>
    <h1 class="text-4xl font-bold text-white-500" style="text-align: left; font-size: 50px; margin-bottom: 40px;">
      GAME LIST
    </h1>
    <p class="text-lg" style="text-align: left; ">
      Kumpulan game terbaik menurut barudak unggulan <br> Kampus ITB STIKOM Bali
    </p>
   </section>

   <!-- Pindahkan grid ke luar loop -->
   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
   <?php
   if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
   ?>
       <div class="custom-box">
          <img alt="<?php echo $row['title']; ?>" class="image" src="assets/<?php echo $row['image']; ?>" />
          
           <a href="detailgame.php?id=<?php echo $row['id']; ?>">
               <button class="button-details" style="margin-top: 5px;">More Details</button>
           </a>
           
           <h2 class="game-title"><?php echo $row['title']; ?></h2>
           <p><?php echo $row['developer']; ?></p>
       </div>
   <?php
       }
   } else {
       echo "<p>No games found.</p>";
   }
   ?>
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