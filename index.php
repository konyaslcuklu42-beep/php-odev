<?php
// 1. Oturumu başlat
session_start();

// 2. Değişkenleri tanımla ve boş değerler ata
$username = $password = "";
$username_err = $password_err = $login_err = "";

// 3. Form gönderildiğinde bu blok çalışır
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Kullanıcı adı kontrolü
    if(empty(trim($_POST["username"]))){
        $username_err = "Lütfen kullanıcı adınızı girin.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Şifre kontrolü
    if(empty(trim($_POST["password"]))){
        $password_err = "Lütfen şifrenizi girin.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // 4. Doğrulama (admin / 12345)
    if(empty($username_err) && empty($password_err)){
        if($username === "admin" && $password === "12345"){
            // GİRİŞ BAŞARILI
            $_SESSION['loggedin'] = true;
            
            // BURASI ÖNEMLİ: Senin ana sayfana yönlendirir
            header("location:index.html"); 
            exit;
        } else{
            // GİRİŞ HATALI
            $login_err = "Kullanıcı adı veya şifre yanlış!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <style>
        /* Arka planı renkli ve ortalı yapar */
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Login kutusu tasarımı */
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 350px;
            text-align: center;
        }

        h2 { color: #333; margin-bottom: 20px; }

        .form-group { margin-bottom: 15px; text-align: left; }

        label { display: block; margin-bottom: 5px; color: #666; }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Hata mesajı stili */
        .error-text { color: #e74c3c; font-size: 13px; margin-top: 5px; }
        .alert { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; }

        /* Giriş butonu */
        .btn {
            width: 100%;
            padding: 12px;
            background: #764ba2;
            border: none;
            color: white;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover { background: #5a3a7d; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Giriş Paneli</h2>
        
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Kullanıcı Adı</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="error-text"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Şifre</label>
                <input type="password" name="password" class="form-control">
                <span class="error-text"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Giriş Yap">
            </div>
            <p style="font-size: 12px; color: #999;">Test: admin / 12345</p>
        </form>
    </div>

</body>
</html>