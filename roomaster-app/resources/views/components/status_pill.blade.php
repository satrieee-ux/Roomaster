{{-- Pill status kecil. status: completed|draft|approved|action_required|pending|rejected|upcoming
     Draft  = request dibuat tapi ditinggal sebelum selesai (biru, ikon file).
     Upcoming = booking sudah dibuat, sesi akan segera dimulai (oranye, ikon pintu). --}}
@props(['status' => 'pending'])
@php
$map = [
  'completed'       => ['Completed',       'bg-primary-500 text-white',            'check-circle'],
  'draft'           => ['Draft',           'bg-primary-50 text-primary-500',       'file'],
  'approved'        => ['Approved',        'bg-success-50 text-success-500',       'check-circle'],
  'action_required' => ['Action Required', 'bg-secondary-50 text-secondary-500',   'alert-circle'],
  'pending'         => ['Pending',         'bg-warning-50 text-warning-500',       'clock'],
  'rejected'        => ['Rejected',        'bg-danger-50 text-danger-500',         'x'],
  'upcoming'        => ['Upcoming',        'bg-secondary-500 text-white',          'door-open'],
];
[$label, $cls, $icon] = $map[$status] ?? $map['pending'];
@endphp
<span {{ $attributes->class(['inline-flex items-center gap-1 whitespace-nowrap rounded-[20px] px-2 py-1 text-[10px] leading-[14px] font-medium', $cls]) }}>
  <x-icon :name="$icon" :size="12" />
  {{ $slot->isEmpty() ? $label : $slot }}
</span>
