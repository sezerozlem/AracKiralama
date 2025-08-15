<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $conn = new mysqli("localhost", "root", "", "akdb");

        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        $sql = "SELECT id, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId, $hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user_id'] = $userId;
                $_SESSION['user_email'] = $email;

                $stmt->close();
                $conn->close();

                header("Location: AraçKiralama.php");
                exit();
            } else {
                $_SESSION['login_error'] = "Şifre yanlış.";
            }
        } else {
            $_SESSION['login_error'] = "Kullanıcı bulunamadı.";
        }

        $stmt->close();
        $conn->close();

        // Başarısız giriş sonrası tekrar ana sayfaya yönlendir
        header("Location: AraçKiralama.php");
        exit();
    }
}
?>
