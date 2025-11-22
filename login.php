<?php
// Kết nối đến cơ sở dữ liệu và bắt đầu phiên làm việc
require_once 'config/init.php';

// Nếu đã đăng nhập thì chuyển hướng đến trang chủ
if(isLoggedIn()) {
    redirect(''); //chvetrangchu
}

// Tiêu đề trang
$pageTitle = "Đăng nhập - FastFeed";

// Biến chứa lỗi
$errors = [];

// Xử lý form đăng nhập
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy và làm sạch dữ liệu
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    // Kiểm tra dữ liệu
    if(empty($email)) {
        $errors[] = "Email không được để trống";
    }
    
    if(empty($password)) {
        $errors[] = "Mật khẩu không được để trống";
    }
    
    // Nếu không có lỗi, thực hiện đăng nhập
    if(empty($errors)) {
        $user = $userModel->login($email, $password);
        
        if($user) {
            // Tạo phiên đăng nhập, Lưu thông tin vào $_S để ghi nhớ trạng thái đăng nhập
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['user_role'] = $user['role'];
            
            // Thông báo đăng nhập thành công
            setFlash('success', 'Đăng nhập thành công!');
            
            // Chuyển hướng dựa vào vai trò
            if($user['role'] == 'admin') {
                redirect('admin/');
            } else {
                redirect('');
            }
        } else {
            $errors[] = "Email hoặc mật khẩu không đúng";
        }
    }
}

// Bao gồm header
include 'includes/header.php';
?>

<!-- Form đăng nhập -->
<div class="container">
    <div class="auth-container">
        <h2 class="auth-title">Đăng nhập</h2>

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
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
        
        <div class="auth-links mt-3">
            <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 