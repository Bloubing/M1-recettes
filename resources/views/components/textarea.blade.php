<div class="w-full">
    <textarea x-data="{
        resize() {
            $el.style.height = '0px';
            $el.style.height = $el.scrollHeight + 'px'
        }
    }" x-init="resize()" @input="resize()" type="text" name={{ $name }}
        id={{ $name }}
        class="flex w-full h-auto min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md   placeholder:text-neutral-400 focus:border-orange-500 focus:ring-orange-500 disabled:cursor-not-allowed disabled:opacity-50">{{ $slot }}</textarea>
</div>
