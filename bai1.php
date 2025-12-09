<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm tra số chia hết cho 5</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #4cc9f0;
            --danger: #f72585;
            --dark: #1e1e2c;
            --light: #f8f9fa;
            --glass: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #1e1e2c 0%, #3a0ca3 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: var(--light);
        }
        
        .container {
            background: var(--glass);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 480px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.4s ease;
        }
        
        .container:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
        }
        
        .logo {
            font-size: 48px;
            margin-bottom: 20px;
            color: var(--success);
            text-shadow: 0 0 15px rgba(76, 201, 240, 0.5);
        }
        
        h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            background: linear-gradient(90deg, #4cc9f0, #f72585);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .subtitle {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.5;
        }
        
        .number-input {
            width: 100%;
            padding: 18px 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            font-size: 18px;
            color: white;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }
        
        .number-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.12);
            border-color: var(--success);
            box-shadow: 0 0 0 3px rgba(76, 201, 240, 0.2);
        }
.number-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 16px 30px;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }
        
        .btn:active {
            transform: translateY(1px);
        }
        
        .result-section {
            margin-top: 30px;
            display: none;
            animation: fadeIn 0.5s ease forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .number-display {
            font-size: 72px;
            font-weight: 800;
            margin: 20px 0;
            color: white;
            text-shadow: 0 0 20px rgba(76, 201, 240, 0.5);
        }
        
        .result-card {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 25px;
            margin: 20px 0;
            border: 1px solid var(--glass-border);
            transition: all 0.3s ease;
        }
        
        .result-card.success {
            background: rgba(76, 201, 240, 0.15);
            border-color: rgba(76, 201, 240, 0.3);
        }
        
        .result-card.error {
            background: rgba(247, 37, 133, 0.15);
            border-color: rgba(247, 37, 133, 0.3);
        }
        
        .result-text {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .result-icon {
            font-size: 28px;
        }
        
        .explanation {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            text-align: left;
            font-size: 14px;
            line-height: 1.6;
            border-left: 4px solid var(--primary);
        }
        
        .math-formula {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 12px;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            margin: 5px 0;
            font-weight: 600;
        }
.footer {
            margin-top: 30px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 25px 0;
        }
        
        .hint {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .number-display {
                font-size: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <i class="fas fa-calculator"></i>
        </div>
        
        <h1>Kiểm Tra Tính Chia Hết</h1>
        <p class="subtitle">Nhập một số để kiểm tra xem nó có chia hết cho 5 hay không</p>
        
        <form method="POST" action="" id="checkForm">
            <input type="number" class="number-input" name="number" 
                   placeholder="Nhập số cần kiểm tra..." 
                   value="<?php echo isset($_POST['number']) ? $_POST['number'] : ''; ?>" 
                   required>
            <button type="submit" class="btn">
                <i class="fas fa-check-circle"></i> Kiểm Tra Ngay
            </button>
        </form>
        
        <div class="hint">
            <i class="fas fa-lightbulb"></i>
            <span>Một số chia hết cho 5 nếu chữ số cuối cùng là 0 hoặc 5</span>
        </div>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $number = $_POST["number"];
            $isDivisible = ($number % 5 == 0);
            
            echo '<div class="result-section" style="display:block;">';
            echo '<div class="divider"></div>';
            echo '<div class="number-display">' . $number . '</div>';
            
            echo '<div class="result-card ' . ($isDivisible ? 'success' : 'error') . '">';
            echo '<div class="result-text">';
            if ($isDivisible) {
                echo '<i class="fas fa-check-circle result-icon" style="color: #4cc9f0;"></i>';
                echo "Số $number chia hết cho 5";
            } else {
                echo '<i class="fas fa-times-circle result-icon" style="color: #f72585;"></i>';
                echo "Số $number không chia hết cho 5";
            }
            echo '</div>';
            
            echo '<div class="explanation">';
            echo '<h3><i class="fas fa-info-circle"></i> Giải thích:</h3>';
echo '<p>Một số chia hết cho 5 khi và chỉ khi chữ số cuối cùng của nó là 0 hoặc 5.</p>';
            echo '<p>Công thức toán học: <span class="math-formula">' . $number . ' % 5 = ' . ($number % 5) . '</span></p>';
            echo '<p>Vì phần dư là ' . ($number % 5) . ' nên số ' . $number . ' ' . 
                 ($isDivisible ? 'chia hết' : 'không chia hết') . ' cho 5.</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
        
        <div class="footer">
            <div>Ứng dụng kiểm tra số học</div>
            <div>Powered by PHP</div>
        </div>
    </div>

    <script>
        // Thêm hiệu ứng khi nhấn nút
        document.querySelector('.btn').addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
        });
        
        // Tự động focus vào ô input
        document.querySelector('.number-input').focus();
    </script>
</body>
</html>


