@props([
    'title',
    'name',
    'rows' => 3,
    'object' => null
])
<div class="block">
    <label for="fieldCarDescription" class="text-gray-700">{{$title}}</label>
    <textarea
        id="{{$name}}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        rows="{{$rows}}"
        name="{{$name}}"
    >{{old($name, $object->$name ?? '')}}</textarea>
    @error($name)
        <span class="text-xs italic text-red-600">{{$message}}</span>
    @enderror
</div>
