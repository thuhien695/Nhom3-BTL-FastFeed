<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Admin - FastFeed'; ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CKEditor -->
    <?php $useCKEditor = true; ?>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/style.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block admin-sidebar">
                <div class="text-center">
                    <a href="<?php echo ROOT_URL; ?>" class="d-flex align-items-center justify-content-center mb-3">
                        <img src="<?php echo ROOT_URL; ?>assets/images/logo.jpg" alt="Web Logo" class="me-2 rounded-circle" style="height: 50px;">
                        <img src="<?php echo ROOT_URL; ?>assets/images/fastfeed.png" alt="FastFeed Logo" class="me-2" style="height: 40px;">
                    </a>
                </div>

                <div class="navbar-nav">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
                        <i class="fas fa-tachometer-alt"></i> Bảng điều khiển
                    </a>
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'posts.php' || basename($_SERVER['PHP_SELF']) == 'create_post.php' || basename($_SERVER['PHP_SELF']) == 'edit_post.php' ? 'active' : ''; ?>" href="posts.php">
                        <i class="fas fa-file-alt"></i> Quản lý bài viết
                    </a>
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'comments.php' ? 'active' : ''; ?>" href="comments.php">
                        <i class="fas fa-comments"></i> Quản lý bình luận
                    </a>
                    <div class="border-top my-3"></div>
                    <a class="nav-link" href="<?php echo ROOT_URL; ?>" target="_blank">
                        <i class="fas fa-home"></i> Xem trang chủ
                    </a>
                    <a class="nav-link" href="<?php echo ROOT_URL; ?>logout.php">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </a>
                </div>
            </div>

            <!-- Main content -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4 py-4">
                <!-- Flash Messages -->
                <div class="container-fluid mb-4">
                    <?php displayFlash(); ?>
                </div>
                <!-- Content starts here - Footer will close the opened divs -->