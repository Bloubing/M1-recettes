<span x-data="{ visible: false, start: 0, target: {{ $target }}, duration: {{ $duration }} }" x-intersect:enter.full="visible = true" x-intersect:leave="visible = false; start = 0"
    x-init="$watch('visible', value => {
        const $el = $refs.el;
        const step = (timestamp) => {
            if (!start) start = timestamp;
            const progress = timestamp - start;
            const percentage = Math.min(progress / duration, 1);
            const value = Math.floor(percentage * target);
            $el.innerHTML = value.toLocaleString();
            if (progress < duration) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    })">
    <span x-ref="el">{{ $slot }}</span>
</span>
