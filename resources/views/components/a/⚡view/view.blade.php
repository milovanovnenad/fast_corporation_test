
<div class="flex items-center justify-center min-h-[calc(100vh-64px)]">
    <button type="button" class="
        {{ $isActive ? 'bg-blue-500 hover:bg-blue-400' : 'bg-gray-400' }}
        px-40
        py-10
        text-white
        text-4xl
        rounded-full
        cursor-pointer
        transition-colors
        duration-300
        shadow-md
    " wire:click="byACow">{{$label}}</button>
</div>
