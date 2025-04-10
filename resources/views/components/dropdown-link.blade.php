<a {{ $attributes->merge([
    'class' => '
        block px-4 py-2 text-sm
        text-gray-700 dark:text-gray-200
        hover:bg-gray-100 dark:hover:bg-gray-600
        transition duration-150 ease-in-out'
]) }}>
    {{ $slot }}
</a>

