<?php
// Kết nối đến cơ sở dữ liệu và bắt đầu phiên làm việc
require_once 'config/init.php';

// Nếu đã đăng nhập thì chuyển hướng đến trang chủ
if(isLoggedIn()) {
    redirect('');
}

// Tiêu đề trang
$pageTitle = "Đăng ký - FastFeed";

// Biến chứa lỗi
$errors = [];

// Xử lý form khi người dùng bấm đăng ký
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy và làm sạch dữ liệu
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Kiểm tra dữ liệu
    if(empty($fullname)) {
        $errors[] = "Họ tên không được để trống";
    }
    
    if(empty($email)) {
        $errors[] = "Email không được để trống";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không hợp lệ";
    } elseif($userModel->emailExists($email)) {
        $errors[] = "Email đã được sử dụng";
    }
    
    if(empty($password)) {
        $errors[] = "Mật khẩu không được để trống";
    } elseif(strlen($password) < 6) {
        $errors[] = "Mật khẩu phải có ít nhất 6 ký tự";
    }
    
    if($password != $confirm_password) {
        $errors[] = "Xác nhận mật khẩu không khớp";
    }
    
    // Nếu không có lỗi, thực hiện đăng ký, rgt-save
    if(empty($errors)) {
        $result = $userModel->register($fullname, $email, $password);
        
        if($result) {
            // Thông báo đăng ký thành công
            setFlash('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
            redirect('login.php');
        } else {
            $errors[] = "Có lỗi xảy ra, vui lòng thử lại sau";
        }
    }
}

// Giao diện HTML, Bao gồm header, req-ktra
include 'includes/header.php';
?>

<!-- Form đăng ký --> 
<div class="container">
    <div class="auth-container">
        <h2 class="auth-title">Đăng ký</h2>
        
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="auth-form">
            <div class="mb-3">
                <label for="fullname" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required value="<?php echo isset($fullname) ? $fullname : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?php echo isset($email) ? $email : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <small class="text-muted">Mật khẩu phải có ít nhất 6 ký tự</small>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
        
        <div class="auth-links mt-3">
            <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 