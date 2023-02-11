<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-red-50 text-base inline-flex items-center px-8 py-2 bg-red-900 border border-transparent rounded-md font-bold uppercase tracking-widest hover:text-red-900 hover:bg-red-50 active:ring-2 active:ring-white active:ring-offset-4 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
