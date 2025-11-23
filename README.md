FastFeed – Website Blog Chia Sẻ Trải Nghiệm Du Lịch

FastFeed là một website blog cho phép người dùng xem bài viết, tìm kiếm, xem chi tiết và bình luận, đồng thời có khu vực quản trị (admin) để quản lý bài viết và bình luận.

✨ Chức năng chính

1. Chức năng cho người dùng
   
1.1. Đăng ký / Đăng nhập

Đăng ký tài khoản bằng email & mật khẩu (mật khẩu được mã hóa bằng password_hash()).

Đăng nhập để sử dụng các chức năng bình luận.

1.2. Xem & Tìm kiếm bài viết

Tìm kiếm theo từ khóa (tiêu đề, nội dung).

Trang chủ hiển thị danh sách bài viết mới nhất.

1.3. Xem chi tiết bài viết

Hiển thị nội dung chi tiết, hình ảnh, thông tin người đăng.

Xem số bình luận trên bài viết.

1.4. Bình luận bài viết

Người dùng đã đăng nhập có thể viết bình luận.

Bình luận có thể bị xóa bởi admin.

3. Chức năng của Admin

2.1. Quản lý bài viết

Tìm kiếm / lọc bài viết theo từ khóa.

Xem danh sách bài viết.

Thêm, sửa, xóa bài viết (nội dung sử dụng CKEditor).

Xem chi tiết bài viết trong trang quản trị.

2.2. Quản lý bình luận

Xem toàn bộ bình luận từ người dùng.

Lọc / tìm kiếm theo tên bài viết hoặc tên người dùng.

Xóa bình luận vĩnh viễn.

🗄 Cơ sở dữ liệu

Gồm 3 bảng chính:

Bảng	Mô tả

user	Lưu thông tin người dùng (id, fullname, email, password, role)

post	Lưu bài viết (id, name, content, image, created_at, user_id)

comments	Lưu bình luận (id, post_id, user_id, content, created_at)

🛠 Công nghệ sử dụng

PHP (thuần)

MySQL + MySQLi

Bootstrap 5

jQuery & AJAX

CKEditor

Font Awesome

🔑 Tài khoản test

Admin:

Email: admin@gmail.com

Mật khẩu: 123123

User:

Email: user@gmail.com

Mật khẩu: 123123

