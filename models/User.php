<?php
/**
 * Lớp User - Xử lý các thao tác liên quan đến người dùng
 */
class User {
    // Thuộc tính lưu trữ kết nối cơ sở dữ liệu
    private $conn;
    
    /**
     * hàm Khởi tạo đối tượng User với kết nối cơ sở dữ liệu
     */
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    /**
     * Đăng ký người dùng mới
     * 
     * @param string $fullname Họ tên đầy đủ
     * @param string $email Email
     * @param string $password Mật khẩu (chưa mã hóa)
     * @return bool Trạng thái thành công
     */
    public function register($fullname, $email, $password) {
        // Mã hóa mật khẩu
        $password = password_hash($password, PASSWORD_DEFAULT);
        // Vai trò mặc định là user
        $role = 'user';
        
        // Chuẩn bị truy vấn
        $query = "INSERT INTO user (fullname, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $fullname, $email, $password, $role);
        
        // Thực thi truy vấn
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Đăng nhập người dùng
     * 
     * @param string $email Email
     * @param string $password Mật khẩu
     * @return array|bool Thông tin người dùng nếu thành công, false nếu thất bại
     */
    public function login($email, $password) {
        // Chuẩn bị truy vấn
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        
        // Thực thi truy vấn
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Kiểm tra xem có tìm thấy người dùng không
        if($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // Xác minh mật khẩu
            if(password_verify($password, $user['password'])) {
                return $user;
            }
        }
        
        return false;
    }
    
    /**
     * Lấy thông tin người dùng theo ID
     * 
     * @param int $id ID người dùng
     * @return array|bool Thông tin người dùng hoặc false nếu không tồn tại
     */
    public function getUserById($id) {
        // Chuẩn bị truy vấn
        $query = "SELECT * FROM user WHERE id = ?";
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
     * Kiểm tra email đã tồn tại chưa khi ng dùng đăng kí
     * 
     * @param string $email Email cần kiểm tra
     * @return bool true nếu email đã tồn tại, ngược lại là false
     */
    public function emailExists($email) {
        // Chuẩn bị truy vấn
        $query = "SELECT id FROM user WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        
        // Thực thi truy vấn
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Trả về true nếu có kết quả
        return ($result->num_rows > 0);
    }
}
?> 