@props([
    'images',
    'title',
    'name',
    'value'
])
<div class="block">
    <label for="fieldCarAdditionalImages" class="text-gray-700 font-bold">{{$title}}</label>
    <div class="grid grid-cols-2 gap-2 mb-2">
        @foreach ($images as $image)
        <div class="flex relative items-center justify-center border rounded">
            <img src="{{$image->url}}" class="max-w-full max-h-32">
            <a href="#" class="absolute top-1 right-1 text-orange hover:text-opacity-70">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        @endforeach
    </div>
    <input
        id="{{$name}}"
        type="file"
        multiple="multiple"
        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-indigo-300 focus:outline-none"
        name="{{$name}}"
        value="{{old($name, $value)}}"
    >
</div>
