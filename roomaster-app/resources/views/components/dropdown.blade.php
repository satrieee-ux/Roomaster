{{-- Dropdown kustom. options: array string, atau array ['value'=>..,'label'=>..].
     <x-dropdown name="department" :options="$list" :value="$selected" placeholder="Select" />
     Nilai terpilih disimpan di <input type="hidden" name="..."> (ikut terkirim bersama form). --}}
@props(['name', 'options' => [], 'value' => null, 'placeholder' => 'Select', 'id' => null])
@php
$id   = $id ?? 'dd-'.$name;
$opts = collect($options)->map(fn ($o) => is_array($o) ? $o : ['value' => $o, 'label' => $o])->values()->all();
$cur  = collect($opts)->firstWhere('value', $value);
@endphp

<div {{ $attributes->class(['relative']) }} data-dropdown>
  <input type="hidden" name="{{ $name }}" value="{{ $value }}" data-dd-input>

  <button type="button" id="{{ $id }}" aria-haspopup="listbox" aria-expanded="false" data-dd-trigger
          class="flex h-[46px] w-full items-center justify-between gap-3 rounded-xl border border-grey-200 bg-grey-50 px-3 text-left shadow-[0_1px_2px_rgba(20,26,40,0.04)] outline-none focus-visible:border-primary-500">
    <span data-dd-label class="min-w-0 flex-1 truncate text-[16px] leading-6 font-normal text-grey-800">{{ $cur['label'] ?? $placeholder }}</span>
    <span data-dd-chevron class="shrink-0 text-grey-500 transition-transform duration-200"><x-icon name="chevron-down" :size="24" /></span>
  </button>

  <ul role="listbox" aria-labelledby="{{ $id }}" data-dd-panel
      class="no-scrollbar invisible absolute inset-x-0 top-full z-40 mt-1 max-h-[232px] -translate-y-1 overflow-y-auto rounded-xl border border-grey-200 bg-white p-1 opacity-0 shadow-[0_8px_24px_rgba(20,26,40,0.12)] transition duration-150 ease-out">
    @foreach($opts as $o)
      <li role="option" aria-selected="{{ $o['value'] === $value ? 'true' : 'false' }}">
        <button type="button" data-dd-option data-value="{{ $o['value'] }}" data-label="{{ $o['label'] }}"
                class="flex min-h-11 w-full items-center justify-between gap-2 rounded-lg px-3 py-2 text-left text-[14px] leading-5 font-medium text-grey-800 hover:bg-grey-100">
          <span>{{ $o['label'] }}</span>
          <span data-dd-check @class(['shrink-0 text-primary-500', 'hidden' => $o['value'] !== $value])><x-icon name="check" :size="18" /></span>
        </button>
      </li>
    @endforeach
  </ul>
</div>

@once
<script>
  (function () {
    function setOpen(dd, open) {
      var panel = dd.querySelector('[data-dd-panel]');
      panel.classList.toggle('invisible', !open);
      panel.classList.toggle('opacity-0', !open);
      panel.classList.toggle('-translate-y-1', !open);
      panel.classList.toggle('opacity-100', open);
      panel.classList.toggle('translate-y-0', open);
      dd.querySelector('[data-dd-chevron]').classList.toggle('rotate-180', open);
      dd.querySelector('[data-dd-trigger]').setAttribute('aria-expanded', open ? 'true' : 'false');
      dd.querySelector('[data-dd-trigger]').classList.toggle('border-primary-500', open);
      dd.dataset.open = open ? '1' : '0';
    }
    document.addEventListener('click', function (e) {
      var trigger = e.target.closest('[data-dd-trigger]');
      var option = e.target.closest('[data-dd-option]');
      document.querySelectorAll('[data-dropdown]').forEach(function (dd) {
        if (trigger && dd.contains(trigger)) {
          setOpen(dd, dd.dataset.open !== '1');
        } else if (option && dd.contains(option)) {
          var input = dd.querySelector('[data-dd-input]');
          input.value = option.dataset.value;
          dd.querySelector('[data-dd-label]').textContent = option.dataset.label;
          dd.querySelectorAll('[data-dd-option]').forEach(function (o) {
            o.querySelector('[data-dd-check]').classList.toggle('hidden', o !== option);
          });
          input.dispatchEvent(new Event('change', { bubbles: true }));
          setOpen(dd, false);
        } else {
          setOpen(dd, false);
        }
      });
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') document.querySelectorAll('[data-dropdown]').forEach(function (dd) { setOpen(dd, false); });
    });
  })();
</script>
@endonce
