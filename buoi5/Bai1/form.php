<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>form.php: Nhập Liệu Mảng</title>
    <style> 
        /* Reset và font chữ hiện đại */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #8E2DE2 0%, #4A00E0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Hiệu ứng hạt ánh sáng nền */
        .light-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1;
        }
        
        .light-particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            box-shadow: 0 0 10px 2px rgba(255, 255, 255, 0.8);
            animation: twinkle 3s infinite ease-in-out;
        }
        
        @keyframes twinkle {
            0%, 100% { opacity: 0.2; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1.2); }
        }
        
        /* Container chính */
        .form-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 24px;
            padding: 45px 40px;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.15),
                inset 0 0 0 1px rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 500px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transform: perspective(1000px) rotateX(0deg);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .form-container:hover {
            transform: perspective(1000px) rotateX(2deg) translateY(-10px);
            box-shadow: 
                0 35px 60px rgba(0, 0, 0, 0.35),
                0 0 0 1px rgba(255, 255, 255, 0.2),
                inset 0 0 0 1px rgba(255, 255, 255, 0.15);
        }
        
        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #FF416C, #FF4B2B);
            border-radius: 24px 24px 0 0;
            z-index: 3;
        }
        
        /* Tiêu đề */
        h2 {
            color: transparent;
            background: linear-gradient(90deg, #FF416C, #FF4B2B);
            -webkit-background-clip: text;
            background-clip: text;
            font-size: 2.4rem;
            font-weight: 800;
            margin-bottom: 15px;
            text-align: center;
            letter-spacing: -0.5px;
            position: relative;
            padding-bottom: 15px;
        }
        
        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #FF416C, #FF4B2B);
            border-radius: 2px;
        }
        
        /* Mô tả */
        p {
            color: rgba(255, 255, 255, 0.8);
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.1rem;
            line-height: 1.6;
            font-weight: 300;
        }
        
        /* Form */
        form {
            position: relative;
        }
        
        /* Label */
        label {
            display: block;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 1.1rem;
            position: relative;
            padding-left: 35px;
        }
        
        label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 25px;
            height: 25px;
            background: linear-gradient(135deg, #FF416C, #FF4B2B);
            border-radius: 6px;
            opacity: 0.9;
            box-shadow: 0 4px 10px rgba(255, 65, 108, 0.3);
        }
        
        label::after {
            content: '✓';
            position: absolute;
            left: 7px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 13px;
            font-weight: bold;
        }
        
        /* Input */
        input[type="text"] {
            width: 100%;
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            padding: 18px 20px 18px 50px;
            font-size: 1.1rem;
            color: white;
            transition: all 0.3s ease;
            outline: none;
            font-weight: 500;
            margin-bottom: 25px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            letter-spacing: 0.5px;
        }
        
        input[type="text"]:focus {
            border-color: rgba(255, 75, 43, 0.8);
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 
                0 0 0 4px rgba(255, 75, 43, 0.15),
                0 12px 25px rgba(0, 0, 0, 0.2);
            transform: translateY(-3px);
        }
        
        input[type="text"]::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 20px;
            top: 18px;
            color: #FF4B2B;
            font-size: 1.2rem;
            z-index: 2;
        }
        
        /* Nút submit */
        input[type="submit"] {
            background: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%);
            color: white;
            border: none;
            padding: 18px 40px;
            font-size: 1.2rem;
            font-weight: 700;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: block;
            margin: 0 auto;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(255, 75, 43, 0.3);
            width: 100%;
            max-width: 300px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        
        input[type="submit"]::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }
        
        input[type="submit"]:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(255, 75, 43, 0.4);
        }
        
        input[type="submit"]:hover::before {
            animation: shimmer 1.5s infinite;
        }
        
        @keyframes shimmer {
            100% { left: 100%; }
        }
        
        input[type="submit"]:active {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(255, 75, 43, 0.3);
        }
        
        /* Hiệu ứng ví dụ */
        .example-text {
            display: block;
            margin-top: 12px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            font-weight: 500;
            background: rgba(255, 255, 255, 0.05);
            padding: 12px 18px;
            border-radius: 10px;
            border-left: 3px solid #FF416C;
            margin-bottom: 25px;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 40px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 2;
        }
        
        /* Hiệu ứng glow cho container */
        .glow-effect {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            border-radius: 24px;
            box-shadow: 
                inset 0 0 50px rgba(255, 65, 108, 0.1),
                inset 0 0 60px rgba(255, 75, 43, 0.05);
            pointer-events: none;
            z-index: -1;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .form-container {
                padding: 35px 30px;
            }
            
            h2 {
                font-size: 2rem;
            }
            
            input[type="text"] {
                padding: 16px 16px 16px 45px;
            }
            
            .input-icon {
                top: 16px;
            }
        }
        
        @media (max-width: 480px) {
            .form-container {
                padding: 30px 25px;
            }
            
            h2 {
                font-size: 1.8rem;
            }
            
            input[type="submit"] {
                width: 100%;
                padding: 16px;
            }
            
            label {
                padding-left: 0;
            }
            
            label::before, label::after {
                display: none;
            }
        }
    </style>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Hiệu ứng hạt ánh sáng nền -->
    <div class="light-particles" id="lightParticles"></div>
    
    <div class="form-container">
        <div class="glow-effect"></div>
        
        <h2>BÀI TẬP 1: XỬ LÝ MẢNG HOÀN CHỈNH</h2>
        <p>Nhập chuỗi số nguyên cách nhau bằng dấu phẩy để hệ thống phân tích và xử lý dữ liệu mảng.</p>

        <form action="formResult.php" method="POST">
            <label for="number_string">NHẬP CHUỖI SỐ</label>
            
            <div class="input-wrapper">
                <div class="input-icon">
                    <i class="fas fa-sort-numeric-down-alt"></i>
                </div>
                <input type="text" id="number_string" name="number_string" 
                       placeholder="Ví dụ: 15, 8, 30, 2, 99, 4, 12, 7" required>
            </div>
            
            <span class="example-text">
                <i class="fas fa-lightbulb" style="color: #FFD700; margin-right: 8px;"></i> 
                Gợi ý: Nhập các số cách nhau bằng dấu phẩy, không giới hạn số lượng
            </span>
            
            <input type="submit" value="Xử lý Mảng">
        </form>
        
        <div class="footer">
            Hệ thống xử lý mảng © 2023 | Phiên bản Pro
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tạo hiệu ứng hạt ánh sáng nền
            const lightParticles = document.getElementById('lightParticles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('light-particle');
                
                // Random vị trí và kích thước
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                particle.style.width = `${Math.random() * 4 + 1}px`;
                particle.style.height = particle.style.width;
                
                // Random animation
                particle.style.animationDelay = `${Math.random() * 3}s`;
                particle.style.animationDuration = `${Math.random() * 3 + 2}s`;
                
                lightParticles.appendChild(particle);
            }
            
            // Hiệu ứng focus cho input
            const inputField = document.getElementById('number_string');
            const inputWrapper = document.querySelector('.input-wrapper');
            
            inputField.addEventListener('focus', function() {
                inputWrapper.style.transform = 'scale(1.02)';
            });
            
            inputField.addEventListener('blur', function() {
                inputWrapper.style.transform = 'scale(1)';
            });
            
            // Hiệu ứng placeholder động
            const placeholderTexts = [
                "Ví dụ: 15, 8, 30, 2, 99, 4",
                "Ví dụ: 10, 25, 3, 48, 9, 17",
                "Ví dụ: 7, 14, 21, 28, 35, 42"
            ];
            
            let placeholderIndex = 0;
            setInterval(() => {
                inputField.placeholder = placeholderTexts[placeholderIndex];
                placeholderIndex = (placeholderIndex + 1) % placeholderTexts.length;
            }, 3000);
            
            // Hiệu ứng cho container khi hover
            const formContainer = document.querySelector('.form-container');
            formContainer.addEventListener('mouseenter', function() {
                this.querySelector('.glow-effect').style.boxShadow = 
                    'inset 0 0 80px rgba(255, 65, 108, 0.15), inset 0 0 90px rgba(255, 75, 43, 0.1)';
            });
            
            formContainer.addEventListener('mouseleave', function() {
                this.querySelector('.glow-effect').style.boxShadow = 
                    'inset 0 0 50px rgba(255, 65, 108, 0.1), inset 0 0 60px rgba(255, 75, 43, 0.05)';
            });
        });
    </script>
</body>
</html>