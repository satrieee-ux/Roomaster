{{-- Sheet "Choose Date" untuk form booking. Dibuka lewat data-popup-open="popup-tanggal".
     Apply mengisi input[name=date], teks tanggal, dan mengaktifkan tombol Check Availability. --}}
@props(['id' => 'popup-tanggal', 'value' => null, 'open' => false])

@once
<style>
  @keyframes sheet-up   { from { transform: translateY(100%); } to { transform: translateY(0); } }
  @keyframes sheet-fade { from { opacity: 0; } to { opacity: 1; } }
  #popup-tanggal, #popup-waktu, [role="dialog"].items-end { animation: sheet-fade .2s ease-out; }
  #popup-tanggal > div:last-child, #popup-waktu > div:last-child, [role="dialog"].items-end > div:last-child {
    animation: sheet-up .3s cubic-bezier(.22, 1, .36, 1);
  }
</style>
@endonce

<x-popup :id="$id" :open="$open" :sheet="true">
  <div data-cal data-value="{{ $value }}" class="pb-2">
    <div class="relative flex items-center justify-center border-b border-grey-200 pb-3">
      <x-icon name="calendar" :size="24" class="absolute left-0 text-primary-500" />
      <span class="text-[16px] leading-6 font-medium text-grey-800">Choose Date</span>
      <button type="button" data-popup-close aria-label="Tutup" class="absolute right-0 text-primary-500"><x-icon name="x" :size="24" /></button>
    </div>

    <div class="mt-3 flex items-center justify-between px-3">
      <button type="button" data-cal-prev aria-label="Bulan sebelumnya" class="flex size-8 items-center justify-center text-primary-500"><x-icon name="chevron-left" :size="20" /></button>
      <span data-cal-month class="text-[16px] leading-6 font-medium text-grey-800"></span>
      <button type="button" data-cal-next aria-label="Bulan berikutnya" class="flex size-8 items-center justify-center text-primary-500"><x-icon name="chevron-right" :size="20" /></button>
    </div>

    <div class="mt-2 grid grid-cols-7 px-3 text-center text-[14px] leading-5 font-medium text-primary-500">
      @foreach(['S', 'M', 'T', 'W', 'T', 'F', 'S'] as $dn)
        <span class="flex h-[34px] items-center justify-center">{{ $dn }}</span>
      @endforeach
    </div>
    <div data-cal-grid class="grid grid-cols-7 px-3"></div>

    <x-button type="button" variant="primary" size="medium" class="mt-2 w-full" data-cal-apply>Apply</x-button>
  </div>
</x-popup>

<script>
  (function () {
    var root = document.getElementById('{{ $id }}');
    if (!root) return;
    var box = root.querySelector('[data-cal]'),
        grid = box.querySelector('[data-cal-grid]'),
        label = box.querySelector('[data-cal-month]'),
        months = ['January','February','March','April','May','June','July','August','September','October','November','December'],
        p2 = function (n) { return ('0' + n).slice(-2); },
        iso = function (d) { return d.getFullYear() + '-' + p2(d.getMonth() + 1) + '-' + p2(d.getDate()); },
        sel = box.dataset.value || '',
        base = sel ? new Date(sel + 'T00:00:00') : new Date(),
        y = base.getFullYear(), m = base.getMonth();

    function render() {
      label.textContent = months[m];
      grid.innerHTML = '';
      var first = new Date(y, m, 1).getDay(), days = new Date(y, m + 1, 0).getDate(), prev = new Date(y, m, 0).getDate();
      var total = Math.ceil((first + days) / 7) * 7;
      for (var i = 0; i < total; i++) {
        var d = i - first + 1, inMonth = d >= 1 && d <= days, n = inMonth ? d : (d < 1 ? prev + d : d - days);
        var v = iso(new Date(y, m, d)), on = inMonth && v === sel;
        var b = document.createElement('button'), s = document.createElement('span');
        b.type = 'button';
        b.className = 'flex h-[34px] items-center justify-center';
        s.className = 'flex size-8 items-center justify-center rounded-full text-[14px] leading-5 font-medium ' +
          (on ? 'bg-primary-900 text-white' : (inMonth ? 'text-grey-800' : 'text-grey-400'));
        s.textContent = n;
        b.appendChild(s);
        if (inMonth) { b.addEventListener('click', (function (val) { return function () { sel = val; render(); }; })(v)); }
        else { b.disabled = true; }
        grid.appendChild(b);
      }
    }

    box.querySelector('[data-cal-prev]').addEventListener('click', function () { m--; if (m < 0) { m = 11; y--; } render(); });
    box.querySelector('[data-cal-next]').addEventListener('click', function () { m++; if (m > 11) { m = 0; y++; } render(); });

    box.querySelector('[data-cal-apply]').addEventListener('click', function () {
      if (!sel) return;
      var d = new Date(sel + 'T00:00:00');
      var f = document.getElementById('booking-form');
      var inp = f && f.querySelector('input[name=date]');
      if (inp) inp.value = sel;
      document.querySelectorAll('[data-date-text]').forEach(function (t) {
        t.textContent = p2(d.getDate()) + '/' + p2(d.getMonth() + 1) + '/' + String(d.getFullYear()).slice(-2);
        t.classList.remove('text-grey-500'); t.classList.add('text-grey-800');
      });
      document.querySelectorAll('[data-date-label]').forEach(function (e) {
        e.textContent = d.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
      });
      document.querySelectorAll('[data-ca-on]').forEach(function (b) { b.classList.remove('hidden'); });
      document.querySelectorAll('[data-ca-off]').forEach(function (b) { b.classList.add('hidden'); });
      root.classList.add('hidden');
    });

    render();
  })();
</script>
