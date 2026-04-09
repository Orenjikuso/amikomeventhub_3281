<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - AMIKOMEVENTHUB</title>
    <meta name="description" content="User Profile - AMIKOMEVENTHUB">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#7C3AED',
                        'primary-light': '#A78BFA',
                        accent: '#06B6D4',
                        'accent-light': '#67E8F9',
                    }
                }
            }
        }
    </script>

    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #7C3AED;
            --primary-light: #A78BFA;
            --primary-glow: rgba(124, 58, 237, 0.5);
            --accent: #06B6D4;
            --accent-light: #67E8F9;
            --accent-glow: rgba(6, 182, 212, 0.4);
            --surface-0: #030014;
            --surface-1: rgba(255, 255, 255, 0.04);
            --surface-2: rgba(255, 255, 255, 0.07);
            --border-subtle: rgba(255, 255, 255, 0.08);
            --border-medium: rgba(255, 255, 255, 0.14);
            --text-primary: #F8FAFC;
            --text-secondary: rgba(248, 250, 252, 0.60);
            --text-muted: rgba(248, 250, 252, 0.35);
            --radius-xl: 32px;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--surface-0);
            overflow-x: hidden;
            position: relative;
        }

        /* Aurora background layers */
        .aurora {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        .aurora-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.4;
            will-change: transform;
        }

        .aurora-blob:nth-child(1) {
            width: 700px; height: 700px;
            background: radial-gradient(circle, var(--primary-glow), transparent 70%);
            top: -20%; left: -10%;
            animation: auroraMove1 16s ease-in-out infinite alternate;
        }

        .aurora-blob:nth-child(2) {
            width: 600px; height: 600px;
            background: radial-gradient(circle, var(--accent-glow), transparent 70%);
            bottom: -25%; right: -10%;
            animation: auroraMove2 20s ease-in-out infinite alternate;
        }

        @keyframes auroraMove1 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-40px, 80px) scale(1.05); }
        }

        @keyframes auroraMove2 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(40px, -60px) scale(0.95); }
        }

        .noise-overlay {
            position: fixed; inset: 0; z-index: 1; opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' /%3E%3C/svg%3E");
            pointer-events: none;
        }

        .dot-grid {
            position: fixed; inset: 0; z-index: 1;
            background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
            mask-image: radial-gradient(ellipse 70% 60% at 50% 50%, black 20%, transparent 80%);
        }

        .stars {
            position: fixed; inset: 0; z-index: 2; pointer-events: none;
        }

        .star {
            position: absolute; width: 2px; height: 2px; background: white; border-radius: 50%;
            animation: starTwinkle var(--dur) ease-in-out infinite;
            animation-delay: var(--delay); opacity: 0;
        }

        @keyframes starTwinkle {
            0%, 100% { opacity: 0; transform: scale(0.5); }
            50% { opacity: var(--max-opacity); transform: scale(1); }
        }

        /* Glassmorphism card */
        .welcome-card {
            position: relative;
            width: 480px;
            max-width: 90vw;
            border-radius: var(--radius-xl);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            z-index: 10;
        }

        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        .card-glow-ring {
            position: absolute; inset: -1.5px; border-radius: var(--radius-xl); padding: 1.5px;
            background: conic-gradient(from 220deg, var(--primary), var(--accent), #F43F5E, #F59E0B, var(--primary));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor; mask-composite: exclude;
            animation: ringRotate 8s linear infinite; z-index: -1;
        }

        @keyframes ringRotate { to { filter: hue-rotate(360deg); } }

        .card-surface {
            position: relative;
            border-radius: var(--radius-xl);
            background: rgba(15, 10, 40, 0.92);
            backdrop-filter: blur(60px);
            -webkit-backdrop-filter: blur(60px);
            border: 1px solid var(--border-subtle);
            overflow: hidden;
            padding: 40px;
        }

        .card-surface::after {
            content: ''; position: absolute; inset: 0; border-radius: var(--radius-xl);
            background: radial-gradient(600px circle at var(--mouse-x, 50%) var(--mouse-y, 0%), rgba(124, 58, 237, 0.1), transparent 40%);
            pointer-events: none; opacity: 0; transition: opacity 0.5s ease;
        }

        .welcome-card:hover .card-surface::after { opacity: 1; }

        .brand-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem; font-weight: 700; letter-spacing: 0.2em;
            background: linear-gradient(135deg, #fff 0%, var(--primary-light) 50%, var(--accent-light) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            margin-bottom: 8px; text-align: center;
        }

        .info-card {
            background: var(--surface-1);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s ease;
            margin-bottom: 12px;
        }

        .info-card:hover {
            background: var(--surface-2);
            transform: translateX(5px);
            border-color: var(--border-medium);
        }

        .info-badge {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.15), rgba(6, 182, 212, 0.1));
            border: 1px solid rgba(124, 58, 237, 0.2);
            color: var(--primary-light);
        }

        .nav-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #4F46E5);
            color: white;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.5);
        }

        .btn-outline {
            background: var(--surface-1);
            border: 1px solid var(--border-subtle);
            color: var(--text-secondary);
        }

        .btn-outline:hover {
            border-color: var(--primary-light);
            color: white;
            background: var(--surface-2);
        }
    </style>
