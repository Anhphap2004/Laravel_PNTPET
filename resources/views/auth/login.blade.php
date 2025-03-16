<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đăng Nhập Đẹp Mắt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(45deg, #ff7eb3, #a191ff, #7bffc0, #52c7ff);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            overflow: hidden;
            position: relative;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            position: relative;
            z-index: 10;
            width: 400px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1),
                0 0 15px rgba(255, 255, 255, 0.5),
                0 0 30px rgba(148, 107, 230, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.5);
            overflow: hidden;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.5), transparent);
            transform: skewX(-20deg);
            animation: shine 6s infinite;
        }

        @keyframes shine {
            0% {
                left: -100%;
            }

            20%,
            100% {
                left: 100%;
            }
        }

        h2 {
            color: #7353e8;
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 30px;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.8), 0 0 10px rgba(115, 83, 232, 0.4);
            animation: colorChange 5s infinite alternate;
        }

        @keyframes colorChange {
            0% {
                color: #7353e8;
            }

            33% {
                color: #ff5e8f;
            }

            66% {
                color: #3a7bd5;
            }

            100% {
                color: #53b88b;
            }
        }

        .input-box {
            position: relative;
            width: 100%;
            margin-bottom: 30px;
            transition: 0.5s;
        }

        .input-box:hover {
            transform: scale(1.02);
        }

        .input-box input {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.6);
            outline: none;
            border: 1px solid rgba(158, 189, 237, 0.5);
            border-radius: 10px;
            font-size: 1em;
            color: #333;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05), 0 0 10px rgba(115, 83, 232, 0.1);
            transition: 0.5s;
        }

        .input-box input:focus {
            background: rgba(255, 255, 255, 0.8);
            border-color: #7353e8;
            box-shadow: 0 0 15px rgba(115, 83, 232, 0.4);
        }

        .input-box span {
            position: absolute;
            left: 20px;
            top: 15px;
            font-size: 1em;
            pointer-events: none;
            color: #6d6d6d;
            transition: 0.5s;
        }

        .input-box input:valid~span,
        .input-box input:focus~span {
            transform: translateY(-32px);
            font-size: 0.8em;
            color: #7353e8;
            opacity: 0.9;
            font-weight: 600;
        }

        .button {
            position: relative;
            width: 100%;
            padding: 15px 20px;
            background: linear-gradient(45deg, #7353e8, #ff5e8f);
            border: none;
            border-radius: 10px;
            font-size: 1em;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1), 0 0 10px rgba(115, 83, 232, 0.3);
            transition: 0.5s;
            overflow: hidden;
            animation: buttonGlow 3s infinite alternate;
        }

        @keyframes buttonGlow {
            0% {
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1), 0 0 10px rgba(115, 83, 232, 0.3);
            }

            100% {
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1), 0 0 20px rgba(255, 94, 143, 0.6);
            }
        }

        .button:hover {
            transform: translateY(-3px) scale(1.02);
            background: linear-gradient(45deg, #8467f0, #ff75a0);
        }

        .button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.5), transparent);
            transform: skewX(-20deg);
            animation: shine 3s infinite;
        }

        .register {
            text-align: center;
            margin-top: 15px;
        }

        .register a {
            color: #7353e8;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            position: relative;
        }

        .register a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: linear-gradient(45deg, #7353e8, #ff5e8f);
            bottom: -2px;
            left: 0;
            transition: 0.3s;
        }

        .register a:hover {
            text-shadow: 0 0 5px rgba(115, 83, 232, 0.5);
        }

        .register a:hover::after {
            width: 100%;
        }

        /* Floating animals */
        .animal {
            position: absolute;
            opacity: 0.7;
            z-index: 1;
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.8));
            transition: 0.5s;
        }

        .animal:hover {
            transform: scale(1.1);
            opacity: 0.9;
            filter: drop-shadow(0 0 12px rgba(255, 255, 255, 1));
        }

        .animal img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
        }

        .animal1 {
            width: 120px;
            height: 120px;
            top: 10%;
            left: 10%;
            animation: floatSpecial 8s ease-in-out infinite;
        }

        .animal2 {
            width: 80px;
            height: 80px;
            top: 30%;
            right: 15%;
            animation: floatSpecial 10s ease-in-out infinite 1s;
        }

        .animal3 {
            width: 100px;
            height: 100px;
            bottom: 15%;
            left: 20%;
            animation: floatSpecial 9s ease-in-out infinite 2s;
        }

        .animal4 {
            width: 90px;
            height: 90px;
            bottom: 30%;
            right: 20%;
            animation: floatSpecial 12s ease-in-out infinite 3s;
        }

        .animal5 {
            width: 110px;
            height: 110px;
            top: 50%;
            left: 5%;
            animation: floatSpecial 11s ease-in-out infinite 4s;
        }

        .animal6 {
            width: 85px;
            height: 85px;
            bottom: 10%;
            right: 30%;
            animation: floatSpecial 13s ease-in-out infinite 2.5s;
        }

        @keyframes floatSpecial {
            0% {
                transform: translatey(0px) rotate(0deg) scale(1);
                filter: hue-rotate(0deg);
            }

            25% {
                transform: translatey(-15px) rotate(5deg) scale(1.05);
            }

            50% {
                transform: translatey(-25px) rotate(10deg) scale(1.1);
                filter: hue-rotate(30deg);
            }

            75% {
                transform: translatey(-15px) rotate(5deg) scale(1.05);
            }

            100% {
                transform: translatey(0px) rotate(0deg) scale(1);
                filter: hue-rotate(0deg);
            }
        }

        /* Enhanced sparkles */
        .sparkle-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .sparkle {
            position: absolute;
            background-color: white;
            border-radius: 50%;
            top: -10px;
            pointer-events: none;
            z-index: 2;
            animation: fallingSparkle linear forwards;
        }

        .sparkle1 {
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 8px 2px rgba(255, 255, 255, 0.8), 0 0 12px 6px rgba(255, 187, 100, 0.5);
        }

        .sparkle2 {
            width: 6px;
            height: 6px;
            background: rgba(255, 223, 100, 0.8);
            box-shadow: 0 0 8px 2px rgba(255, 223, 100, 0.8), 0 0 12px 6px rgba(255, 223, 100, 0.5);
        }

        .sparkle3 {
            width: 3px;
            height: 3px;
            background: rgba(100, 237, 255, 0.8);
            box-shadow: 0 0 8px 2px rgba(100, 237, 255, 0.8), 0 0 12px 6px rgba(100, 237, 255, 0.5);
        }

        .sparkle4 {
            width: 5px;
            height: 5px;
            background: rgba(240, 125, 255, 0.8);
            box-shadow: 0 0 8px 2px rgba(240, 125, 255, 0.8), 0 0 12px 6px rgba(240, 125, 255, 0.5);
        }

        .star {
            position: absolute;
            width: 10px;
            height: 10px;
            top: -10px;
            background: transparent;
            pointer-events: none;
            z-index: 2;
            animation: fallingStar linear forwards;
        }

        .star::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: white;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
            box-shadow: 0 0 8px 2px rgba(255, 255, 255, 0.8), 0 0 12px 6px rgba(255, 223, 100, 0.5);
        }

        @keyframes fallingSparkle {
            0% {
                transform: translateY(0) rotate(0deg) scale(0);
                opacity: 0;
            }

            10% {
                transform: translateY(10vh) rotate(45deg) scale(1);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh) rotate(360deg) scale(0.5);
                opacity: 0;
            }
        }

        @keyframes fallingStar {
            0% {
                transform: translateY(0) rotate(0deg) scale(0);
                opacity: 0;
            }

            10% {
                transform: translateY(10vh) rotate(45deg) scale(1);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh) rotate(180deg) scale(0.5);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Floating animals -->
    <div class="animal animal1">
        <img src="https://cdn.pixabay.com/photo/2024/10/16/16/14/cat-9125207_1280.jpg" alt="Floating cat" />
    </div>
    <div class="animal animal2">
        <img src="https://cdn.pixabay.com/photo/2014/12/10/05/50/english-bulldog-562723_1280.jpg" alt="Floating dog" />
    </div>
    <div class="animal animal3">
        <img src="https://cdn.pixabay.com/photo/2017/08/01/09/04/dog-2563759_1280.jpg" alt="Floating bird" />
    </div>
    <div class="animal animal4">
        <img src="https://cdn.pixabay.com/photo/2023/01/21/22/53/cat-7735258_960_720.jpg" alt="Floating fox" />
    </div>
    <div class="animal animal5">
        <img src="https://cdn.pixabay.com/photo/2014/11/03/17/40/leopard-515509_1280.jpg" alt="Floating panda" />
    </div>
    <div class="animal animal6">
        <img src="https://cdn.pixabay.com/photo/2017/12/11/15/34/lion-3012515_1280.jpg" alt="Floating bunny" />
    </div>
   <div class="container">
    <h2>Đăng Nhập</h2>


    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="input-box">
            <input type="text" name="username" required>
            <span>Tên đăng nhập</span>
        </div>

        <div class="input-box">
            <input type="password" name="password" required>
            <span>Mật khẩu</span>
        </div>

        <button type="submit" class="button">Đăng Nhập</button>
        @if ($errors->has('login'))
            <div class="alert alert-danger" style="padding: 10px; border-radius: 5px; font-size: 14px;">
                <div style="color: #ff5e8f">{{ $errors->first('login') }}</div>
            </div>
        @endif
    </form>

    <div class="register">
        <p>Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a></p>
    </div>
</div>

    <!-- Sparkle container -->
    <div class="sparkle-container" id="sparkleContainer"></div>

    <!-- Add sparkles -->
    <script>
        // Create falling sparkles continuously
        function createSparkles() {
            const container = document.getElementById('sparkleContainer');

            // Create new sparkle every 100ms
            setInterval(() => {
                // Random position
                const posX = Math.random() * window.innerWidth;

                // Random sparkle type
                const sparkleTypes = ['sparkle1', 'sparkle2', 'sparkle3', 'sparkle4', 'star'];
                const randomType = sparkleTypes[Math.floor(Math.random() * sparkleTypes.length)];

                // Create element
                const sparkle = document.createElement('div');

                if (randomType === 'star') {
                    sparkle.classList.add('star');
                } else {
                    sparkle.classList.add('sparkle', randomType);
                }

                // Position
                sparkle.style.left = posX + 'px';

                // Random animation duration (3-8 seconds)
                const duration = 3 + Math.random() * 5;
                sparkle.style.animationDuration = duration + 's';

                // Append to container
                container.appendChild(sparkle);

                // Remove after animation completes
                setTimeout(() => {
                    sparkle.remove();
                }, duration * 1000);

            }, 100);
        }

        // Generate initial sparkles
        window.onload = () => {
            createSparkles();
        };
    </script>
</body>

</html>
