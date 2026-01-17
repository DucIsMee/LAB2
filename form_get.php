<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm - Form GET</title>
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
        input[type="text"] {
            padding: 8px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            background-color: #e7f3fe;
            border-left: 4px solid #2196F3;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tìm Kiếm</h2>
        <form method="GET">
            <label for="keyword">Từ khóa:</label><br><br>
            <input type="text" id="keyword" name="keyword" placeholder="Nhập từ khóa tìm kiếm" required>
            <button type="submit">Tìm Kiếm</button>
        </form>

        <?php
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $keyword = htmlspecialchars($_GET['keyword']);
            echo '<div class="result">';
            echo 'Bạn đang tìm kiếm từ khóa: <strong>' . $keyword . '</strong>';
            echo '</div>';
            echo '<p><strong>URL hiện tại:</strong> ' . htmlspecialchars($_SERVER['REQUEST_URI']) . '</p>';
        }
        ?>
    </div>
</body>
</html>
