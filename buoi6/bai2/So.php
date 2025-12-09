<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Hàm Kiểm Tra Số</title>
    <style>
        /* CSS Chung cho Form (Giống Bài 1) */
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --button-color: linear-gradient(45deg, #2ecc71, #27ae60);
            --text-dark: #2c3e50;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background: var(--primary-gradient); padding: 20px; }
        .container { background: rgba(255, 255, 255, 0.95); padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); width: 100%; max-width: 400px; }
        h1 { color: var(--text-dark); margin-bottom: 25px; text-align: center; font-size: 1.8rem; }
        .input-group label { display: block; margin-bottom: 5px; color: var(--text-dark); font-weight: 600; }
        input[type="number"] { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 8px; box-sizing: border-box; font-size: 16px; transition: border-color 0.3s; }
        input[type="number"]:focus { border-color: #667eea; outline: none; }
        button { background: var(--button-color); color: white; padding: 12px 20px; border: none; border-radius: 8px; cursor: pointer; width: 100%; font-size: 16px; font-weight: bold; transition: opacity 0.3s, transform 0.3s; box-shadow: 0 4px 10px rgba(46, 204, 113, 0.3); }
        button:hover { opacity: 0.9; transform: translateY(-2px); }
    </style>
</head>
<body>
    <form class="container" action="SoResult.php" method="post">
        <h1> Giám Định Thuật ☲</h1>
        <div class="input-group">
            <label for="n2">Nhập linh số n</label>
            <input type="number" name="n2" id="n2" placeholder="Nhập một số nguyên" required>
        </div>
        <button type="submit" name="btn_bai2">Giám Định</button>
    </form>
</body>
</html>