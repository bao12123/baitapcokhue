<?php
// Tên file cần đọc
$filename = "note.txt";

echo "<h2>Bài 3: Đọc từng dòng trong file " . $filename . "</h2>";

// Mở file ở chế độ chỉ đọc ('r')
$handle = @fopen($filename, "r");
if ($handle) {
    echo "<h3>Nội dung dưới dạng danh sách:</h3>";
    echo "<ul>"; // Bắt đầu danh sách không thứ tự (unordered list)

    // Lặp qua từng dòng cho đến cuối file (EOF)
    while (!feof($handle)) {
        $line = fgets($handle);  // Đọc một dòng
        $trimmed_line = trim($line);   // Loại bỏ khoảng trắng hoặc ký tự xuống dòng ở đầu và cuối dòng
        if (!empty($trimmed_line)) {
            // In dòng đó dưới dạng mục danh sách
            echo "<li>" . htmlspecialchars($trimmed_line) . "</li>"; 
        }
    }
    
    echo "</ul>"; // Kết thúc danh sách
    fclose($handle);

} else {
    echo "<p style='color: red;'>Lỗi: Không thể mở file **" . $filename . "**. Hãy đảm bảo bạn đã chạy Bài 2 để tạo file này.</p>";
}
?>