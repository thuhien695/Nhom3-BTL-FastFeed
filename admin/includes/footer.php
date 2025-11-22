            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Khởi tạo CKEditor cho các textarea có class editor -->
    <script>
        $(document).ready(function() {
            if(typeof CKEDITOR !== 'undefined') {
                var elements = document.getElementsByClassName('editor');
                for(var i = 0; i < elements.length; i++) {
                    CKEDITOR.replace(elements[i]);
                }
            }
            
            // Xác nhận trước khi xóa
            $('.delete-btn').on('click', function(e) {
                if(!confirm('Bạn có chắc muốn xóa mục này?')) {
                    e.preventDefault(); //ngăn hđ xảy ra khi bấm cancel
                }
            });
        });
    </script>
</body>
</html> 