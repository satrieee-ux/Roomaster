{{-- Slot unggah berkas: kotak "Upload File" ↔ kartu berkas. file: null | ['name'=>'..','size'=>'1.2 MB'].
     Saat semua slot terisi, tombol Continue di component_bookdocbar otomatis aktif. --}}
@props(['label', 'name', 'file' => null])

<div {{ $attributes->class(['flex flex-col gap-2.5']) }} data-doc>
  <span class="text-[14px] leading-5 font-semibold text-grey-800">{{ $label }}</span>

  <label data-doc-drop @class([
    'flex h-[46px] cursor-pointer items-center justify-center gap-2 rounded-xl border border-grey-200 bg-grey-50 text-[16px] leading-6 font-medium text-grey-500',
    'hidden' => $file,
  ])>
    <x-icon name="upload" :size="20" /> Upload File
    <input type="file" name="{{ $name }}" accept=".pdf,.jpg,.jpeg,.png" class="sr-only" data-doc-input>
  </label>

  <x-file_card :name="$file['name'] ?? ''" :size="$file['size'] ?? ''" :class="$file ? '' : 'hidden'" data-doc-card />
</div>

@once
<script>
  (function () {
    function refresh() {
      var docs = document.querySelectorAll('[data-doc]');
      if (!docs.length) return;
      var all = true;
      docs.forEach(function (d) {
        if (d.querySelector('[data-doc-card]').classList.contains('hidden')) all = false;
      });
      document.querySelectorAll('[data-docbar-on]').forEach(function (b) { b.classList.toggle('hidden', !all); });
      document.querySelectorAll('[data-docbar-off]').forEach(function (b) { b.classList.toggle('hidden', all); });
    }
    document.addEventListener('change', function (e) {
      var inp = e.target.closest && e.target.closest('[data-doc-input]');
      if (!inp || !inp.files[0]) return;
      var d = inp.closest('[data-doc]'), f = inp.files[0];
      d.querySelector('[data-doc-name]').textContent = f.name;
      d.querySelector('[data-doc-size]').textContent = (f.size / 1048576).toFixed(1) + ' MB';
      d.querySelector('[data-doc-drop]').classList.add('hidden');
      d.querySelector('[data-doc-card]').classList.remove('hidden');
      refresh();
    });
    document.addEventListener('click', function (e) {
      var b = e.target.closest && e.target.closest('[data-doc-remove]');
      if (!b) return;
      var d = b.closest('[data-doc]');
      if (!d) return;
      d.querySelector('[data-doc-input]').value = '';
      d.querySelector('[data-doc-card]').classList.add('hidden');
      d.querySelector('[data-doc-drop]').classList.remove('hidden');
      refresh();
    });
  })();
</script>
@endonce
