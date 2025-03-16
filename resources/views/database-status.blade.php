<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm tra kết nối Database</title>
</head>
<body>
    <h1>{{ $status }}</h1>

    @if(count($tables) > 0)
        <h2>Các bảng trong database:</h2>
        <ul>
            @foreach ($tables as $table)
                <li>{{ reset($table) }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
