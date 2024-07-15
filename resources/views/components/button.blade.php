<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-fuchsia-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-fuchsia-800 focus:bg-fuchsia-800 active:bg-fuchsia-900 focus:outline-none focus:ring-2 focus:ring-fuchsia-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
