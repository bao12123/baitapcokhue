<?php
// Thư mục lưu trữ ảnh
$target_dir = "uploads/images/"; 
// Kích thước tối đa cho phép (2MB = 2 * 1024 * 1024 bytes)
$max_file_size = 2097152; 

// Tạo thư mục nếu nó chưa tồn tại
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

echo "<h2>Kết quả Xử Lý Upload Ảnh</h2>";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image_file'])) {
    
    $file_info = $_FILES['image_file'];
    $upload_ok = true;
    $error_message = "";
    
    // Tên file gốc và đường dẫn đích
    $original_file_name = basename($file_info['name']);
    $file_extension = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));
    $target_file = $target_dir . uniqid() . "." . $file_extension; // Đặt tên file duy nhất để tránh trùng lặp
    
    // 1. Kiểm tra Lỗi Upload
    if ($file_info['error'] !== UPLOAD_ERR_OK) {
        $error_message = "Có lỗi xảy ra trong quá trình upload (mã lỗi: " . $file_info['error'] . ").";
        $upload_ok = false;
    }
    // 2. Kiểm tra Dung lượng
    if ($file_info['size'] > $max_file_size) {
        $error_message = "File quá lớn. Vui lòng chọn ảnh dưới 2MB.";
        $upload_ok = false;
    }

    // 3. Kiểm tra Định dạng (chỉ cho phép JPG và PNG)
    if ($file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg") {
        $error_message = "Chỉ cho phép upload các file định dạng JPG, JPEG, và PNG.";
        $upload_ok = false;
    }
    
    // --- Thực hiện Upload ---
    if ($upload_ok) {
        if (move_uploaded_file($file_info['tmp_name'], $target_file)) {
            
            echo "<p style='color: green;'>✅ Ảnh **" . htmlspecialchars($original_file_name) . "** đã được upload thành công!</p>";
            
            // Hiển thị ảnh
            echo "<h3>Ảnh Đã Upload:</h3>";
            echo "<img src='" . htmlspecialchars($target_file) . "' style='max-width: 300px; height: auto;'>";
            
            // Hiển thị thông tin file
            echo "<h3>Thông tin File:</h3>";
            echo "<ul>";
            echo "<li>Đường dẫn lưu trữ: **" . htmlspecialchars($target_file) . "**</li>";
            echo "<li>Dung lượng: **" . number_format($file_info['size'] / 1024, 2) . " KB**</li>";
            echo "</ul>";
            
        } else {
            echo "<p style='color: red;'>❌ Lỗi khi di chuyển file. Vui lòng kiểm tra quyền ghi của thư mục **" . $target_dir . "**.</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Upload thất bại: " . $error_message . "</p>";
    }

} else {
    echo "<p>Vui lòng chọn một file để upload.</p>";
}

echo "<p><a href='upload_image_form.php'>Quay lại Form Upload</a></p>";
?>