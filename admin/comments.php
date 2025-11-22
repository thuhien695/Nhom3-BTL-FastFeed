<?php
// Kết nối đến cơ sở dữ liệu và bắt đầu phiên làm việc
require_once '../config/init.php';

// Kiểm tra quyền admin
if(!isAdmin()) {
    setFlash('danger', 'Bạn không có quyền truy cập trang này!');
    redirect('');
}

// Xử lý tìm kiếm
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
if(!empty($search)) {
    $comments = $commentModel->searchComments($search);
} else {
    $comments = $commentModel->getAllComments();
}

// Xử lý xóa bình luận
if(isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $comment_id = (int)$_GET['delete'];
    
    if($commentModel->deleteComment($comment_id)) {
        setFlash('success', 'Xóa bình luận thành công!');
    } else {
        setFlash('danger', 'Không thể xóa bình luận!');
    }
    
    redirect('admin/comments.php');
}

// Tiêu đề trang
$pageTitle = "Quản lý bình luận - FastFeed";

// Bao gồm header admin
include 'includes/header.php';
?>

<!-- Quản lý bình luận -->
<div class="container-fluid admin-content">
    <h2 class="admin-panel-title">Quản lý bình luận</h2>
    
    <!-- Form tìm kiếm -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="comments.php" method="GET" class="row g-3">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm bình luận theo tên bài viết, người dùng hoặc nội dung..." value="<?php echo $search; ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Danh sách bình luận -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bài viết</th>
                            <th>Người dùng</th>
                            <th>Nội dung</th>
                            <th>Ngày đăng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($comments)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Không tìm thấy bình luận nào.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($comments as $comment): ?>
                                <tr>
                                    <td><?php echo $comment['id']; ?></td>
                                    <td>
                                        <a href="../post.php?id=<?php echo $comment['post_id']; ?>" target="_blank">
                                            <?php echo $comment['post_name']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $comment['fullname']; ?></td>
                                    <td><?php echo substr($comment['content'], 0, 100); ?><?php echo (strlen($comment['content']) > 100) ? '...' : ''; ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($comment['created_at'])); ?></td>
                                    <td>
                                        <a href="comments.php?delete=<?php echo $comment['id']; ?>" class="btn btn-sm btn-danger delete-btn">
                                            <i class="fas fa-trash"></i> Xóa
                                        </a>
                                        <a href="../post.php?id=<?php echo $comment['post_id']; ?>" class="btn btn-sm btn-info" target="_blank">
                                            <i class="fas fa-eye"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 