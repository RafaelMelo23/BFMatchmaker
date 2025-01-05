<link rel="stylesheet" href="/swbfsite/assets/css/navbar.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;400;600;800&display=swap" rel="stylesheet">

<nav>
    <div class="nav-left">
    <a class="home-link <?php if(basename($_SERVER['PHP_SELF']) == 'home.php') echo 'current'; ?>" href="/swbfsite/pages/home.php">HOME</a>
    <a href="https://discord.gg/JfhKSeBDZc" target="_blank" class="discord-link">COMMUNITY DISCORD</a>
    <a class="availability-link <?php if(basename($_SERVER['PHP_SELF']) == 'availability-form.php') echo 'current'; ?>" href="/swbfsite/pages/availability-form.php">YOUR MATCHMAKE</a>
    <a class="terms-link <?php if(basename($_SERVER['PHP_SELF']) == 'terms-and-privacy.php') echo 'current'; ?>" href="/swbfsite/pages/terms-and-privacy.php">TERMS AND PRIVACY</a>
    </div>
    <div class="navbar-login-register">
    </div>
</nav>

