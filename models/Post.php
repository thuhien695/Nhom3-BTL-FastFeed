<?php
/**
 * Lớp Post - Xử lý các thao tác liên quan đến bài viết
 */
class Post {
    // Thuộc tính kết nối cơ sở dữ liệu
    private $conn;
    
    /**
     * Khởi tạo đối tượng Post với kết nối cơ sở dữ liệu
     */
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    /**
     * Lấy tất cả các bài viết
     * 
     * @return array Danh sách bài viết
     */
    public function getAllPosts() {
        // Chuẩn bị truy vấn
        $query = "SELECT p.*, u.fullname as author_name 
                 FROM post p 
                 JOIN user u ON p.user_id = u.id 
                 ORDER BY p.created_at DESC";
        
        // Thực thi truy vấn
        $result = $this->conn->query($query);
        
        $posts = [];
        while($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        
        return $posts;
    }
    
    /**
     * Lấy các bài viết mới nhất
     * 
     * @param int $limit Số lượng bài viết cần lấy
     * @return array Danh sách bài viết mới nhất
     */
    public function getLatestPosts($limit = 6) {
        // Chuẩn bị truy vấn
        $query = "SELECT p.*, u.fullname as author_name 
                 FROM post p 
                 JOIN user u ON p.user_id = u.id 
                 ORDER BY p.created_at DESC 
                 LIMIT ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $limit);
        
        // Thực thi truy vấn
        $stmt->execute();
        $result = $stmt->get_result();
        
        $posts = [];
        while($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        
        return $posts;
    }
    
    /**
     * Lấy bài viết theo ID
     * 
     * @param int $id ID của bài viết
     * @return array|bool Thông tin bài viết hoặc false nếu không tồn tại
     */
    public function getPostById($id) {
        // Chuẩn bị truy vấn
        $query = "SELECT p.*, u.fullname as author_name 
                  FROM post p 
                  JOIN user u ON p.user_id = u.id 
                  WHERE p.id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        // Thực thi truy vấn
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Kiểm tra kết quả
        if($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    
    /**
     * Tìm kiếm bài viết theo từ khóa
     * 
     * @param string $keyword Từ khóa tìm kiếm
     * @return array Danh sách bài viết tìm thấy
     */
    public function searchPosts($keyword) {
        // Chuẩn bị truy vấn
        $searchTerm = "%{$keyword}%";
        $query = "SELECT p.*, u.fullname as author_name 
                 FROM post p 
                 JOIN user u ON p.user_id = u.id 
                 WHERE p.name LIKE ? OR p.content LIKE ? 
                 ORDER BY p.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        
        // Thực thi truy vấn
        $stmt->execute();
        $result = $stmt->get_result();
        
        $posts = [];
        while($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        
        return $posts;
    }
    
    /**
     * Thêm bài viết mới
     * 
     * @param string $name Tiêu đề bài viết
     * @param string $content Nội dung bài viết
     * @param int $user_id ID người dùng
     * @param string $image Đường dẫn hình ảnh
     * @return bool Trạng thái thành công
     */
    public function addPost($name, $content, $user_id, $image = '') {
        // Chuẩn bị truy vấn
        $query = "INSERT INTO post (name, content, user_id, image, created_at) 
                 VALUES (?, ?, ?, ?, NOW())";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssis", $name, $content, $user_id, $image);
        
        // Thực thi truy vấn
        if($stmt->execute()) {
            return $this->conn->insert_id;
        } else {
            return false;
        }
    }
    
    /**
     * Cập nhật bài viết
     * 
     * @param int $id ID bài viết
     * @param string $name Tiêu đề bài viết
     * @param string $content Nội dung bài viết
     * @param string $image Đường dẫn hình ảnh
     * @return bool Trạng thái thành công
     */
    public function updatePost($id, $name, $content, $image = null) {
        // Chuẩn bị truy vấn
        $query = "UPDATE post SET name = ?, content = ?";
        
        // Nếu có cập nhật ảnh
        if($image !== null) {
            $query .= ", image = ?";
        }
        
        $query .= " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        // Bind tham số
        if($image !== null) {
            $stmt->bind_param("sssi", $name, $content, $image, $id);
        } else {
            $stmt->bind_param("ssi", $name, $content, $id);
        }
        
        // Thực thi truy vấn
        return $stmt->execute();
    }
    
    /**
     * Xóa bài viết
     * 
     * @param int $id ID bài viết cần xóa
     * @return bool Trạng thái thành công
     */
    public function deletePost($id) {
        // Chuẩn bị truy vấn
        $query = "DELETE FROM post WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        // Thực thi truy vấn
        return $stmt->execute();
    }
    
    /**
     * Lấy số lượng bình luận của bài viết
     * 
     * @param int $post_id ID bài viết
     * @return int Số lượng bình luận
     */
    public function getCommentCount($post_id) {
        // Chuẩn bị truy vấn
        $query = "SELECT COUNT(*) as comment_count FROM comments WHERE post_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $post_id);
        
        // Thực thi truy vấn
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return $row['comment_count'];
    }
    
    /**
     * Lấy các bài viết liên quan
     * 
     * @param int $post_id ID bài viết hiện tại
     * @param int $limit Số lượng bài viết cần lấy
     * @return array Danh sách bài viết liên quan
     */
    public function getRelatedPosts($post_id, $limit = 3) {
        // Chuẩn bị truy vấn
        $query = "SELECT p.*, u.fullname as author_name 
                 FROM post p 
                 JOIN user u ON p.user_id = u.id 
                 WHERE p.id != ? 
                 ORDER BY RAND() 
                 LIMIT ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $post_id, $limit);
        
        // Thực thi truy vấn
        $stmt->execute();
        $result = $stmt->get_result();
        
        $posts = [];
        while($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        
        return $posts;
    }
}
?> 