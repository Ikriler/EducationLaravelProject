@props([
    'title',
    'name',
    'value',
    'src'
])
<div class="block">
    <label for="fieldCarMainImage" class="text-gray-700 font-bold">{{$title}}</label>
    <div class="flex items-center justify-center border rounded mb-2"><img src="{{$src}}" class="max-w-full max-h-60"></div>
    <input
        id="{{$name}}"
        type="file"
        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-indigo-300 focus:outline-none"
        value="{{old($name, $value)}}"
        name="{{$name}}"
    >
    @error($name)
    <span class="text-xs italic text-red-600">{{$message}}</span>
    @enderror
</div>
