<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính Toán Đơn Giản</title>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(45deg, #ff6b6b, #ee5a24);
            --blue-gradient: linear-gradient(45deg, #74b9ff, #0984e3);
            --green-gradient: linear-gradient(45deg, #2ecc71, #27ae60);
            --text-dark: #2c3e50;
            --text-light: #ecf0f1;
            --shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            --shadow-light: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

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
            background: var(--primary-gradient);
            padding: 20px;
        }

        .calculator-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 450px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            color: var(--text-dark);
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 2rem;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            position: relative;
            padding-bottom: 15px;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 3px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        .input-group {
            margin-bottom: 25px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 1.1rem;
        }

        input[type="text"] {
            width: 100%; 
            padding: 15px 20px;
            margin: 5px 0 15px 0;
            border: 2px solid rgba(102, 126, 234, 0.3);
            border-radius: 12px;
            box-sizing: border-box; 
            transition: all 0.3s ease;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.9);
            color: var(--text-dark);
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        input[type="text"]::placeholder {
            color: #95a5a6;
            font-weight: 400;
        }

        input[type="text"]:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
            outline: none;
            background: white;
            transform: translateY(-2px);
        }

        .button-group {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 30px;
        }

        .form-button {
            background: var(--blue-gradient);
            color: var(--text-light);
            padding: 16px 10px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
            position: relative;
            overflow: hidden;
            min-height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .form-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .form-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.4);
        }

        .form-button:hover::before {
            left: 100%;
        }

        .form-button:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .form-button:nth-child(1) {
            background: var(--green-gradient);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
        }

        .form-button:nth-child(1):hover {
            box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
        }

        .form-button:nth-child(2) {
            background: var(--secondary-gradient);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        .form-button:nth-child(2):hover {
            box-shadow: 0 8px 20px rgba(231, 76, 60, 0.4);
        }

        .form-button:nth-child(3) {
            background: linear-gradient(45deg, #9b59b6, #8e44ad);
            box-shadow: 0 5px 15px rgba(155, 89, 182, 0.3);
        }

        .form-button:nth-child(3):hover {
            box-shadow: 0 8px 20px rgba(155, 89, 182, 0.4);
        }

        .form-button i {
            font-size: 1.2em;
        }

        .calculator-icon {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5rem;
            color: #667eea;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .calculator-footer {
            margin-top: 25px;
            text-align: center;
            color: #7f8c8d;
            font-size: 0.9rem;
            padding-top: 15px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .calculator-container {
                padding: 30px 25px;
                margin: 10px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .button-group {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .form-button {
                padding: 14px 10px;
                font-size: 15px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 15px;
            }
            
            .calculator-container {
                padding: 25px 20px;
            }
            
            h1 {
                font-size: 1.6rem;
            }
            
            input[type="text"] {
                padding: 12px 15px;
            }
            
            .calculator-icon {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <form class="calculator-container" action="functionResult.php" method="post">
        <div class="calculator-icon">🧮</div>
        <h1>Máy Tính Đơn Giản</h1>
        
        <div class="input-group">
            <label for="giatriA">Số thứ nhất</label>
            <input type="text" name="giatriA" id="giatriA" placeholder="Nhập giá trị a" required>
        </div>
        
        <div class="input-group">
            <label for="giatriB">Số thứ hai</label>
            <input type="text" name="giatriB" id="giatriB" placeholder="Nhập giá trị b" required>
        </div>
        
        <div class="button-group">
            <button class="form-button" type="submit" name="action" value="Tong">
                <span>➕</span> Tính Tổng
            </button>
            <button class="form-button" type="submit" name="action" value="Hieu">
                <span>➖</span> Tính Hiệu
            </button>
            <button class="form-button" type="submit" name="action" value="Tich">
                <span>✖️</span> Tính Tích
            </button>
        </div>
        
        <div class="calculator-footer">
            Nhập hai số và chọn phép tính
        </div>
    </form>
</body>
</html>