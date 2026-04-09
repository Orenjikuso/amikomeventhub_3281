<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda - AMIKOMEVENTHUB</title>
    
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
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #7C3AED; --primary-light: #A78BFA; --primary-glow: rgba(124, 58, 237, 0.5);
            --accent: #06B6D4; --accent-light: #67E8F9; --accent-glow: rgba(6, 182, 212, 0.4);
            --surface-0: #030014; 
            --radius-xl: 32px;
        }

        body {
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            font-family: 'Inter', -apple-system, sans-serif; background: var(--surface-0);
            overflow-x: hidden; position: relative; padding: 40px 20px;
        }

        /* Subtle Aurora Background for Consistency */
        .aurora { position: fixed; inset: 0; z-index: 0; overflow: hidden; }
        .aurora-blob { position: absolute; border-radius: 50%; filter: blur(120px); opacity: 0.2; }
        .aurora-blob:nth-child(1) { width: 700px; height: 700px; background: radial-gradient(circle, var(--primary-glow), transparent 70%); top: -20%; left: -10%; animation: auroraMove1 20s ease-in-out infinite alternate; }
        .aurora-blob:nth-child(2) { width: 600px; height: 600px; background: radial-gradient(circle, var(--accent-glow), transparent 70%); bottom: -25%; right: -10%; animation: auroraMove2 25s ease-in-out infinite alternate; }
        @keyframes auroraMove1 { to { transform: translate(-40px, 80px) scale(1.05); } }
        @keyframes auroraMove2 { to { transform: translate(40px, -60px) scale(0.95); } }

        .noise-overlay { position: fixed; inset: 0; z-index: 1; opacity: 0.02; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' /%3E%3C/svg%3E"); pointer-events: none; }
        .dot-grid { position: fixed; inset: 0; z-index: 1; background-image: radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px); background-size: 40px 40px; pointer-events: none; mask-image: radial-gradient(ellipse 70% 60% at 50% 50%, black 20%, transparent 80%); }
        
        .stars { position: fixed; inset: 0; z-index: 2; pointer-events: none; }
        .star { position: absolute; width: 1.5px; height: 1.5px; background: white; border-radius: 50%; animation: starTwinkle var(--dur) ease-in-out infinite; animation-delay: var(--delay); opacity: 0; }
        @keyframes starTwinkle { 0%, 100% { opacity: 0; transform: scale(0.5); } 50% { opacity: var(--max-opacity); transform: scale(1); } }

        /* Minimalist Card */
        .welcome-card { position: relative; width: 420px; max-width: 100%; border-radius: var(--radius-xl); opacity: 0; transform: translateY(20px); animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; z-index: 10; }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

        /* Very subtle ring */
        .card-glow-ring { position: absolute; inset: -1px; border-radius: var(--radius-xl); padding: 1px; background: conic-gradient(from 220deg, rgba(255,255,255,0.05), rgba(255,255,255,0.15), rgba(255,255,255,0.05)); -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); -webkit-mask-composite: xor; mask-composite: exclude; animation: ringRotate 15s linear infinite; z-index: -1; }
        @keyframes ringRotate { to { filter: hue-rotate(360deg); } }

        .card-surface { position: relative; border-radius: var(--radius-xl); background: rgba(10, 10, 15, 0.5); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.05); overflow: hidden; padding: 48px; }

        .brand-name { font-family: 'Space Grotesk', sans-serif; font-size: 1.6rem; font-weight: 700; letter-spacing: 0.15em; color: white; margin-bottom: 4px; text-align: center; }

        .nav-btn { display: flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: 12px; font-weight: 500; font-size: 0.85rem; transition: all 0.3s ease; }
        
        /* Minimalist UI Buttons */
        .btn-ghost { background: transparent; border: 1px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); width: 100%; }
        .btn-ghost:hover { background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.2); }
        
        .btn-primary-min { background: white; color: black; font-weight: 600; width: 100%; border: 1px solid white; }
        .btn-primary-min:hover { background: transparent; color: white; }
    </style>
</head>
<body>
    <div class="aurora"><div class="aurora-blob"></div><div class="aurora-blob"></div></div>
    <div class="noise-overlay"></div>
    <div class="dot-grid"></div>
    <div class="stars" id="stars-container"></div>

    <div class="welcome-card" id="welcome-card">
        <div class="card-glow-ring"></div>
        <div class="card-surface">
            <!-- Icon / Logo -->
            <header class="text-center mb-8">
                <div class="w-14 h-14 bg-white rounded-full mx-auto flex items-center justify-center mb-6 shadow-[0_0_40px_rgba(255,255,255,0.15)]">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
                <h1 class="brand-name">EVENT HUB</h1>
                <p class="text-[10px] tracking-[0.2em] text-white/40 uppercase font-medium mt-2">Powered by Laravel 12</p>
            </header>

            <!-- User Info (Simplified) -->
            <div class="text-center mb-10 space-y-1 bg-white/[0.02] border border-white/[0.05] rounded-2xl py-6">
                <p class="text-white/50 text-xs uppercase tracking-widest font-semibold mb-2">Selamat Datang</p>
                <p class="text-white font-medium text-base">Muhammad Adam Siswantoro</p>
                <p class="text-white/40 font-mono text-xs pt-1">24.12.3281</p>
            </div>

            <!-- Navigation Links -->
            <div class="flex flex-col gap-3">
                <a href="/katalog" class="nav-btn btn-primary-min tracking-wider uppercase text-xs">
                    Mulai Eksplorasi Katalog
                </a>
                <div class="grid grid-cols-2 gap-3 mt-1">
                    <a href="/profile" class="nav-btn btn-ghost">Profile</a>
                    <a href="/bantuan" class="nav-btn btn-ghost">Bantuan</a>
                    <a href="/kontak" class="nav-btn btn-ghost col-span-2">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            // Reduced star count for a cleaner look
            const container = document.getElementById('stars-container');
            const count = 25; 
            for (let i = 0; i < count; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                star.style.left = Math.random() * 100 + '%';
                star.style.top = Math.random() * 100 + '%';
                star.style.setProperty('--dur', (4 + Math.random() * 6) + 's');
                star.style.setProperty('--delay', (Math.random() * 8) + 's');
                star.style.setProperty('--max-opacity', (0.1 + Math.random() * 0.2).toFixed(2));
                container.appendChild(star);
            }
        })();
    </script>
</body>
</html>
