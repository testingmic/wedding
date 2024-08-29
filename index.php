<?php
#display errors
error_reporting(E_ALL);

if($_SERVER['HTTP_HOST'] == "localhost") {
	// display the errors
	ini_set("display_errors", 1);
}

#set new places for my error recordings
ini_set("log_errors","1");
ini_set("error_log", "errors_log");

$wedding_date = "September 7, 2024";
$venue = "Beautiful Wedding Venue";
$time = "1:30 PM";
$address = "Most Rev. Kwesi Dickson Memorial Methodist Chapel, Adjiringanor";
$google_maps_link = "https://maps.app.goo.gl/HjZGqbGNi8ZNHLZh7";
$qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode("https://wedding.emmallextech.com/assets/program.pdf");

// Get all image files from the photoshoot directory
$photos = glob("assets/images/photoshoot" . "/*.{jpg,jpeg,png,gif,JPG}", GLOB_BRACE);

// Get all image files from the program directory
$program_photos = glob("assets/images/program" . "/*.{jpg,jpeg,png,gif,JPG}", GLOB_BRACE);  

// Sort the files alphabetically
sort($photos);
sort($program_photos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Wedding - <?php echo $wedding_date; ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- heatmap.com snippet -->
    <script>
    (function() {      
        var _heatmap_paq = window._heatmap_paq || [];
        var heatUrl = window.heatUrl = "https://dashboard.heatmap.com/";
        function heatLoader(url, item) {
        if(typeof handleSinglePagedWebsite !== 'undefined' && item == 'prep') return true;
        var s = document.createElement("script"); s.type = "text/javascript"; 
        s.src = url; s.async = false; s.defer = true; document.head.appendChild(s);
        }
        heatLoader(heatUrl+"preprocessor.min.js?sid=2705", "prep");
        setTimeout(function() {
        if(typeof _heatmap_paq !== "object" || _heatmap_paq.length == 0) {     
            _heatmap_paq.push(["setTrackerUrl", heatUrl+"heatmap.php"]);
            heatLoader(heatUrl+"heatmap-light.min.js?sid=2705", "heat");
        }
        }, 1000);
    })();
    </script>
    <!-- End heatmap.com snippet Code -->
</head>
<body>
    <header hidden>
        <h1 style="text-align: center;">Our Wedding</h1>
        <p class="date"><?php echo $wedding_date; ?></p>
    </header>

    <main>
        <section id="location">
            <img src="assets/images/logo.jpeg" width="100%" alt="Wedding Location">
            <h2></h2>
            <p><strong>Time:</strong> <?php echo $time; ?></p>
            <p><strong>Date:</strong> <?php echo $wedding_date; ?></p>
            <p><strong>Venue:</strong> <?php echo $address; ?></p>
        </section>

        <!-- Pre-wedding Photos Slideshow -->
        <section id="slideshow">
            <h2 class="center">Our Pre-Wedding Photos</h2>
            <div class="slideshow-container prewedding-slideshow">
                <?php foreach ($photos as $index => $photo): ?>
                    <div class="slide fade">
                        <img src="<?php echo $photo; ?>" alt="Pre-wedding photo <?php echo $index + 1; ?>">
                    </div>
                <?php endforeach; ?>
                <a class="prev" onclick="changeSlide(-1, this.closest('.slideshow-container'))">&#10094;</a>
                <a class="next" onclick="changeSlide(1, this.closest('.slideshow-container'))">&#10095;</a>
            </div>
        </section>

        <!-- Program Slideshow -->
        <section id="program-slideshow">
            <h2 class="center">Our Wedding Program</h2>
            <div class="center">
                <a href="assets/program.pdf" download class="download-button">Download Wedding Program</a>
            </div>
            <div class="slideshow-container program-slideshow">
                <?php foreach ($program_photos as $index => $page): ?>
                    <div class="slide fade">
                        <img height="100%" width="100%" src="<?php echo $page; ?>" alt="Program page <?php echo $index + 1; ?>">
                    </div>
                <?php endforeach; ?>
                <a class="prev" onclick="changeSlide(-1, this.closest('.slideshow-container'))">&#10094;</a>
                <a class="next" onclick="changeSlide(1, this.closest('.slideshow-container'))">&#10095;</a>
            </div>
        </section>

        <section id="location">
            <h2 class="center">Google Maps Location</h2>
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


    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> - Emmanuel & Emmanuella</p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>
