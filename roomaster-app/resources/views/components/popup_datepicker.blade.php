{{-- Modal Choose Date (bottom sheet). Hidden input name="date" berisi YYYY-MM-DD. --}}
@props(['id' => 'popup-datepicker', 'open' => false, 'name' => 'date', 'action' => '#'])
<x-popup :id="$id" :open="$open" :sheet="true">
  <form action="{{ $action }}" method="GET">
    <div class="flex items-center justify-between text-primary-500">
      <x-icon name="calendar" :size="24" />
      <span class="text-[16px] leading-6 font-semibold text-grey-800">Choose Date</span>
      <button type="button" data-popup-close aria-label="Tutup"><x-icon name="x" :size="24" /></button>
    </div>

    <div class="mt-3 border-t border-grey-200 pt-4">
      <div class="flex items-center justify-between text-primary-500">
        <button type="button" data-prev aria-label="Bulan sebelumnya"><x-icon name="chevron-left" :size="20" /></button>
        <span data-month class="text-[16px] leading-6 font-medium text-grey-800"></span>
        <button type="button" data-next aria-label="Bulan berikutnya"><x-icon name="chevron-right" :size="20" /></button>
      </div>

      <div class="mt-3 grid grid-cols-7 text-center text-[14px] leading-5 font-medium text-primary-500">
        @foreach(['S', 'M', 'T', 'W', 'T', 'F', 'S'] as $d)
          <span class="flex h-[34px] items-center justify-center">{{ $d }}</span>
        @endforeach
      </div>
      <div data-days class="grid grid-cols-7 text-center text-[14px] leading-5 font-medium"></div>
    </div>

    <input type="hidden" name="{{ $name }}" value="">
    <x-button type="submit" variant="primary" size="medium" class="mt-2 w-full">Apply</x-button>
  </form>
</x-popup>

<script>
  (function () {
    var root = document.getElementById('{{ $id }}'); if (!root) return;
    var M = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    var label = root.querySelector('[data-month]');
    var grid = root.querySelector('[data-days]');
    var input = root.querySelector('input[type=hidden]');
    var now = new Date();
    var cur = new Date(now.getFullYear(), now.getMonth(), 1);
    var picked = null;
    function iso(d) { return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0'); }
    function draw() {
      label.textContent = M[cur.getMonth()];
      var first = cur.getDay();
      var total = new Date(cur.getFullYear(), cur.getMonth() + 1, 0).getDate();
      var rows = Math.ceil((first + total) / 7);
      grid.innerHTML = '';
      for (var i = 0; i < rows * 7; i++) {
        var d = new Date(cur.getFullYear(), cur.getMonth(), 1 - first + i);
        var b = document.createElement('button');
        var other = d.getMonth() !== cur.getMonth();
        var sel = picked === iso(d);
        b.type = 'button'; b.textContent = d.getDate(); b.dataset.date = iso(d);
        b.className = 'mx-auto flex size-[34px] items-center justify-center rounded-full ' +
          (sel ? 'bg-primary-800 text-white' : (other ? 'text-grey-400' : 'text-grey-800'));
        grid.appendChild(b);
      }
    }
    root.addEventListener('click', function (e) {
      var t = e.target.closest('button'); if (!t) return;
      if (t.hasAttribute('data-prev')) { cur = new Date(cur.getFullYear(), cur.getMonth() - 1, 1); draw(); }
      else if (t.hasAttribute('data-next')) { cur = new Date(cur.getFullYear(), cur.getMonth() + 1, 1); draw(); }
      else if (t.dataset.date) { picked = t.dataset.date; input.value = picked; draw(); }
    });
    draw();
  })();
</script>
