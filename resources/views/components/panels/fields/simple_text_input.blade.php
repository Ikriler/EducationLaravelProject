@props([
    'name',
    'title',
    'placeholder' => '',
    'type' => 'text',
    'object' => null,
    'value'
])
<div class="block">
    <label for="fieldCarName" class="text-gray-700 font-bold">{{$title}}</label>
    <input
        id="{{$name}}"
        type="{{$type}}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        placeholder="{{$placeholder}}"
        name="{{$name}}"
        value="{{old($name, $value ?? '')}}"
    >
    @error($name)
        <span class="text-xs italic text-red-600">{{$message}}</span>
    @enderror
</div>
