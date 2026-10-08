@php
// Port of mockup/src/components/ui/command.tsx (cmdk) — Alpine.js version.
// Provides client-side filtering, arrow-key navigation and Enter-to-select.
$classes = 'flex h-full w-full flex-col overflow-hidden rounded-md bg-popover text-popover-foreground';
@endphp

<div
    x-data="{
        query: '',
        active: 0,
        count: 0,
        items() {
            return [...this.$el.querySelectorAll('[data-cmd-item]')].filter(el => ! el.hidden)
        },
        filter() {
            const q = this.query.trim().toLowerCase()
            ;[...this.$el.querySelectorAll('[data-cmd-item]')].forEach(el => {
                el.hidden = q !== '' && ! (el.dataset.cmd || '').toLowerCase().includes(q)
            })
            ;[...this.$el.querySelectorAll('[data-cmd-group]')].forEach(group => {
                const visible = [...group.querySelectorAll('[data-cmd-item]')].some(el => ! el.hidden)
                group.hidden = ! visible
            })
            this.active = 0
            this.count = this.items().length
            this.mark()
        },
        mark() {
            const visible = this.items()
            visible.forEach((el, i) => el.setAttribute('data-active', i === this.active ? 'true' : 'false'))
            if (visible[this.active]) visible[this.active].scrollIntoView({ block: 'nearest' })
        },
        move(delta) {
            const visible = this.items()
            if (! visible.length) return
            this.active = (this.active + delta + visible.length) % visible.length
            this.mark()
        },
        choose() {
            const visible = this.items()
            if (visible[this.active]) visible[this.active].click()
        },
        init() {
            this.$nextTick(() => this.filter())
            this.$watch('query', () => this.filter())
        },
    }"
    {{ $attributes->merge(['class' => $classes]) }}
>{{ $slot }}</div>
