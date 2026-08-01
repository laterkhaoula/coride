@props(['minHeight' => 'min-h-[260px]'])

<div class="relative overflow-hidden rounded-xl border border-slate-200 {{ $minHeight }} flex items-center">
    <svg viewBox="0 0 700 260" preserveAspectRatio="xMidYMid slice" class="absolute inset-0 w-full h-full" aria-hidden="true">
        <rect x="0" y="0" width="700" height="150" fill="#64748B" />
        <rect x="0" y="150" width="700" height="110" fill="#1E293B" />
        <rect x="0" y="142" width="700" height="8" fill="#334155" />
        <rect x="20" y="196" width="60" height="8" fill="#E2E8F0" />
        <rect x="140" y="196" width="60" height="8" fill="#E2E8F0" />
        <rect x="260" y="196" width="60" height="8" fill="#E2E8F0" />
        <rect x="380" y="196" width="60" height="8" fill="#E2E8F0" />
        <rect x="500" y="196" width="60" height="8" fill="#E2E8F0" />
        <rect x="620" y="196" width="60" height="8" fill="#E2E8F0" />
        <circle cx="640" cy="45" r="20" fill="#94A3B8" />
        <g>
            <rect x="500" y="176" width="72" height="28" rx="6" fill="#2563EB" />
            <rect x="512" y="164" width="38" height="18" rx="4" fill="#2563EB" />
            <circle cx="518" cy="204" r="9" fill="#0F172A" />
            <circle cx="558" cy="204" r="9" fill="#0F172A" />
        </g>
        <g>
            <rect x="230" y="216" width="60" height="24" rx="5" fill="#0F172A" />
            <rect x="240" y="205" width="32" height="14" rx="3" fill="#0F172A" />
            <circle cx="246" cy="240" r="8" fill="#1E293B" />
            <circle cx="282" cy="240" r="8" fill="#1E293B" />
        </g>
    </svg>

    <div class="absolute inset-0 bg-slate-900/60"></div>

    <div class="relative z-10 p-8 sm:p-12 max-w-2xl text-white">
        {{ $slot }}
    </div>
</div>
