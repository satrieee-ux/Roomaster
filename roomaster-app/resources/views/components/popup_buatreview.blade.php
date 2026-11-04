{{-- Pop-up Review & Rating (bottom sheet). Bintang interaktif via JS ringan di bawah. --}}
@props(['id' => 'popup-buatreview', 'open' => true, 'room' => '', 'submitUrl' => '#', 'closeUrl' => '#'])
<x-popup :id="$id" :open="$open" :sheet="true" title="Bagaimana ruangannya?" :message="$room ? 'Beri penilaian untuk '.$room : null">
  <form action="{{ $submitUrl }}" method="POST">
    @csrf
    <div class="flex justify-center gap-2" data-rating>
      @for($i = 1; $i <= 5; $i++)
        <button type="button" data-star="{{ $i }}" aria-label="{{ $i }} bintang" class="text-grey-300">
          <x-icon name="star" :size="36" />
        </button>
      @endfor
    </div>
    <input type="hidden" name="rating" value="0">
    <textarea name="komentar" rows="3" placeholder="Tulis ulasan Anda..."
      class="mt-4 w-full resize-none rounded-2xl bg-grey-100 p-4 text-[14px] leading-5 font-normal text-grey-900 outline-none placeholder:text-grey-400 focus:ring-2 focus:ring-primary-50"></textarea>
    <div class="mt-5 flex gap-3">
      <x-button :href="$closeUrl" variant="outline" class="flex-1">Skip</x-button>
      <x-button type="submit" class="flex-1">Submit</x-button>
    </div>
  </form>
</x-popup>
<script>
  document.querySelectorAll('[data-rating]').forEach(function (box) {
    var input = box.parentElement.querySelector('input[name="rating"]');
    box.addEventListener('click', function (e) {
      var btn = e.target.closest('[data-star]'); if (!btn) return;
      var n = +btn.dataset.star; input.value = n;
      box.querySelectorAll('[data-star]').forEach(function (b) {
        var on = +b.dataset.star <= n;
        b.classList.toggle('text-warning-500', on); b.classList.toggle('text-grey-300', !on);
        b.firstElementChild.setAttribute('fill', on ? 'currentColor' : 'none');
      });
    });
  });
</script>
