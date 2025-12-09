<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>formResult.php: Kết Quả Xử Lý Mảng</title>
    <style> 
        /* Reset và font chữ */
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
        .container {
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
            max-width: 900px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transform: perspective(1000px) rotateX(0deg);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .container:hover {
            transform: perspective(1000px) rotateX(2deg) translateY(-10px);
            box-shadow: 
                0 35px 60px rgba(0, 0, 0, 0.35),
                0 0 0 1px rgba(255, 255, 255, 0.2),
                inset 0 0 0 1px rgba(255, 255, 255, 0.15);
        }
        
        .container::before {
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
        h1 {
            color: transparent;
            background: linear-gradient(90deg, #FF416C, #FF4B2B);
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
            width: 150px;
            height: 4px;
            background: linear-gradient(90deg, #FF416C, #FF4B2B);
            border-radius: 2px;
        }
        
        /* Section */
        .section {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .section:hover {
            background: rgba(255, 255, 255, 0.12);
            transform: translateY(-5px);
            box-shadow: 0 18px 35px rgba(0, 0, 0, 0.3);
        }
        
        h3 {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1.5rem;
            margin-bottom: 20px;
            position: relative;
            padding-left: 30px;
            font-weight: 700;
        }
        
        h3::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background: linear-gradient(135deg, #FF416C, #FF4B2B);
            border-radius: 5px;
        }
        
        /* Hiển thị mảng */
        .array-display {
            background: rgba(0, 0, 0, 0.25);
            border-radius: 14px;
            padding: 25px;
            font-family: 'Courier New', monospace;
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            overflow-x: auto;
            border: 1px solid rgba(255, 255, 255, 0.15);
            line-height: 1.6;
            box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.2);
            margin-top: 15px;
        }
        
        .array-display pre {
            margin: 0;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        
        /* Bảng kết quả */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        
        th {
            background: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%);
            color: white;
            padding: 22px;
            text-align: left;
            font-weight: 700;
            font-size: 1.1rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            letter-spacing: 0.5px;
        }
        
        td {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        tr {
            background: rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }
        
        tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.03);
        }
        
        tr:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(8px);
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        /* Highlight */
        .highlight {
            background: linear-gradient(135deg, #FF416C, #FF4B2B);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 800;
            font-size: 1.2rem;
            padding: 8px 15px;
            border-radius: 8px;
            display: inline-block;
            background-color: rgba(255, 65, 108, 0.15);
            border-left: 3px solid #FF416C;
        }
        
        /* Thống kê nhanh */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .stat-item {
            background: rgba(255, 255, 255, 0.07);
            border-radius: 14px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #FF416C, #FF4B2B);
        }
        
        .stat-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            background: rgba(255, 255, 255, 0.1);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(255, 65, 108, 0.15), rgba(255, 75, 43, 0.15));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: #FF416C;
            font-size: 1.8rem;
        }
        
        .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(90deg, #FF416C, #FF4B2B);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 8px;
        }
        
        .stat-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            font-weight: 600;
        }
        
        /* Nút quay lại */
        .back-btn {
            background: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%);
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
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(255, 75, 43, 0.3);
            text-decoration: none;
            margin-top: 30px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        
        .back-btn::before {
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
            box-shadow: 0 15px 25px rgba(255, 75, 43, 0.4);
        }
        
        .back-btn:hover::before {
            animation: shimmer 1.5s infinite;
        }
        
        @keyframes shimmer {
            100% { left: 100%; }
        }
        
        .back-btn:active {
            transform: translateY(-2px);
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
            border-left: 5px solid #FF416C;
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            font-weight: 500;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }
        
        .error-message a {
            color: #FFD700;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: rgba(255, 215, 0, 0.15);
            border-radius: 10px;
            border: 1px solid rgba(255, 215, 0, 0.3);
        }
        
        .error-message a:hover {
            color: white;
            background: rgba(255, 215, 0, 0.25);
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 40px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 2;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
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
                inset 0 0 50px rgba(255, 65, 108, 0.1),
                inset 0 0 60px rgba(255, 75, 43, 0.05);
            pointer-events: none;
            z-index: -1;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 35px 30px;
            }
            
            h1 {
                font-size: 2.2rem;
            }
            
            .section {
                padding: 25px;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
            
            th, td {
                padding: 16px;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 30px 25px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .back-btn {
                width: 100%;
                padding: 16px;
            }
            
            .array-display {
                padding: 20px;
                font-size: 1rem;
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
    
    <div class="container">
        <div class="glow-effect"></div>
        
        <h1>KẾT QUẢ XỬ LÝ MẢNG</h1>

        <?php
        if (isset($_POST['number_string']) && !empty($_POST['number_string'])) {
            $input_string = $_POST['number_string'];
            
            // 2. Chuyển chuỗi thành mảng số bằng explode()
            $string_array = explode(',', $input_string);
            
            // Lọc, loại bỏ khoảng trắng và chuyển đổi sang số nguyên (để đảm bảo tính toán đúng)
            $number_array = [];
            foreach ($string_array as $item) {
                $trimmed_item = trim($item);
                if (is_numeric($trimmed_item)) {
                    $number_array[] = (int)$trimmed_item; 
                }
            }

            if (empty($number_array)) {
                echo "<div class='error-message'>";
                echo "<p><i class='fas fa-exclamation-triangle'></i> Lỗi: Không tìm thấy số hợp lệ nào trong chuỗi đã nhập.</p>";
                echo "<a href='form.php'><i class='fas fa-arrow-left'></i> Quay lại trang nhập liệu</a>";
                echo "</div>";
                exit;
            }

            // --- BẮT ĐẦU THỰC HIỆN CÁC YÊU CẦU ---
            
            // Tính toán tất cả các yêu cầu
            $sum = array_sum($number_array);               // Tính tổng
            $count = count($number_array);                 // Tính số lượng phần tử
            $max_value = max($number_array);               // Tìm phần tử lớn nhất
            $min_value = min($number_array);               // Tìm phần tử nhỏ nhất
            
            // In các phần tử chẵn
            $even_numbers = array_filter($number_array, function($number) {
                return $number % 2 == 0;
            });
            $even_output = empty($even_numbers) ? "Không có số chẵn" : implode(', ', $even_numbers);
            
            // Thống kê nhanh
            echo "<div class='stats-grid'>";
            echo "<div class='stat-item'>";
            echo "<div class='stat-icon'><i class='fas fa-calculator'></i></div>";
            echo "<div class='stat-value'>" . $sum . "</div>";
            echo "<div class='stat-label'>TỔNG CÁC SỐ</div>";
            echo "</div>";
            
            echo "<div class='stat-item'>";
            echo "<div class='stat-icon'><i class='fas fa-layer-group'></i></div>";
            echo "<div class='stat-value'>" . $count . "</div>";
            echo "<div class='stat-label'>SỐ LƯỢNG PHẦN TỬ</div>";
            echo "</div>";
            
            echo "<div class='stat-item'>";
            echo "<div class='stat-icon'><i class='fas fa-arrow-up'></i></div>";
            echo "<div class='stat-value'>" . $max_value . "</div>";
            echo "<div class='stat-label'>GIÁ TRỊ LỚN NHẤT</div>";
            echo "</div>";
            
            echo "<div class='stat-item'>";
            echo "<div class='stat-icon'><i class='fas fa-arrow-down'></i></div>";
            echo "<div class='stat-value'>" . $min_value . "</div>";
            echo "<div class='stat-label'>GIÁ TRỊ NHỎ NHẤT</div>";
            echo "</div>";
            echo "</div>";
            
            // 3. Thực hiện: In ra mảng vừa nhập
            echo "<div class='section'>";
            echo "<h3>1. MẢNG VỪA NHẬP (Sau khi explode và lọc)</h3>";
            echo "<div class='array-display'>"; 
            echo "<pre>"; 
            print_r($number_array); 
            echo "</pre>";
            echo "</div>";
            echo "</div>";
            
            // HIỂN THỊ KẾT QUẢ
            echo "<div class='section'>";
            echo "<h3>2. CÁC THAO TÁC TÍNH TOÁN VÀ HÀM PHP SỬ DỤNG</h3>";
            
            echo "<table>";
            echo "<tr><th style='width: 25%;'>YÊU CẦU</th><th style='width: 30%;'>HÀM PHP SỬ DỤNG</th><th>KẾT QUẢ</th></tr>";
            
            echo "<tr><td>Tính Tổng</td><td>array_sum()</td><td><span class='highlight'>" . $sum . "</span></td></tr>";
            echo "<tr><td>Tính Số lượng phần tử</td><td>count()</td><td><span class='highlight'>" . $count . "</span></td></tr>";
            echo "<tr><td>Tìm Phần tử lớn nhất</td><td>max()</td><td><span class='highlight'>" . $max_value . "</span></td></tr>";
            echo "<tr><td>Tìm Phần tử nhỏ nhất</td><td>min()</td><td><span class='highlight'>" . $min_value . "</span></td></tr>";
            echo "<tr><td>In Các phần tử chẵn</td><td>array_filter()</td><td><span class='highlight'>" . $even_output . "</span></td></tr>";

            echo "</table>";
            echo "</div>";

        } else {
            echo "<div class='error-message'>";
            echo "<p><i class='fas fa-exclamation-circle'></i> Lỗi: Dữ liệu chưa được gửi. Vui lòng nhập từ Form nhập liệu.</p>";
            echo "<a href='form.php'><i class='fas fa-arrow-left'></i> Quay lại trang nhập liệu</a>";
            echo "</div>";
        }
        ?>
        
        <div class="btn-container">
            <a href="form.php" class="back-btn">
                <i class="fas fa-arrow-circle-left"></i> QUAY LẠI TRANG NHẬP LIỆU
            </a>
        </div>
        
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
            
            // Hiệu ứng cho các hàng trong bảng
            const tableRows = document.querySelectorAll('table tr');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.style.opacity = '0';
                row.style.transform = 'translateX(-15px)';
                
                setTimeout(() => {
                    row.style.transition = 'all 0.5s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, 100 + index * 50);
            });
            
            // Hiệu ứng cho stat items
            const statItems = document.querySelectorAll('.stat-item');
            statItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.1}s`;
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    item.style.transition = 'all 0.5s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 200 + index * 100);
            });
            
            // Hiệu ứng hover cho container
            const container = document.querySelector('.container');
            container.addEventListener('mouseenter', function() {
                this.querySelector('.glow-effect').style.boxShadow = 
                    'inset 0 0 80px rgba(255, 65, 108, 0.15), inset 0 0 90px rgba(255, 75, 43, 0.1)';
            });
            
            container.addEventListener('mouseleave', function() {
                this.querySelector('.glow-effect').style.boxShadow = 
                    'inset 0 0 50px rgba(255, 65, 108, 0.1), inset 0 0 60px rgba(255, 75, 43, 0.05)';
            });
            
            // Hiệu ứng hover cho sections
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });
                
                section.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>