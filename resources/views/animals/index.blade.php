@extends('layouts.master')

@section('content')
  <div style="position: absolute; top: 110px; right: 1px; pointer-events: none;"><img style="width: 200px;height: auto" src="{{ asset('img/TrangTri/10.png') }}" alt=""></div>
<div class="container mt-5">
    <div class="row mb-4">
            <div class="border-start border-5 border-danger ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-danger text-uppercase">THÚ CƯNG</h6>
                <h1 class="display-5 text-uppercase mb-0">THƯ VIỆN THÚ CƯNG</h1>
            </div>
        </div>

 <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

        @forelse($animals as $animal)
            <div class="col">
               <div class="card h-100">
    <div style="width: 100%; height: 200px; display: flex; justify-content: center; align-items: center; overflow: hidden;">
        <img src="{{ asset('img/Animal/' . $animal->image) }}"
             class="card-img-top"
             alt="{{ $animal->name }}"
             style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    <div class="card-body text-center">
        <h5 class="card-title">
            <a href="{{ route('animals.show', ['animal_id' => $animal->animal_id]) }}">
                {{ $animal->name }}
            </a>
        </h5>
        <p class="text-danger">{{ $animal->breed }}</p>
        <p>{{ $animal->description }}</p>
    </div>
</div>

            </div>
        @empty
            <p class="text-center">Không có thú cưng nào.</p>
        @endforelse
    </div>
</div>
 <script>
        // Fireworks effect without background overlay
        function createFireworks() {
            const canvas = document.getElementById('canvas');
            const ctx = canvas.getContext('2d');

            // Set canvas to full window size
            function resizeCanvas() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }

            // Initial resize
            resizeCanvas();

            // Resize on window change
            window.addEventListener('resize', resizeCanvas);

            // Fireworks array
            const fireworks = [];
            const particles = [];

            // Colors for fireworks
            const colors = ['#FF5252', '#FFD740', '#64FFDA', '#448AFF', '#E040FB', '#69F0AE'];

            // Firework class
            class Firework {
                constructor(x, y, targetX, targetY) {
                    this.x = x;
                    this.y = y;
                    this.targetX = targetX;
                    this.targetY = targetY;
                    this.speed = 2;
                    this.angle = Math.atan2(targetY - y, targetX - x);
                    this.velocity = {
                        x: Math.cos(this.angle) * this.speed,
                        y: Math.sin(this.angle) * this.speed
                    };
                    this.brightness = 70;
                    this.alpha = 1;
                    this.color = colors[Math.floor(Math.random() * colors.length)];
                }

                update() {
                    this.x += this.velocity.x;
                    this.y += this.velocity.y;
                    this.alpha -= 0.01;

                    // Check if reached target
                    const distance = Math.sqrt(Math.pow(this.targetX - this.x, 2) + Math.pow(this.targetY - this.y, 2));
                    if (distance < 5 || this.alpha <= 0) {
                        this.explode();
                        return true;
                    }
                    return false;
                }

                explode() {
                    const particleCount = 100;
                    for (let i = 0; i < particleCount; i++) {
                        particles.push(new Particle(this.x, this.y, this.color));
                    }
                }

                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, 2, 0, Math.PI * 2);
                    ctx.fillStyle = this.color;
                    ctx.fill();

                    ctx.beginPath();
                    ctx.arc(this.x, this.y, 4, 0, Math.PI * 2);
                    ctx.strokeStyle = `rgba(255, 255, 255, ${this.alpha})`;
                    ctx.stroke();
                }
            }

            // Particle class
            class Particle {
                constructor(x, y, color) {
                    this.x = x;
                    this.y = y;
                    this.color = color;
                    this.speed = Math.random() * 3 + 1;
                    this.angle = Math.random() * Math.PI * 2;
                    this.velocity = {
                        x: Math.cos(this.angle) * this.speed,
                        y: Math.sin(this.angle) * this.speed
                    };
                    this.alpha = 1;
                    this.decay = Math.random() * 0.03 + 0.01;
                    this.size = Math.random() * 3 + 1;
                }

                update() {
                    this.x += this.velocity.x;
                    this.y += this.velocity.y;
                    this.velocity.y += 0.05; // Gravity
                    this.alpha -= this.decay;

                    if (this.alpha <= 0) {
                        return true;
                    }
                    return false;
                }

                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(${hexToRgb(this.color)}, ${this.alpha})`;
                    ctx.fill();
                }
            }

            // Convert hex to rgb
            function hexToRgb(hex) {
                // Remove # if present
                hex = hex.replace('#', '');

                // Parse the rgb values
                const r = parseInt(hex.substring(0, 2), 16);
                const g = parseInt(hex.substring(2, 4), 16);
                const b = parseInt(hex.substring(4, 6), 16);

                return `${r}, ${g}, ${b}`;
            }

            // Create a firework at random position
            function createRandomFirework() {
                const startX = Math.random() * canvas.width;
                const startY = canvas.height;
                const targetX = Math.random() * canvas.width;
                const targetY = Math.random() * (canvas.height * 0.6); // Only target top 60% of screen

                fireworks.push(new Firework(startX, startY, targetX, targetY));
            }

            // Create a firework at mouse click position
            canvas.addEventListener('click', (e) => {
                const rect = canvas.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                // Launch from bottom to click position
                const startX = x;
                const startY = canvas.height;
                fireworks.push(new Firework(startX, startY, x, y));
            });

            // Animation loop
            function animate() {
                requestAnimationFrame(animate);

                // Clear the canvas completely without any background overlay
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                // Random chance to create a firework
                if (Math.random() < 0.05) {
                    createRandomFirework();
                }

                // Update and draw fireworks
                for (let i = fireworks.length - 1; i >= 0; i--) {
                    if (fireworks[i].update()) {
                        fireworks.splice(i, 1);
                    } else {
                        fireworks[i].draw();
                    }
                }

                // Update and draw particles
                for (let i = particles.length - 1; i >= 0; i--) {
                    if (particles[i].update()) {
                        particles.splice(i, 1);
                    } else {
                        particles[i].draw();
                    }
                }
            }

            // Start animation
            animate();
        }

        // Start fireworks when DOM is fully loaded
        document.addEventListener('DOMContentLoaded', createFireworks);
    </script>
@endsection
