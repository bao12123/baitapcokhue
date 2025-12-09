<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>webResult.php: Kết Quả Thêm/Xóa Mảng</title>
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
        
        /* Hiệu ứng nền cyberpunk */
        .cyber-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1;
            background: 
                radial-gradient(circle at 10% 20%, rgba(0, 255, 234, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(255, 51, 102, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(0, 255, 136, 0.05) 0%, transparent 60%);
        }
        
        /* Grid nền */
        .cyber-grid {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 255, 234, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 234, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: grid-move 20s linear infinite;
            z-index: 0;
        }
        
        @keyframes grid-move {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }
        
        /* Container chính */
        .container {
            background: rgba(10, 15, 30, 0.9);
            border-radius: 20px;
            padding: 50px 45px;
            box-shadow: 
                0 0 40px rgba(0, 123, 255, 0.4),
                0 0 80px rgba(0, 123, 255, 0.2),
                inset 0 0 20px rgba(255, 255, 255, 0.05);
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 900px;
            border: 1px solid rgba(0, 255, 234, 0.3);
            overflow: hidden;
            transition: all 0.5s ease;
        }
        
        .container:hover {
            box-shadow: 
                0 0 50px rgba(0, 123, 255, 0.6),
                0 0 100px rgba(0, 123, 255, 0.3),
                inset 0 0 30px rgba(255, 255, 255, 0.08);
        }
        
        .container::before {
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
        h1 {
            color: #00ffea;
            font-size: 2.8rem;
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
        
        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 300px;
            height: 3px;
            background: linear-gradient(90deg, 
                transparent, 
                #00ffea, 
                #007bff, 
                #00ffea, 
                transparent);
            border-radius: 2px;
            box-shadow: 0 0 15px #00ffea;
        }
        
        /* Thông báo kết quả */
        h2 {
            background: rgba(20, 30, 50, 0.7);
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
            border-left: 4px solid;
            font-size: 1.5rem;
            line-height: 1.6;
            animation: message-glow 3s infinite alternate;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }
        
        @keyframes message-glow {
            0% { box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); }
            100% { box-shadow: 0 0 30px rgba(0, 255, 234, 0.2); }
        }
        
        /* Màu cho thông báo */
        .success-message {
            border-left-color: #00ff88;
            color: #00ff88;
            text-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
        }
        
        .delete-message {
            border-left-color: #ff3366;
            color: #ff3366;
            text-shadow: 0 0 10px rgba(255, 51, 102, 0.5);
        }
        
        .error-message {
            border-left-color: #ff3300;
            color: #ff3300;
            text-shadow: 0 0 10px rgba(255, 51, 0, 0.5);
        }
        
        .info-message {
            border-left-color: #00aaff;
            color: #00aaff;
            text-shadow: 0 0 10px rgba(0, 170, 255, 0.5);
        }
        
        /* Tiêu đề phụ */
        h3 {
            color: #00ffea;
            font-size: 1.8rem;
            margin: 40px 0 25px 0;
            padding-left: 20px;
            border-left: 4px solid #00ffea;
            text-shadow: 0 0 10px rgba(0, 255, 234, 0.5);
            letter-spacing: 1px;
        }
        
        /* Bảng kết quả */
        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            margin: 30px 0;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 
                0 0 30px rgba(0, 255, 234, 0.3),
                0 10px 30px rgba(0, 0, 0, 0.4);
            border: 2px solid rgba(0, 255, 234, 0.3);
        }
        
        th {
            background: linear-gradient(135deg, #0066cc 0%, #0099ff 100%);
            color: #001122;
            padding: 25px;
            text-align: center;
            font-weight: 800;
            font-size: 1.3rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-bottom: 3px solid #00ffea;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        td {
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid rgba(0, 255, 234, 0.2);
            background: rgba(20, 30, 50, 0.7);
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }
        
        tr:hover td {
            background: rgba(30, 45, 70, 0.9);
            transform: scale(1.02);
            box-shadow: 0 0 15px rgba(0, 255, 234, 0.2);
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        /* Highlight */
        .highlight {
            color: #00ffea;
            font-weight: 800;
            font-size: 1.3rem;
            text-shadow: 
                0 0 10px #00ffea,
                0 0 20px #00ffea;
            padding: 5px 10px;
            background: rgba(0, 255, 234, 0.1);
            border-radius: 5px;
            border: 1px solid rgba(0, 255, 234, 0.3);
        }
        
        /* Màu sắc trong bảng */
        .index-cell {
            color: #ffcc00;
            font-weight: 800;
            text-shadow: 0 0 10px #ffcc00;
        }
        
        .color-cell {
            color: #ff66cc;
            font-weight: 700;
            text-shadow: 0 0 10px #ff66cc;
        }
        
        /* Note box */
        .note-box {
            background: rgba(20, 40, 60, 0.7);
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
            border-left: 4px solid #00ff88;
            border-right: 4px solid #00ff88;
            box-shadow: 
                0 0 25px rgba(0, 255, 136, 0.3),
                inset 0 0 15px rgba(0, 255, 136, 0.1);
        }
        
        .note-title {
            color: #00ff88;
            font-size: 1.3rem;
            margin-bottom: 15px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: 1px;
        }
        
        .note-text {
            color: #a0e0ff;
            font-size: 1.1rem;
            line-height: 1.6;
            letter-spacing: 0.5px;
        }
        
        /* Nút quay lại */
        .back-btn {
            background: linear-gradient(135deg, #0099ff 0%, #00ccff 100%);
            color: #001122;
            border: none;
            padding: 20px 50px;
            font-size: 1.3rem;
            font-weight: 800;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            box-shadow: 
                0 0 25px rgba(0, 153, 255, 0.5),
                0 8px 20px rgba(0, 0, 0, 0.4);
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            font-family: 'Orbitron', monospace;
            text-align: center;
        }
        
        .back-btn::before {
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
        
        .back-btn:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 
                0 0 35px rgba(0, 153, 255, 0.7),
                0 12px 25px rgba(0, 0, 0, 0.5);
        }
        
        .back-btn:hover::before {
            animation: shimmer 1s infinite;
        }
        
        @keyframes shimmer {
            100% { left: 100%; }
        }
        
        .back-btn:active {
            transform: translateY(-4px) scale(1.02);
        }
        
        .back-btn i {
            margin-right: 15px;
            font-size: 1.4rem;
        }
        
        .btn-container {
            text-align: center;
            margin-top: 40px;
        }
        
        /* Hiệu ứng màu sắc */
        .color-display {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 20px 0;
            justify-content: center;
        }
        
        .color-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            border-radius: 10px;
            background: rgba(30, 40, 70, 0.7);
            border: 2px solid;
            transition: all 0.3s ease;
            min-width: 120px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }
        
        .color-item:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 0 25px;
        }
        
        .color-index {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 10px;
            color: #00ffea;
        }
        
        .color-name {
            font-size: 1.2rem;
            font-weight: 700;
        }
        
        /* HR */
        hr {
            border: none;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent, 
                #00ffea, 
                #007bff, 
                #00ffea, 
                transparent);
            margin: 40px 0;
            border-radius: 2px;
            box-shadow: 0 0 10px #00ffea;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 40px 30px;
            }
            
            h1 {
                font-size: 2.2rem;
            }
            
            h2 {
                font-size: 1.3rem;
                padding: 20px;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
            
            th, td {
                padding: 18px;
                font-size: 1.1rem;
            }
            
            .color-display {
                flex-direction: column;
                align-items: center;
            }
            
            .color-item {
                width: 100%;
                max-width: 300px;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            h3 {
                font-size: 1.4rem;
            }
            
            th, td {
                padding: 15px;
                font-size: 1rem;
            }
            
            .back-btn {
                width: 100%;
                padding: 18px;
                font-size: 1.1rem;
            }
        }
    </style>
    <!-- Font Awesome và Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Hiệu ứng nền -->
    <div class="cyber-bg"></div>
    <div class="cyber-grid"></div>
    
    <div class="container">
        <h1>KẾT QUẢ THAO TÁC MẢNG (THÊM / XÓA)</h1>

        <?php
        // Khởi tạo mảng màu theo ví dụ của bạn: 0:đỏ, 1:vàng, 2:xanh, 3:xanh lá, 4:đen, 5:hồng
        $colors = ["đỏ", "vàng", "xanh", "xanh lá", "đen", "hồng"];
        
        $action_type = $_POST['action_type'] ?? 'none';
        $message = "";
        $message_class = "info-message";

        // --- XỬ LÝ THÊM/XÓA ---
        if ($action_type === 'Thêm Màu' && !empty($_POST['new_color'])) {
            $new_color = strtolower(trim($_POST['new_color']));
            $colors[] = $new_color; // Thêm vào cuối mảng
            $message = "<i class='fas fa-plus-circle'></i> THAO TÁC THÊM THÀNH CÔNG: <span class='highlight'>" . htmlspecialchars($new_color) . "</span>";
            $message_class = "success-message";
            
        } elseif ($action_type === 'Xóa Vị Trí' && isset($_POST['delete_index']) && $_POST['delete_index'] !== '') {
            $delete_index = (int)$_POST['delete_index'];
            
            if (isset($colors[$delete_index])) {
                $deleted_color = $colors[$delete_index];
                
                // 1. XÓA phần tử
                unset($colors[$delete_index]); 
                
                // 2. DỒN INDEX: Đảm bảo các phần tử sau đẩy lên bằng array_values()
                $colors = array_values($colors); 
                
                $message = "<i class='fas fa-minus-circle'></i> THAO TÁC XÓA THÀNH CÔNG. Đã dồn index. Màu bị xóa: <span class='highlight'>" . htmlspecialchars($deleted_color) . "</span> (vị trí cũ: $delete_index)";
                $message_class = "delete-message";
            } else {
                $message = "<i class='fas fa-exclamation-triangle'></i> LỖI: Vị trí xóa (<span class='highlight'>$delete_index</span>) không hợp lệ.";
                $message_class = "error-message";
            }

        } else {
            $message = "<i class='fas fa-info-circle'></i> CHỜ THAO TÁC. Vui lòng chọn Thêm hoặc Xóa từ Form.";
            $message_class = "info-message";
        }
        
        // --- HIỂN THỊ KẾT QUẢ CUỐI CÙNG (CÓ BẢNG INDEX) ---

        echo "<h2 class='$message_class'>" . $message . "</h2>";
        
        echo "<h3><i class='fas fa-palette'></i> DANH SÁCH MÀU HIỆN TẠI VÀ VỊ TRÍ INDEX:</h3>";

        if (!empty($colors)) {
            // Hiển thị dạng bảng
            echo "<table>";
            echo "<tr><th>VỊ TRÍ (INDEX)</th><th>MÀU SẮC</th></tr>";
            
            // Duyệt mảng để hiển thị index và giá trị
            foreach ($colors as $key => $value) {
                echo "<tr>";
                echo "<td class='index-cell'><span class='highlight'>$key</span></td>";
                echo "<td class='color-cell'>" . htmlspecialchars($value) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            // Hiển thị dạng visual
            echo "<div class='color-display'>";
            foreach ($colors as $key => $value) {
                $border_color = "";
                switch(strtolower($value)) {
                    case 'đỏ': $border_color = "#ff0000"; break;
                    case 'vàng': $border_color = "#ffcc00"; break;
                    case 'xanh': $border_color = "#0066ff"; break;
                    case 'xanh lá': $border_color = "#00ff00"; break;
                    case 'đen': $border_color = "#000000"; break;
                    case 'hồng': $border_color = "#ff66cc"; break;
                    default: $border_color = "#00ffea";
                }
                
                echo "<div class='color-item' style='border-color: $border_color; box-shadow: 0 0 15px $border_color;'>";
                echo "<div class='color-index'>$key</div>";
                echo "<div class='color-name' style='color: $border_color;'>" . htmlspecialchars($value) . "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<h2 class='error-message'><i class='fas fa-exclamation-circle'></i> MẢNG HIỆN ĐANG TRỐNG!</h2>";
        }

        ?>
        <hr>
        <div class="note-box">
            <div class="note-title">
                <i class="fas fa-code"></i> GHI CHÚ VỀ VIỆC DỒN INDEX
            </div>
            <div class="note-text">
                Hàm <span class="highlight">array_values()</span> đã đảm bảo sau khi xóa, tất cả các phần tử sau đó đều được gán lại chỉ mục (index) liên tục, bắt đầu từ 0. 
                <br>Ví dụ: Nếu xóa phần tử ở vị trí 2, các phần tử từ vị trí 3 trở đi sẽ được dồn lên thành vị trí 2, 3, ...
            </div>
        </div>
        
        <div class="btn-container">
            <a href="web.php" class="back-btn">
                <i class="fas fa-arrow-circle-left"></i> QUAY LẠI FORM NHẬP LIỆU
            </a>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hiệu ứng scanline cho container
            const container = document.querySelector('.container');
            
            // Tạo hiệu ứng random glitch
            setInterval(() => {
                if (Math.random() > 0.7) {
                    container.style.boxShadow = 
                        `0 0 60px rgba(${Math.random() * 255}, ${Math.random() * 255}, 255, 0.5),
                         0 0 120px rgba(0, 123, 255, 0.4),
                         inset 0 0 25px rgba(255, 255, 255, 0.1)`;
                    
                    setTimeout(() => {
                        container.style.boxShadow = 
                            '0 0 40px rgba(0, 123, 255, 0.4), 0 0 80px rgba(0, 123, 255, 0.2), inset 0 0 20px rgba(255, 255, 255, 0.05)';
                    }, 150);
                }
            }, 3000);
            
            // Hiệu ứng cho các hàng trong bảng
            const tableRows = document.querySelectorAll('table tr');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.1}s`;
                row.style.opacity = '0';
                row.style.transform = 'translateX(-20px)';
                
                setTimeout(() => {
                    row.style.transition = 'all 0.5s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, 100 + index * 100);
            });
            
            // Hiệu ứng cho các màu sắc
            const colorItems = document.querySelectorAll('.color-item');
            colorItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.15}s`;
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px) scale(0.9)';
                
                setTimeout(() => {
                    item.style.transition = 'all 0.5s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0) scale(1)';
                }, 300 + index * 150);
            });
            
            // Hiệu ứng pulse cho thông báo
            const messageBox = document.querySelector('h2');
            if (messageBox) {
                setInterval(() => {
                    const currentClass = messageBox.className;
                    if (currentClass.includes('success-message')) {
                        messageBox.style.boxShadow = 
                            `0 0 ${25 + Math.random() * 15}px rgba(0, 255, 136, 0.4)`;
                    } else if (currentClass.includes('delete-message')) {
                        messageBox.style.boxShadow = 
                            `0 0 ${25 + Math.random() * 15}px rgba(255, 51, 102, 0.4)`;
                    } else if (currentClass.includes('error-message')) {
                        messageBox.style.boxShadow = 
                            `0 0 ${25 + Math.random() * 15}px rgba(255, 51, 0, 0.4)`;
                    } else {
                        messageBox.style.boxShadow = 
                            `0 0 ${25 + Math.random() * 15}px rgba(0, 170, 255, 0.4)`;
                    }
                }, 1000);
            }
            
            // Hiệu ứng cho nút
            const backBtn = document.querySelector('.back-btn');
            if (backBtn) {
                setInterval(() => {
                    backBtn.style.boxShadow = 
                        `0 0 ${30 + Math.random() * 10}px rgba(0, 153, 255, 0.6),
                         0 8px 20px rgba(0, 0, 0, 0.4)`;
                }, 1500);
            }
        });
    </script>
</body>
</html>