@extends('layouts.main')

@section('content')

<!-- Hero Banner -->
<section class="hero">
    <div class="hero-badge animate-fade-in">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41" />
        </svg>
        <span>t-lek tech &bull; Next-Gen Technology</span>
    </div>
    
    <h1 class="hero-title animate-fade-in-up">
        ขับเคลื่อนโลกอนาคตด้วย <br>
        <span class="hero-gradient">นวัตกรรม และ AI-technologies</span>
    </h1>
    
    <p class="hero-desc animate-fade-in-up">
        เราพัฒนาซอฟต์แวร์และนวัตกรรมอัจฉริยะที่สะท้อนถึง ประสิทธิภาพ สูงสุดและความทันสมัยอย่างไร้ข้อจำกัด ด้วยสถาปัตยกรรมยุคใหม่ที่รวดเร็ว มั่นคง และสอดรับกับอนาคตอย่างแท้จริง
    </p>
    
    <div class="hero-actions animate-fade-in-up">
        <a href="/products" class="btn btn-primary">
            ดูผลิตภัณฑ์ของเรา
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
        <a href="#features" class="btn btn-secondary">จุดเด่นและบริการ</a>
    </div>
</section>

<!-- Features Grid (นวัตกรรม, ประสิทธิภาพ, ความทันสมัย, AI-technologies) -->
<section class="features-section" id="features">
    <div class="section-header">
        <div class="section-subtitle">Core Pillars</div>
        <h2 class="section-title">เสาหลักแห่งความสำเร็จของเรา</h2>
    </div>

    <div class="features-grid">
        <!-- 1. นวัตกรรม -->
        <div class="card-feature">
            <div class="card-icon-container">
                <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .5 2.2 1.5 3 .7.7 1.3 1.5 1.5 2.5v2h6v-2Z" />
                    <path d="M9 18h6M10 21h4" />
                    <path d="M12 2v2M4.9 4.9l1.4 1.4M2 12h2M17.7 6.3l1.4-1.4M20 12h2" />
                </svg>
            </div>
            <h3 class="card-title">นวัตกรรม</h3>
            <p class="card-desc">
                การสร้างสรรค์โซลูชันที่อยู่นอกกรอบเดิม ๆ พลิกโฉมการทำงานด้วยสถาปัตยกรรมระดับก้าวหน้า เพื่อตอบสนองต่อโจทย์ปัญหาที่ซับซ้อนในยุคปัจจุบัน
            </p>
        </div>

        <!-- 2. ประสิทธิภาพ -->
        <div class="card-feature">
            <div class="card-icon-container">
                <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z" stroke-dasharray="3 3"/>
                    <path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                    <path d="M12 12L16 8"/>
                    <path d="M12 4V2M4 12H2M22 12h-2"/>
                </svg>
            </div>
            <h3 class="card-title">ประสิทธิภาพ</h3>
            <p class="card-desc">
                มุ่งเน้นการประมวลผลที่รวดเร็ว อัตราการหน่วงเวลาต่ำมาก (Low-latency) และทรัพยากรการประมวลผลที่มีการรีดประสิทธิภาพอย่างคุ้มค่าสูงสุดในทุกสภาพการทำงาน
            </p>
        </div>

        <!-- 3. ความทันสมัย -->
        <div class="card-feature">
            <div class="card-icon-container">
                <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
                    <path d="m5 3 1 2.5L8.5 6 6 7 5 9.5 4 7 1.5 6 4 5 5 3Z" opacity="0.6"/>
                </svg>
            </div>
            <h3 class="card-title">ความทันสมัย</h3>
            <p class="card-desc">
                อินเตอร์เฟสผู้ใช้ที่ดูสะอาด สบายตา เรียบหรู สะท้อนปรัชญาการออกแบบสไตล์ Minimalist ยอดนิยม เช่นเดียวกับระเบียบวิธีของ Linear, Vercel และ Hono
            </p>
        </div>

        <!-- 4. AI-technologies -->
        <div class="card-feature">
            <div class="card-icon-container">
                <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="4" y="4" width="16" height="16" rx="3" />
                    <path d="M9 9h6v6H9z" />
                    <path d="M9 12h6M12 9v6" />
                    <path d="M12 2v2M12 20v2M20 12h2M2 12h2" />
                    <circle cx="12" cy="12" r="1.5" />
                </svg>
            </div>
            <h3 class="card-title">AI-technologies</h3>
            <p class="card-desc">
                ผสานระบบปัญญาประดิษฐ์ (AI Models) เข้าไปเป็นส่วนประกอบในโครงสร้างสถาปัตยกรรม ช่วยวิเคราะห์ ประมวลผล และขยายขีดความสามารถอัจฉริยะอย่างอัตโนมัติ
            </p>
        </div>
    </div>
