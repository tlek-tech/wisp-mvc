@extends('layout')

@section('content')
<style>
    .db-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding-bottom: 1.25rem;
    }

    .db-title-group {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .db-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.6rem;
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .db-driver-badge {
        font-size: 0.75rem;
        background: rgba(99, 102, 241, 0.15);
        color: #818cf8;
        border: 1px solid rgba(99, 102, 241, 0.3);
        padding: 0.2rem 0.6rem;
        border-radius: 999px;
        align-self: flex-start;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Grid of status cards */
    .status-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2.25rem;
    }

    .status-card {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .status-card:hover {
        background: rgba(255, 255, 255, 0.04);
        border-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .status-label {
        font-size: 0.8rem;
        color: var(--text-secondary);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .status-value {
        font-family: 'Outfit', sans-serif;
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(to right, #fff, #9ca3af);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .status-value.accent {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Migration creation form */
    .action-panel {
        background: rgba(255, 255, 255, 0.01);
        border: 1px dashed rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 2.25rem;
    }

    .panel-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #f3f4f6;
    }

    .create-form {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
    }

    .input-field {
        flex: 1;
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        color: white;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.25s ease;
    }

    .input-field:focus {
        border-color: #6366f1;
        box-shadow: 0 0 10px rgba(99, 102, 241, 0.15);
    }

    .btn {
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
    }

    .btn-primary {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(99, 102, 241, 0.35);
    }

    .btn-danger {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .btn-danger:hover {
        background: rgba(239, 68, 68, 0.18);
        border-color: rgba(239, 68, 68, 0.35);
        transform: translateY(-1px);
    }

    .btn-success {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .btn-success:hover {
        background: rgba(16, 185, 129, 0.18);
        border-color: rgba(16, 185, 129, 0.35);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.05);
        color: var(--text-primary);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .action-row {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        padding-top: 1rem;
    }

    /* Migrations Table */
    .migration-section-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #f3f4f6;
    }

    .table-container {
        overflow-x: auto;
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.06);
        background: rgba(255, 255, 255, 0.005);
    }

    .migration-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.9rem;
    }

    .migration-table th {
        background: rgba(255, 255, 255, 0.03);
        padding: 1rem 1.25rem;
        font-weight: 600;
        color: #f3f4f6;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }

    .migration-table td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        color: #e5e7eb;
    }

    .migration-table tr:last-child td {
        border-bottom: none;
    }

    .migration-name-cell {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
    }

    .migration-filename {
        font-weight: 500;
        word-break: break-all;
    }

    .migration-timestamp {
        font-size: 0.75rem;
        color: var(--text-secondary);
    }

    /* Badges */
    .badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.6rem;
        border-radius: 999px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .badge-success {
        background: rgba(16, 185, 129, 0.1);
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, 0.25);
    }

    .badge-pending {
        background: rgba(168, 85, 247, 0.1);
        color: #c084fc;
        border: 1px solid rgba(168, 85, 247, 0.25);
    }

    .badge-batch {
        background: rgba(255, 255, 255, 0.06);
        color: #e5e7eb;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 0.15rem 0.45rem;
        font-size: 0.7rem;
    }

    .empty-row-state {
        text-align: center !important;
        padding: 2.5rem !important;
        color: var(--text-secondary);
        font-style: italic;
    }

    /* Toast Notification system */
    .toast-container {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        z-index: 100;
    }

    .toast {
        background: rgba(22, 28, 36, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 1rem 1.5rem;
        border-radius: 14px;
        color: white;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 280px;
        max-width: 400px;
        transform: translateY(20px);
        opacity: 0;
        animation: toastIn 0.3s forwards cubic-bezier(0.16, 1, 0.3, 1);
        transition: all 0.3s ease;
    }

    .toast.success {
        border-left: 4px solid #10b981;
    }

    .toast.error {
        border-left: 4px solid #ef4444;
    }

    .toast.info {
        border-left: 4px solid #3b82f6;
    }

    @keyframes toastIn {
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .toast-hide {
        transform: scale(0.9) translateY(10px);
        opacity: 0 !important;
    }
</style>

<div class="db-header">
    <div class="db-title-group">
        <h2 class="db-title">Migration Panel</h2>
        <span class="db-driver-badge">Driver: {{ $driver }}</span>
    </div>
    <a href="/mvc-demo" class="btn btn-secondary">&larr; Back to Demo</a>
</div>

<?php
$total = count($status);
$applied = count(array_filter($status, fn($s) => $s['applied']));
$pending = $total - $applied;
?>

<div class="status-grid">
    <div class="status-card">
        <span class="status-label">Total Migrations</span>
        <span class="status-value">{{ $total }}</span>
    </div>
    <div class="status-card">
        <span class="status-label">Applied</span>
        <span class="status-value accent">{{ $applied }}</span>
    </div>
    <div class="status-card">
        <span class="status-label">Pending</span>
        <span class="status-value">{{ $pending }}</span>
    </div>
</div>

<div class="action-panel">
    <div class="panel-title">Developer Operations</div>
    
    <form id="create-form" class="create-form" onsubmit="createMigration(event)">
        <input type="text" id="migration-name" class="input-field" placeholder="create_users_table" required autocomplete="off">
        <button type="submit" id="create-btn" class="btn btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Create File
        </button>
    </form>
    
    <div class="action-row">
        <button onclick="rollbackLast()" id="rollback-btn" class="btn btn-danger" {{ $applied === 0 ? 'disabled' : '' }}>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><polyline points="3 3 3 8 8 8"></polyline></svg>
            Rollback Batch
        </button>
        <button onclick="runPending()" id="run-btn" class="btn btn-success" {{ $pending === 0 ? 'disabled' : '' }}>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
            Run Migrations
        </button>
    </div>
</div>

<h3 class="migration-section-title">Migrations History</h3>
<div class="table-container">
    <table class="migration-table">
        <thead>
            <tr>
                <th>Migration File</th>
                <th>Status</th>
                <th>Batch</th>
                <th>Applied At</th>
            </tr>
        </thead>
        <tbody id="migrations-body">
            @if(empty($status))
                <tr>
                    <td colspan="4" class="empty-row-state">No migration files found in database/migrations/</td>
                </tr>
            @else
                @foreach($status as $s)
                    <?php
                    // Extract name and timestamp for pretty visual display
                    $filename = $s['migration'];
                    $parts = explode('_', $filename, 5);
                    $timestamp = "";
                    $displayName = $filename;
                    if (count($parts) >= 5 && is_numeric($parts[0])) {
                        $timestamp = "{$parts[0]}/{$parts[1]}/{$parts[2]} {$parts[3]}";
                        $displayName = $parts[4];
                    }
                    ?>
                    <tr>
                        <td>
                            <div class="migration-name-cell">
                                <span class="migration-filename">{{ $displayName }}</span>
                                <span class="migration-timestamp">{{ $filename }}.php</span>
                            </div>
                        </td>
                        <td>
                            @if($s['applied'])
                                <span class="badge badge-success">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    Applied
                                </span>
                            @else
                                <span class="badge badge-pending">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($s['applied'])
                                <span class="badge badge-batch">Batch {{ $s['batch'] }}</span>
                            @else
                                <span class="text-secondary">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-secondary">{{ $s['applied_at'] ?? '-' }}</span>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<div class="toast-container" id="toast-container"></div>

<script>
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        
        let icon = '';
        if (type === 'success') {
            icon = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>`;
        } else if (type === 'error') {
            icon = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>`;
        } else {
            icon = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>`;
        }
        
        toast.innerHTML = `${icon} <span>${message}</span>`;
        container.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('toast-hide');
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }

    async function runPending() {
        const btn = document.getElementById('run-btn');
        btn.disabled = true;
        showToast('Executing pending migrations...', 'info');

        try {
            const response = await fetch('/migration-demo/run', { method: 'POST' });
            const result = await response.json();
            
            if (result.status === 'success') {
                showToast(result.message, 'success');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showToast(result.message || 'Failed to run migrations.', 'error');
                btn.disabled = false;
            }
        } catch (e) {
            showToast('Network error occurred.', 'error');
            btn.disabled = false;
        }
    }

    async function rollbackLast() {
        const btn = document.getElementById('rollback-btn');
        btn.disabled = true;
        showToast('Rolling back last batch...', 'info');

        try {
            const response = await fetch('/migration-demo/rollback', { method: 'POST' });
            const result = await response.json();
            
            if (result.status === 'success') {
                showToast(result.message, 'success');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showToast(result.message || 'Failed to rollback.', 'error');
                btn.disabled = false;
            }
        } catch (e) {
            showToast('Network error occurred.', 'error');
            btn.disabled = false;
        }
    }

    async function createMigration(event) {
        event.preventDefault();
        
        const input = document.getElementById('migration-name');
        const btn = document.getElementById('create-btn');
        const name = input.value.trim();
        
        if (!name) return;
        
        btn.disabled = true;
        showToast('Creating migration file...', 'info');

        try {
            const response = await fetch('/migration-demo/create', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name })
            });
            const result = await response.json();
            
            if (result.status === 'success') {
                showToast(result.message + ' (' + result.data.filename + ')', 'success');
                input.value = '';
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showToast(result.message || 'Failed to create migration.', 'error');
                btn.disabled = false;
            }
        } catch (e) {
            showToast('Network error occurred.', 'error');
            btn.disabled = false;
        }
    }
</script>
@endsection
