<?php
session_start();

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));  // Create a new CSRF token
}

// Validate CSRF token for form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'])) {
    die('Invalid CSRF token');
}

// Sanitize dynamic content
$productName = isset($productName) ? htmlspecialchars($productName, ENT_QUOTES, 'UTF-8') : '';
$productImage = isset($productImage) ? htmlspecialchars($productImage, ENT_QUOTES, 'UTF-8') : '';
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Tyne Brew Coffee - Quality coffee blends ethically sourced and roasted to perfection.">
    <meta name="author" content="Tyne Brew Coffee">
    <meta name="robots" content="index, follow">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Tyne Brew Coffee</title>

    <!-- Link to Font Awesome and External CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">


</head>

<body>
<div class="navbar">
        <div class="logo"> <img src="Images/mainlogo1.JPG">
        </div>
        <ul class="nav-list">
            <li><a href="index.php"><i class="fa fa-fw fa-home"></i>HOME</a></li>
            <li><a href="aboutus.php"><i class="fa fa-fw fa-home"></i>ABOUT US</a></li>
            <li><a href="loginn.php"><i class="fa fa-address-book"> </i> LOGIN</a></li>
            <li><a href="register.php"><i class="fa fa-sign-in"></i> REGISTER</a></li>
            <li><a href="admin.php"><i class="fa fa-sign-in"></i> ADMIN</a></li>
            <li><a href="basket.php"><img src="Images/basket.png" height="30px" width="30px"></a></li>
        </ul>
        <form action="search_results.php" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search Items " required>
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
    </div>

    </div>

    <!-- About Us and Philosophy Section -->
    <div class="about-container" style="padding: 40px 20px 20px; color: white; font-family: 'Roboto Condensed', sans-serif; margin-top: 120px; display: flex; gap: 20px; justify-content: space-between;">
        <!-- About Us Box -->
        <div style="background-color: rgba(255, 255, 255, 0.1); padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5); width: 48%; text-align: center; display: flex; flex-direction: column; justify-content: space-between; height: 300px;">
            <h1 style="font-size: 2rem; font-family: 'Permanent Marker', cursive; color: #e67e22;">About Us</h1>
            <p>At Tyne Brew Coffee, we are passionate about the art of coffee. We specialize in delivering rich and flavorful coffee blends crafted with the finest beans from around the world. With a strong commitment to sustainability, our coffee is ethically sourced and roasted to perfection.</p>
            <p>Our journey began in the heart of the community, where we built a loyal following of coffee lovers who share our love for high-quality coffee and exceptional service. Today, we’ve expanded our reach with an eCommerce platform, offering our signature blends and coffee accessories online, bringing the taste of Tyne Brew to homes across the globe.</p>
        </div>

        <!-- Coffee Philosophy Box -->
        <div style="background-color: rgba(255, 255, 255, 0.1); padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5); width: 48%; text-align: center; display: flex; flex-direction: column; justify-content: space-between; height: 300px;">
            <h2 style="font-size: 2rem; font-family: 'Permanent Marker', cursive; color: #e67e22;">Our Coffee Philosophy</h2>
            <p>At Tyne Brew Coffee, our mission is simple: to provide the highest quality coffee, to support sustainable practices, and to create a community where coffee lovers can connect and share their passion. We strive to make a positive impact not only in the coffee industry but also in our local and global communities.</p>        </div>
    </div>

    <!-- Team Section -->
    <div style="background-color: rgba(255, 255, 255, 0.1); padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5); margin-bottom: 40px;">
        <center><h2 style="font-size: 2rem; font-family: 'Permanent Marker', cursive; color: #e67e22;">Meet the Team</h2></center>
        <div class="team-section" style="display: flex; gap: 20px; justify-content: space-between; margin-top: 20px;">
            <!-- Team Member 1 -->
            <div class="team-member" style="text-align: center; width: 30%;">
                <img src="Images/team1.jpg" alt="Fahim Aziz - Founder & Head Barista" style="width: 100%; height: 500px; border-radius: 10px; margin-bottom: 10px;">
                <h3 style="color: #e67e22;">Fahim Aziz</h3>
                <h2 style="color: #e67e22;">Founder & Head Barista</h2>
                <p style="color: white;">Fahim is the heart and soul behind Tyne Brew Coffee. As the Founder & Head Barista, he has dedicated his life to perfecting the craft of coffee. His passion for the rich, complex flavors of coffee has driven him to travel the world, seeking out the finest beans and learning from the best baristas and roasters along the way. Fahim's vision for Tyne Brew is not just about offering exceptional coffee, but about creating a community of like-minded individuals who share his love for high-quality coffee, sustainability, and the art of brewing.</p>

            </div>
            <!-- Team Member 2 -->
            <div class="team-member" style="text-align: center; width: 30%;">
                <img src="Images/team2.jpg" alt="Sagari Burai - Roast Master" style="width: 100%; height: 500px; border-radius: 10px; margin-bottom: 10px;">
                <h3 style="color: #e67e22;">Sagari Burai</h3>
                <h2 style="color: #e67e22;">Roast Master</h2>
                <p style="color: white;">Sagari Burai is a master of his craft</p>
                <p style="color: white;">Sagari Burai is a master of his craft, bringing an unmatched level of expertise and passion to every batch of coffee he roasts. With years of experience and a keen understanding of flavor profiles, Sagari is able to create blends that highlight the nuances of each bean. His dedication to the roasting process ensures that every cup of coffee at Tyne Brew Coffee is rich, balanced, and full of character.</p>

            </div>
            <!-- Team Member 3 -->
            <div class="team-member" style="text-align: center; width: 30%;">
                <img src="Images/team3.jpg" alt="Murray Lambert - Operations Manager" style="width: 100%; height: 500px; border-radius: 10px; margin-bottom: 10px;">
                <h3 style="color: #e67e22;">Murray Lambert</h3>
                <h2 style="color: #e67e22;">Operations Manager</h2>
                <p style="color: white">Murray Lambert ensures everything runs smoothly</p>
                <p style="color: white;">Murray Lambert ensures everything runs smoothly, overseeing the daily operations with a meticulous eye for detail. His organizational skills and calm demeanor under pressure ensure that the entire team works cohesively to deliver the best experience to every customer.</p>

            </div>
        </div>
    </div>

    <!-- Why Choose Us Box -->
    <div style="background-color: rgba(255, 255, 255, 0.1); padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5); margin-bottom: 40px;">
        <center><h2 style="font-size: 2rem; font-family: 'Permanent Marker', cursive; color: #e67e22;">Why Choose Us?</h2></center>
        <center><ul style="color: white; font-size: 18px; line-height: 1.5;">
            <li>Expertly crafted blends from the finest beans</li>
            <li>Sustainably sourced and eco-friendly practices</li>
            <li>Commitment to community and customer satisfaction</li>
            <li>Friendly and knowledgeable team of coffee lovers</li>
            <li>Easy online shopping experience for your favorite coffee blend</li>
        </ul></center>
    </div>

    <!-- Footer Section -->
    <div class="footer" style="padding: 2rem; background: rgb(236, 165, 34); color: white; font-weight: 500; display: flex; justify-content: center; align-items: center; gap: 0.2rem;">
        <p>&copy; <span id="year"><?php echo $currentYear; ?></span> Tyne Brew Coffee. All rights reserved.</p>
    </div>

    <!-- Dynamic Year -->
    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
</body>
</html>
