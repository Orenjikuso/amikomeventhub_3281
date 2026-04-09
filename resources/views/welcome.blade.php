<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMIKOMEVENTHUB</title>
    <meta name="description" content="AMIKOMEVENTHUB - Welcome Card by Muhammad Adam Siswantoro">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            --rose: #F43F5E;
            --rose-light: #FDA4AF;
            --amber: #F59E0B;
            --amber-light: #FCD34D;
            --surface-0: #030014;
            --surface-1: rgba(255, 255, 255, 0.04);
            --surface-2: rgba(255, 255, 255, 0.07);
            --surface-3: rgba(255, 255, 255, 0.10);
            --border-subtle: rgba(255, 255, 255, 0.08);
            --border-medium: rgba(255, 255, 255, 0.14);
            --text-primary: #F8FAFC;
            --text-secondary: rgba(248, 250, 252, 0.60);
            --text-muted: rgba(248, 250, 252, 0.35);
            --radius-sm: 10px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-xl: 32px;
        }

        html, body {
            height: 100%;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--surface-0);
            overflow: hidden;
            position: relative;
        }

        /* ═══════════════════════════════════
           BACKGROUND SYSTEM
        ═══════════════════════════════════ */

        /* Aurora gradient blobs */
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
            opacity: 0.5;
            will-change: transform;
        }

        .aurora-blob:nth-child(1) {
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, var(--primary-glow), transparent 70%);
            top: -20%;
            left: -10%;
            animation: auroraMove1 16s ease-in-out infinite alternate;
        }

        .aurora-blob:nth-child(2) {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--accent-glow), transparent 70%);
            bottom: -25%;
            right: -10%;
            animation: auroraMove2 20s ease-in-out infinite alternate;
        }

        .aurora-blob:nth-child(3) {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(244, 63, 94, 0.2), transparent 70%);
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: auroraMove3 14s ease-in-out infinite alternate;
        }

        @keyframes auroraMove1 {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(80px, 40px) scale(1.15); }
            100% { transform: translate(-40px, 80px) scale(1.05); }
        }

        @keyframes auroraMove2 {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-60px, -40px) scale(1.2); }
            100% { transform: translate(40px, -60px) scale(0.95); }
        }

        @keyframes auroraMove3 {
            0% { transform: translate(-50%, -50%) scale(0.9); }
            50% { transform: translate(-40%, -55%) scale(1.1); }
            100% { transform: translate(-55%, -45%) scale(1); }
        }

        /* Noise texture overlay */
        .noise-overlay {
            position: fixed;
            inset: 0;
            z-index: 1;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' /%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* Dot grid pattern */
        .dot-grid {
            position: fixed;
            inset: 0;
            z-index: 1;
            background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
            mask-image: radial-gradient(ellipse 70% 60% at 50% 50%, black 20%, transparent 80%);
            -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 50%, black 20%, transparent 80%);
        }

        /* Floating light particles */
        .stars {
            position: fixed;
            inset: 0;
            z-index: 2;
            pointer-events: none;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: white;
            border-radius: 50%;
            animation: starTwinkle var(--dur) ease-in-out infinite;
            animation-delay: var(--delay);
            opacity: 0;
        }

        @keyframes starTwinkle {
            0%, 100% { opacity: 0; transform: scale(0.5); }
            50% { opacity: var(--max-opacity); transform: scale(1); }
        }

        /* ═══════════════════════════════════
           MAIN CARD
        ═══════════════════════════════════ */

        .card-stage {
            position: relative;
            z-index: 10;
            perspective: 1200px;
        }

        .welcome-card {
            position: relative;
            width: 480px;
            max-width: 90vw;
            border-radius: var(--radius-xl);
            overflow: visible;
            animation: cardReveal 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.3s forwards;
            opacity: 0;
            transform: translateY(50px) rotateX(8deg) scale(0.92);
            transform-style: preserve-3d;
        }

        @keyframes cardReveal {
            to {
                opacity: 1;
                transform: translateY(0) rotateX(0) scale(1);
            }
        }

        /* Glowing ring border */
        .card-glow-ring {
            position: absolute;
            inset: -1px;
            border-radius: var(--radius-xl);
            padding: 1.5px;
            background: conic-gradient(
                from 220deg,
                var(--primary),
                var(--accent),
                var(--rose),
                var(--amber),
                var(--primary-light),
                var(--accent-light),
                var(--primary)
            );
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            animation: ringRotate 8s linear infinite;
            opacity: 0.6;
            z-index: -1;
        }

        @keyframes ringRotate {
            to { filter: hue-rotate(360deg); }
        }

        /* Outer glow */
        .card-outer-glow {
            position: absolute;
            inset: -40px;
            border-radius: 60px;
            background: radial-gradient(
                ellipse at 50% 50%,
                rgba(124, 58, 237, 0.12) 0%,
                rgba(6, 182, 212, 0.06) 40%,
                transparent 70%
            );
            z-index: -2;
            animation: outerPulse 6s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes outerPulse {
            0% { opacity: 0.5; transform: scale(1); }
            100% { opacity: 1; transform: scale(1.05); }
        }

        /* Card inner surface */
        .card-surface {
            position: relative;
            border-radius: var(--radius-xl);
            background: linear-gradient(
                165deg,
                rgba(15, 10, 40, 0.92) 0%,
                rgba(8, 5, 25, 0.96) 50%,
                rgba(12, 8, 35, 0.94) 100%
            );
            backdrop-filter: blur(60px);
            -webkit-backdrop-filter: blur(60px);
            border: 1px solid var(--border-subtle);
            overflow: hidden;
        }

        /* Inner shine effect */
        .card-surface::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(
                180deg,
                rgba(255, 255, 255, 0.06) 0%,
                rgba(255, 255, 255, 0.02) 40%,
                transparent 100%
            );
            border-radius: var(--radius-xl) var(--radius-xl) 0 0;
            pointer-events: none;
        }

        /* Spotlight hover effect */
        .card-surface::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: var(--radius-xl);
            background: radial-gradient(
                600px circle at var(--mouse-x, 50%) var(--mouse-y, 0%),
                rgba(124, 58, 237, 0.08),
                transparent 40%
            );
            pointer-events: none;
            transition: opacity 0.5s ease;
            opacity: 0;
        }

        .welcome-card:hover .card-surface::after {
            opacity: 1;
        }

        /* ═══════════════════════════════════
           HEADER SECTION
        ═══════════════════════════════════ */

        .card-header {
            position: relative;
            padding: 44px 40px 32px;
            text-align: center;
        }

        .header-divider {
            position: absolute;
            bottom: 0;
            left: 32px;
            right: 32px;
            height: 1px;
            background: linear-gradient(
                90deg,
                transparent 0%,
                var(--border-medium) 30%,
                var(--border-medium) 70%,
                transparent 100%
            );
        }

        /* Animated logo icon */
        .logo-container {
            position: relative;
            width: 76px;
            height: 76px;
            margin: 0 auto 24px;
        }

        .logo-ring {
            position: absolute;
            inset: -4px;
            border-radius: 22px;
            border: 2px solid transparent;
            background: conic-gradient(from 0deg, var(--primary), var(--accent), var(--primary)) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            animation: logoRingSpin 4s linear infinite;
            opacity: 0.6;
        }

        @keyframes logoRingSpin {
            to { transform: rotate(360deg); }
        }

        .logo-icon {
            width: 76px;
            height: 76px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--primary) 0%, #4F46E5 50%, var(--accent) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow:
                0 8px 32px var(--primary-glow),
                0 0 0 1px rgba(255,255,255,0.1) inset;
            animation: iconFloat 5s ease-in-out infinite;
        }

        @keyframes iconFloat {
            0%, 100% {
                transform: translateY(0);
                box-shadow: 0 8px 32px var(--primary-glow), 0 0 0 1px rgba(255,255,255,0.1) inset;
            }
            50% {
                transform: translateY(-4px);
                box-shadow: 0 16px 48px var(--accent-glow), 0 0 0 1px rgba(255,255,255,0.15) inset;
            }
        }

        .logo-icon svg {
            width: 38px;
            height: 38px;
            color: white;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        }

        /* Brand text */
        .brand-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.55rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            background: linear-gradient(
                135deg,
                var(--text-primary) 0%,
                var(--primary-light) 40%,
                var(--accent-light) 60%,
                var(--text-primary) 100%
            );
            background-size: 200% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: textShimmer 6s ease-in-out infinite;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        @keyframes textShimmer {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .brand-tagline {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-muted);
            letter-spacing: 0.22em;
            text-transform: uppercase;
        }

        /* ═══════════════════════════════════
           WELCOME MESSAGE
        ═══════════════════════════════════ */

        .welcome-section {
            padding: 28px 40px 8px;
            text-align: center;
        }

        .welcome-greeting {
            font-size: 0.82rem;
            font-weight: 400;
            color: var(--text-secondary);
            line-height: 1.7;
            max-width: 320px;
            margin: 0 auto;
        }

        .welcome-greeting span {
            color: var(--accent-light);
            font-weight: 600;
        }

        /* ═══════════════════════════════════
           INFO CARDS
        ═══════════════════════════════════ */

        .info-section {
            padding: 20px 32px 24px;
        }

        .info-grid {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-card {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 18px 20px;
            border-radius: var(--radius-md);
            background: var(--surface-1);
            border: 1px solid var(--border-subtle);
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: default;

            /* Staggered entrance */
            animation: infoSlideIn 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(16px);
        }

        .info-card:nth-child(1) { animation-delay: 0.6s; }
        .info-card:nth-child(2) { animation-delay: 0.75s; }

        @keyframes infoSlideIn {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Hover shine sweep */
        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent 0%,
                rgba(255,255,255,0.04) 50%,
                transparent 100%
            );
            transition: left 0.6s ease;
        }

        .info-card:hover::before {
            left: 100%;
        }

        .info-card:hover {
            background: var(--surface-2);
            border-color: var(--border-medium);
            transform: translateX(4px);
            box-shadow: 0 4px 24px rgba(0,0,0,0.2);
        }

        /* Icon badge */
        .info-badge {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            position: relative;
        }

        .info-badge.badge-purple {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.18), rgba(167, 139, 250, 0.08));
            border: 1px solid rgba(124, 58, 237, 0.25);
        }

        .info-badge.badge-cyan {
            background: linear-gradient(135deg, rgba(6, 182, 212, 0.18), rgba(103, 232, 249, 0.08));
            border: 1px solid rgba(6, 182, 212, 0.25);
        }

        .info-badge svg {
            width: 22px;
            height: 22px;
            position: relative;
            z-index: 1;
        }

        .info-badge.badge-purple svg {
            color: var(--primary-light);
            filter: drop-shadow(0 0 6px var(--primary-glow));
        }

        .info-badge.badge-cyan svg {
            color: var(--accent-light);
            filter: drop-shadow(0 0 6px var(--accent-glow));
        }

        /* Info text */
        .info-text {
            display: flex;
            flex-direction: column;
            gap: 3px;
            min-width: 0;
        }

        .info-label {
            font-size: 0.65rem;
            font-weight: 600;
            color: var(--text-muted);
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            letter-spacing: 0.01em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .info-value.mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.95rem;
            letter-spacing: 0.08em;
            color: var(--accent-light);
        }

        /* ═══════════════════════════════════
           FOOTER
        ═══════════════════════════════════ */

        .card-footer {
            position: relative;
            padding: 20px 32px 30px;
        }

        .footer-divider {
            position: absolute;
            top: 0;
            left: 32px;
            right: 32px;
            height: 1px;
            background: linear-gradient(
                90deg,
                transparent 0%,
                var(--border-medium) 30%,
                var(--border-medium) 70%,
                transparent 100%
            );
        }

        .footer-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 16px;
            border-radius: 100px;
            background: var(--surface-1);
            border: 1px solid var(--border-subtle);
            font-size: 0.68rem;
            font-weight: 500;
            color: var(--text-secondary);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            animation: fadeUp 0.8s ease forwards;
            animation-delay: 0.9s;
            opacity: 0;
            transform: translateY(8px);
        }

        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        .pulse-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #34D399;
            position: relative;
        }

        .pulse-dot::before {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            background: rgba(52, 211, 153, 0.3);
            animation: pulseRing 2s ease-out infinite;
        }

        @keyframes pulseRing {
            0% { transform: scale(1); opacity: 0.6; }
            100% { transform: scale(2); opacity: 0; }
        }

        .footer-version {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.62rem;
            font-weight: 500;
            color: var(--text-muted);
            letter-spacing: 0.05em;
            animation: fadeUp 0.8s ease forwards;
            animation-delay: 1s;
            opacity: 0;
            transform: translateY(8px);
        }

        /* ═══════════════════════════════════
           DECORATIVE ELEMENTS
        ═══════════════════════════════════ */

        /* Corner brackets */
        .corner-bracket {
            position: absolute;
            width: 20px;
            height: 20px;
            pointer-events: none;
            opacity: 0.12;
        }

        .corner-bracket.tl {
            top: 16px;
            left: 16px;
            border-top: 1.5px solid var(--primary-light);
            border-left: 1.5px solid var(--primary-light);
            border-radius: 4px 0 0 0;
        }

        .corner-bracket.tr {
            top: 16px;
            right: 16px;
            border-top: 1.5px solid var(--accent-light);
            border-right: 1.5px solid var(--accent-light);
            border-radius: 0 4px 0 0;
        }

        .corner-bracket.bl {
            bottom: 16px;
            left: 16px;
            border-bottom: 1.5px solid var(--accent-light);
            border-left: 1.5px solid var(--accent-light);
            border-radius: 0 0 0 4px;
        }

        .corner-bracket.br {
            bottom: 16px;
            right: 16px;
            border-bottom: 1.5px solid var(--primary-light);
            border-right: 1.5px solid var(--primary-light);
            border-radius: 0 0 4px 0;
        }

        /* ═══════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════ */

        @media (max-width: 520px) {
            .welcome-card {
                border-radius: var(--radius-lg);
            }

            .card-glow-ring {
                border-radius: var(--radius-lg);
            }

            .card-surface {
                border-radius: var(--radius-lg);
            }

            .card-header {
                padding: 32px 24px 24px;
            }

            .welcome-section {
                padding: 20px 24px 4px;
            }

            .info-section {
                padding: 16px 20px 20px;
            }

            .card-footer {
                padding: 16px 20px 24px;
            }

            .header-divider,
            .footer-divider {
                left: 20px;
                right: 20px;
            }

            .brand-name {
                font-size: 1.2rem;
                letter-spacing: 0.18em;
            }

            .logo-container {
                width: 64px;
                height: 64px;
                margin-bottom: 20px;
            }

            .logo-icon {
                width: 64px;
                height: 64px;
                border-radius: 16px;
            }

            .logo-icon svg {
                width: 32px;
                height: 32px;
            }

            .info-card {
                padding: 14px 16px;
            }

            .info-badge {
                width: 42px;
                height: 42px;
            }

            .info-value {
                font-size: 0.9rem;
            }

            .corner-bracket {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- ═══ Background layers ═══ -->
    <div class="aurora">
        <div class="aurora-blob"></div>
        <div class="aurora-blob"></div>
        <div class="aurora-blob"></div>
    </div>
    <div class="noise-overlay"></div>
    <div class="dot-grid"></div>
    <div class="stars" id="stars-container"></div>

    <!-- ═══ Main Card ═══ -->
    <div class="card-stage">
        <div class="welcome-card" id="welcome-card">
            <!-- Glowing ring border -->
            <div class="card-glow-ring"></div>
            <!-- Outer glow -->
            <div class="card-outer-glow"></div>

            <!-- Card surface -->
            <div class="card-surface">
                <!-- Corner brackets -->
                <div class="corner-bracket tl"></div>
                <div class="corner-bracket tr"></div>
                <div class="corner-bracket bl"></div>
                <div class="corner-bracket br"></div>

                <!-- Header -->
                <header class="card-header">
                    <div class="logo-container">
                        <div class="logo-ring"></div>
                        <div class="logo-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        </div>
                    </div>
                    <h1 class="brand-name">AMIKOMEVENTHUB</h1>
                    <p class="brand-tagline">Event Management Platform</p>
                    <div class="header-divider"></div>
                </header>

                <!-- Welcome message -->
                <section class="welcome-section">
                    <p class="welcome-greeting">
                        Selamat datang, <span>Muhammad Adam Siswantoro</span>.<br>
                        Anda terdaftar sebagai anggota aktif.
                    </p>
                </section>

                <!-- Info cards -->
                <section class="info-section">
                    <div class="info-grid">
                        <!-- Nama -->
                        <div class="info-card" id="info-name">
                            <div class="info-badge badge-purple">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                            <div class="info-text">
                                <span class="info-label">Nama Lengkap</span>
                                <span class="info-value">Muhammad Adam Siswantoro</span>
                            </div>
                        </div>

                        <!-- NIM -->
                        <div class="info-card" id="info-nim">
                            <div class="info-badge badge-cyan">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="3" width="20" height="18" rx="3"/>
                                    <line x1="7" y1="8" x2="17" y2="8"/>
                                    <line x1="7" y1="12" x2="14" y2="12"/>
                                    <line x1="7" y1="16" x2="11" y2="16"/>
                                </svg>
                            </div>
                            <div class="info-text">
                                <span class="info-label">Nomor Induk Mahasiswa</span>
                                <span class="info-value mono">24.12.3281</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Footer -->
                <footer class="card-footer">
                    <div class="footer-divider"></div>
                    <div class="footer-content">
                        <div class="footer-pill">
                            <span class="pulse-dot"></span>
                            <span>Active &bull; {{ date('Y') }}</span>
                        </div>
                        <span class="footer-version">v1.0.0</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script>
        // ═══ Generate star particles ═══
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

        // ═══ Spotlight mouse tracking ═══
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
