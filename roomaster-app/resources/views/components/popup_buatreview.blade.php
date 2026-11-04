{{-- Pop-up Rate & Review. Bintang interaktif. --}}
@props(['id' => 'popup-buatreview', 'open' => false, 'submitUrl' => '#'])
<x-popup :id="$id" :open="$open" title="Rate & Review">
  <x-slot:body>Keep your messages short, but make sure they cover everything you need to say.</x-slot:body>

  <form action="{{ $submitUrl }}" method="POST">
    @csrf
    <div class="flex justify-center gap-1.5" data-rating>
      @for($i = 1; $i <= 5; $i++)
        <button type="button" data-star="{{ $i }}" aria-label="{{ $i }} bintang" class="text-grey-400">
          <x-icon name="star" :size="36" class="fill-current" />
        </button>
      @endfor
    </div>
    <input type="hidden" name="rating" value="0">

    <textarea name="komentar" rows="8" placeholder="Fill your review here.."
      class="mt-5 h-[222px] w-full resize-none rounded-xl border border-grey-200 bg-white p-3 text-[14px] leading-5 font-normal text-grey-800 outline-none placeholder:text-grey-400"></textarea>

    <div class="mt-6 flex gap-4">
      <x-button href="#" variant="outline" size="large" class="flex-1" data-popup-close>Cancel</x-button>
      <x-button type="submit" variant="primary" size="large" class="flex-1">Post</x-button>
    </div>
  </form>
</x-popup>

<script>
  document.querySelectorAll('#{{ $id }} [data-rating]').forEach(function (box) {
    var input = box.parentElement.querySelector('input[name="rating"]');
    box.addEventListener('click', function (e) {
      var btn = e.target.closest('[data-star]'); if (!btn) return;
      var n = +btn.dataset.star; input.value = n;
      box.querySelectorAll('[data-star]').forEach(function (b) {
        var on = +b.dataset.star <= n;
        b.classList.toggle('text-secondary-300', on); b.classList.toggle('text-grey-400', !on);
      });
    });
  });
</script>
