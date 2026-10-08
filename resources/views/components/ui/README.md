# UI components (`<x-ui.*>`)

Blade ports of the shadcn/ui components used by the React mockup
(`mockup/src/components/ui`), rewritten to run on **Alpine.js** (already loaded
in `resources/js/app.js`) with the shadcn design tokens ported to
`tailwind.config.js` + `resources/css/app.css`.

Your original Breeze components (`<x-primary-button>`, `<x-text-input>`, …) are
untouched and keep working.

## How it works

| Mockup (React) | This project (Blade) |
| --- | --- |
| Radix primitives | Alpine.js state (`x-data`), `data-state` attributes keep the original shadcn classes |
| `cva()` variants | `@props()` + class maps in `@php` blocks |
| `lucide-react` icons | `<x-ui.icon name="…">` (inline SVG, no extra package) |
| `asChild` / `Slot` | `tag="a"` prop on buttons, plain `$attributes` merging |
| Dialog/Sheet open state | window events: `$dispatch('open-dialog', 'name')` / `close-dialog`, `open-sheet` / `close-sheet` |

### Events

```blade
{{-- open / close any dialog or sheet from anywhere: --}}
<button x-on:click="$dispatch('open-dialog', 'edit-user')">Edit</button>
<button x-on:click="$dispatch('close-dialog', 'edit-user')">Save</button>

<button x-on:click="$dispatch('open-sheet', 'filters')">Filters</button>
<button x-on:click="$dispatch('close-sheet', 'filters')">Done</button>
```

Dialogs close on `Esc`, overlay click and their close button; `focusable` makes
the first control receive focus on open (same convention as `<x-modal>`):

```blade
<x-ui.dialog name="edit-user" max-width="lg" focusable>…</x-ui.dialog>
```

Inside a dialog, Alpine child components can also close it directly with
`x-on:click="show = false"` (see `<x-ui.alert-dialog.action>`).

## Static components

### Button

```blade
<x-ui.button>Save</x-ui.button>
<x-ui.button variant="destructive" type="submit">Delete</x-ui.button>
<x-ui.button variant="outline" size="sm">Cancel</x-ui.button>
<x-ui.button variant="ghost" size="icon"><x-ui.icon name="search" /></x-ui.button>
<x-ui.button tag="a" href="/projects" variant="secondary">View projects</x-ui.button>
<x-ui.button disabled>Disabled</x-ui.button>
```

Variants: `default`, `destructive`, `outline`, `secondary`, `ghost`, `link`.
Sizes: `default`, `sm`, `lg`, `icon`.

### Inputs / labels / textarea / skeleton

```blade
<x-ui.label for="email" value="Email" />
<x-ui.input id="email" name="email" type="email" value="{{ old('email') }}" />
<x-ui.textarea name="notes" rows="3">{{ old('notes') }}</x-ui.textarea>
<x-ui.input disabled placeholder="Disabled" />
<x-ui.skeleton class="h-12 w-full" />
```

Pair with the existing `<x-input-error :messages="$errors->get('email')" />`.

### Alert

```blade
<x-ui.alert variant="destructive">
    <x-ui.alert.title>Heads up</x-ui.alert.title>
    <x-ui.alert.description>Something went wrong.</x-ui.alert.description>
</x-ui.alert>
```

Variant: `default` or `destructive`.

### Icon

```blade
<x-ui.icon name="check" />           {{-- default size h-4 w-4 --}}
<x-ui.icon name="x" class="h-5 w-5" />
```

Available: `x`, `check`, `chevron-down`, `chevron-up`, `chevron-right`,
`search`, `circle`. Add more in `components/ui/icon.blade.php` (lucide paths).

### Table

```blade
<x-ui.table>
    <x-ui.table.header>
        <x-ui.table.row>
            <x-ui.table.head>Name</x-ui.table.head>
            <x-ui.table.head>Role</x-ui.table.head>
        </x-ui.table.row>
    </x-ui.table.header>
    <x-ui.table.body>
        @foreach ($users as $user)
            <x-ui.table.row>
                <x-ui.table.cell>{{ $user->name }}</x-ui.table.cell>
                <x-ui.table.cell>{{ $user->role }}</x-ui.table.cell>
            </x-ui.table.row>
        @endforeach
    </x-ui.table.body>
    <x-ui.table.footer>…</x-ui.table.footer>
    <x-ui.table.caption>Total: {{ $users->total() }}</x-ui.table.caption>
</x-ui.table>
```

