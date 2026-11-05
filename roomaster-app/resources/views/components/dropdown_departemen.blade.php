{{-- Dropdown pilih departemen. <x-dropdown_departemen name="department" :value="$department" /> --}}
@props(['name' => 'department', 'value' => null, 'placeholder' => 'Select'])
@php
$departments = [
  'Departemen Sistem Informasi',
  'Departemen Teknik Informatika',
  'Departemen Teknik Elektro',
  'Departemen Teknik Mesin',
  'Departemen Teknik Sipil',
  'Departemen Teknik Industri',
  'Departemen Teknik Kimia',
  'Departemen Arsitektur',
  'Departemen Matematika',
  'Departemen Perencanaan Wilayah dan Kota',
];
@endphp
<x-dropdown :name="$name" :options="$departments" :value="$value" :placeholder="$placeholder" {{ $attributes }} />
