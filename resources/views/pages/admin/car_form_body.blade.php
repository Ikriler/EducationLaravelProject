
<x-panels.fields.simple_text_input name="name" title="Название модели" placeholder="Stinger" type="text" :object="$car" :value="$car->name"/>

<x-panels.fields.image name="image" title="Основное изображение модели" :value="$car->image" :src="$car->imageUrl"/>

<x-panels.fields.simple_text_input name="price" title="Цена с учетом скидки" placeholder="1000000" type="number" :object="$car" :value="$car->price"/>

<x-panels.fields.simple_text_input name="old_price" title="Цена без скидки" placeholder="1000001" type="number" :object="$car" :value="$car->old_price"/>

<x-panels.fields.textarea name="body" title="Описание модели" rows="3" :object="$car"/>

<x-panels.fields.simple_text_input name="salon" title="Салон" placeholder="Черный, Натуральная кожа (WK)" type="text" :object="$car" :value="$car->salon"/>

<x-panels.fields.simple_text_input name="kpp" title="КПП" placeholder="Автомат, 6 AT" type="text" :object="$car" :value="$car->kpp"/>

<x-panels.fields.simple_text_input name="year" title="Год выпуска" placeholder="2022" type="number" :object="$car" :value="$car->year"/>

<x-panels.fields.simple_text_input name="color" title="Цвет" placeholder="Yacht Blue (DU3)" type="text" :object="$car" :value="$car->color"/>

<x-panels.fields.select name="car_class_id" title="Класс" :items="$carClasses" :object="$car"/>

<x-panels.fields.select name="car_body_id" title="Кузов" :items="$carBodies" :object="$car"/>

<x-panels.fields.select name="car_engine_id" title="Двигатель" :items="$carEngines" :object="$car"/>

<x-panels.fields.multiple-images name="images" title="Дополнительные изображения модели" :images="$car->images" :value="$car->images"/>

<x-panels.fields.checkbox name="is_new" title="Новинка" :object="$car"/>

{{-- <div class="block">
    <label for="fieldCarTags" class="text-gray-700 font-bold">Теги</label>
    <input
            id="fieldCarTags"
            type="text"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            placeholder="Парадигма, Архетип, Киа Seed"
    >
</div> --}}
