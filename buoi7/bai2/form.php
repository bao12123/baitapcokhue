<!DOCTYPE html>
<html>
<head>
    <title>Ghi Nội Dung Vào File</title>
</head>
<body>

    <h2>Bài 2: Ghi nội dung vào file (note.txt)</h2>
    
    <form action="process.php" method="POST" enctype="multipart/form-data">
        <label for="input_content">Nhập nội dung cần ghi vào file:</label><br>
        
        <textarea name="input_content" id="input_content" rows="5" cols="50" required></textarea>
        
        <br><br>
        
        <input type="submit" name="submit_btn" value="Ghi Nội Dung (Nối Tiếp)">
    </form>

</body>
</html>