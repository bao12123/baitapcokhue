<!DOCTYPE html>
<html>
<head>
    <title>Upload Ảnh Có Kiểm Tra</title>
</head>
<body>

    <h2>Bài 6: Upload Ảnh & Kiểm Tra Định Dạng/Dung Lượng</h2>
    <p>Chỉ chấp nhận ảnh **JPG** hoặc **PNG** và dung lượng **dưới 2MB**.</p>
    
    <form action="image_handler.php" method="POST" enctype="multipart/form-data">
        <label for="image_file">Chọn Ảnh:</label>
        
        <input type="file" name="image_file" id="image_file" accept=".jpg, .jpeg, .png" required>
        
        <br><br>
        
        <input type="submit" value="Upload Ảnh">
    </form>

</body>
</html>