<svg viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <!-- Dome Base Shadow / Glow -->
    <defs>
        <radialGradient id="gold-glow" cx="50%" cy="50%" r="50%">
            <stop offset="0%" stop-color="#fef08a" stop-opacity="0.3"/>
            <stop offset="100%" stop-color="#d97706" stop-opacity="0"/>
        </radialGradient>
        <linearGradient id="emerald-grad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#065f46" />
            <stop offset="100%" stop-color="#022c22" />
        </linearGradient>
        <linearGradient id="gold-grad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#fbbf24" />
            <stop offset="50%" stop-color="#d97706" />
            <stop offset="100%" stop-color="#b45309" />
        </linearGradient>
    </defs>
    
    <circle cx="60" cy="65" r="45" fill="url(#gold-glow)" />

    <!-- Main Shield with Mosque Dome shape top -->
    <path d="M60 110 C25 95 20 70 20 45 C20 30 35 25 60 12 C85 25 100 30 100 45 C100 70 95 95 60 110 Z" fill="url(#emerald-grad)" stroke="url(#gold-grad)" stroke-width="3" filter="drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.15))" />
    
    <!-- Inner Dome Arch Border (Gold Outline) -->
    <path d="M60 17 C38 29 26 33 26 45 C26 67 31 89 60 103 C89 89 94 67 94 45 C94 33 82 29 60 17 Z" fill="none" stroke="url(#gold-grad)" stroke-width="1" stroke-dasharray="3,3" opacity="0.8" />
    
    <!-- Crescent & Star (Gold) at the upper part -->
    <g transform="translate(60, 36) scale(0.8)">
        <!-- Crescent -->
        <path d="M0 -15 C-8.28 -15 -15 -8.28 -15 0 C-15 8.28 -8.28 15 0 15 C4.9 15 9.24 12.65 11.9 9.04 C6.27 10.35 1 6.05 1 0 C1 -6.05 6.27 -10.35 11.9 -9.04 C9.24 -12.65 4.9 -15 0 -15 Z" fill="url(#gold-grad)" />
        <!-- Star -->
        <polygon points="5,-3 7,2 12,2 8,5 10,10 5,7 0,10 2,5 -2,2 3,2" fill="url(#gold-grad)" transform="translate(4, -4) scale(0.6)" />
    </g>

    <!-- Open Holy Quran (Book) (Gold & White pages) -->
    <g transform="translate(60, 72) scale(0.9)">
        <!-- Rehal / Book Stand (Wood/Gold) -->
        <path d="M-22 10 L-8 -2 L0 4 L8 -2 L22 10 L15 15 L0 6 L-15 15 Z" fill="url(#gold-grad)" />
        
        <!-- Book Pages Left -->
        <path d="M-20 -2 C-10 -7 -3 -7 0 -2 L0 8 C-3 3 -10 3 -20 8 Z" fill="#ffffff" stroke="url(#gold-grad)" stroke-width="1" />
        <!-- Book Pages Right -->
        <path d="M20 -2 C10 -7 3 -7 0 -2 L0 8 C3 3 10 3 20 8 Z" fill="#ffffff" stroke="url(#gold-grad)" stroke-width="1" />
        
        <!-- Book Lines (Symbolic writing) -->
        <line x1="-15" y1="1" x2="-5" y2="1" stroke="#cbd5e1" stroke-width="0.8" />
        <line x1="-17" y1="3.5" x2="-7" y2="3.5" stroke="#cbd5e1" stroke-width="0.8" />
        <line x1="-15" y1="6" x2="-5" y2="6" stroke="#cbd5e1" stroke-width="0.8" />
        
        <line x1="5" y1="1" x2="15" y2="1" stroke="#cbd5e1" stroke-width="0.8" />
        <line x1="7" y1="3.5" x2="17" y2="3.5" stroke="#cbd5e1" stroke-width="0.8" />
        <line x1="5" y1="6" x2="15" y2="6" stroke="#cbd5e1" stroke-width="0.8" />
    </g>
</svg>

