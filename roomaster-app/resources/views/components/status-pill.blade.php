@props([
    'status' => 'pending', // completed, approved, action, rejected, pending, draft
])

@php
$configs = [
    'completed' => ['bg' => 'bg-primary-500', 'text' => 'text-white', 'icon' => 'check-circle', 'label' => 'Completed'],
    'approved'  => ['bg' => 'bg-green-50', 'text' => 'text-green-500', 'icon' => 'check-circle', 'label' => 'Approved'],
    'action'    => ['bg' => 'bg-secondary-50', 'text' => 'text-secondary-500', 'icon' => 'alert-circle', 'label' => 'Action Required'],
    'rejected'  => ['bg' => 'bg-red-50', 'text' => 'text-red-500', 'icon' => 'x-circle', 'label' => 'Rejected'],
    'pending'   => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-500', 'icon' => 'clock', 'label' => 'Pending'],
    'draft'     => ['bg' => 'bg-primary-50', 'text' => 'text-primary-500', 'icon' => 'file-text', 'label' => 'Draft'],
];

$config = $configs[$status] ?? $configs['pending'];
@endphp

<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium {{ $config['bg'] }} {{ $config['text'] }}">
    <i data-lucide="{{ $config['icon'] }}" class="w-3.5 h-3.5"></i>
    <span>{{ $config['label'] }}</span>
</span>