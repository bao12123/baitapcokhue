<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Tính Toán</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            text-align: center;
            padding: 20px;
        }

        .result-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            color: #333;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(102, 126, 234, 0.2);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
        
        .result-content {
            background: rgba(255, 255, 255, 0.8);
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .success {
            color: #2ecc71;
            font-size: 1.4rem;
            font-weight: 600;
            line-height: 1.5;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .success::before {
            content: "✓";
            background: #2ecc71;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 3px 10px rgba(46, 204, 113, 0.3);
        }

        .error {
            color: #e74c3c;
            font-size: 1.3rem;
            font-weight: 600;
            line-height: 1.5;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .error::before {
            content: "!";
            background: #e74c3c;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: bold;
            box-shadow: 0 3px 10px rgba(231, 76, 60, 0.3);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 30px;
            padding: 15px 35px;
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            min-width: 200px;
        }

        .back-button::before {
            content: '←';
            margin-right: 10px;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .back-button:hover {
            background: linear-gradient(45deg, #2980b9, #3498db);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.4);
        }

        .back-button:hover::before {
            transform: translateX(-5px);
        }

        .back-button:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .calculation-details {
            background: rgba(52, 152, 219, 0.1);
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 1.1rem;
            color: #2c3e50;
            border-left: 4px solid #3498db;
        }

        .calculation-details span {
            font-weight: bold;
            color: #2980b9;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .result-container {
                padding: 30px 20px;
                margin: 10px;
            }
            
            h1 {
                font-size: 1.6rem;
            }
            
            .success, .error {
                font-size: 1.2rem;
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .back-button {
                padding: 12px 25px;
                font-size: 1rem;
                min-width: 180px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px;
            }
            
            .result-container {
                padding: 25px 15px;
            }
            
            h1 {
                font-size: 1.4rem;
            }
            
            .success, .error {
                font-size: 1.1rem;
            }
            
            .back-button {
                padding: 10px 20px;
                min-width: 160px;
            }
        }

        /* Glow effect for success */
        .success-glow {
            animation: glow 2s infinite alternate;
        }

        @keyframes glow {
            from {
                box-shadow: 0 0 10px rgba(46, 204, 113, 0.4);
            }
            to {
                box-shadow: 0 0 20px rgba(46, 204, 113, 0.7);
            }
        }
    </style>
</head>
<body>
    <div class="result-container">
        <?php
            // Khởi tạo $action để tránh lỗi undefined index nếu truy cập trực tiếp
            $action = isset($_POST['action']) ? $_POST['action'] : ''; 

            // Lấy giá trị và chuyển về kiểu số thực (float)
            $a = isset($_POST['giatriA']) ? floatval($_POST['giatriA']) : null;
            $b = isset($_POST['giatriB']) ? floatval($_POST['giatriB']) : null;

            // Hàm kiểm tra xem input có phải là số hợp lệ không
            $is_a_numeric = isset($_POST['giatriA']) && is_numeric($_POST['giatriA']);
            $is_b_numeric = isset($_POST['giatriB']) && is_numeric($_POST['giatriB']);

            if ($is_a_numeric && $is_b_numeric) {
                // Định nghĩa các hàm tính toán
                function Tong($val_a, $val_b) { return $val_a + $val_b; }
                function Hieu($val_a, $val_b) { return $val_a - $val_b; }
                function Tich($val_a, $val_b) { return $val_a * $val_b; }

                switch ($action) {
                    case 'Tong':
                        $result = Tong($a, $b);
                        echo '<h1>Kết Quả Phép Tính</h1>';
                        echo '<div class="result-content success-glow">';
                        echo '<div class="success">Tổng của '.$a.' và '.$b.' là: '.$result.'</div>';
                        echo '<div class="calculation-details">Phép tính: <span>'.$a.' + '.$b.' = '.$result.'</span></div>';
                        echo '</div>';
                        break;
                        
                    case 'Hieu':
                        $result = Hieu($a, $b);
                        echo '<h1>Kết Quả Phép Tính</h1>';
                        echo '<div class="result-content">';
                        echo '<div class="success">Hiệu của '.$a.' và '.$b.' là: '.$result.'</div>';
                        echo '<div class="calculation-details">Phép tính: <span>'.$a.' - '.$b.' = '.$result.'</span></div>';
                        echo '</div>';
                        break;
                        
                    case 'Tich':
                        $result = Tich($a, $b);
                        echo '<h1>Kết Quả Phép Tính</h1>';
                        echo '<div class="result-content">';
                        echo '<div class="success">Tích của '.$a.' và '.$b.' là: '.$result.'</div>';
                        echo '<div class="calculation-details">Phép tính: <span>'.$a.' × '.$b.' = '.$result.'</span></div>';
                        echo '</div>';
                        break;
                        
                    default:
                        echo '<h1>Lỗi Hệ Thống</h1>';
                        echo '<div class="result-content">';
                        echo '<div class="error">Không nhận diện được hành động hoặc bạn chưa chọn hành động!</div>';
                        echo '</div>';
                }
            } else if (isset($_POST['giatriA']) || isset($_POST['giatriB'])) {
                // Ít nhất 1 giá trị được gửi nhưng không phải là số hợp lệ
                echo '<h1>Lỗi Đầu Vào</h1>';
                echo '<div class="result-content">';
                echo '<div class="error">Giá trị nhập vào không phải là số hợp lệ.</div>';
                echo '<div class="calculation-details">Vui lòng nhập số hợp lệ vào cả hai trường.</div>';
                echo '</div>';
            } else {
                // Trường hợp người dùng truy cập trực tiếp result.php
                echo '<h1>Truy Cập Không Hợp Lệ</h1>';
                echo '<div class="result-content">';
                echo '<div class="error">Vui lòng điền vào Form để thực hiện phép tính.</div>';
                echo '</div>';
            }
        ?>
        <a href="functions.php" class="back-button">Quay lại trang tính</a>
    </div>
</body>
</html>