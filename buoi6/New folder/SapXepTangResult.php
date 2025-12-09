<?php
// Định nghĩa hàm
function sapXepTangDan($arr) {
    // Lọc và chuyển đổi các phần tử hợp lệ sang float
    $arr_clean = [];
    foreach($arr as $v) {
        $trimmed_v = trim($v);
        if (is_numeric($trimmed_v)) {
            $arr_clean[] = (float)$trimmed_v;
        }
    }
    
    // Thuật toán sắp xếp nổi bọt (Bubble Sort)
    $count = count($arr_clean);
    for ($i = 0; $i < $count - 1; $i++) {
        for ($j = $i + 1; $j < $count; $j++) {
            if ($arr_clean[$i] > $arr_clean[$j]) {
                $temp = $arr_clean[$i]; 
                $arr_clean[$i] = $arr_clean[$j]; 
                $arr_clean[$j] = $temp;
            }
        }
    }
    return $arr_clean;
}

// Xử lý dữ liệu
$inputArr = isset($_POST['arr3']) ? $_POST['arr3'] : "";
$arr = explode(",", $inputArr); 

$ketQua = "Trận pháp chưa kích hoạt.";
$is_error = true;

if (!empty($inputArr)) {
    $sorted = sapXepTangDan($arr);
    $original_display = implode(", ", array_map('trim', $arr));
    $sorted_display = implode(" ⇢ ", $sorted);
    
    $ketQua = "
        <p><strong>Dãy số ban đầu:</strong> {$original_display}</p>
        <hr>
        <p><strong>Thứ tự linh lực (Tăng dần):</strong></p>
        <p style='font-weight: bold; font-size: 1.1em;'>{$sorted_display}</p>
    ";
    $is_error = false;
    if (empty($sorted)) {
        $ketQua = "Đầu vào không chứa số hợp lệ.";
        $is_error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Sắp Xếp</title>
    <style>
        /* CSS Chung cho Result (Giống Bài 1) */
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background: linear-gradient(135deg, #f1c40f 0%, #e67e22 100%); }
        .result-container { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); width: 100%; max-width: 500px; text-align: center; }
        h1 { color: #2c3e50; font-size: 1.8rem; margin-bottom: 20px; }
        .result-box { margin-top: 20px; padding: 15px; border-radius: 8px; line-height: 1.8; text-align: left; }
        .success { background: #e8f5e9; border: 1px solid #4caf50; color: #1e8449; }
        .error { background: #fbecec; border: 1px solid #e74c3c; color: #c0392b; }
        .back-button { display: inline-block; margin-top: 25px; padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px; transition: background 0.3s; }
        .back-button:hover { background: #2980b9; }
        hr { border: 0; height: 1px; background-color: #f39c12; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="result-container">
        <h1>Kết Quả Hoán Vị 🔄</h1>
        <div class="result-box <?php echo $is_error ? 'error' : 'success'; ?>">
            <?php echo $ketQua; ?>
        </div>
        <a href="SapXepTang.php" class="back-button">Quay lại Form</a>
    </div>
</body>
</html>