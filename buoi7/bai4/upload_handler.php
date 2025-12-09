<?php
$target_dir = "uploads/"; 

// Tạo thư mục nếu nó chưa tồn tại
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

echo "<h2>Kết quả Upload</h2>";

// Kiểm tra xem nút submit đã được nhấn và có file được gửi lên không
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['uploaded_file'])) {
    
    $file_info = $_FILES['uploaded_file'];
    
    // Tên file gốc trên máy khách
    $original_file_name = $file_info['name'];
    
    // Đường dẫn đầy đủ của file tạm thời trên server (tên tạm thời do PHP tạo ra)
    $temp_file_path = $file_info['tmp_name'];
    
    // Đường dẫn đầy đủ của file sau khi di chuyển vào thư mục lưu trữ
    $target_file = $target_dir . basename($original_file_name); 

    // --- XỬ LÝ VÀ HIỂN THỊ THÔNG TIN FILE TẠM THỜI ---
    
    echo "<h3>Thông tin File Upload:</h3>";
    echo "<ul>";
    echo "<li>Tên file gốc: **" . htmlspecialchars($original_file_name) . "**</li>";
    echo "<li>Loại file (MIME Type): **" . htmlspecialchars($file_info['type']) . "**</li>";
    echo "<li>Dung lượng: **" . number_format($file_info['size'] / 1024, 2) . " KB**</li>";
    echo "<li>Đường dẫn TẠM THỜI trên Server: **" . htmlspecialchars($temp_file_path) . "**</li>";
    echo "</ul>";
    // --- DI CHUYỂN FILE TẠM THỜI VÀO THƯ MỤC LƯU TRỮ ---
    if (move_uploaded_file($temp_file_path, $target_file)) {
        echo "<p style='color: green;'>✅ File đã được upload và lưu trữ thành công!</p>";
        echo "<h3>Thông tin File Đã Lưu Trữ:</h3>";
        echo "<ul>";
        echo "<li>Đường dẫn LƯU TRỮ: **" . htmlspecialchars($target_file) . "**</li>";
        echo "</ul>";
    } else {
        echo "<p style='color: red;'>❌ Lỗi khi di chuyển file (mã lỗi: " . $file_info['error'] . "). Vui lòng kiểm tra quyền ghi của thư mục **" . $target_dir . "**.</p>";
    }

} else {
    echo "<p>Vui lòng chọn một file để upload.</p>";
}

echo "<p><a href='upload_form.php'>Quay lại Form Upload</a></p>";
?>