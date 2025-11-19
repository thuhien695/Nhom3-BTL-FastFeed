<?php
// Thiết lập cấu hình và khởi tạo các thành phần cơ bản của ứng dụng

// Bắt đầu phiên làm việc
session_start();

// Định nghĩa các hằng số cấu hình
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'fast_feed');

define('ROOT_URL', 'http://localhost/FastFeed/');
define('SITE_NAME', 'FastFeed');
define('ADMIN_URL', ROOT_URL . 'admin/');

// Xác định đường dẫn gốc của dự án
define('ROOT_PATH', dirname(__DIR__) . '/');

// Cấu hình múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Thực hiện kết nối đến cơ sở dữ liệu
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Kiểm tra kết nối
if(mysqli_connect_errno()){
    // Hiển thị lỗi nếu kết nối thất bại
    echo "Không thể kết nối đến MySQL: " . mysqli_connect_error();
    exit();
}

// Thiết lập charset cho kết nối
mysqli_set_charset($conn, "utf8mb4");

// Đăng ký tự động tải các lớp
spl_autoload_register(function($className) {
    $file = ROOT_PATH . 'models/' . $className . '.php';
    if(file_exists($file)) {
        include $file;
    }
});

// Khởi tạo các mô hình
$userModel = new User($conn);
$postModel = new Post($conn);
$commentModel = new Comment($conn);

// Hàm kiểm tra người dùng đã đăng nhập chưa
function isLoggedIn(){
    return isset($_SESSION['user_id']);
}

// Hàm kiểm tra người dùng là admin
function isAdmin(){
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin';
}

// Hàm chuyển hướng trang
function redirect($url){
    header('Location: '.ROOT_URL.$url);
    exit();
}

// Hàm xử lý thông báo
function setFlash($type, $message){
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

// Hàm hiển thị thông báo
function displayFlash(){
    if(isset($_SESSION['flash'])){
        $flash = $_SESSION['flash'];
        echo '<div class="alert alert-'.$flash['type'].' alert-dismissible fade show" role="alert">
                '.$flash['message'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        unset($_SESSION['flash']);
    }
}
?> 