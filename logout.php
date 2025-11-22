<?php
// Kết nối đến cơ sở dữ liệu và bắt đầu phiên làm việc
require_once 'config/init.php';

// Xóa tất cả các biến phiên
session_unset();

// Hủy phiên
session_destroy();

// Thông báo đăng xuất thành công
setFlash('success', 'Đăng xuất thành công!');

// Chuyển hướng về trang chủ
redirect('');
?> 