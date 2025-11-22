<?php
// Kết nối đến cơ sở dữ liệu và bắt đầu phiên làm việc
require_once '../config/init.php';

// Kiểm tra quyền admin
if(!isAdmin()) {
    setFlash('danger', 'Bạn không có quyền truy cập trang này!');
    redirect('');
}

// Lấy thống kê tổng quan
$totalPosts = count($postModel->getAllPosts());
$totalComments = count($commentModel->getAllComments());
$latestPosts = $postModel->getLatestPosts(5); // 5 bài viết mới nhất

// Tiêu đề trang
$pageTitle = "Quản trị - FastFeed";

// Bao gồm header admin
include 'includes/header.php';
?>

<!-- Thống kê tổng quan -->
<div class="container-fluid admin-content">
    <h2 class="admin-panel-title">Bảng điều khiển</h2>
    
    <div class="row">
        <!-- Thống kê bài viết -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Bài viết</h5>
                        <span class="badge bg-primary align-self-center"><?php echo $totalPosts; ?></span>
                    </div>
                    <p class="card-text text-muted">Tổng số bài viết đã đăng</p>
                    <a href="posts.php" class="btn btn-sm btn-outline-primary">Quản lý bài viết</a>
                </div>
            </div>
        </div>
        
        <!-- Thống kê bình luận -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Bình luận</h5>
                        <span class="badge bg-primary align-self-center"><?php echo $totalComments; ?></span>
                    </div>
                    <p class="card-text text-muted">Tổng số bình luận từ người dùng</p>
                    <a href="comments.php" class="btn btn-sm btn-outline-primary">Quản lý bình luận</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bài viết mới nhất -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Bài viết mới nhất</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Tác giả</th>
                            <th>Ngày đăng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($latestPosts)): ?>
                            <tr>
                                <td colspan="5" class="text-center">Chưa có bài viết nào.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($latestPosts as $post): ?>
                                <tr>
                                    <td><?php echo $post['id']; ?></td>
                                    <td><?php echo $post['name']; ?></td>
                                    <td><?php echo $post['author_name']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></td>
                                    <td>
                                        <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <a href="../post.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-info" target="_blank">
                                            <i class="fas fa-eye"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="text-center mt-3">
                <a href="posts.php" class="btn btn-primary">Xem tất cả bài viết</a>
                <a href="create_post.php" class="btn btn-success ms-2">
                    <i class="fas fa-plus"></i> Thêm bài viết mới
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 