<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
        }
        .container {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e7f3fe;
        }
        .actions {
            text-align: center;
        }
        .btn {
            padding: 6px 12px;
            margin: 0 5px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            font-size: 14px;
        }
        .btn-edit {
            background-color: #2196F3;
            color: white;
        }
        .btn-edit:hover {
            background-color: #0b7dda;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
        }
        .btn-delete:hover {
            background-color: #da190b;
        }
        .btn-add {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .btn-add:hover {
            background-color: #45a049;
        }
        .error {
            padding: 10px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            border-radius: 4px;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Danh Sách Sinh Viên</h2>
        
        <a href="add_student.php" class="btn-add">+ Thêm Sinh Viên</a>

        <?php
        try {
            // Kết nối DB
            include 'db_connect.php';
            
            // Viết câu lệnh SELECT
            $sql = "SELECT * FROM students";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            // Lấy dữ liệu về mảng sử dụng fetchAll
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($students) > 0) {
                // Hiển thị bảng HTML
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>STT</th>';
                echo '<th>Họ Tên</th>';
                echo '<th>Mã SV</th>';
                echo '<th>Email</th>';
                echo '<th class="actions">Hành Động</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                
                // Dùng vòng lặp foreach để đổ dữ liệu
                $count = 1;
                foreach ($students as $student) {
                    echo '<tr>';
                    echo '<td>' . $count . '</td>';
                    echo '<td>' . htmlspecialchars($student['fullname']) . '</td>';
                    echo '<td>' . htmlspecialchars($student['student_code']) . '</td>';
                    echo '<td>' . htmlspecialchars($student['email']) . '</td>';
                    echo '<td class="actions">';
                    echo '<a href="#" class="btn btn-edit">Sửa</a>';
                    echo '<a href="#" class="btn btn-delete" onclick="return confirm(\'Bạn có chắc muốn xóa?\')">Xóa</a>';
                    echo '</td>';
                    echo '</tr>';
                    $count++;
                }
                
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<div class="no-data">Không có sinh viên nào trong hệ thống.</div>';
            }
        } catch (Exception $e) {
            echo '<div class="error">Lỗi: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
        ?>
    </div>
</body>
</html>
