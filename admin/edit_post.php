<?php
// Kết nối đến cơ sở dữ liệu và bắt đầu phiên làm việc
require_once '../config/init.php';

// Kiểm tra quyền admin
if(!isAdmin()) {
    setFlash('danger', 'Bạn không có quyền truy cập trang này!');
    redirect('');
}

// Kiểm tra ID bài viết
if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    setFlash('danger', 'ID bài viết không hợp lệ!');
    redirect('admin/posts.php');
}

$post_id = (int)$_GET['id'];
$post = $postModel->getPostById($post_id);

// Kiểm tra bài viết tồn tại
if(!$post) {
    setFlash('danger', 'Không tìm thấy bài viết!');
    redirect('admin/posts.php');
}

// Biến lưu lỗi
$errors = [];

// Xử lý form chỉnh sửa bài viết
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    
    // Xử lý upload hình ảnh
    $image = null; // null nghĩa là không thay đổi ảnh
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = $_FILES['image']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Kiểm tra định dạng file
        if(in_array($file_ext, $allowed)) {
            // Tạo tên file mới để tránh trùng lặp
            $new_name = uniqid('post_') . '.' . $file_ext;
            $upload_dir = '../assets/images/posts/';
            $upload_path = $upload_dir . $new_name;
            
            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            if(!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Upload file
            if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image = 'assets/images/posts/' . $new_name;
                
                // Xóa ảnh cũ nếu có
                if(!empty($post['image']) && file_exists('../'.$post['image'])) {
                    unlink('../'.$post['image']);
                }
            } else {
                $errors[] = 'Không thể upload hình ảnh. Vui lòng thử lại!';
            }
        } else {
            $errors[] = 'Chỉ cho phép file hình ảnh định dạng JPG, JPEG, PNG, GIF!';
        }
    }
    
    // Xử lý xóa ảnh
    if(isset($_POST['remove_image']) && $_POST['remove_image'] == 1) {
        $image = ''; // empty string là xóa ảnh
        
        // Xóa file ảnh cũ
        if(!empty($post['image']) && file_exists('../'.$post['image'])) {
            unlink('../'.$post['image']);
        }
    }
    
    // Kiểm tra dữ liệu
    if(empty($name)) {
        $errors[] = 'Tiêu đề bài viết không được để trống!';
    }
    
    if(empty($content)) {
        $errors[] = 'Nội dung bài viết không được để trống!';
    }
    
    // Nếu không có lỗi, cập nhật bài viết
    if(empty($errors)) {
        $result = $postModel->updatePost($post_id, $name, $content, $image);
        
        if($result) {
            setFlash('success', 'Cập nhật bài viết thành công!');
            redirect('admin/posts.php');
        } else {
            $errors[] = 'Có lỗi xảy ra, vui lòng thử lại!';
        }
    }
}

// Lấy dữ liệu để hiển thị trong form
$name = isset($_POST['name']) ? $_POST['name'] : $post['name'];
$content = isset($_POST['content']) ? $_POST['content'] : $post['content'];

// Tiêu đề trang
$pageTitle = "Chỉnh sửa bài viết - FastFeed";
$useCKEditor = true;

// Bao gồm header admin
include 'includes/header.php';
?>

<!-- Chỉnh sửa bài viết -->
<div class="container-fluid admin-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="admin-panel-title">Chỉnh sửa bài viết</h2>
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
    
    <!-- Form chỉnh sửa bài viết -->
    <div class="card">
        <div class="card-body">
            <form action="edit_post.php?id=<?php echo $post_id; ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Tiêu đề bài viết <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Nội dung bài viết <span class="text-danger">*</span></label>
                    <textarea class="form-control editor" id="content" name="content" rows="10" required><?php echo $content; ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Hình ảnh hiện tại</label>
                    <div>
                        <?php if(!empty($post['image'])): ?>
                            <div class="mb-2">
                                <img src="<?php echo ROOT_URL . $post['image']; ?>" alt="<?php echo $post['name']; ?>" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
                                <label class="form-check-label" for="remove_image">
                                    Xóa ảnh hiện tại
                                </label>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">Không có ảnh</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Thay đổi hình ảnh</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <small class="text-muted">Chấp nhận file: JPG, JPEG, PNG, GIF (tối đa 2MB)</small>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu thay đổi
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