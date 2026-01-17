<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .form-container {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        input[type="text"],
        input[type="email"] {
            padding: 8px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        .success {
            margin-top: 20px;
            padding: 10px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            border-radius: 4px;
        }
        .error {
            margin-top: 20px;
            padding: 10px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Thêm Sinh Viên</h2>
        <form method="POST">
            <label for="fullname">Họ Tên:</label>
            <input type="text" id="fullname" name="fullname" placeholder="Nhập họ tên sinh viên" required>

            <label for="student_code">Mã SV:</label>
            <input type="text" id="student_code" name="student_code" placeholder="Nhập mã sinh viên" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Nhập email" required>

            <button type="submit">Thêm Mới</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Nhúng file kết nối database
                include 'db_connect.php';
                
                // Lấy dữ liệu từ $_POST
                $fullname = $_POST['fullname'] ?? '';
                $student_code = $_POST['student_code'] ?? '';
                $email = $_POST['email'] ?? '';
                
                // Kiểm tra dữ liệu không được rỗng
                if (empty($fullname) || empty($student_code) || empty($email)) {
                    echo '<div class="error">Vui lòng điền đầy đủ thông tin!</div>';
                } else {
                    // Viết câu lệnh INSERT sử dụng Prepared Statement
                    $sql = "INSERT INTO students (fullname, student_code, email) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    
                    // Thực thi câu lệnh
                    $stmt->execute([$fullname, $student_code, $email]);
                    
                    // Thông báo thành công
                    echo '<div class="success">✓ Thêm sinh viên thành công!</div>';
                }
            } catch (Exception $e) {
                echo '<div class="error">Lỗi: ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
        }
        ?>
    </div>
</body>
</html>
