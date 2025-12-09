<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>SapxepResult.php: Kết Quả Sắp Xếp</title>
    <style> 
        /* Reset và font chữ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', -apple-system, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #6a3093 0%, #a044ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Hiệu ứng ánh sáng nền */
        .light-effect {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }
        
        .light-ray {
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 8s infinite ease-in-out;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 0.3; transform: scale(0.8); }
            50% { opacity: 0.6; transform: scale(1.2); }
        }
        
        /* Container chính */
        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 50px 45px;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.2),
                inset 0 0 30px rgba(255, 255, 255, 0.5);
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 850px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transform: perspective(1000px) rotateX(0deg);
            transition: all 0.5s ease;
        }
        
        .container:hover {
            transform: perspective(1000px) rotateX(2deg) translateY(-10px);
            box-shadow: 
                0 35px 60px rgba(0, 0, 0, 0.35),
                0 0 0 1px rgba(255, 255, 255, 0.3),
                inset 0 0 40px rgba(255, 255, 255, 0.6);
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #6a3093, #a044ff);
            border-radius: 24px 24px 0 0;
            z-index: 3;
        }
        
        /* Tiêu đề */
        h1 {
            color: transparent;
            background: linear-gradient(90deg, #6a3093, #a044ff);
            -webkit-background-clip: text;
            background-clip: text;
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 30px;
            text-align: center;
            letter-spacing: -0.5px;
            position: relative;
            padding-bottom: 20px;
        }
        
        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 4px;
            background: linear-gradient(90deg, #6a3093, #a044ff);
            border-radius: 2px;
        }
        
        /* Section */
        .section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 
                0 15px 35px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.8);
            transition: all 0.4s ease;
            border-left: 8px solid #6a3093;
        }
        
        .section:hover {
            transform: translateY(-5px);
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.9);
        }
        
        h2, h3 {
            color: #2d3748;
            margin-bottom: 20px;
            position: relative;
            padding-left: 40px;
            display: flex;
            align-items: center;
        }
        
        h2::before, h3::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: 30px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 16px;
            color: white;
        }
        
        h3:nth-of-type(1)::before {
            content: '\f03a';
            background: #6a3093;
        }
        
        h2::before {
            content: '\f024';
            background: #a044ff;
        }
        
        /* Highlight */
        .highlight {
            background: linear-gradient(90deg, #6a3093, #a044ff);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 800;
            font-size: 1.3rem;
            padding: 8px 15px;
            border-radius: 8px;
            display: inline-block;
            background-color: rgba(106, 48, 147, 0.1);
            border-left: 3px solid #6a3093;
            margin-top: 10px;
        }
        
        /* Danh sách điểm số */
        .marks-display {
            background: linear-gradient(135deg, rgba(106, 48, 147, 0.05) 0%, rgba(160, 68, 255, 0.05) 100%);
            border-radius: 16px;
            padding: 25px;
            margin: 20px 0;
            border: 2px dashed rgba(106, 48, 147, 0.3);
            font-size: 1.4rem;
            font-weight: 700;
            color: #6a3093;
            text-align: center;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        .marks-display:hover {
            background: linear-gradient(135deg, rgba(106, 48, 147, 0.1) 0%, rgba(160, 68, 255, 0.1) 100%);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }
        
        /* Result box */
        .result-box {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            border-radius: 20px;
            padding: 35px;
            margin-top: 25px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.15),
                0 0 0 2px #6a3093;
            border-left: 8px solid;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .asc-result {
            border-left-color: #00b09b;
            box-shadow: 0 20px 40px rgba(0, 176, 155, 0.15), 0 0 0 2px #00b09b;
        }
        
        .desc-result {
            border-left-color: #ff416c;
            box-shadow: 0 20px 40px rgba(255, 65, 108, 0.15), 0 0 0 2px #ff416c;
        }
        
        .result-box:hover {
            transform: translateY(-8px);
            box-shadow: 
                0 30px 50px rgba(0, 0, 0, 0.2),
                0 0 0 2px #6a3093;
        }
        
        .asc-result:hover {
            box-shadow: 0 30px 50px rgba(0, 176, 155, 0.2), 0 0 0 2px #00b09b;
        }
        
        .desc-result:hover {
            box-shadow: 0 30px 50px rgba(255, 65, 108, 0.2), 0 0 0 2px #ff416c;
        }
        
        .result-title {
            color: #2d3748;
            font-size: 1.8rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .asc-title {
            color: #00b09b;
        }
        
        .desc-title {
            color: #ff416c;
        }
        
        .result-title i {
            font-size: 2rem;
        }
        
        /* Hiển thị mảng đã sắp xếp */
        .sorted-marks {
            background: linear-gradient(135deg, rgba(106, 48, 147, 0.1) 0%, rgba(160, 68, 255, 0.1) 100%);
            border-radius: 14px;
            padding: 25px;
            font-family: 'Courier New', monospace;
            font-size: 1.5rem;
            font-weight: 800;
            color: #2ecc71;
            overflow-x: auto;
            border: 2px solid rgba(46, 204, 113, 0.3);
            line-height: 1.6;
            text-align: center;
            margin: 20px 0;
            letter-spacing: 2px;
            transition: all 0.3s ease;
        }
        
        .sorted-marks:hover {
            background: linear-gradient(135deg, rgba(106, 48, 147, 0.15) 0%, rgba(160, 68, 255, 0.15) 100%);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(46, 204, 113, 0.2);
        }
        
        /* Function info */
        .function-info {
            background: linear-gradient(135deg, rgba(106, 48, 147, 0.05) 0%, rgba(160, 68, 255, 0.05) 100%);
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            border-left: 4px solid #6a3093;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .function-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #6a3093, #a044ff);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        
        .function-text {
            flex-grow: 1;
        }
        
        .function-text h4 {
            color: #6a3093;
            margin-bottom: 5px;
            font-size: 1.2rem;
        }
        
        .function-text p {
            color: #4a5568;
            font-size: 1rem;
        }
        
        /* Nút quay lại */
        .back-btn {
            background: linear-gradient(135deg, #6a3093 0%, #a044ff 100%);
            color: white;
            border: none;
            padding: 18px 45px;
            font-size: 1.2rem;
            font-weight: 700;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(106, 48, 147, 0.3);
            text-decoration: none;
            margin-top: 30px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        
        .back-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }
        
        .back-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(106, 48, 147, 0.4);
        }
        
        .back-btn:hover::after {
            animation: shimmer 1.5s infinite;
        }
        
        @keyframes shimmer {
            100% { left: 100%; }
        }
        
        .back-btn i {
            margin-right: 12px;
            font-size: 1.3rem;
        }
        
        .btn-container {
            text-align: center;
            margin-top: 40px;
        }
        
        /* Thông báo lỗi */
        .error-message {
            background: linear-gradient(135deg, rgba(255, 65, 108, 0.15) 0%, rgba(255, 75, 43, 0.1) 100%);
            border-radius: 18px;
            padding: 30px;
            text-align: center;
            border-left: 5px solid #ff416c;
            color: #c53030;
            font-size: 1.2rem;
            font-weight: 500;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }
        
        .error-message a {
            color: #6a3093;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: rgba(106, 48, 147, 0.1);
            border-radius: 10px;
            border: 1px solid rgba(106, 48, 147, 0.2);
        }
        
        .error-message a:hover {
            color: white;
            background: rgba(106, 48, 147, 0.3);
        }
        
        /* HR */
        hr {
            border: none;
            height: 2px;
            background: linear-gradient(90deg, transparent, #6a3093, transparent);
            margin: 40px 0;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 40px;
            color: #718096;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        
        /* Hiệu ứng glow */
        .glow-effect {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            border-radius: 24px;
            box-shadow: 
                inset 0 0 60px rgba(106, 48, 147, 0.1),
                inset 0 0 80px rgba(160, 68, 255, 0.05);
            pointer-events: none;
            z-index: -1;
            transition: all 0.5s ease;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 40px 30px;
            }
            
            h1 {
                font-size: 2.2rem;
            }
            
            .section {
                padding: 25px;
            }
            
            .result-box {
                padding: 25px;
            }
            
            .sorted-marks {
                padding: 20px;
                font-size: 1.3rem;
            }
            
            .marks-display {
                font-size: 1.2rem;
                padding: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 35px 25px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            h2, h3 {
                padding-left: 0;
                flex-direction: column;
                align-items: flex-start;
            }
            
            h2::before, h3::before {
                position: static;
                margin-bottom: 10px;
            }
            
            .back-btn {
                width: 100%;
                padding: 16px;
            }
            
            .sorted-marks {
                font-size: 1.1rem;
                padding: 15px;
                letter-spacing: 1px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="light-effect">
        <div class="light-ray" style="top: 10%; left: 10%; animation-delay: 0s;"></div>
        <div class="light-ray" style="top: 60%; right: 15%; animation-delay: 2s;"></div>
        <div class="light-ray" style="bottom: 20%; left: 20%; animation-delay: 4s;"></div>
    </div>
    
    <div class="container">
        <div class="glow-effect"></div>
        
        <h1>KẾT QUẢ SẮP XẾP DANH SÁCH ĐIỂM SỐ</h1>

        <?php
        // LẤY DỮ LIỆU TỪ FORM VÀ XỬ LÝ
        $input_string = $_POST['marks_string'] ?? ''; // Chuỗi điểm số người dùng nhập
        $sort_type = $_POST['sort_type'] ?? 'none'; 
        
        $marks = [];
        $initial_marks = '';
        $isValidInput = true; // Cờ kiểm tra tính hợp lệ

        if (!empty($input_string)) {
            // 1. Chuyển chuỗi thành mảng số bằng explode()
            $string_array = explode(',', $input_string);
            
            foreach ($string_array as $item) {
                $trimmed_item = trim($item);
                if (is_numeric($trimmed_item)) {
                    // Chuyển thành số thực (float)
                    $marks[] = (float)$trimmed_item; 
                }
            }
            
            // Lưu chuỗi ban đầu đã được làm sạch để hiển thị
            $initial_marks = implode(', ', $marks); 
            
            if (empty($marks)) {
                // Input được cung cấp nhưng không có số hợp lệ
                $isValidInput = false;
            }
        } else {
            // Không có input (người dùng chưa nhập gì)
            $isValidInput = false;
        }

        // --- BẮT ĐẦU HIỂN THỊ KẾT QUẢ ---
        
        if ($isValidInput && $sort_type !== 'none') {
            // TRƯỜNG HỢP 1: Dữ liệu hợp lệ và đã chọn kiểu sắp xếp
            
            $result_text = "";
            $sort_function = "";
            
            // Hiển thị mảng nhập vào
            echo "<div class='section'>";
            echo "<h3><i class='fas fa-list-ol' style='margin-right: 10px;'></i> 1. DANH SÁCH ĐIỂM SỐ BAN ĐẦU</h3>";
            echo "<div class='marks-display'>" . $initial_marks . "</div>";
            echo "</div>";
            
            echo "<hr>";

            // Xử lý sắp xếp
            if ($sort_type === 'asc') {
                // Sắp xếp tăng dần (Ascending)
                sort($marks); 
                $result_text = "SẮP XẾP TĂNG DẦN";
                $sort_function = "sort()";
                $result_class = "asc-result";
                $title_class = "asc-title";
                $icon = "fas fa-sort-amount-up-alt";
                $icon_color = "#00b09b";
            } elseif ($sort_type === 'desc') {
                // Sắp xếp giảm dần (Descending)
                rsort($marks);
                $result_text = "SẮP XẾP GIẢM DẦN";
                $sort_function = "rsort()";
                $result_class = "desc-result";
                $title_class = "desc-title";
                $icon = "fas fa-sort-amount-down-alt";
                $icon_color = "#ff416c";
            }

            echo "<div class='section'>";
            echo "<h2><i class='fas fa-chart-bar' style='margin-right: 10px;'></i> 2. KẾT QUẢ SẮP XẾP</h2>";
            
            // Phần hiển thị kết quả sắp xếp
            echo "<div class='result-box $result_class'>";
            echo "<div class='result-title $title_class'>";
            echo "<i class='$icon' style='color: $icon_color;'></i>";
            echo "<span>KIỂU SẮP XẾP: $result_text</span>";
            echo "</div>";
            
            echo "<div class='function-info'>";
            echo "<div class='function-icon'>";
            echo "<i class='fas fa-code'></i>";
            echo "</div>";
            echo "<div class='function-text'>";
            echo "<h4>HÀM PHP ĐƯỢC SỬ DỤNG</h4>";
            echo "<p><span class='highlight'>$sort_function</span></p>";
            echo "</div>";
            echo "</div>";
            
            // Hiển thị mảng đã sắp xếp
            echo "<p style='color: #4a5568; margin: 20px 0 10px 0; font-weight: 600;'>Danh sách điểm số sau khi sắp xếp:</p>";
            echo "<div class='sorted-marks'>"; 
            echo implode(', ', $marks);
            echo "</div>";

            echo "</div>";
            
            // Visual comparison
            echo "<div style='margin-top: 30px; text-align: center;'>";
            echo "<p style='color: #718096; font-size: 1.1rem;'><i class='fas fa-arrow-right' style='margin: 0 10px; color: #6a3093;'></i> Điểm số đã được sắp xếp theo thứ tự từ " . ($sort_type === 'asc' ? 'THẤP đến CAO' : 'CAO đến THẤP') . " <i class='fas fa-arrow-left' style='margin: 0 10px; color: #6a3093;'></i></p>";
            echo "</div>";
            
            echo "</div>";
            
        } else {
            // TRƯỜNG HỢP 2: Lỗi dữ liệu hoặc chưa chọn
            $errorMessage = "Vui lòng nhập chuỗi điểm số cách nhau bằng dấu phẩy và chọn kiểu sắp xếp.";
            if (!$isValidInput && !empty($input_string)) {
                $errorMessage = "Chuỗi bạn nhập (<span style='font-weight: 700; color: #ff416c;'>".htmlspecialchars($input_string)."</span>) không chứa điểm số hợp lệ nào. Vui lòng kiểm tra lại.";
            }

            echo "<div class='error-message'>";
            echo "<p><i class='fas fa-exclamation-circle'></i> " . $errorMessage . "</p>";
            echo "<a href='Sapxep.php'><i class='fas fa-arrow-left'></i> Quay lại trang nhập liệu</a>";
            echo "</div>";
        }
        
        ?>
        
        <div class="btn-container">
            <a href="Sapxep.php" class="back-btn">
                <i class="fas fa-arrow-circle-left"></i> QUAY LẠI TRANG NHẬP LIỆU
            </a>
        </div>
        
        <div class="footer">
            Hệ thống sắp xếp dữ liệu © 2023 | Phiên bản 4.0
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hiệu ứng cho container
            const container = document.querySelector('.container');
            container.addEventListener('mouseenter', function() {
                this.querySelector('.glow-effect').style.boxShadow = 
                    'inset 0 0 80px rgba(106, 48, 147, 0.15), inset 0 0 100px rgba(160, 68, 255, 0.08)';
            });
            
            container.addEventListener('mouseleave', function() {
                this.querySelector('.glow-effect').style.boxShadow = 
                    'inset 0 0 60px rgba(106, 48, 147, 0.1), inset 0 0 80px rgba(160, 68, 255, 0.05)';
            });
            
            // Hiệu ứng cho các section
            const sections = document.querySelectorAll('.section');
            sections.forEach((section, index) => {
                section.style.animationDelay = `${index * 0.1}s`;
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    section.style.transition = 'all 0.5s ease';
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, 100 + index * 100);
            });
            
            // Hiệu ứng cho result box nếu có
            const resultBox = document.querySelector('.result-box');
            if (resultBox) {
                resultBox.style.opacity = '0';
                resultBox.style.transform = 'scale(0.9)';
                
                setTimeout(() => {
                    resultBox.style.transition = 'all 0.5s ease';
                    resultBox.style.opacity = '1';
                    resultBox.style.transform = 'scale(1)';
                }, 300);
            }
            
            // Hiệu ứng cho marks display
            const marksDisplay = document.querySelector('.marks-display');
            if (marksDisplay) {
                marksDisplay.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                marksDisplay.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(-3px)';
                });
            }
            
            // Hiệu ứng ánh sáng nền
            const lightRays = document.querySelectorAll('.light-ray');
            lightRays.forEach(ray => {
                ray.style.animationDuration = `${Math.random() * 10 + 5}s`;
            });
            
            // Hiệu ứng cho sorted marks
            const sortedMarks = document.querySelector('.sorted-marks');
            if (sortedMarks) {
                // Typewriter effect cho sorted marks
                const originalText = sortedMarks.textContent;
                sortedMarks.textContent = '';
                let i = 0;
                
                function typeWriter() {
                    if (i < originalText.length) {
                        sortedMarks.textContent += originalText.charAt(i);
                        i++;
                        setTimeout(typeWriter, 50);
                    }
                }
                
                // Chỉ chạy hiệu ứng typewriter nếu có kết quả
                if (originalText.trim().length > 0 && originalText !== ', ') {
                    setTimeout(typeWriter, 500);
                }
            }
        });
    </script>
</body>
</html>