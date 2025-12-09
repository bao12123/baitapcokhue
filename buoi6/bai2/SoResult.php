<?php
// Định nghĩa hàm
function kiemTraSoChan($n) { return (intval($n) % 2 == 0); }

function kiemTraSoNguyenTo($n) {
    $n = intval($n);
    if ($n < 2) return false;
    // Kiểm tra đến căn bậc hai của n
    for ($i = 2; $i * $i <= $n; $i++) { 
        if ($n % $i == 0) return false; 
    }
    return true;
}

// Xử lý dữ liệu
$n = isset($_POST['n2']) ? intval($_POST['n2']) : null;

$ketQua = "Đang chờ vật phẩm...";
$is_error = true;

if ($n !== null) {
    $chanLe = kiemTraSoChan($n) ? "Số Chẵn (Dương Khí) ✅" : "Số Lẻ (Âm Khí) ❌";
    $nguyenTo = kiemTraSoNguyenTo($n) ? "Là Nguyên Tố (Thuần Khiết) ⭐" : "Không phải Nguyên Tố (Tạp Căn) 🚫";
    
    $ketQua = "
        <p><strong>Linh Số:</strong> {$n}</p>
        <hr>
        <p><strong>Kiểm tra Chẵn/Lẻ:</strong> {$chanLe}</p>
        <p><strong>Kiểm tra Nguyên Tố:</strong> {$nguyenTo}</p>
    ";
    $is_error = false;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Giám Định</title>
    <style>
        /* CSS Chung cho Result (Giống Bài 1) */
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .result-container { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); width: 100%; max-width: 450px; text-align: center; }
        h1 { color: #2c3e50; font-size: 1.8rem; margin-bottom: 20px; }
        .result-box { margin-top: 20px; padding: 15px; border-radius: 8px; line-height: 1.8; text-align: left; }
        .success { background: #e3f2fd; border: 1px solid #2196f3; color: #1976d2; }
        .error { background: #fbecec; border: 1px solid #e74c3c; color: #c0392b; }
        .back-button { display: inline-block; margin-top: 25px; padding: 10px 20px; background: #4caf50; color: white; text-decoration: none; border-radius: 5px; transition: background 0.3s; }
        .back-button:hover { background: #388e3c; }
        hr { border: 0; height: 1px; background-color: #bbdefb; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="result-container">
        <h1>Kết Quả Giám Định Thuật 👁️</h1>
        <div class="result-box <?php echo $is_error ? 'error' : 'success'; ?>">
            <?php echo $ketQua; ?>
        </div>
        <a href="So.php" class="back-button">Quay lại Form</a>
    </div>
</body>
</html>