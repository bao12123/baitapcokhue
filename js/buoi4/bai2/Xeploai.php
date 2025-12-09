<?php 
// Đặt tiêu đề
echo "<h1>BÀI TẬP THỰC HÀNH - BÀI 2</h1>";

// In ra Form với method POST và action trỏ đến tệp xử lý
echo "<form method=\"POST\" action=\"Bai2Result.php\">";

// In ra trường nhập liệu (Input field)
// type="number" step="0.1" để cho phép nhập số thập phân (ví dụ: 7.5)
echo "Điểm trung bình (0.0-10.0) : <input type=\"number\" step=\"0.1\" name=\"diem_tb\" min=\"0\" max=\"10\" required> <br>";

// In ra nút submit
echo "<input type=\"submit\" value=\"Xếp loại\">";

// In ra thẻ form đóng
echo "</form>";
?>