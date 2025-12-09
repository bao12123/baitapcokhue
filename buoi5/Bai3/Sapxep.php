<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sapxep.php: Form Sắp Xếp Mảng</title>
    <style> 
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f8f9fa; }
        .form-container { 
            background-color: white; 
            padding: 30px; 
            border-radius: 12px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
            display: inline-block; 
            border-top: 5px solid #8e44ad;
        }
        h2 { color: #8e44ad; margin-bottom: 20px; }
        input[type="text"] { 
            padding: 10px; 
            width: 300px; 
            margin-bottom: 20px; 
            border: 1px solid #ccc; 
            border-radius: 6px; 
            transition: border-color 0.3s;
        }
        input[type="text"]:focus {
            border-color: #8e44ad;
            box-shadow: 0 0 0 3px rgba(142, 68, 173, 0.2);
            outline: none;
        }
        input[type="submit"] { 
            background-color: #8e44ad; 
            color: white; 
            border: none; 
            padding: 12px 25px; 
            border-radius: 8px; 
            cursor: pointer; 
            font-weight: bold; 
            margin-top: 15px; 
            transition: background-color 0.3s, transform 0.2s;
        }
        input[type="submit"]:hover {
            background-color: #a044ff;
            transform: translateY(-2px);
        }
        fieldset {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }
        legend {
            font-weight: bold;
            color: #8e44ad;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>BÀI TẬP 3: WEB SẮP XẾP DANH SÁCH ĐIỂM SỐ</h2>
        
        <p>Vui lòng nhập chuỗi điểm số, cách nhau bằng dấu phẩy (,):</p>
        
        <form action="SapxepResult.php" method="POST">
            
            <label for="marks_string">Chuỗi điểm số (ví dụ: 7.5, 9, 6.5, 8, 10):</label><br>
            <input type="text" id="marks_string" name="marks_string" required><br>

            <fieldset>
                <legend>Chọn kiểu sắp xếp:</legend>
                <input type="radio" id="asc" name="sort_type" value="asc" required>
                <label for="asc">Sắp xếp **Tăng dần** (dùng `sort()`)</label><br>

                <input type="radio" id="desc" name="sort_type" value="desc" required>
                <label for="desc">Sắp xếp **Giảm dần** (dùng `rsort()`)</label><br>
            </fieldset>
            
            <input type="submit" value="Xem Kết Quả Sắp Xếp">
        </form>
    </div>
</body>
</html>