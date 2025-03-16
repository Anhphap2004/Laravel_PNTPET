<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        /* Hiệu ứng lấp lánh nền */
        .sparkles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 0;
        }

        .sparkle {
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px 2px rgba(255, 255, 255, 0.8);
            animation: sparkle-animation 3s linear infinite;
        }

        @keyframes sparkle-animation {
            0% {
                opacity: 0;
                transform: scale(0.5);
            }

            50% {
                opacity: 1;
                transform: scale(1);
            }

            100% {
                opacity: 0;
                transform: scale(0.5);
            }
        }

        .container {
            position: relative;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
            padding: 30px;
            backdrop-filter: blur(10px);
            z-index: 1;
            overflow: hidden;
            animation: container-glow 3s infinite alternate;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        @keyframes container-glow {
            0% {
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            }

            100% {
                box-shadow: 0 15px 40px rgba(118, 75, 162, 0.6), 0 0 20px rgba(255, 255, 255, 0.8);
            }
        }

        /* Thêm hiệu ứng gradient lấp lánh cho container */
        .container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 10%, transparent 70%);
            animation: rotate-gradient 10s linear infinite;
            z-index: -1;
        }

        @keyframes rotate-gradient {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Hình dạng con mèo */
        .cat-shape {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 0;
        }

        .cat-ear-left,
        .cat-ear-right {
            position: absolute;
            width: 0;
            height: 0;
            border-left: 40px solid transparent;
            border-right: 40px solid transparent;
            border-bottom: 60px solid #ffc7d6;
            top: -30px;
            animation: ear-wiggle 3s ease-in-out infinite alternate;
        }

        @keyframes ear-wiggle {
            0% {
                transform: rotate(-15deg);
            }

            50% {
                transform: rotate(-10deg);
            }

            100% {
                transform: rotate(-18deg);
            }
        }

        .cat-ear-left {
            left: 20%;
            transform: rotate(-15deg);
        }

        .cat-ear-right {
            right: 20%;
            transform: rotate(15deg);
            animation: ear-wiggle-right 4s ease-in-out infinite alternate;
        }

        @keyframes ear-wiggle-right {
            0% {
                transform: rotate(15deg);
            }

            50% {
                transform: rotate(10deg);
            }

            100% {
                transform: rotate(18deg);
            }
        }

        .cat-tail {
            position: absolute;
            width: 100px;
            height: 20px;
            background-color: #ffc7d6;
            border-radius: 20px;
            bottom: -10px;
            right: -50px;
            transform-origin: left center;
            animation: tail-wag 4s ease-in-out infinite;
        }

        @keyframes tail-wag {
            0% {
                transform: rotate(-20deg);
            }

            50% {
                transform: rotate(-10deg);
            }

            100% {
                transform: rotate(-30deg);
            }
        }

        .cat-paw1,
        .cat-paw2 {
            position: absolute;
            width: 50px;
            height: 30px;
            background-color: #ffc7d6;
            border-radius: 50%;
            bottom: -15px;
            animation: paw-move 2s ease-in-out infinite alternate;
        }

        @keyframes paw-move {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-5px);
            }
        }

        .cat-paw1 {
            left: 15%;
            animation-delay: 0.5s;
        }

        .cat-paw2 {
            left: 30%;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .logo h1 {
            color: #333;
            font-size: 28px;
            font-weight: 700;
            position: relative;
            display: inline-block;
            animation: text-glow 2s infinite alternate;
        }

        @keyframes text-glow {
            0% {
                text-shadow: 0 0 5px rgba(118, 75, 162, 0.5);
            }

            100% {
                text-shadow: 0 0 15px rgba(118, 75, 162, 0.8), 0 0 30px rgba(118, 75, 162, 0.4);
            }
        }

        .logo h1::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #764ba2, transparent);
            animation: line-animation 3s linear infinite;
        }

        @keyframes line-animation {
            0% {
                width: 0;
                left: 0;
            }

            50% {
                width: 100%;
            }

            100% {
                width: 0;
                left: 100%;
            }
        }

        .logo span {
            display: block;
            color: #764ba2;
            font-size: 16px;
            margin-top: 5px;
            opacity: 0;
            transform: translateY(10px);
            animation: fade-in 1s forwards 0.5s;
        }

        @keyframes fade-in {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container {
            display: flex;
            gap: 30px;
        }

        .form-column {
            flex: 1;
            opacity: 0;
            transform: translateX(-20px);
            animation: slide-in 0.8s forwards;
        }

        .form-column:nth-child(2) {
            transform: translateX(20px);
            animation-delay: 0.3s;
        }

        @keyframes slide-in {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #555;
            margin-bottom: 5px;
            font-weight: 500;
            font-size: 14px;
            transform: translateY(5px);
            opacity: 0;
            animation: label-appear 0.5s forwards;
        }

        @keyframes label-appear {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .form-group:nth-child(2) label {
            animation-delay: 0.1s;
        }

        .form-group:nth-child(3) label {
            animation-delay: 0.2s;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-group input:focus {
            border-color: #764ba2;
            box-shadow: 0 0 15px rgba(118, 75, 162, 0.4);
            outline: none;
            background: white;
        }

        /* Hiệu ứng khi input được focus */
        .form-group input:focus+.input-glow {
            opacity: 1;
        }

        .input-glow {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(118, 75, 162, 0.6);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 33px;
            color: #aaa;
            cursor: pointer;
            font-size: 14px;
            z-index: 2;
            transition: all 0.3s;
        }

        .password-toggle:hover {
            color: #764ba2;
            transform: scale(1.1);
        }

        .button-group {
            display: flex;
            margin-top: 20px;
            gap: 10px;
            opacity: 0;
            transform: translateY(20px);
            animation: buttons-appear 0.8s forwards 0.8s;
        }

        @keyframes buttons-appear {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 10%, transparent 40%);
            transition: opacity 0.5s;
            opacity: 0;
        }

        .btn:hover::after {
            opacity: 1;
            animation: btn-sparkle 2s linear infinite;
        }

        @keyframes btn-sparkle {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .btn-primary {
            background: linear-gradient(135deg, #764ba2, #667eea);
            color: white;
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #854fb8, #7687eb);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(118, 75, 162, 0.5);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #f5f5f5, #e6e6e6);
            color: #555;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #ffffff, #f0f0f0);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            color: #666;
            font-size: 14px;
            opacity: 0;
            animation: fade-up 1s forwards 1s;
        }

        @keyframes fade-up {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer a {
            color: #764ba2;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: all 0.3s;
        }

        .footer a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #764ba2, #667eea);
            transition: width 0.3s;
        }

        .footer a:hover {
            text-shadow: 0 0 5px rgba(118, 75, 162, 0.5);
        }

        .footer a:hover::after {
            width: 100%;
        }

        /* Mặt mèo */
        .cat-face {
            position: absolute;
            top: -80px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 80px;
            background-color: #ffc7d6;
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 2;
            animation: cat-face-bob 3s ease-in-out infinite;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        @keyframes cat-face-bob {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(-10px);
            }
        }

        .cat-eyes {
            display: flex;
            justify-content: space-around;
            width: 80%;
        }

        .cat-eye {
            width: 15px;
            height: 20px;
            background-color: white;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            animation: blink 4s infinite;
        }

        @keyframes blink {

            0%,
            95%,
            100% {
                transform: scaleY(1);
            }

            97% {
                transform: scaleY(0.1);
            }
        }

        .cat-eye:after {
            content: '';
            position: absolute;
            width: 8px;
            height: 15px;
            background-color: black;
            border-radius: 50%;
            top: 2px;
            left: 3px;
            animation: eye-move 5s ease-in-out infinite;
        }

        @keyframes eye-move {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-2px);
            }

            75% {
                transform: translateX(2px);
            }
        }

        .cat-nose {
            width: 10px;
            height: 5px;
            background-color: #ff758f;
            border-radius: 50%;
            margin-top: 10px;
        }

        .cat-whiskers {
            display: flex;
            justify-content: space-around;
            width: 120px;
            margin-top: 5px;
        }

        .whisker {
            width: 25px;
            height: 1px;
            background-color: #555;
            animation: whisker-twitch 6s ease-in-out infinite;
            transform-origin: center left;
        }

        .whisker:nth-child(1) {
            animation-delay: 0.5s;
        }

        .whisker:nth-child(3) {
            animation-delay: 1s;
        }

        @keyframes whisker-twitch {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(5deg);
            }

            75% {
                transform: rotate(-5deg);
            }
        }

        @media (max-width: 768px) {
            .form-container {
                flex-direction: column;
                gap: 10px;
            }

            .cat-ear-left,
            .cat-ear-right,
            .cat-tail,
            .cat-paw1,
            .cat-paw2,
            .cat-face {
                display: none;
            }

            .container {
                padding: 20px;
                max-width: 500px;
            }
        }
    </style>
</head>

<body>
    <!-- Hiệu ứng lấp lánh nền -->
    <div class="sparkles" id="sparkles"></div>

    <div class="container">
        <!-- Hình dạng con mèo -->
        <div class="cat-shape">
            <div class="cat-ear-left"></div>
            <div class="cat-ear-right"></div>
            <div class="cat-tail"></div>
            <div class="cat-paw1"></div>
            <div class="cat-paw2"></div>
        </div>

        <!-- Mặt mèo -->
        <div class="cat-face">
            <div class="cat-eyes">
                <div class="cat-eye"></div>
                <div class="cat-eye"></div>
            </div>
            <div class="cat-nose"></div>
            <div class="cat-whiskers">
                <div class="whisker"></div>
                <div class="whisker"></div>
                <div class="whisker"></div>
            </div>
        </div>

        <div class="logo">
            <h1>PNTET</h1>
            <span>Tạo tài khoản mới</span>
        </div>

        <form action="{{ route('register.submit') }}" method="POST" id="registerForm">
             @csrf 
            <div class="form-container">
                <div class="form-column">
                    <div class="form-group">
                        <label for="full_Name">Họ và tên</label>
                        <input type="text" id="full_Name" name="full_name" required placeholder="Nhập họ và tên của bạn">
                        <div class="input-glow"></div>
                    </div>

                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" required placeholder="Chọn tên đăng nhập">
                        <div class="input-glow"></div>
                    </div>

                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" id="password" name="password" required placeholder="Tạo mật khẩu">
                        <span class="password-toggle" onclick="togglePassword('password')">👁️</span>
                        <div class="input-glow"></div>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <label for="email">Địa chỉ email</label>
                        <input type="email" id="email" name="email" required placeholder="example@email.com">
                        <div class="input-glow"></div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="tel" id="phone" name="phone" required placeholder="Nhập số điện thoại">
                        <div class="input-glow"></div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Xác nhận mật khẩu</label>
                        <input type="password" id="confirmPassword" name="confirm_password" required placeholder="Nhập lại mật khẩu">
                        <span class="password-toggle" onclick="togglePassword('confirmPassword')">👁️</span>
                        <div class="input-glow"></div>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Đăng Ký</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Trang Chủ</button>
            </div>
        </form>

        <div class="footer">
            <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
        </div>

    </div>

    <script>
        // Tạo hiệu ứng sparkle
        function createSparkles() {
            const sparklesContainer = document.getElementById('sparkles');
            const sparkleCount = 50;

            for (let i = 0; i < sparkleCount; i++) {
                const sparkle = document.createElement('div');
                sparkle.classList.add('sparkle');

                // Vị trí ngẫu nhiên
                const left = Math.random() * 100;
                const top = Math.random() * 100;

                // Kích thước ngẫu nhiên
                const size = Math.random() * 5 + 2;

                // Delay animation
                const delay = Math.random() * 3;

                sparkle.style.left = `${left}%`;
                sparkle.style.top = `${top}%`;
                sparkle.style.width = `${size}px`;
                sparkle.style.height = `${size}px`;
                sparkle.style.animationDelay = `${delay}s`;

                sparklesContainer.appendChild(sparkle);
            }
        }

        // Hàm toggle password
        function togglePassword(id) {
            const passwordInput = document.getElementById(id);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }

        // Validation mật khẩu
        document.getElementById("registerForm").addEventListener("submit", function(e) {
            e.preventDefault(); // Ngăn chặn form gửi đi ngay lập tức

            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Mật khẩu xác nhận không khớp!");
                return;
            }

            // Thêm hiệu ứng khi submit
            const btn = document.querySelector('.btn-primary');
            btn.innerHTML = "Đang xử lý...";
            btn.style.opacity = '0.8';

            setTimeout(() => {
                // Nếu hợp lệ, submit form
                this.submit();
            }, 800);
        });

        // Tạo hiệu ứng sparkle khi trang load
        window.addEventListener('load', createSparkles);

        // Thêm hiệu ứng input focus
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.classList.add('input-focus');
            });

            input.addEventListener('blur', function() {
                this.parentNode.classList.remove('input-focus');
            });
        });
    </script>
</body>

</html>
