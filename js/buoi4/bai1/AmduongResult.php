<?php 
// Đảm bảo chỉ xử lý khi dữ liệu được gửi bằng phương thức POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Lấy giá trị từ trường có tên "so_nhap"
    // Ép kiểu (float) và sử dụng toán tử ?? '' để an toàn hơn
    $so = (float)($_POST['so_nhap'] ?? 0);
    $so_hien_thi = $_POST['so_nhap'] ?? 'Không có giá trị';

    echo "Số bạn đã nhập là: {$so_hien_thi} <br>";
    
    // --- Dùng cấu trúc điều khiển để kiểm tra số dương ---
    
    if ($so > 0) {
        echo "Kết quả: Đây là **SỐ DƯƠNG**.";
    } 
    
    else if ($so == 0) {
        echo "Kết quả: Đây là **SỐ 0** (không phải số dương).";
    } 
    
    else {
        echo "Kết quả: Đây là **SỐ ÂM**.";
    }

} else {
    // Thông báo nếu truy cập trực tiếp
    echo "Lỗi: Vui lòng gửi dữ liệu bằng phương thức POST từ form nhập liệu.";
}
?>