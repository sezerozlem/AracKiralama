<?php
session_start();
if (isset($_SESSION['login_error'])) {
    echo "<script>alert('" . $_SESSION['login_error'] . "');</script>";
   
    unset($_SESSION['login_error']);
}
if (isset($_SESSION['register_success'])) {
    echo "
    <div id='successMessage' style='position: relative; background-color: #d4edda; color: #155724; padding: 10px 40px 10px 10px; margin: 10px; border-radius: 5px;'>
        <span onclick=\"document.getElementById('successMessage').style.display='none';\" 
              style='position: absolute; top: 5px; right: 10px; cursor: pointer; font-weight: bold;'>&times;</span>
        " . htmlspecialchars($_SESSION['register_success']) . "
    </div>";
    unset($_SESSION['register_success']);
}

if (isset($_SESSION['register_error'])) {
    echo "
    <div id='errorMessage' style='position: relative; background-color: #f8d7da; color: #721c24; padding: 10px 40px 10px 10px; margin: 10px; border-radius: 5px;'>
        <span onclick=\"document.getElementById('errorMessage').style.display='none';\" 
              style='position: absolute; top: 5px; right: 10px; cursor: pointer; font-weight: bold;'>&times;</span>
        " . htmlspecialchars($_SESSION['register_error']) . "
    </div>";
    unset($_SESSION['register_error']);
}


?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOSS Araç Kiralama</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header class="main-header">
        <div class="container">
            <img src="Resimler/logo.png" alt="Araç Kiralama Logo" class="logo">
            <h1 style="color: white;">BOSS Araç Kiralama</h1>
            <nav>
                <ul class="nav-links">
                    <li><a href="#home">Ana Sayfa</a></li>
                    <li><a href="#cars">Araçlar</a></li>
                    <li><a href="#contact">İletişim</a></li>
                </ul>
            </nav>
        </div>

        <div class="auth-buttons">
            <?php if (isset($_SESSION['user_email'])):
                $email = $_SESSION['user_email'];
                $email_parts = explode('@', $email);


                $username = substr($email_parts[0], 0, 2) . '****';
                $domain_parts = explode('.', $email_parts[1]);
                $domain = '****.' . end($domain_parts);

                $email_sansured = $username . '@' . $domain;
                ?>
                <span class="user-info">Hoşgeldiniz, <?php echo $email_sansured; ?></span>
                <br>
                <button style="margin-left:auto; float:right;" class="btn" onclick="location.href='logout.php'">Çıkış
                    Yap</button>
            <?php else: ?>
                <button id="loginButton">Giriş Yap</button>
                <button id="registerButton">Kayıt Ol</button>
            <?php endif; ?>

        </div>


        <div id="loginModal" class="modal">
            <div class="modal-content" id="loginContent">
                <span class="close" id="closeLogin">&times;</span>
                <h2>Giriş Yap</h2>
                <form action="login.php" method="post">
                    <label for="loginEmail">E-posta:</label>
                    <input type="email" name="email" id="loginEmail" required>
                    <label for="loginPassword">Şifre:</label>
                    <input type="password" name="password" id="loginPassword" required>
                    <button type="submit">Giriş Yap</button>
                </form>
            </div>
        </div>


        <div id="registerModal" class="modal">
            <div class="modal-content" id="registerContent">
                <span class="close" id="closeRegister">&times;</span>
                <h2>Kayıt Ol</h2>
                <form id="registerUserForm" action="register.php" method="post">
                    <label for="registerEmail">E-posta:</label>
                    <input type="email" name="email" id="registerEmail" required>
                    <label for="registerPassword">Şifre:</label>
                    <input type="password" name="password" id="registerPassword" required>
                    <label for="registerPasswordRepeat">Şifre Tekrar:</label>
                    <input type="password" id="registerPasswordRepeat" required>
                    <button type="submit">Kayıt Ol</button>
                </form>
            </div>
        </div>
    </header>

    <section id="home" class="hero">
        <div class="hero-content">
            <h2>Kolay, Hızlı ve Güvenilir Araç Kiralama</h2>
            <p>Hemen size uygun aracı bulun ve rezervasyon yapın.</p>
            <form class="search-form">
                <label for="location">Lokasyon:</label>
                <input type="text" id="location" placeholder="Şehir veya Lokasyon" required>

                <div style="display: flex; gap: 20px; align-items: center;">
                    <div>
                        <label for="start-date">Başlangıç Tarihi:</label><br>
                        <input type="date" id="start-date" required>
                    </div>
                    <div>
                        <label for="end-date">Bitiş Tarihi:</label><br>
                        <input type="date" id="end-date" required>
                    </div>
                </div>

                <button type="submit">Araç Bul</button>
            </form>
        </div>
    </section>



    <section id="cars" class="cars-section">
        <h2>Mevcut Araçlar</h2>
        <div class="car-list">

            <div class="car-card">
                <img src="Resimler/araba1.png" alt="Ford Focus">
                <h3>Ford Focus</h3>
                <p>Fiyat: 500 TL/gün</p>
                <button onclick="location.href='ford_focus.html'">Rezervasyon Yap</button>
            </div>
            <div class="car-card">
                <img src="Resimler/araba2.png" alt="Renault Clio">
                <h3>Renault Clio</h3>
                <p>Fiyat: 450 TL/gün</p>
                <button onclick="location.href='renault_clio.html'">Rezervasyon Yap</button>
            </div>
            <div class="car-card">
                <img src="Resimler/araba3.png" alt="Toyota Corolla">
                <h3>Toyota Corolla</h3>
                <p>Fiyat: 1000 TL/gün</p>
                <button onclick="location.href='toyota_corolla.html'">Rezervasyon Yap</button>
            </div>
        </div>
    </section>


    <section id="contact" class="contact-section">
        <h2>İletişim</h2>
        <ul>
            <li>Email: <a href="mailto:info@bossarackiralama.com">info@bossarackiralama.com</a></li>
            <li>Telefon: <a href="tel:+905555555555">+90 555 555 5555</a></li>
            <li>Adres: Kırklareli, Türkiye</li>
        </ul>
    </section>

    <footer class="main-footer">
        <p>&copy; 2024 Araç Kiralama. Tüm hakları saklıdır.</p>
    </footer>
    
    <script src="script.js"></script>
</body>

</html>