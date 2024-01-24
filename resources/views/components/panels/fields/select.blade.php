@props([
    'title',
    'name',
    'items' => [],
    'object' => null
])
<div class="block">
    <label for="fieldCarClass" class="text-gray-700 font-bold">{{$title}}</label>
    <select
        id="fieldCarClass"
        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        name="{{$name}}"
    >
        @foreach ($items as $item)
            <option value="{{$item->id}}" {{old($name, $object->$name ?? '') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
        @endforeach
    </select>
    @error($name)
        <span class="text-xs italic text-red-600">{{$message}}</span>
    @enderror
</div>
