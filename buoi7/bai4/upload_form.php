<!DOCTYPE html>
<html>
<head>
    <title>Upload File Đơn Giản</title>
</head>
<body>

    <h2>Bài 4: Upload File Đơn Giản</h2>
    
    <form action="upload_handler.php" method="POST" enctype="multipart/form-data">
        <label for="uploaded_file">Chọn 1 File:</label>
        
        <input type="file" name="uploaded_file" id="uploaded_file" required>
        
        <br><br>
        
        <input type="submit" value="Upload File">
    </form>

</body>
</html>