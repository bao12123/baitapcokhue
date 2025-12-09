<?php 
// Đặt tiêu đề
echo "<h1>BÀI TẬP THỰC HÀNH - BÀI 3</h1>";

// In ra Form với method POST và action trỏ đến tệp xử lý
echo "<form method=\"POST\" action=\"Bai3Result.php\">";

// In ra trường nhập liệu (Input field)
// type="number" min="1" max="7" để giới hạn nhập liệu từ 1 đến 7
echo "Nhập số (1-7) : <input type=\"number\" name=\"so_ngay\" min=\"1\" max=\"7\" required> <br>";

// In ra nút submit
echo "<input type=\"submit\" value=\"Xem Thứ\">";

// In ra thẻ form đóng
echo "</form>";
?>