<?php
$content = file_get_contents("vdfile.txt");
 echo "<h3>Nội dung file: Hello Word</h3>";
echo nl2br($content) ; // đổi \n thành <br>
?>

<?php
// Cách 2: Đọc từng dòng bằng fgets()
$handle = fopen("vdfile.txt"
,
"r"); // mở file để đọc
echo "<h3>Đọc từng dòng:</h3>";
while (!feof($handle)) {
$line = fgets($handle);
echo $line .
"<br>";
}
fclose($handle); // đóng file
?>

<?php
// Cách 3: Đọc file thành mảng các dòng
$lines = file("vdfile.txt");
echo "<h3>Danh sách các dòng trong file:</h3>";
foreach ($lines as $index => $line) {
echo "Dòng "
. ($index + 1) .
": "
. $line .
"<br>";
}
?>

<?php
// ghi file
$filename = "note.txt";
$handle = fopen($filename, "a");
// Ghi nội dung vào file
fwrite($handle, "Dòng mới\n");
// Đóng file
fclose($handle); "<br>"; "<br>";
echo "Đã ghi 'Dòng mới' vào cuối file $filename thành công.";
?>
