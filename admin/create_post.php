<?php
// Kết nối đến cơ sở dữ liệu và bắt đầu phiên làm việc
require_once '../config/init.php';

// Kiểm tra quyền admin
if(!isAdmin()) {
    setFlash('danger', 'Bạn không có quyền truy cập trang này!');
    redirect('');
}

// Biến lưu lỗi
$errors = [];

// Xử lý form thêm bài viết
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $user_id = $_SESSION['user_id'];
    
    // Xử lý upload hình ảnh
    $image = '';
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = $_FILES['image']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Kiểm tra định dạng file
        if(in_array($file_ext, $allowed)) {
            // Tạo tên file mới để tránh trùng lặp
            $new_name = uniqid('post_') . '.' . $file_ext;
            $upload_dir = '../assets/images/posts/'; //đường dẫn tới thư mục chứa ả
            $upload_path = $upload_dir . $new_name; //đường dẫn đầy đủ tới file ảnh mớ
            
            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            if(!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Upload file
            if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image = 'assets/images/posts/' . $new_name;
            } else {
                $errors[] = 'Không thể upload hình ảnh. Vui lòng thử lại!';
            }
        } else {
            $errors[] = 'Chỉ cho phép file hình ảnh định dạng JPG, JPEG, PNG, GIF!';
        }
    }
    
    // Kiểm tra dữ liệu
    if(empty($name)) {
        $errors[] = 'Tiêu đề bài viết không được để trống!';
    }
    
    if(empty($content)) {
        $errors[] = 'Nội dung bài viết không được để trống!';
    }
    
    // Nếu không có lỗi, thêm bài viết mới
    if(empty($errors)) {
        $result = $postModel->addPost($name, $content, $user_id, $image);
        
        if($result) {
            setFlash('success', 'Thêm bài viết thành công!');
            redirect('admin/posts.php');
        } else {
            $errors[] = 'Có lỗi xảy ra, vui lòng thử lại!';
        }
    }
}

// Tiêu đề trang
$pageTitle = "Thêm bài viết mới - FastFeed";
$useCKEditor = true;

// Bao gồm header admin
include 'includes/header.php';
?>

<!-- Thêm bài viết mới -->
<div class="container-fluid admin-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="admin-panel-title">Thêm bài viết mới</h2>
        <a href="posts.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>
    
    <!-- Hiển thị lỗi nếu có -->
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <!-- Form thêm bài viết -->
    <div class="card">
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Tiêu đề bài viết <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Nội dung bài viết <span class="text-danger">*</span></label>
                    <textarea class="form-control editor" id="content" name="content" rows="10" required><?php echo isset($content) ? $content : ''; ?></textarea> 
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh bài viết</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <small class="text-muted">Chấp nhận file: JPG, JPEG, PNG, GIF (tối đa 2MB)</small>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu bài viết
                    </button>
                    <a href="posts.php" class="btn btn-secondary ms-2">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 