{{--
    Popup konfirmasi. layout="row" (tombol sejajar) | "stack" (tombol bertumpuk)
--}}
@props(['id', 'title' => '', 'message' => '', 'layout' => 'row'])

<x-modal :id="$id" :labelledby="$id.'-title'" class="bg-grey-50 p-xl text-center">
    <h2 id="{{ $id }}-title" class="text-s2 text-grey-900">{{ $title }}</h2>
    @if($message)
        <p class="mt-1 text-b3 text-grey-500">{{ $message }}</p>
    @endif
    <div class="mt-lg {{ $layout === 'stack' ? 'flex flex-col gap-xs' : 'flex gap-sm' }}">
        {{ $slot }}
    </div>
</x-modal>
