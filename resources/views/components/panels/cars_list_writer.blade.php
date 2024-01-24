@foreach ($cars as $car)
    <x-panels.cars_list_item :car="$car"/>
@endforeach
