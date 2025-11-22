<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : SITE_NAME; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CKEditor (chỉ cho admin) -->
    <?php if(isset($useCKEditor) && $useCKEditor): ?>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <?php endif; ?>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/style.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-md-3">
                    <a href="<?php echo ROOT_URL; ?>" class="logo">
                    <img src="<?php echo ROOT_URL; ?>assets/images/logoweb.jpg" alt="Web Logo" class="me-2 rounded-circle" style="height: 50px;">
                    <img src="<?php echo ROOT_URL; ?>assets/images/fastfeed.png" alt="FastFeed Logo" class="me-2" style="height: 40px;">
                    </a>
                </div>
                
                <!-- Search bar -->
                <div class="col-md-5">
                    <form action="<?php echo ROOT_URL; ?>search.php" method="GET" class="search-form">
                        <input type="text" name="keyword" placeholder="Tìm kiếm" class="search-input">
                        <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                
                <!-- Navigation -->
                <div class="col-md-4">
                    <nav class="main-nav">
                        <ul class="nav-list">
                            <li><a href="<?php echo ROOT_URL; ?>about.php">Giới thiệu</a></li>
                            <li><a href="<?php echo ROOT_URL; ?>posts.php">Bài viết</a></li>
                            <?php if(isLoggedIn()): ?>
                                <?php if(isAdmin()): ?>
                                    <li><a href="<?php echo ADMIN_URL; ?>">Quản lý</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo ROOT_URL; ?>logout.php">Đăng xuất</a></li>
                            <?php else: ?>
                                <li><a href="<?php echo ROOT_URL; ?>login.php" class="login-link">Đăng nhập</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Flash Messages -->
    <div class="container mt-3">
        <?php displayFlash(); ?>
    </div>
</body>
</html> 