## Interactive components

### Tabs

```blade
<x-ui.tabs default-value="board">
    <x-ui.tabs.list>
        <x-ui.tabs.trigger value="board">Board</x-ui.tabs.trigger>
        <x-ui.tabs.trigger value="list">List</x-ui.tabs.trigger>
        <x-ui.tabs.trigger value="activity">Activity</x-ui.tabs.trigger>
    </x-ui.tabs.list>
    <x-ui.tabs.content value="board">…</x-ui.tabs.content>
    <x-ui.tabs.content value="list">…</x-ui.tabs.content>
    <x-ui.tabs.content value="activity">…</x-ui.tabs.content>
</x-ui.tabs>
```

Use `value="…"` for a controlled tab (swap it server-side), `default-value="…"`
for the initial tab.

### Dialog

```blade
<x-ui.dialog name="edit-user">
    <x-ui.dialog.header>
        <x-ui.dialog.title>Edit user</x-ui.dialog.title>
        <x-ui.dialog.description>Update the account details.</x-ui.dialog.description>
    </x-ui.dialog.header>

    <form method="POST" action="/users/{{ $user->id }}" class="space-y-4">
        @csrf @method('PUT')
        <x-ui.input name="name" value="{{ old('name', $user->name) }}" />
    </form>

    <x-ui.dialog.footer>
        <x-ui.button variant="outline" x-on:click="show = false">Cancel</x-ui.button>
        <x-ui.button type="submit" form="…">Save</x-ui.button>
    </x-ui.dialog.footer>
</x-ui.dialog>

<button x-on:click="$dispatch('open-dialog', 'edit-user')">Edit</button>
```

Props: `name` (required), `show`, `max-width` (`sm|md|lg|xl|2xl`, default `lg`),
`content-class` (default `p-6`), `focusable`.

### Alert dialog (destructive confirm)

```blade
<x-ui.alert-dialog name="confirm-delete">
    <x-ui.alert-dialog.header>
        <x-ui.alert-dialog.title>Delete project?</x-ui.alert-dialog.title>
        <x-ui.alert-dialog.description>This action cannot be undone.</x-ui.alert-dialog.description>
    </x-ui.alert-dialog.header>
    <x-ui.alert-dialog.footer>
        <x-ui.alert-dialog.cancel>Cancel</x-ui.alert-dialog.cancel>
        <form method="POST" action="/projects/{{ $project->id }}">
            @csrf @method('DELETE')
            <x-ui.alert-dialog.action type="submit">Delete</x-ui.alert-dialog.action>
        </form>
    </x-ui.alert-dialog.footer>
</x-ui.alert-dialog>
```

Outside clicks do **not** dismiss it (matches Radix); Esc / cancel / close do.

### Sheet (side drawer)

```blade
<x-ui.sheet name="filters" side="left">   {{-- top | bottom | left | right --}}
    <x-ui.sheet.header>
        <x-ui.sheet.title>Filters</x-ui.sheet.title>
    </x-ui.sheet.header>
    …content…
</x-ui.sheet>
```

### Dropdown menu

```blade
<x-ui.dropdown-menu align="right">       {{-- left | right | center --}}
    <x-slot:trigger>
        <x-ui.button variant="ghost" size="icon"><x-ui.icon name="circle" /></x-ui.button>
    </x-slot:trigger>

    <x-ui.dropdown-menu.label>My account</x-ui.dropdown-menu.label>
    <x-ui.dropdown-menu.separator />
    <x-ui.dropdown-menu.item>Profile</x-ui.dropdown-menu.item>
    <x-ui.dropdown-menu.item>Settings</x-ui.dropdown-menu.item>
    <x-ui.dropdown-menu.checkbox-item checked>Compact rows</x-ui.dropdown-menu.checkbox-item>
    <x-ui.dropdown-menu.separator />
    <x-ui.dropdown-menu.item>Logout</x-ui.dropdown-menu.item>
    <x-ui.dropdown-menu.shortcut>⌘K</x-ui.dropdown-menu.shortcut>
</x-ui.dropdown-menu>
```

