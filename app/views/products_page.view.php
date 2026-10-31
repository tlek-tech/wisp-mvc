@extends('layouts.main')

@section('content')
<!-- Products Hero Section -->
<section class="products-hero">
    <div class="hero-badge">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
            <polyline points="2 17 12 22 22 17"></polyline>
            <polyline points="2 12 12 17 22 12"></polyline>
        </svg>
        <span>t-lek tech &bull; Products Suite</span>
    </div>
    
    <h1 class="hero-title" style="margin-bottom: 1rem;">
        ผลิตภัณฑ์และ <span class="hero-gradient">โซลูชันนวัตกรรม</span>
    </h1>
    
    <p class="hero-desc">
        สัมผัสความก้าวหน้าของระบบการทำงานยุคใหม่ที่ขับเคลื่อนด้วยปัญญาประดิษฐ์ (AI-Powered) ออกแบบมาเพื่อลดความซับซ้อน เพิ่มประสิทธิภาพ และเชื่อมต่อทุกความเป็นไปได้ให้กับองค์กรของคุณ
    </p>
</section>

<!-- Products Grid Section -->
<section class="products-grid">
    @foreach($products as $product)
        <div class="product-card">
            <!-- Product Icon -->
            <div class="product-icon-container">
                @if($product['icon_type'] === 'erp')
                    <!-- ERP Icon: Database/Line Chart -->
                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 3v18h18"></path>
                        <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"></path>
                        <circle cx="7" cy="14.3" r="1.5"></circle>
                        <circle cx="10.8" cy="10.5" r="1.5"></circle>
                        <circle cx="13.6" cy="13.2" r="1.5"></circle>
                        <circle cx="18.7" cy="8" r="1.5"></circle>
                    </svg>
                @elseif($product['icon_type'] === 'assistant')
                    <!-- Assistant Icon: Laptop/PC -->
                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="14" rx="2"></rect>
                        <line x1="2" y1="20" x2="22" y2="20"></line>
                        <line x1="12" y1="17" x2="12" y2="20"></line>
                        <circle cx="12" cy="10" r="2.5"></circle>
                        <path d="M9 10h.01M15 10h.01M11 12h2"></path>
                    </svg>
                @elseif($product['icon_type'] === 'translator')
                    <!-- Translator Icon: Book with Arrows -->
                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        <path d="m14 7 3 3-3 3M10 15l-3-3 3-3"></path>
                    </svg>
                @endif
            </div>

            <!-- Product Header -->
            <h3 class="product-title">{{ $product['title'] }}</h3>

            <!-- Product Description -->
            <p class="product-desc">{{ $product['description'] }}</p>

            <!-- AI-Powered Feature Section -->
            <div class="product-ai-feature">
                <!-- Sparkle SVG (AI indicator) -->
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path>
                </svg>
                <span>{{ $product['ai_feature'] }}</span>
            </div>

            <!-- Product Status -->
            <div class="product-status-badge">
                <span class="status-dot"></span>
                <span>{{ $product['status'] }}</span>
            </div>
        </div>
    @endforeach
</section>
@endsection
