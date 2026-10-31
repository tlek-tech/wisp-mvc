<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 't-lek tech.' }}</title>
    <!-- SEO Meta Tags -->
    <meta name="description" content="t-lek tech. - นวัตกรรม เทคโนโลยี และการพัฒนาเทคโนโลยี AI ยุคใหม่ เพื่อประสิทธิภาพและความทันสมัยที่แท้จริง">
    <meta name="keywords" content="t-lek, t-lek tech, นวัตกรรม, ประสิทธิภาพ, ความทันสมัย, AI-technologies, AI, เทคโนโลยี">
    <meta name="author" content="t-lek tech.">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <!-- Google Fonts: Inter and Noto Sans Thai -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Thai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="brand-link">
                <img src="/images/logo.jpg" alt="t-lek tech. logo" class="brand-logo">
                <span class="brand-text">t-lek tech.</span>
            </a>
            
            <ul class="nav-menu">
                <li class="nav-item"><a href="/#features">จุดเด่นของเรา</a></li>
                <li class="nav-item"><a href="/products">ผลิตภัณฑ์</a></li>
                <li class="nav-item"><a href="/#about">เกี่ยวกับเรา</a></li>
                <li class="nav-item"><a href="/#showcase">เทคโนโลยี</a></li>
            </ul>

            <div class="nav-actions">
                <a href="/#contact" class="btn-nav btn-nav-outline">ติดต่อ</a>
            </div>
        </div>
    </nav>

    <!-- Main Content Yield -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <a href="/" class="footer-brand-logo">
                    <img src="/images/logo.jpg" alt="t-lek tech." class="footer-logo-img">
                    <span style="font-family: 'Inter';">t-lek tech.</span>
                </a>
                <p class="footer-desc">
                    ผู้พัฒนาเทคโนโลยีชั้นนำที่นำเอา AI, ความทันสมัย และประสิทธิภาพระดับสูงมาผสานเข้าด้วยกันเพื่อตอบโจทย์ทุกความต้องการของธุรกิจยุคดิจิทัล
                </p>
            </div>
            
            <div class="footer-links-col">
                <h4 class="footer-title">เทคโนโลยี</h4>
                <ul class="footer-links">
                    <li><a href="/#showcase">AI-Technologies</a></li>
                    <li><a href="/products">ผลิตภัณฑ์ของเรา</a></li>
                    <li><a href="/#features">นวัตกรรม & ประสิทธิภาพ</a></li>
                    <li><a href="/#about">เกี่ยวกับเรา</a></li>
                </ul>
            </div>

            <!-- <div class="footer-links-col">
                <h4 class="footer-title">ข้อมูลระบบ</h4>
                <ul class="footer-links">
                    <li><a href="/products">ผลิตภัณฑ์ทั้งหมด</a></li>
                    <li><a href="/version">System Version</a></li>
                    <li><a href="/mvc-demo">MVC Demo Controller</a></li>
                </ul>
            </div> -->
        </div>

        <div class="footer-bottom">
            <div>&copy; {{ date('Y') }} t-lek tech. All rights reserved.</div>
            <div style="font-family: 'Noto Sans Thai', 'Inter', sans-serif;">
                ขับเคลื่อนเว็บไซต์ด้วย <a href="https://github.com/tlek-tech/wisp" target="_blank" style="color: var(--cyan); text-decoration: none; font-weight: 500; transition: var(--transition-smooth);" onmouseover="this.style.color='var(--purple)'" onmouseout="this.style.color='var(--cyan)'">Wisp Framework</a>
            </div>
            <div style="font-family: 'Inter';">Clean. Light. Modern.</div>
        </div>
    </footer>
</body>
</html>
