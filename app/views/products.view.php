@extends('layout')

@section('content')
<style>
    .welcome-banner {
        background: rgba(99, 102, 241, 0.08);
        border: 1px dashed rgba(99, 102, 241, 0.3);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 2rem;
        font-size: 0.95rem;
        color: #c7d2fe;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .banner-dot {
        width: 8px;
        height: 8px;
        background-color: var(--success-color);
        border-radius: 50%;
        box-shadow: 0 0 8px var(--success-color);
        display: inline-block;
        animation: pulse 2s infinite;
    }

    .section-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.25rem;
        letter-spacing: -0.01em;
    }

    .product-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .product-item {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.04);
        border-radius: 16px;
        padding: 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .product-item:hover {
        transform: translateY(-2px);
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(99, 102, 241, 0.3);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .product-details {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .product-name {
        font-weight: 600;
        font-size: 1.05rem;
        color: var(--text-primary);
    }

    .product-id {
        font-size: 0.8rem;
        color: var(--text-secondary);
    }

    .product-price {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1.2rem;
        color: #a855f7;
        background: rgba(168, 85, 247, 0.1);
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        border: 1px solid rgba(168, 85, 247, 0.2);
    }

    .empty-state {
        text-align: center;
        padding: 2rem;
        color: var(--text-secondary);
        font-style: italic;
    }

    .action-buttons {
        margin-top: 2rem;
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .btn {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 0.9rem;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.05);
        color: var(--text-primary);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    @keyframes pulse {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
        }
        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }
</style>

<div class="welcome-banner">
    <span class="banner-dot"></span>
    <span><strong>Container:</strong> {{ $greeting }}</span>
</div>

<h2 class="section-title">Products Available</h2>

@if(empty($products))
    <div class="empty-state">
        No products found in the database.
    </div>
@else
    <ul class="product-list">
        @foreach($products as $product)
            <li class="product-item">
                <div class="product-details">
                    <span class="product-name">{{ $product->name }}</span>
                    <span class="product-id">SKU: #00{{ $product->id }}</span>
                </div>
                <span class="product-price">${{ number_format($product->price, 2) }}</span>
            </li>
        @endforeach
    </ul>
@endif

<div class="action-buttons">
    <a href="/mvc-demo/db" target="_blank" class="btn btn-primary">Test Active Record CRUD</a>
    @if(($_ENV['APP_DEBUG'] ?? 'false') === 'true')
        <a href="/migration-demo" class="btn btn-secondary">Migration Panel</a>
    @endif
    <a href="/version" class="btn btn-secondary">System Version</a>
</div>
@endsection
