@extends('layouts.app')

@section('content')
<div class="lucky-draw-page">
    <div class="lucky-draw-container">
        <div class="confetti-container" id="confetti-container"></div>

        <div class="lucky-draw-header">
            <h1 class="lucky-title">🎁 Bốc Thăm Trúng Thưởng 🎉</h1>
        </div>

        <div class="wheel-container">
            <div class="wheel-outer">
                <div class="wheel-inner" id="wheel">
                    <div class="wheel-section" style="--i:1; --clr:#ff0000;">
                        <span>Quà 1</span>
                    </div>
                    <div class="wheel-section" style="--i:2; --clr:#ffff00;">
                        <span>Quà 2</span>
                    </div>
                    <div class="wheel-section" style="--i:3; --clr:#00ff00;">
                        <span>Quà 3</span>
                    </div>
                    <div class="wheel-section" style="--i:4; --clr:#00ffff;">
                        <span>Quà 4</span>
                    </div>
                    <div class="wheel-section" style="--i:5; --clr:#0000ff;">
                        <span>Quà 5</span>
                    </div>
                    <div class="wheel-section" style="--i:6; --clr:#ff00ff;">
                        <span>Quà 6</span>
                    </div>
                    <div class="wheel-section" style="--i:7; --clr:#ff8800;">
                        <span>Quà 7</span>
                    </div>
                    <div class="wheel-section" style="--i:8; --clr:#00ff88;">
                        <span>Quà 8</span>
                    </div>
                </div>
                <div class="spin-btn" id="spinBtn">
                    <div class="arrow"></div>
                    <span>QUAY</span>
                </div>
            </div>
        </div>

        <div id="result" class="result-container mt-4">
            <!-- Kết quả sẽ hiển thị ở đây -->
        </div>

        <div class="buttons-container">
            <a href="{{ url('/') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Quay Lại Trang Chủ
            </a>
        </div>
    </div>
</div>

