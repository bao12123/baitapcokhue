<?php 
// Đảm bảo chỉ xử lý khi dữ liệu được gửi bằng phương thức POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Lấy giá trị từ trường có tên "diem_tb" và ép kiểu sang float
    $diem_tb = (float)($_POST['diem_tb'] ?? 0);
    $diem_hien_thi = $_POST['diem_tb'] ?? 'Không có giá trị';

    // Biến để lưu kết quả xếp loại
    $xep_loai = "";

    echo "Điểm trung bình bạn đã nhập: {$diem_hien_thi} <br>";
    
    // --- Dùng cấu trúc điều khiển để xếp loại theo quy tắc ---
    
    // 1. Giỏi (>= 8.0)
    if ($diem_tb >= 8.0) {
        $xep_loai = "Giỏi";
    } 
    
    // 2. Khá (6.5 - 7.9)
    else if ($diem_tb >= 6.5) {
        // Chỉ cần kiểm tra >= 6.5 vì điều kiện trước (>= 8.0) đã là FALSE
        $xep_loai = "Khá";
    } 
    
    // 3. Trung bình (5.0 - 6.4)
    else if ($diem_tb >= 5.0) {
        // Chỉ cần kiểm tra >= 5.0 vì điều kiện trước (>= 6.5) đã là FALSE
        $xep_loai = "Trung bình";
    } 
    
    // 4. Yếu (< 5.0)
    else {
        $xep_loai = "Yếu";
    }

    echo "Kết quả xếp loại: **{$xep_loai}**";

} else {
    // Thông báo nếu truy cập trực tiếp
    echo "Lỗi: Vui lòng gửi dữ liệu bằng phương thức POST từ form nhập liệu.";
}
?>