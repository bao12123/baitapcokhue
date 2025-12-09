<?php 
// Đảm bảo chỉ xử lý khi dữ liệu được gửi bằng phương thức POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $so_ngay = (int)($_POST['so_ngay'] ?? 0);
    $so_hien_thi = $_POST['so_ngay'] ?? 'Không có giá trị';
    echo "Số bạn đã nhập là: {$so_hien_thi} <br>";
    echo "Kết quả: ";
    
    switch ($so_ngay) {
        case 1:
            echo "Chủ nhật";
            break;
        case 2:
            echo "Thứ hai";
            break;
        case 3:
            echo "Thứ ba";
            break;
        case 4:
            echo "Thứ tư";
            break;
        case 5:
            echo "Thứ năm";
            break;
        case 6:
            echo "Thứ sáu";
            break;
        case 7:
            echo "Thứ bảy";
            break;
        default:
            echo "Số **{$so_hien_thi}** không hợp lệ (Vui lòng nhập số từ 1 đến 7).";
    }

} else {
    // Thông báo nếu truy cập trực tiếp
    echo "Lỗi: Vui lòng gửi dữ liệu bằng phương thức POST từ form nhập liệu.";
}
?>