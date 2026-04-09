<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog Event - AMIKOMEVENTHUB</title>
    
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
            margin: 0; padding: 0; box-sizing: border-box;
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
            padding: 40px 20px;
        }

        .aurora {
            position: fixed; inset: 0; z-index: 0; overflow: hidden;
        }

        .aurora-blob {
            position: absolute; border-radius: 50%; filter: blur(100px); opacity: 0.4;
        }

        .aurora-blob:nth-child(1) {
            width: 700px; height: 700px;
            background: radial-gradient(circle, var(--primary-glow), transparent 70%);
            top: -20%; left: -10%; animation: auroraMove1 16s ease-in-out infinite alternate;
        }

        .aurora-blob:nth-child(2) {
            width: 600px; height: 600px;
            background: radial-gradient(circle, var(--accent-glow), transparent 70%);
            bottom: -25%; right: -10%; animation: auroraMove2 20s ease-in-out infinite alternate;
        }

        @keyframes auroraMove1 { to { transform: translate(-40px, 80px) scale(1.05); } }
        @keyframes auroraMove2 { to { transform: translate(40px, -60px) scale(0.95); } }

        .noise-overlay { position: fixed; inset: 0; z-index: 1; opacity: 0.03; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' /%3E%3C/svg%3E"); pointer-events: none; }
        .dot-grid { position: fixed; inset: 0; z-index: 1; background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px); background-size: 32px 32px; pointer-events: none; mask-image: radial-gradient(ellipse 70% 60% at 50% 50%, black 20%, transparent 80%); }
        .stars { position: fixed; inset: 0; z-index: 2; pointer-events: none; }
        .star { position: absolute; width: 2px; height: 2px; background: white; border-radius: 50%; animation: starTwinkle var(--dur) ease-in-out infinite; animation-delay: var(--delay); opacity: 0; }
        @keyframes starTwinkle { 0%, 100% { opacity: 0; transform: scale(0.5); } 50% { opacity: var(--max-opacity); transform: scale(1); } }

        .welcome-card {
            position: relative;
            width: 680px;
            max-width: 100%;
            border-radius: var(--radius-xl);
            opacity: 0;
            transform: translateY(30px);
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            z-index: 10;
        }

        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

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

        .brand-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem; font-weight: 700; letter-spacing: 0.15em;
            background: linear-gradient(135deg, #fff 0%, var(--primary-light) 50%, var(--accent-light) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            margin-bottom: 8px; text-align: center;
        }

        .event-card {
            background: var(--surface-1);
            border: 1px solid var(--border-subtle);
            border-radius: 20px;
            padding: 20px;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .event-card:hover {
            background: var(--surface-2);
            transform: translateY(-5px);
            border-color: var(--primary-light);
            box-shadow: 0 10px 30px rgba(124, 58, 237, 0.15);
        }

        .event-badge {
            background: rgba(124, 58, 237, 0.1);
            border: 1px solid rgba(124, 58, 237, 0.2);
            color: var(--primary-light);
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .nav-btn {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 12px 24px; border-radius: 12px; font-weight: 600; font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-primary { background: linear-gradient(135deg, var(--primary), #4F46E5); color: white; box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(124, 58, 237, 0.5); }
        
        .btn-outline { background: var(--surface-1); border: 1px solid var(--border-subtle); color: var(--text-secondary); }
        .btn-outline:hover { border-color: var(--primary-light); color: white; background: var(--surface-2); }
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
            <header class="text-center mb-10">
                <h1 class="brand-name">KATALOG EVENT</h1>
                <p class="text-xs tracking-[0.3em] text-white/40 uppercase font-medium">Temukan Event Menarik Anda</p>
                <div class="h-px w-24 bg-gradient-to-r from-transparent via-primary to-transparent mx-auto mt-6"></div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                <!-- Event Placeholder 1 -->
                <div class="event-card group">
                    <span class="event-badge mb-3 inline-block">Teknologi</span>
                    <h3 class="text-white font-bold text-lg mb-2 group-hover:text-primary-light transition-colors">Workshop AI & Future</h3>
                    <p class="text-white/50 text-xs mb-4 leading-relaxed">Pelajari bagaimana AI mengubah dunia di tahun 2026 ini bersama para ahli industri.</p>
                    <div class="flex items-center justify-between text-[10px] text-white/30 font-bold uppercase tracking-widest">
                        <span>12 April 2026</span>
                        <span class="text-accent-light">Gratis</span>
                    </div>
                </div>

                <!-- Event Placeholder 2 -->
                <div class="event-card group">
                    <span class="event-badge mb-3 inline-block" style="background: rgba(6, 182, 212, 0.1); border-color: rgba(6, 182, 212, 0.2); color: #67E8F9;">Seminar</span>
                    <h3 class="text-white font-bold text-lg mb-2 group-hover:text-accent-light transition-colors">Digital Marketing 5.0</h3>
                    <p class="text-white/50 text-xs mb-4 leading-relaxed">Strategi pemasaran terbaru untuk menjangkau audiens global secara efektif.</p>
                    <div class="flex items-center justify-between text-[10px] text-white/30 font-bold uppercase tracking-widest">
                        <span>15 April 2026</span>
                        <span class="text-primary-light">Tertutup</span>
                    </div>
                </div>

                <!-- Event Placeholder 3 -->
                <div class="event-card group opacity-50">
                    <span class="event-badge mb-3 inline-block" style="background: rgba(244, 63, 94, 0.1); border-color: rgba(244, 63, 94, 0.2); color: #FDA4AF;">Lomba</span>
                    <h3 class="text-white font-bold text-lg mb-2">Hackathon Amikom</h3>
                    <p class="text-white/50 text-xs mb-4 leading-relaxed">Kembangkan solusi inovatif dalam 48 jam untuk tantangan lokal.</p>
                    <div class="flex items-center justify-between text-[10px] text-white/30 font-bold uppercase tracking-widest">
                        <span>Coming Soon</span>
                        <span>-</span>
                    </div>
                </div>

                <!-- Empty State / More placeholder -->
                <div class="event-card flex flex-col items-center justify-center border-dashed opacity-40">
                    <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <span class="text-[10px] text-white/30 uppercase tracking-widest font-bold">Event Selanjutnya</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="/" class="nav-btn btn-primary flex-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <a href="/profile" class="nav-btn btn-outline flex-1">Lihat Profile</a>
                <a href="/bantuan" class="nav-btn btn-outline flex-1">Bantuan</a>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const container = document.getElementById('stars-container');
            const count = 50;
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