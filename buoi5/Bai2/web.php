<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>web.php: Thêm/Xóa Phần Tử Mảng</title>
    <style> 
        /* Reset và font chữ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Orbitron', 'Segoe UI', monospace;
        }
        
        body {
            background: #0a0a16;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
            color: #fff;
        }
        
        /* Hiệu ứng nền neon */
        .neon-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1;
            background: 
                radial-gradient(circle at 20% 30%, rgba(0, 123, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(220, 53, 69, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(40, 167, 69, 0.15) 0%, transparent 50%);
        }
        
        /* Container chính */
        .form-container {
            background: rgba(15, 15, 30, 0.9);
            border-radius: 20px;
            padding: 50px 45px;
            box-shadow: 
                0 0 30px rgba(0, 123, 255, 0.3),
                0 0 60px rgba(0, 123, 255, 0.2),
                inset 0 0 20px rgba(255, 255, 255, 0.05);
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 700px;
            border: 1px solid rgba(0, 123, 255, 0.3);
            overflow: hidden;
            transition: all 0.5s ease;
        }
        
        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, 
                transparent, 
                #00ffea, 
                #007bff, 
                #00ffea, 
                transparent);
            animation: scanline 3s linear infinite;
        }
        
        @keyframes scanline {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        /* Tiêu đề */
        h2 {
            color: #00ffea;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 30px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            padding-bottom: 20px;
            text-shadow: 
                0 0 10px #00ffea,
                0 0 20px #00ffea,
                0 0 30px #007bff;
        }
        
        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 3px;
            background: linear-gradient(90deg, 
                transparent, 
                #00ffea, 
                #007bff, 
                #00ffea, 
                transparent);
            border-radius: 2px;
            box-shadow: 0 0 10px #00ffea;
        }
        
        /* Form */
        form {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        
        /* Fieldset */
        fieldset {
            border: 2px solid;
            padding: 30px;
            margin-bottom: 0;
            background: rgba(20, 20, 40, 0.7);
            border-radius: 15px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            animation: border-glow 4s infinite alternate;
        }
        
        @keyframes border-glow {
            0%, 100% { box-shadow: 0 0 15px rgba(0, 123, 255, 0.3); }
            50% { box-shadow: 0 0 25px rgba(0, 123, 255, 0.6); }
        }
        
        fieldset:first-child {
            border-color: #00ff88;
            box-shadow: 
                0 0 20px rgba(0, 255, 136, 0.3),
                inset 0 0 20px rgba(0, 255, 136, 0.1);
        }
        
        fieldset:last-child {
            border-color: #ff3366;
            box-shadow: 
                0 0 20px rgba(255, 51, 102, 0.3),
                inset 0 0 20px rgba(255, 51, 102, 0.1);
            animation-delay: 2s;
        }
        
        fieldset:hover {
            transform: translateY(-5px);
        }
        
        fieldset:first-child:hover {
            box-shadow: 
                0 0 30px rgba(0, 255, 136, 0.5),
                inset 0 0 25px rgba(0, 255, 136, 0.15);
        }
        
        fieldset:last-child:hover {
            box-shadow: 
                0 0 30px rgba(255, 51, 102, 0.5),
                inset 0 0 25px rgba(255, 51, 102, 0.15);
        }
        
        /* Legend */
        legend {
            font-weight: 700;
            font-size: 1.4rem;
            padding: 0 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            letter-spacing: 1px;
            background: transparent;
            width: auto;
        }
        
        fieldset:first-child legend {
            color: #00ff88;
            text-shadow: 0 0 10px #00ff88;
        }
        
        fieldset:last-child legend {
            color: #ff3366;
            text-shadow: 0 0 10px #ff3366;
        }
        
        /* Label */
        label {
            display: block;
            color: #a0c8ff;
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 1.2rem;
            letter-spacing: 1px;
        }
        
        /* Input */
        input[type="text"], input[type="number"] {
            width: 100%;
            background: rgba(0, 20, 40, 0.7);
            border: 2px solid #007bff;
            border-radius: 10px;
            padding: 18px 20px;
            font-size: 1.1rem;
            color: #00ffea;
            transition: all 0.3s ease;
            outline: none;
            font-weight: 500;
            margin-bottom: 25px;
            letter-spacing: 1px;
            font-family: 'Orbitron', monospace;
        }
        
        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #00ffea;
            box-shadow: 
                0 0 15px rgba(0, 255, 234, 0.5),
                inset 0 0 10px rgba(0, 255, 234, 0.1);
            background: rgba(0, 30, 60, 0.8);
        }
        
        input[type="text"]::placeholder, input[type="number"]::placeholder {
            color: rgba(0, 255, 234, 0.5);
        }
        
        /* Button container */
        .button-container {
            display: flex;
            justify-content: flex-end;
        }
        
        /* Nút submit */
        input[type="submit"] {
            background: linear-gradient(135deg, #00ff88 0%, #00cc6a 100%);
            color: #001122;
            border: none;
            padding: 18px 35px;
            font-size: 1.2rem;
            font-weight: 800;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            box-shadow: 
                0 0 20px rgba(0, 255, 136, 0.4),
                0 5px 15px rgba(0, 0, 0, 0.3);
            text-transform: uppercase;
            font-family: 'Orbitron', monospace;
        }
        
        input[type="submit"][value="Xóa Vị Trí"] {
            background: linear-gradient(135deg, #ff3366 0%, #cc0044 100%);
            box-shadow: 
                0 0 20px rgba(255, 51, 102, 0.4),
                0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        input[type="submit"]::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.3), 
                transparent);
            transition: 0.5s;
        }
        
        input[type="submit"]:hover {
            transform: translateY(-5px) scale(1.05);
        }
        
        input[type="submit"][value="Thêm Màu"]:hover {
            box-shadow: 
                0 0 30px rgba(0, 255, 136, 0.6),
                0 10px 20px rgba(0, 0, 0, 0.4);
        }
        
        input[type="submit"][value="Xóa Vị Trí"]:hover {
            box-shadow: 
                0 0 30px rgba(255, 51, 102, 0.6),
                0 10px 20px rgba(0, 0, 0, 0.4);
        }
        
        input[type="submit"]:hover::before {
            animation: shimmer 1s infinite;
        }
        
        @keyframes shimmer {
            100% { left: 100%; }
        }
        
        input[type="submit"]:active {
            transform: translateY(-2px) scale(1.02);
        }
        
        /* Hiệu ứng icon động */
        .fieldset-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 2rem;
            opacity: 0.5;
        }
        
        fieldset:first-child .fieldset-icon {
            color: #00ff88;
            text-shadow: 0 0 10px #00ff88;
        }
        
        fieldset:last-child .fieldset-icon {
            color: #ff3366;
            text-shadow: 0 0 10px #ff3366;
        }
        
        /* Thông tin thêm */
        .info-box {
            background: rgba(20, 30, 60, 0.7);
            border-radius: 15px;
            padding: 25px;
            margin-top: 30px;
            border-left: 4px solid #00ffea;
            box-shadow: 
                0 0 15px rgba(0, 255, 234, 0.2),
                inset 0 0 10px rgba(0, 255, 234, 0.05);
        }
        
        .info-title {
            color: #00ffea;
            font-size: 1.3rem;
            margin-bottom: 15px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: 1px;
        }
        
        .info-text {
            color: #a0c8ff;
            font-size: 1rem;
            line-height: 1.6;
        }
        
        .info-text p {
            margin-bottom: 10px;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 40px;
            color: #6688cc;
            font-size: 0.9rem;
            letter-spacing: 1px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 123, 255, 0.3);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                padding: 40px 30px;
            }
            
            h2 {
                font-size: 2rem;
            }
            
            fieldset {
                padding: 25px;
            }
            
            input[type="text"], input[type="number"] {
                width: 100%;
                padding: 16px;
            }
            
            .button-container {
                justify-content: center;
            }
            
            input[type="submit"] {
                width: 100%;
            }
        }
        
        @media (max-width: 480px) {
            .form-container {
                padding: 30px 20px;
            }
            
            h2 {
                font-size: 1.6rem;
            }
            
            legend {
                font-size: 1.2rem;
            }
            
            input[type="text"], input[type="number"] {
                font-size: 1rem;
                padding: 14px;
            }
            
            input[type="submit"] {
                padding: 16px;
                font-size: 1.1rem;
            }
        }
    </style>
    <!-- Font Awesome và Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Hiệu ứng nền neon -->
    <div class="neon-bg"></div>
    
    <div class="form-container">
        <h2>BÀI TẬP 2: THÊM / XÓA PHẦN TỬ MẢNG</h2>
        
        <form action="webResult.php" method="POST">
            <fieldset>
                <div class="fieldset-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <legend><i class="fas fa-plus-square" style="margin-right: 10px;"></i> THAO TÁC THÊM MÀU MỚI</legend>
                <label for="new_color">NHẬP MÀU MỚI</label>
                <input type="text" id="new_color" name="new_color" placeholder="Ví dụ: purple, gold, silver">
                <div class="button-container">
                    <input type="submit" name="action_type" value="Thêm Màu">
                </div>
            </fieldset>

            <fieldset>
                <div class="fieldset-icon">
                    <i class="fas fa-minus-circle"></i>
                </div>
                <legend><i class="fas fa-minus-square" style="margin-right: 10px;"></i> THAO TÁC XÓA VỊ TRÍ</legend>
                <label for="delete_index">NHẬP VỊ TRÍ (INDEX) MUỐN XÓA</label>
                <input type="number" id="delete_index" name="delete_index" placeholder="Ví dụ: 0, 1, 2, 3...">
                <div class="button-container">
                    <input type="submit" name="action_type" value="Xóa Vị Trí">
                </div>
            </fieldset>
        </form>
        
        <div class="info-box">
            <div class="info-title">
                <i class="fas fa-terminal"></i> HƯỚNG DẪN SỬ DỤNG
            </div>
            <div class="info-text">
                <p><strong>Thao tác thêm:</strong> Nhập tên màu (tiếng Anh) để thêm vào mảng màu hiện có.</p>
                <p><strong>Thao tác xóa:</strong> Nhập chỉ số (index) của phần tử muốn xóa (bắt đầu từ 0).</p>
                <p><strong>Mảng mặc định:</strong> red, green, blue, yellow, black</p>
            </div>
        </div>
        
        <div class="footer">
            Hệ thống quản lý mảng động © 2023 | Phiên bản Neon
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hiệu ứng scanline cho container
            const formContainer = document.querySelector('.form-container');
            
            // Tạo hiệu ứng random glitch
            setInterval(() => {
                if (Math.random() > 0.7) {
                    formContainer.style.boxShadow = 
                        `0 0 40px rgba(${Math.random() * 255}, ${Math.random() * 255}, 255, 0.4),
                         0 0 80px rgba(0, 123, 255, 0.3),
                         inset 0 0 20px rgba(255, 255, 255, 0.05)`;
                    
                    setTimeout(() => {
                        formContainer.style.boxShadow = 
                            '0 0 30px rgba(0, 123, 255, 0.3), 0 0 60px rgba(0, 123, 255, 0.2), inset 0 0 20px rgba(255, 255, 255, 0.05)';
                    }, 100);
                }
            }, 2000);
            
            // Hiệu ứng focus cho input
            const inputs = document.querySelectorAll('input[type="text"], input[type="number"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-8px)';
                    this.style.boxShadow = 
                        '0 0 20px rgba(0, 255, 234, 0.7), inset 0 0 15px rgba(0, 255, 234, 0.15)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = 
                        '0 0 15px rgba(0, 255, 234, 0.5), inset 0 0 10px rgba(0, 255, 234, 0.1)';
                });
            });
            
            // Gợi ý placeholder động
            const colorInput = document.getElementById('new_color');
            const colorExamples = [
                "Ví dụ: purple, gold, silver",
                "Ví dụ: crimson, teal, coral",
                "Ví dụ: magenta, cyan, indigo",
                "Ví dụ: amber, violet, emerald"
            ];
            
            let colorIndex = 0;
            if (colorInput) {
                setInterval(() => {
                    colorInput.placeholder = colorExamples[colorIndex];
                    colorIndex = (colorIndex + 1) % colorExamples.length;
                }, 3000);
            }
            
            // Hiệu ứng cho nút submit
            const submitButtons = document.querySelectorAll('input[type="submit"]');
            submitButtons.forEach(button => {
                button.addEventListener('mousedown', function() {
                    this.style.transform = 'translateY(-2px) scale(0.98)';
                });
                
                button.addEventListener('mouseup', function() {
                    this.style.transform = 'translateY(-5px) scale(1.05)';
                });
                
                // Hiệu ứng neon pulse cho nút
                setInterval(() => {
                    if (button.value === "Thêm Màu") {
                        button.style.boxShadow = 
                            `0 0 ${15 + Math.random() * 10}px rgba(0, 255, 136, 0.5),
                             0 5px 15px rgba(0, 0, 0, 0.3)`;
                    } else {
                        button.style.boxShadow = 
                            `0 0 ${15 + Math.random() * 10}px rgba(255, 51, 102, 0.5),
                             0 5px 15px rgba(0, 0, 0, 0.3)`;
                    }
                }, 1000);
            });
            
            // Hiệu ứng cho fieldset
            const fieldsets = document.querySelectorAll('fieldset');
            fieldsets.forEach(fieldset => {
                // Random glow intensity
                setInterval(() => {
                    const intensity = 0.3 + Math.random() * 0.3;
                    if (fieldset.classList.contains('first-child') || fieldset === fieldsets[0]) {
                        fieldset.style.boxShadow = 
                            `0 0 ${15 + Math.random() * 10}px rgba(0, 255, 136, ${intensity}),
                             inset 0 0 ${15 + Math.random() * 5}px rgba(0, 255, 136, 0.1)`;
                    } else {
                        fieldset.style.boxShadow = 
                            `0 0 ${15 + Math.random() * 10}px rgba(255, 51, 102, ${intensity}),
                             inset 0 0 ${15 + Math.random() * 5}px rgba(255, 51, 102, 0.1)`;
                    }
                }, 2000);
            });
        });
    </script>
</body>
</html>