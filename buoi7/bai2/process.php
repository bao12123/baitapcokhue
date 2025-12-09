<?php

if (isset($_POST['submit_btn'])) {
    $new_content = $_POST['input_content']; // Lấy nội dung người dùng nhập từ form
    $filename = "note.txt"; // Này là tên file 
    $data_to_write = $new_content . "\n"; //dấu xuống dòng \n vào cuối nội dung để mỗi lần ghi sẽ xuống dòng mới
    
    // Ghi nối tiếp (append) nội dung vào file note.txt
    // Sử dụng cờ FILE_APPEND để đảm bảo nội dung cũ không bị ghi đè
    $result = file_put_contents($filename, $data_to_write, FILE_APPEND); 

    echo "<h2>Kết quả ghi file</h2>";
    if ($result !== false) {
        echo "✅ Đã ghi nội dung vào file"."<br>"; 
        echo "Nội dung vừa ghi: <strong>" . htmlspecialchars($new_content) . "</strong>";
        echo "<h3>Toàn bộ nội dung hiện tại của file note.txt:</h3>"; // đọc và hiện  thị nội dung hiện tại
        $current_file_content = file_get_contents($filename);
        if ($current_file_content !== false) {
             echo nl2br(htmlspecialchars($current_file_content));
        }
       
    } else {
        echo "<p style='color: red;'>❌ Lỗi: Không thể ghi nội dung vào file **" . $filename . "**.</p>";
    }
    echo "<p><a href='form.php'>Quay lại form nhập liệu</a></p>";
} else {
    // Nếu truy cập trực tiếp mà không qua Submit form
    header("Location: form.php");
    exit;
}
?>