<?php
/**
 * Lớp Comment - Xử lý các thao tác liên quan đến bình luận
 */
class Comment {
    // Thuộc tính kết nối cơ sở dữ liệu
    private $conn;
    
    /**
     * Khởi tạo đối tượng Comment với kết nối cơ sở dữ liệu
     */
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    /**
     * Lấy tất cả bình luận của một bài viết
     * 
     * @param int $post_id ID của bài viết
     * @return array Danh sách bình luận
     */
    public function getCommentsByPostId($post_id) {
        // Chuẩn bị truy vấn
        $query = "SELECT c.*, u.fullname 
                 FROM comments c 
                 JOIN user u ON c.user_id = u.id 
                 WHERE c.post_id = ? 
                 ORDER BY c.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $post_id);
        
        // Thực thi truy vấn
        $stmt->execute();
        $result = $stmt->get_result();
        
        $comments = [];
        while($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        
        return $comments;
    }
    
    /**
     * Thêm bình luận mới
     * 
     * @param int $post_id ID bài viết
     * @param int $user_id ID người dùng
     * @param string $content Nội dung bình luận
     * @return bool Trạng thái thành công
     */
    public function addComment($post_id, $user_id, $content) {
        // Chuẩn bị truy vấn
        $query = "INSERT INTO comments (post_id, user_id, content, created_at) 
                 VALUES (?, ?, ?, NOW())";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iis", $post_id, $user_id, $content);
        
        // Thực thi truy vấn
        if($stmt->execute()) {
            return $this->conn->insert_id;
        } else {
            return false;
        }
    }
    
    /**
     * Xóa bình luận
     * 
     * @param int $id ID bình luận cần xóa
     * @return bool Trạng thái thành công
     */
    public function deleteComment($id) {
        // Chuẩn bị truy vấn
        $query = "DELETE FROM comments WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        // Thực thi truy vấn
        return $stmt->execute();
    }
    
    /**
     * Lấy tất cả bình luận (dành cho admin)
     * 
     * @return array Danh sách tất cả bình luận
     */
    public function getAllComments() {
        // Chuẩn bị truy vấn
        $query = "SELECT c.*, u.fullname, p.name as post_name 
                 FROM comments c 
                 JOIN user u ON c.user_id = u.id 
                 JOIN post p ON c.post_id = p.id 
                 ORDER BY c.created_at DESC";
        
        // Thực thi truy vấn
        $result = $this->conn->query($query);
        
        $comments = [];
        while($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        
        return $comments;
    }
    
    /**
     * Tìm kiếm bình luận (dành cho admin)
     * 
     * @param string $keyword Từ khóa tìm kiếm
     * @return array Danh sách bình luận tìm thấy
     */
    public function searchComments($keyword) {
        // Chuẩn bị truy vấn
        $searchTerm = "%{$keyword}%";
        $query = "SELECT c.*, u.fullname, p.name as post_name 
                 FROM comments c 
                 JOIN user u ON c.user_id = u.id 
                 JOIN post p ON c.post_id = p.id 
                 WHERE p.name LIKE ? OR u.fullname LIKE ? OR c.content LIKE ? 
                 ORDER BY c.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
        
        // Thực thi truy vấn
        $stmt->execute();
        $result = $stmt->get_result();
        
        $comments = [];
        while($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        
        return $comments;
    }
    
    /**
     * Kiểm tra xem bình luận có thuộc về người dùng hoặc người dùng là admin
     * 
     * @param int $comment_id ID bình luận
     * @param int $user_id ID người dùng
     * @return bool Kết quả kiểm tra
     */
    public function isOwnerOrAdmin($comment_id, $user_id, $user_role) {
        // Nếu là admin thì có quyền xóa
        if($user_role == 'admin') {
            return true;
        }
        
        // Kiểm tra bình luận có thuộc về người dùng không
        $query = "SELECT id FROM comments WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $comment_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return ($result->num_rows > 0);
    }
}
?> 