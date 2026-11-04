{{-- Banner status lebar penuh + versi ikon bulat (circle="true").
     Contoh: <x-status_banner status="upcoming" updated="2h ago" /> --}}
@props(['status' => 'pending', 'updated' => null, 'circle' => false])
@php
$map = [
  'completed'       => ['Completed',       'bg-primary-500 text-white',          'text-white/80',           'check-circle'],
  'approved'        => ['Approved',        'bg-success-50 text-success-500',     'text-success-400',        'check-circle'],
  'action_required' => ['Action Required', 'bg-secondary-50 text-secondary-500', 'text-secondary-300',      'alert-circle'],
  'rejected'        => ['Rejected',        'bg-danger-50 text-danger-500',       'text-danger-300',         'x'],
  'pending'         => ['Pending',         'bg-warning-50 text-warning-500',     'text-warning-300',        'clock'],
  'draft'           => ['Draft',           'bg-primary-50 text-primary-500',     'text-primary-500/70',     'file'],
  'upcoming'        => ['Upcoming',        'bg-secondary-500 text-white',        'text-white/80',           'door-open'],
];
[$label, $cls, $muted, $icon] = $map[$status] ?? $map['pending'];
@endphp
@if($circle)
  <span {{ $attributes->class(['inline-flex size-12 items-center justify-center rounded-full', $cls]) }}>
    <x-icon :name="$icon" :size="24" />
  </span>
@else
  <div {{ $attributes->class(['flex items-center justify-between rounded-xl px-3 py-3', $cls]) }}>
    <div class="flex items-center gap-2 text-[14px] leading-5 font-semibold">
      <x-icon :name="$icon" :size="20" /> Status: {{ $label }}
    </div>
    @if($updated)<span class="text-[12px] leading-4 {{ $muted }}">Updated {{ $updated }}</span>@endif
  </div>
@endif
