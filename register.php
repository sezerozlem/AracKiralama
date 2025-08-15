<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

        $host = "localhost";
        $db = "akdb";
        $user = "root";
        $pass = "";

        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {
            $_SESSION['register_success'] = "Kayıt başarılı! Giriş yapabilirsiniz.";
        } else {
            $_SESSION['register_error'] = "Bu e-posta zaten kayıtlı veya başka bir hata oluştu.";
        }

        $stmt->close();
        $conn->close();

        // Ana sayfaya yönlendir
        header("Location: AraçKiralama.php");
        exit();
    } else {
        $_SESSION['register_error'] = "E-posta veya şifre alanı boş!";
        header("Location: AraçKiralama.php");
        exit();
    }
} else {
    $_SESSION['register_error'] = "Form gönderilmedi.";
    header("Location: AraçKiralama.php");
    exit();
}
?>
