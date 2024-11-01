<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../Public/theme.css">
    <title>SIPINJAM - Riwayat</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .profile-container {
            width: 350px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .header {
            background-color: #4a4fe7;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            margin: 0 auto;
            border-radius: 50%;
            background-color: #fff;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .profile-pic img {
            width: 70%;
            border-radius: 50%;
        }

        .user-info h2 {
            margin: 10px 0 5px;
            font-size: 18px;
            font-weight: bold;
        }

        .user-info p {
            font-size: 14px;
            color: #dcdcdc;
        }

        .logout {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: #ff6666;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .menu {
            padding: 10px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 10px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 16px;
            color: #555;
            cursor: pointer;
        }

        .menu-item:last-child {
            border-bottom: none;
        }

        .icon {
            margin-right: 15px;
            font-size: 20px;
        }

        .arrow {
            margin-left: auto;
            font-size: 16px;
            color: #ccc;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
            margin-left: auto;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #4a4fe7;
        }

        input:checked + .slider:before {
            transform: translateX(18px);
        }
    </style>
</head>

<body>

    <!-- Profile aku buatin sidebar -->

    <!-- Sidebar -->
    <?php include '../../components/sidebar.php' ?>
    <!-- End Sidebar -->

    <!-- Header -->
    <?php include '../../components/header.php' ?>
    <!-- End Header -->

     <!-- Profile -->
    <div class="profile-container">
        <div class="header">
            <div class="profile-pic">
                <img src="https://via.placeholder.com/100" alt="Profile Picture">
            </div>
            <div class="user-info">
                <h2><?php echo "PENGGUNA SIPINJAM"; ?></h2>
                <p><?php echo "sipinmataku@gmail.com"; ?></p>
            </div>
            <form action="logout.php" method="post">
                <button type="submit" class="logout">Log out</button>
            </form>
        </div>
        <div class="menu">
            <div class="menu-item">
                <span class="icon">✏️</span>
                <span>Edit Profile</span>
                <span class="arrow">></span>
            </div>
            <div class="menu-item">
                <span class="icon">🔒</span>
                <span>Edit Password</span>
                <span class="arrow">></span>
            </div>
            <div class="menu-item">
                <span class="icon">🔔</span>
                <span>Notifikasi</span>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>
            <div class="menu-item">
                <span class="icon">🌐</span>
                <span>Bahasa</span>
                <span class="arrow">></span>
            </div>
            <div class="menu-item">
                <span class="icon">❓</span>
                <span>FAQ</span>
                <span class="arrow">></span>
            </div>
        </div>
    </div>
<!-- End Profile -->
</body>

</html>