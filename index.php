<?php
$wedding_date = "September 7, 2024";
$venue = "Beautiful Wedding Venue";
$time = "1:30 PM";
$address = "Most Rev. Kwesi Dickson Memorial Methodist Chapel, Adjiringanor";
$google_maps_link = "https://maps.app.goo.gl/HjZGqbGNi8ZNHLZh7";
$qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode("https://wedding.emmallextech.com/pdf");

// Get all image files from the photoshoot directory
$photoshoot_dir = "assets/images/photoshoot";
$photos = glob($photoshoot_dir . "/*.{jpg,jpeg,png,gif}", GLOB_BRACE);

// Sort the files alphabetically
sort($photos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Wedding - <?php echo $wedding_date; ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header hidden>
        <h1>Our Wedding</h1>
        <p class="date"><?php echo $wedding_date; ?></p>
    </header>

    <main>
        <section id="location">
            <img src="assets/images/logo.jpeg" width="100%" alt="Wedding Location">
            <h2></h2>
            <p><strong>Time:</strong> <?php echo $time; ?></p>
            <p><strong>Date:</strong> <?php echo $wedding_date; ?></p>
            <p><strong>Venue:</strong> <?php echo $address; ?></p>
            <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.4718986073362!2d-0.13038682501418508!3d5.644650294336619!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf849e371a4c6b%3A0xc39e46b96c80314a!2sMost%20Rev.%20Kwesi%20Dickson%20Memorial%20Methodist%20Chapel%2C%20Adjiringanor!5e0!3m2!1sen!2sgh!4v1724840292577!5m2!1sen!2sgh" 
                width="600" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            </div>
        </section>
        <section id="slideshow">
            <h2>Our Pre-Wedding Photos</h2>
            <div class="slideshow-container">
                <?php foreach ($photos as $index => $photo): ?>
                    <div class="slide fade">
                        <img src="<?php echo $photo; ?>" alt="Pre-wedding photo <?php echo $index + 1; ?>">
                    </div>
                <?php endforeach; ?>
                <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
                <a class="next" onclick="changeSlide(1)">&#10095;</a>
            </div>
        </section>

        <section id="qr-code">
            <h2>Download Our Program</h2>
            <img src="<?php echo $qr_code_url; ?>" alt="QR Code for Wedding Program">
            <p>Scan this QR code to download our wedding program</p>
        </section>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> - Emmanuel & Emmanuella</p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>