</section>

<!-- Technology & Architecture Showcase -->
<section class="showcase-section" id="showcase">
    <div class="showcase-container">
        <div class="showcase-grid">
            <div class="showcase-content">
                <div class="section-subtitle">High-end Infrastructure</div>
                <h2 class="section-title" style="margin-bottom: 1.5rem;">พลังแห่งสถาปัตยกรรมระดับ Premium</h2>
                <p class="hero-desc" style="font-size: 1rem; text-align: left; margin-bottom: 1rem;">
                    โครงสร้างพื้นฐานของเราออกแบบมาเพื่อตอบรับงานระดับองค์กร ด้วยการผสมผสานการประมวลผลอัจฉริยะ (AI-Powered Engine) ร่วมกับสถาปัตยกรรมความเร็วสูง มั่นคง ปลอดภัย และไร้ความซับซ้อนโดยไม่จำเป็น
                </p>
                
                <ul class="showcase-features-list">
                    <li class="showcase-item">
                        <div class="showcase-item-icon">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h4 class="showcase-item-title">โครงสร้างแบบไร้ภาระพึ่งพิง (Zero Dependency)</h4>
                            <p class="showcase-item-desc">สถาปัตยกรรมภายในพัฒนาขึ้นจาก Wisp Core รันโค้ดและไลบรารีได้โดยตรง รวดเร็ว แม่นยำ และไร้ปัญหาความล้าสมัย</p>
                        </div>
                    </li>
                    <li class="showcase-item">
                        <div class="showcase-item-icon">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h4 class="showcase-item-title">AI Integration Ecosystem</h4>
                            <p class="showcase-item-desc">รองรับการสับเปลี่ยนแบบจำลองภาษาขนาดใหญ่ (LLMs) และส่วนประสานงานอัจฉริยะ ช่วยให้ระบบแปลความ ประมวลผล และวิเคราะห์ข้อมูลเสร็จสิ้นในพริบตา</p>
                        </div>
                    </li>
                    <li class="showcase-item">
                        <div class="showcase-item-icon">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h4 class="showcase-item-title">เบื้องหลังที่เบาบาง (Lightweight Core)</h4>
                            <p class="showcase-item-desc">เรายึดมั่นในปรัชญา "สะอาด เบา และทันสมัย" ไร้ภาพสลักที่เทอะทะ ไร้ปลั๊กอินส่วนเกินที่คอยดึงรั้งความเร็ว เพื่อความเสถียรและความนุ่มนวลสูงสุด (Smooth Transitions)</p>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Showcase Visual Card -->
            <div class="showcase-visual animate-fade-in">
                <div class="visual-header">
                    <div class="visual-dots">
                        <span class="visual-dot visual-dot-red"></span>
                        <span class="visual-dot visual-dot-yellow"></span>
                        <span class="visual-dot visual-dot-green"></span>
                    </div>
                    <div class="visual-label">WispCoreServer.php</div>
                </div>
                <div class="visual-body">
                    <div><span class="syntax-keyword">class</span> <span style="color: #0f766e;">AppKernel</span> {</div>
                    <div style="padding-left: 1.25rem;"><span class="syntax-comment">// นวัตกรรม + ความทันสมัยผสานในหนึ่งเดียว</span></div>
                    <div style="padding-left: 1.25rem;"><span class="syntax-keyword">public function</span> <span style="color: #b45309;">bootAiService</span>(<span class="syntax-variable">$aiModel</span>) {</div>
                    <div style="padding-left: 2.5rem;"><span class="syntax-variable">$this</span>->logger->info(<span class="syntax-string">"AI Engine loading..."</span>);</div>
                    <div style="padding-left: 2.5rem;"><span class="syntax-keyword">return</span> <span class="syntax-variable">$this</span>->container->resolve(<span class="syntax-string">'aiTranslater'</span>)</div>
                    <div style="padding-left: 3.75rem;">->setEngine(<span class="syntax-variable">$aiModel</span>)</div>
                    <div style="padding-left: 3.75rem;">->optimizePerformance(<span class="syntax-string">'ultra-speed'</span>);</div>
                    <div style="padding-left: 1.25rem;">}</div>
                    <div>}</div>

                    <!-- Performance Stats inside Visual -->
                    <div class="performance-graph">
                        <div class="perf-bar-container">
                            <div class="perf-bar-label">
                                <span>t-lek tech. (Optimized Kernel)</span>
                                <span style="color: var(--cyan); font-weight: 600;">9.8k req/sec</span>
                            </div>
                            <div class="perf-bar-track">
                                <div class="perf-bar-fill fill-wisp"></div>
                            </div>
                        </div>
                        <div class="perf-bar-container" style="margin-bottom: 0;">
                            <div class="perf-bar-label">
                                <span>Standard Frameworks</span>
                                <span>2.4k req/sec</span>
                            </div>
                            <div class="perf-bar-track">
                                <div class="perf-bar-fill fill-other"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section" id="about">
    <div class="about-card">
        <div class="about-grid">
            <div>
                <h3 class="about-heading" style="margin-bottom: 1.25rem;">
                    เกี่ยวกับเรา
                </h3>
                <p class="about-text" style="font-weight: 500; font-size: 1.15rem; color: var(--purple); margin-bottom: 1.75rem;">
                    "ใส่ใจในรายละเอียด และสร้างสรรค์ผลงานที่เชื่อมต่ออนาคต"
                </p>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.95rem; margin-bottom: 0;">
                    <li style="display: flex; gap: 0.75rem; align-items: flex-start; font-size: 0.95rem; color: var(--text-secondary); line-height: 1.6;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="var(--cyan)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 0.15rem;">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>เราสร้างระบบการทำงานที่เบาและรวดเร็ว รองรับอนาคต</span>
                    </li>
                    <li style="display: flex; gap: 0.75rem; align-items: flex-start; font-size: 0.95rem; color: var(--text-secondary); line-height: 1.6;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="var(--cyan)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 0.15rem;">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>App สามารถทำงานร่วมกับ AI ได้อย่างราบลื่น</span>
                    </li>
                    <li style="display: flex; gap: 0.75rem; align-items: flex-start; font-size: 0.95rem; color: var(--text-secondary); line-height: 1.6;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="var(--cyan)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 0.15rem;">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>เราใส่ใจเรื่องความเสถียรและดีไซน์ที่นุ่มนวล</span>
                    </li>
                    <li style="display: flex; gap: 0.75rem; align-items: flex-start; font-size: 0.95rem; color: var(--text-secondary); line-height: 1.6;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="var(--cyan)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; margin-top: 0.15rem;">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>ทีมงานมีทั้งมนุษย์และ AI ร่วมกันทำงานอย่างลงตัว</span>
                    </li>
                </ul>
            </div>
            <div style="text-align: center; display: flex; justify-content: center; align-items: center;">
                <svg viewBox="0 0 200 200" width="160" height="160" fill="none" style="filter: drop-shadow(0 10px 20px rgba(6, 182, 212, 0.08));">
                    <!-- Concentric thin circles for design decoration -->
                    <circle cx="100" cy="100" r="80" stroke="rgba(6, 182, 212, 0.15)" stroke-width="1" />
                    <circle cx="100" cy="100" r="60" stroke="rgba(139, 92, 246, 0.1)" stroke-width="1" />
                    <circle cx="100" cy="100" r="40" stroke="rgba(6, 182, 212, 0.08)" stroke-width="1.5" stroke-dasharray="4 4" />
                    <!-- Middle modern hexagon symbol in SVG -->
                    <polygon points="100,65 130,82.5 130,117.5 100,135 70,117.5 70,82.5" stroke="url(#hex-grad)" stroke-width="3" fill="rgba(255,255,255,0.7)"/>
                    <defs>
                        <linearGradient id="hex-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#06b6d4" />
                            <stop offset="100%" stop-color="#8b5cf6" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="contact-section" id="contact">
    <div class="contact-container">
        <div class="section-header" style="margin-bottom: 2.5rem;">
            <div class="section-subtitle">Get in Touch</div>
            <h2 class="section-title">ร่วมขับเคลื่อนอนาคตไปกับเรา</h2>
        </div>

        <div class="contact-card">
            <form onsubmit="event.preventDefault(); alert('ระบบจำลองการส่งข้อมูลเสร็จสิ้น ขอบคุณที่ติดต่อ t-lek tech.!');">
                <div class="form-group">
                    <label class="form-label" for="name">ชื่อผู้ติดต่อ</label>
                    <input class="form-input" type="text" id="name" placeholder="ระบุชื่อของคุณ" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">อีเมลติดต่อ</label>
                    <input class="form-input" type="email" id="email" placeholder="name@domain.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="message">รายละเอียดที่ต้องการติดต่อ</label>
                    <textarea class="form-textarea" id="message" rows="4" placeholder="ระบุความสนใจใน นวัตกรรม หรือ AI-technologies ของคุณ..." required></textarea>
                </div>
                <button type="submit" class="btn btn-submit">
                    ส่งข้อความสอบถามข้อมูล
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