</head>
<body>
    <div class="aurora">
        <div class="aurora-blob"></div>
        <div class="aurora-blob"></div>
    </div>
    <div class="noise-overlay"></div>
    <div class="dot-grid"></div>
    <div class="stars" id="stars-container"></div>

    <div class="welcome-card" id="welcome-card">
        <div class="card-glow-ring"></div>
        <div class="card-surface">
            <header class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-tr from-primary to-accent rounded-3xl mx-auto flex items-center justify-center mb-4 shadow-xl shadow-primary/20 border border-white/10">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h1 class="brand-name">PROFILE SAYA</h1>
                <p class="text-xs tracking-[0.3em] text-white/40 uppercase font-medium">Informasi Akun</p>
            </header>

            <div class="space-y-4">
                <div class="info-card">
                    <div class="info-badge">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-white/40 uppercase tracking-wider font-bold">Nama Lengkap</p>
                        <p class="text-white font-medium">Muhammad Adam Siswantoro</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-badge" style="color: #06B6D4; border-color: rgba(6, 182, 212, 0.2);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-white/40 uppercase tracking-wider font-bold">Alamat Email</p>
                        <p class="text-white font-medium">admin@amikomeventhub.com</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-badge" style="color: #F59E0B; border-color: rgba(245, 158, 11, 0.2);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-white/40 uppercase tracking-wider font-bold">Status Keanggotaan</p>
                        <p class="text-amber-400 font-bold">Anggota Aktif</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col gap-2">
                <a href="/" class="nav-btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Kembali ke Beranda
                </a>
                <div class="grid grid-cols-2 gap-2">
                    <a href="/katalog" class="nav-btn btn-outline text-xs">Katalog</a>
                    <a href="/bantuan" class="nav-btn btn-outline text-xs">Bantuan</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Stars generation
        (function() {
            const container = document.getElementById('stars-container');
            const count = 40;
            for (let i = 0; i < count; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                star.style.left = Math.random() * 100 + '%';
                star.style.top = Math.random() * 100 + '%';
                star.style.setProperty('--dur', (3 + Math.random() * 6) + 's');
                star.style.setProperty('--delay', (Math.random() * 8) + 's');
                star.style.setProperty('--max-opacity', (0.2 + Math.random() * 0.5).toFixed(2));
                star.style.width = (1 + Math.random() * 2) + 'px';
                star.style.height = star.style.width;
                container.appendChild(star);
            }
        })();

        // Mouse Spotlight
        (function() {
            const card = document.querySelector('.card-surface');
            const welcomeCard = document.getElementById('welcome-card');
            welcomeCard.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width) * 100;
                const y = ((e.clientY - rect.top) / rect.height) * 100;
                card.style.setProperty('--mouse-x', x + '%');
                card.style.setProperty('--mouse-y', y + '%');
            });
        })();
    </script>
</body>
</html>