<style>
    .lucky-draw-page {
        background: linear-gradient(135deg, #f5f7fa 0%, #e6eef8 100%);
        min-height: 100vh;
        padding: 50px 0;
        overflow: hidden;
        position: relative;
    }

    .lucky-draw-page::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle cx="10" cy="10" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="30" cy="10" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="50" cy="10" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="70" cy="10" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="90" cy="10" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="10" cy="30" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="30" cy="30" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="50" cy="30" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="70" cy="30" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="90" cy="30" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="10" cy="50" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="30" cy="50" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="50" cy="50" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="70" cy="50" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="90" cy="50" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="10" cy="70" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="30" cy="70" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="50" cy="70" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="70" cy="70" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="90" cy="70" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="10" cy="90" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="30" cy="90" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="50" cy="90" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="70" cy="90" r="2" fill="%23dc3545" opacity="0.1"/><circle cx="90" cy="90" r="2" fill="%23dc3545" opacity="0.1"/></svg>');
        opacity: 0.5;
        z-index: 0;
    }

    .lucky-draw-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 30px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .lucky-draw-header {
        margin-bottom: 30px;
        position: relative;
    }

    .lucky-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 800;
        font-size: 2.5rem;
        background: linear-gradient(45deg, #dc3545, #fd7e14);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-transform: uppercase;
        margin-bottom: 20px;
        animation: titleGlow 2s infinite alternate;
        position: relative;
        display: inline-block;
    }

    @keyframes titleGlow {
        0% {
            text-shadow: 0 0 10px rgba(220, 53, 69, 0.3);
        }
        100% {
            text-shadow: 0 0 20px rgba(220, 53, 69, 0.7), 0 0 30px rgba(220, 53, 69, 0.5);
        }
    }

    .lucky-title::before,
    .lucky-title::after {
        content: "★";
        position: absolute;
        font-size: 1.5rem;
        color: #ffc107;
        animation: starTwinkle 1s infinite alternate;
    }

    .lucky-title::before {
        left: -30px;
        top: 50%;
        transform: translateY(-50%);
    }

    .lucky-title::after {
        right: -30px;
        top: 50%;
        transform: translateY(-50%);
    }

    @keyframes starTwinkle {
        0% {
            opacity: 0.3;
            transform: translateY(-50%) scale(0.8);
        }
        100% {
            opacity: 1;
            transform: translateY(-50%) scale(1.2);
        }
    }

    .wheel-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 40px auto;
        perspective: 1000px;
    }

    .wheel-outer {
        position: relative;
        width: 350px;
        height: 350px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        box-shadow: 0 0 0 15px #dc3545,
                    0 0 0 16px #fff,
                    0 0 20px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
        transform-style: preserve-3d;
    }

    .wheel-outer:hover {
        transform: scale(1.02) rotateY(5deg);
    }

    .wheel-inner {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: #fff;
        overflow: hidden;
        transition: transform 6s cubic-bezier(0.25, 0.1, 0.25, 1);
        box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .wheel-section {
        position: absolute;
        width: 50%;
        height: 50%;
        transform-origin: bottom right;
        clip-path: polygon(0 0, 100% 0, 100% 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        transform: rotate(calc(45deg * var(--i)));
        background: var(--clr);
    }

    .wheel-section span {
        position: relative;
        transform: rotate(calc(-45deg * var(--i) - 45deg));
        font-weight: bold;
        font-size: 1rem;
        color: #fff;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    .spin-btn {
        position: absolute;
        width: 80px;
        height: 80px;
        background: #dc3545;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-weight: bold;
        letter-spacing: 1px;
        font-size: 20px;
        cursor: pointer;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        z-index: 10;
        transition: all 0.3s;
        text-transform: uppercase;
        border: 4px solid white;
        user-select: none;
    }

    .spin-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 5px 20px rgba(220, 53, 69, 0.4);
    }

    .spin-btn:active {
        transform: scale(0.95);
    }

    .spin-btn::before {
        content: "";
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        border-bottom: 25px solid #dc3545;
    }

    .result-container {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 15px;
        margin-top: 30px;
        min-height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        color: #28a745;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transition: all 0.5s ease;
        transform: translateY(20px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .result-container.show {
        opacity: 1;
        transform: translateY(0);
    }

    .buttons-container {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    .back-btn {
        padding: 12px 25px;
        background: linear-gradient(135deg, #6c757d, #495057);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .back-btn i {
        margin-right: 8px;
    }

    .back-btn:hover {
        background: linear-gradient(135deg, #495057, #343a40);
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        color: #fff;
        text-decoration: none;
    }

    .back-btn:active {
        transform: translateY(-1px);
    }

    .confetti-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
    }

    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        opacity: 0;
    }

    .winning-animation {
        animation: winningPulse 1s ease-in-out;
    }

    @keyframes winningPulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    @media (max-width: 768px) {
        .lucky-title {
            font-size: 1.8rem;
        }

        .wheel-outer {
            width: 280px;
            height: 280px;
        }

        .wheel-section span {
            font-size: 0.8rem;
        }

        .spin-btn {
            width: 60px;
            height: 60px;
            font-size: 16px;
        }

        .spin-btn::before {
            top: -15px;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 20px solid #dc3545;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const wheel = document.getElementById('wheel');
    const spinBtn = document.getElementById('spinBtn');
    const resultContainer = document.getElementById('result');
    let isSpinning = false;

    // Create confetti elements
    function createConfetti() {
        const confettiContainer = document.getElementById('confetti-container');
        confettiContainer.innerHTML = '';

        const colors = ['#dc3545', '#ffc107', '#28a745', '#17a2b8', '#6610f2', '#e83e8c'];

        for (let i = 0; i < 100; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.top = '-10px';
            confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
            confettiContainer.appendChild(confetti);
        }
    }

    // Animation for showering confetti
    function showConfetti() {
        const confettis = document.querySelectorAll('.confetti');

        confettis.forEach((confetti, index) => {
            const delay = Math.random() * 2;
            const duration = Math.random() * 3 + 2;

            confetti.style.animation = `fall ${duration}s ease-in ${delay}s forwards, sway ${duration / 2}s ease-in-out ${delay}s infinite alternate`;
        });
    }

    // Add CSS animation for confetti
    const styleSheet = document.createElement('style');
    styleSheet.textContent = `
        @keyframes fall {
            0% {
                top: -10px;
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            80% {
                opacity: 1;
            }
            100% {
                top: 100%;
                opacity: 0;
            }
        }

        @keyframes sway {
            0% {
                transform: translateX(-10px) rotate(0deg);
            }
            100% {
                transform: translateX(10px) rotate(360deg);
            }
        }
    `;
    document.head.appendChild(styleSheet);

    createConfetti();

    spinBtn.addEventListener('click', function() {
        if (isSpinning) return;

        isSpinning = true;
        resultContainer.innerHTML = '';
        resultContainer.classList.remove('show');

        // Random degree between 360*5 and 360*10 (5-10 full rotations) + random segment
        const randomDegree = (5 + Math.random() * 5) * 360 + Math.floor(Math.random() * 8) * 45;

        wheel.style.transform = `rotate(${randomDegree}deg)`;

        // Add spin sound effect
        const spinSound = new Audio('/sounds/spin.mp3'); // Provide a path to your sound effect
        spinSound.volume = 0.5;
        spinSound.play().catch(e => console.log('Cannot play sound:', e));

        setTimeout(function() {
            fetch("{{ route('spin.wheel') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                setTimeout(() => {
                    resultContainer.classList.add('show');

                    if (data.success) {
                        resultContainer.innerHTML = `<div class="winning-result">🎉 ${data.message} 🎉</div>`;
                        resultContainer.style.color = '#28a745';
                        resultContainer.classList.add('winning-animation');

                        // Play winning sound
                        const winSound = new Audio('/sounds/win.mp3'); // Provide a path to your sound effect
                        winSound.volume = 0.5;
                        winSound.play().catch(e => console.log('Cannot play sound:', e));

                        showConfetti();
                    } else {
                        resultContainer.innerHTML = `<div>😭 ${data.message}</div>`;
                        resultContainer.style.color = '#dc3545';

                        // Play lose sound
                        const loseSound = new Audio('/sounds/lose.mp3'); // Provide a path to your sound effect
                        loseSound.volume = 0.3;
                        loseSound.play().catch(e => console.log('Cannot play sound:', e));
                    }

                    isSpinning = false;
                }, 5500); // Wait for wheel to stop spinning
            })
            .catch(error => {
                resultContainer.innerHTML = 'Có lỗi xảy ra. Vui lòng thử lại!';
                resultContainer.style.color = '#dc3545';
                resultContainer.classList.add('show');
                isSpinning = false;
            });
        }, 500);
    });
});
</script>
@endsection
