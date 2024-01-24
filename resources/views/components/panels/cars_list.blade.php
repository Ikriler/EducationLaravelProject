@if ($cars)
<section class="pb-4 px-4">
    <p class="inline-block text-3xl text-black font-bold mb-4">Модели недели</p>
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
        <x-panels.cars_list_writer :cars="$cars"/>
    </div>
</section>
@endif
