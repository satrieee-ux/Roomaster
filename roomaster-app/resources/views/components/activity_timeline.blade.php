{{-- Timeline aktivitas. items: [['icon'=>'check','state'=>'done|current|todo','title'=>'..','desc'=>'..'], ...] --}}
@props(['items' => []])

<div {{ $attributes->class(['flex flex-col']) }}>
  @foreach($items as $a)
    @php $s = $a['state'] ?? 'todo'; @endphp
    <div @class(['relative flex items-center gap-3', 'pb-8' => ! $loop->last])>
      <span @class([
        'z-10 flex size-12 shrink-0 items-center justify-center rounded-full',
        'bg-primary-900 text-white' => $s === 'done',
        'border border-grey-600 bg-white text-grey-800' => $s === 'current',
        'bg-grey-200 text-grey-400' => $s === 'todo',
      ])>
        <x-icon :name="$a['icon']" :size="20" />
      </span>
      @unless($loop->last)
        <span class="absolute left-6 top-12 h-8 w-0.5 -translate-x-1/2 bg-grey-300"></span>
      @endunless
      <div class="flex min-w-0 flex-col">
        <span @class(['text-[14px] leading-5 font-semibold', 'text-grey-800' => $s !== 'todo', 'text-grey-500' => $s === 'todo'])>{{ $a['title'] }}</span>
        <span class="text-[12px] leading-4 font-medium text-grey-500">{{ $a['desc'] }}</span>
      </div>
    </div>
  @endforeach
</div>
