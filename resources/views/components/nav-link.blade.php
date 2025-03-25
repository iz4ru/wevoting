@props(['active' => false])

<a {{ $attributes->merge([
    'class' => request()->routeIs(['voter.dashboard', 'voter.candidate.preview']) 
        ? 'bg-[#FFB300] text-white drop-shadow-xl rounded-e-lg' 
        : ($active 
            ? 'bg-[#7644D9] text-white drop-shadow-xl rounded-e-lg' 
            : 'bg-[#E3E3E3]/50 hover:bg-[#C1C1C1]/50 text-[#718295] border-white')
]) }}>
    {{ $slot }}
</a>

