@props([
    'basketPositions'
])
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <tbody>
        @foreach ($basketPositions as $basketPosition)
            <x-basket.basket-table-item :basketPosition="$basketPosition"/>
        @endforeach
    </tbody>
</table>