### Popover

```blade
<x-ui.popover align="right">             {{-- left | right | center --}}
    <x-slot:trigger>
        <x-ui.button variant="outline">Notifications</x-ui.button>
    </x-slot:trigger>
    <div class="space-y-2">…panel…</div>
</x-ui.popover>
```

### Select (form-friendly)

```blade
<x-ui.select name="priority" value="{{ old('priority', 'medium') }}" placeholder="Pick one">
    <x-ui.select.item value="critical">Critical</x-ui.select.item>
    <x-ui.select.item value="high">High</x-ui.select.item>
    <x-ui.select.item value="medium">Medium</x-ui.select.item>
</x-ui.select>
<x-input-error :messages="$errors->get('priority')" />
```

Renders a hidden input carrying the value, so it works with `old()`, validation
and form submission. Optional `label` prop on items when the display text
differs from the slot. Listen for changes with `x-on:select-change.window`.

### Switch / Checkbox (form-friendly)

```blade
{{-- with name: emits a hidden "0" input so unchecked values still submit --}}
<x-ui.switch name="active" :checked="(bool) old('active', $user->active)" />
<x-ui.checkbox name="terms" :checked="(bool) old('terms')" />

{{-- array names ("roles[]") omit the hidden input: unchecked items are
     simply dropped, so `exists:…,id` array rules keep passing --}}
<x-ui.checkbox name="roles[]" :value="$role->id" :checked="in_array($role->id, old('roles', []))" />

{{-- standalone UI-only toggles: no hidden input, no name --}}
<x-ui.switch x-model="notificationsEnabled" />
<x-ui.checkbox checked />
```

Pass `value` to change what is submitted when checked (default `"1"`).

### Slider (single value)

```blade
<x-ui.slider name="priority_weight" :value="75" :min="0" :max="100" :step="5" />
```

Keyboard accessible via the native range input; multi-thumb sliders are not
supported (was Radix-only in the mockup).

### Command palette (Cmd+K style)

```blade
<x-ui.command.dialog name="palette" placeholder="Search projects, tickets, users…">
    <x-ui.command.group heading="Projects">
        <x-ui.command.item x-on:click="window.location = '/projects/1'">
            Actionhub
        </x-ui.command.item>
    </x-ui.command.group>
    <x-ui.command.group heading="Users">
        <x-ui.command.item keywords="jane admin">Jane Doe</x-ui.command.item>
    </x-ui.command.group>
</x-ui.command.dialog>

<button x-on:click="$dispatch('open-dialog', 'palette')">Search</button>
```

Open with `$dispatch('open-dialog', 'palette')` — bind it to `keydown.meta.k` /
`keydown.ctrl.k` on `window` if you want the keyboard shortcut.

Standalone (non-dialog) usage:

```blade
<x-ui.command>
    <x-ui.command.input placeholder="Filter…" />
    <x-ui.command.list>
        <x-ui.command.empty>No results.</x-ui.command.empty>
        <x-ui.command.group heading="Results">
            <x-ui.command.item>…</x-ui.command.item>
        </x-ui.command.group>
    </x-ui.command.list>
</x-ui.command>
```

Arrow keys + Enter are handled by the root; items receive your own
`x-on:click` handlers (none is emitted by the component, so yours always wins).

## Notes & limitations

- **Tailwind v3, not v4**: Radix-only expressions were replaced with static
  values (e.g. `max-h-72` for the select panel) and `tw-animate-css`
  `animate-in` classes with Alpine `x-transition`.
- **No portals**: dropdown/select/popover panels render in place with `z-50`;
  inside `overflow-hidden` ancestors they can clip (same as Breeze's `x-dropdown`).
- Dropdown **submenus** and select scroll buttons were not ported (unused in
  the mockup). Checkbox/radio menu items toggle local state only.
- **Fonts**: the mockup's IBM Plex was not ported; the app keeps Figtree.
- **Dark mode**: `.dark` tokens exist (`darkMode: 'class'` in the Tailwind
  config) but no theme switcher is included.
- Validation: `vendor/bin/phpunit --filter UiComponentsTest` renders every
  component (17 tests).


