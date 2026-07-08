<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-emerald-600 dark:bg-emerald-700 border border-transparent rounded-xl font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-emerald-700 dark:hover:bg-emerald-600 focus:bg-emerald-700 dark:focus:bg-emerald-600 active:bg-emerald-800 dark:active:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-md shadow-emerald-500/10']) }}>
    {{ $slot }}
</button>

