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
    $posts = $postModel->searchPosts($search);
} else {
    $posts = $postModel->getAllPosts();
}

// Xử lý xóa bài viết
if(isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $post_id = (int)$_GET['delete'];
    
    if($postModel->deletePost($post_id)) {
        setFlash('success', 'Xóa bài viết thành công!');
    } else {
        setFlash('danger', 'Không thể xóa bài viết!');
    }
    
    redirect('admin/posts.php');
}

// Tiêu đề trang
$pageTitle = "Quản lý bài viết - FastFeed";

// Bao gồm header admin
include 'includes/header.php';
?>

<!-- Quản lý bài viết -->
<div class="container-fluid admin-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="admin-panel-title">Quản lý bài viết</h2>
        <a href="create_post.php" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm bài viết mới
        </a>
    </div>
    
    <!-- Form tìm kiếm -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="posts.php" method="GET" class="row g-3">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm bài viết..." value="<?php echo $search; ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Danh sách bài viết -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Tác giả</th>
                            <th>Ngày đăng</th>
                            <th>Bình luận</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($posts)): ?>
                            <tr>
                                <td colspan="7" class="text-center">Không tìm thấy bài viết nào.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($posts as $post): ?>
                                <tr>
                                    <td><?php echo $post['id']; ?></td>
                                    <td>
                                        <?php if(!empty($post['image'])): ?>
                                            <img src="../<?php echo $post['image']; ?>" alt="<?php echo $post['name']; ?>" class="img-thumbnail" style="width: 60px;height: 60px;">
                                        <?php else: ?>
                                            <span class="text-muted">Không có ảnh</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $post['name']; ?></td>
                                    <td><?php echo $post['author_name']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></td>
                                    <td>
                                        <span class="badge bg-primary rounded-pill">
                                            <?php echo $postModel->getCommentCount($post['id']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <a href="../post.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-info" target="_blank">
                                            <i class="fas fa-eye"></i> Xem
                                        </a>
                                        <a href="posts.php?delete=<?php echo $post['id']; ?>" class="btn btn-sm btn-danger delete-btn">
                                            <i class="fas fa-trash"></i> Xóa
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