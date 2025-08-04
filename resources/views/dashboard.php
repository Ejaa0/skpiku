<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard Utama SKPI UNAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Pulse emoji */
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.15);
            }
        }

        /* Floating card effect */
        @keyframes floatUpDown {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Slight rocking emoji */
        @keyframes rock {
            0%, 100% {
                transform: rotate(0deg);
            }
            25% {
                transform: rotate(8deg);
            }
            75% {
                transform: rotate(-8deg);
            }
        }

        .pulse-emoji {
            animation: pulse 2.5s ease-in-out infinite, rock 4s ease-in-out infinite;
            display: inline-block;
            user-select: none;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        /* Card container */
        main.card-grid {
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            gap: 3rem;
            padding: 0 1rem;
            flex-wrap: nowrap;
        }

        /* Card base style */
        a.card {
            border: 3px solid transparent;
            border-radius: 1.5rem;
            padding: 2rem;
            flex: 1 1 280px;
            max-width: 320px;
            color: white;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform, box-shadow, border-color;
            background-size: 200% 200%;
            animation: floatUpDown 6s ease-in-out infinite;
        }

        a.card:hover {
            transform: translateY(-18px) scale(1.07);
            box-shadow:
                0 30px 40px rgba(0, 0, 0, 0.18),
                0 12px 15px rgba(0, 0, 0, 0.08);
            border-color: #2563eb; /* Tailwind blue-600 */
            cursor: pointer;
            z-index: 10;
            animation-play-state: paused;
            background-position: right center;
        }

        /* Background gradients */
        a.mahasiswa {
            background: linear-gradient(135deg, #7c3aed, #5b21b6);
        }

        a.organisasi {
            background: linear-gradient(135deg, #22c55e, #15803d);
        }

        a.warek {
            background: linear-gradient(135deg, #ec4899, #be185d);
        }

        /* Headings and paragraphs */
        a.card h2 {
            font-size: 1.75rem;
            font-weight: 800;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            margin-bottom: 0.6rem;
        }

        a.card p {
            font-size: 1rem;
            font-weight: 500;
            color: #d1d5db;
            text-align: center;
            line-height: 1.4;
            max-width: 260px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.15);
        }

        body {
            background: linear-gradient(135deg, #e0e7ff, #d1d5db);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem 5rem;
        }

        header {
            margin-bottom: 3rem;
            text-align: center;
            max-width: 600px;
            padding: 0 1rem;
        }

        header h1 {
            font-size: 2.75rem;
            font-weight: 900;
            color: #3730a3;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.15);
            margin-bottom: 0.4rem;
        }

        header h1 span {
            color: #2563eb;
        }

        header p {
            font-size: 1.15rem;
            font-weight: 600;
            color: #4b5563;
            text-shadow: 0 1px 1px rgba(255, 255, 255, 0.7);
        }

        /* WhatsApp help button */
        #help-center {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #25D366;
            width: 60px;
            height: 60px;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow:
                0 4px 12px rgba(0, 0, 0, 0.35),
                0 0 10px #25D366aa;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            z-index: 1000;
        }

        #help-center:hover {
            transform: scale(1.2);
            box-shadow:
                0 6px 15px rgba(0, 0, 0, 0.45),
                0 0 20px #25D366ff;
        }

        #help-center svg {
            width: 30px;
            height: 30px;
            fill: white;
        }

        /* Responsive tweaks */
        @media (max-width: 1024px) {
            main.card-grid {
                flex-wrap: wrap;
            }
            a.card {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <header>
        <h1>Selamat Datang di <span>SKPI UNAI!</span></h1>
        <p>Silakan pilih role login sesuai dengan peran Anda di sistem SKPI</p>
    </header>

    <main class="card-grid">
        <a href="<?php echo url('/login/mahasiswa'); ?>" class="card mahasiswa" aria-label="Login Mahasiswa">
            <span class="pulse-emoji" style="font-size: 6rem;">🎓</span>
            <h2>Mahasiswa</h2>
            <p>Login sebagai mahasiswa untuk mengakses data dan aktivitas akademik</p>
        </a>

        <a href="<?php echo url('/login/organisasi'); ?>" class="card organisasi" aria-label="Login Organisasi">
            <span class="pulse-emoji" style="font-size: 6rem;">🏢</span>
            <h2>Organisasi</h2>
            <p>Login sebagai organisasi mahasiswa untuk mengelola kegiatan dan info</p>
        </a>

        <a href="<?php echo url('/login/warek'); ?>" class="card warek" aria-label="Login Wakil Rektor III">
            <span class="pulse-emoji" style="font-size: 6rem;">👨‍💼</span>
            <h2>Wakil Rektor III</h2>
            <p>Login sebagai Wakil Rektor III untuk mengelola administrasi tinggi</p>
        </a>
    </main>

    <a id="help-center" href="https://wa.me/6281223236894" target="_blank" rel="noopener" aria-label="Help Center WhatsApp">
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path
                d="M20.52 3.48A11.868 11.868 0 0 0 12 0C5.372 0 0 5.372 0 12c0 2.12.555 4.146 1.608 5.935L0 24l6.292-1.582A11.922 11.922 0 0 0 12 24c6.627 0 12-5.372 12-12 0-3.21-1.254-6.22-3.48-8.52zm-1.834 13.3c-.278.78-1.504 1.49-2.077 1.6-.553.11-1.202.16-3.328-.766-3.021-1.178-4.976-4.61-5.132-4.857-.156-.246-1.27-1.676-1.27-3.2 0-1.524.806-2.28 1.092-2.596.288-.317.63-.4.84-.4.21 0 .425 0 .61.003.196.002.46-.074.704.553.245.627.837 2.18.91 2.34.074.16.12.353.015.57-.104.216-.156.35-.31.55-.156.2-.33.45-.47.61-.156.157-.316.335-.14.64.176.3.78 1.27 1.67 2.06 1.16 1.18 2.134 1.57 2.45 1.75.31.177.492.15.67-.09.178-.245.62-.72.795-.968.176-.246.352-.205.6-.123.246.08 1.56.735 1.83.866.27.127.45.19.514.297.066.11.066.63-.21 1.41z">
            </path>
        </svg>
    </a>

</body>

</html>
