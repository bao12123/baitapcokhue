<?php
$filename = "data.txt";
// Đọc toàn bộ nội dung file và lưu vào biến $content
$content = file_get_contents($filename);
echo "<h2>Bài 1: Đọc toàn bộ nội dung file</h2>";
if ($content !== false) {
    // Hiển thị nội dung ra màn hình, dùng nl2br để chuyển \n thành <br>
    echo "<h3>Conan movie 29 sẽ tập trung vào nhân vật Chihaya Hagiwara - đội trưởng đội tuần tra giao thông thuộc Sở Cảnh sát tỉnh Kanagawa. Nhân vật do Miyuki Sawashiro lồng tiếng, thay cho diễn viên quá cố Atsuko Tanaka. 

Bên cạnh đó, Thiên thần sa ngã trên xa lộ còn quy tụ loạt gương mặt quen thuộc như thanh tra Jugo Yokomizo, thám tử trung học Masumi Sera, Kenji Hagiwara - em trai đã mất của Chihaya, và Jinpei Matsuda - bạn học của Kenji tại Học viện Cảnh sát. </h3>";
    echo nl2br($content);
} else {
    echo "Lỗi: Không thể đọc file " ;
}

?>