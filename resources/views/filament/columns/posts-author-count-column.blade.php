@php
use App\Models\Post;
@endphp

    <div @class([
        'inline-flex items-center justify-center space-x-1 rtl:space-x-reverse min-h-6 px-2 py-0.5 text-sm font-medium tracking-tight rounded-xl whitespace-nowrap',
        'text-primary-700 bg-primary-500/10', 'dark:text-primary-500',
    ])>
        
            <x-dynamic-component component="heroicon-o-x" class="heroicon-o-truck" />

        <span>
            {{ Post::where('author_id', $getRecord()->id)->count() }}
        </span>

            <x-dynamic-component  component="heroicon-o-x" class="heroicon-o-truck" />
    </div>
</div>

