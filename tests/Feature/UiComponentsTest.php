<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

/**
 * Render smoke tests for the shadcn/ui components ported from the mockup
 * (mockup/src/components/ui -> resources/views/components/ui).
 */
class UiComponentsTest extends TestCase
{
    private function render(string $template): string
    {
        return Blade::render($template);
    }

    public function test_icon_renders_svg_with_path(): void
    {
        $html = $this->render('<x-ui.icon name="check" class="h-4 w-4" />');

        $this->assertStringContainsString('<svg', $html);
        $this->assertStringContainsString('M20 6 9 17l-5-5', $html);
        $this->assertStringContainsString('h-4 w-4', $html);
    }

    public function test_button_renders_all_variants_and_sizes(): void
    {
        foreach (['default', 'destructive', 'outline', 'secondary', 'ghost', 'link'] as $variant) {
            $html = $this->render("<x-ui.button variant=\"{$variant}\">Save</x-ui.button>");
            $this->assertStringContainsString('<button', $html);
            $this->assertStringContainsString('type="button"', $html);
            $this->assertStringContainsString('Save', $html);
        }

        $html = $this->render('<x-ui.button variant="destructive" size="sm" type="submit" disabled>Delete</x-ui.button>');
        $this->assertStringContainsString('type="submit"', $html);
        $this->assertStringContainsString('disabled', $html);

        $html = $this->render('<x-ui.button tag="a" href="/projects" variant="outline">Open</x-ui.button>');
        $this->assertStringContainsString('<a', $html);
        $this->assertStringContainsString('href="/projects"', $html);
    }

    public function test_input_label_textarea_and_skeleton_render(): void
    {
        $html = $this->render('<x-ui.input type="email" name="email" placeholder="a@b.c" disabled />');
        $this->assertStringContainsString('type="email"', $html);
        $this->assertStringContainsString('name="email"', $html);
        $this->assertStringContainsString('disabled', $html);

        $html = $this->render('<x-ui.label value="Email" for="email" required />');
        $this->assertStringContainsString('Email', $html);

        $html = $this->render('<x-ui.textarea name="body" rows="3">Hello</x-ui.textarea>');
        $this->assertStringContainsString('<textarea', $html);
        $this->assertStringContainsString('Hello', $html);

        $html = $this->render('<x-ui.skeleton class="h-12 w-full" />');
        $this->assertStringContainsString('animate-pulse', $html);
    }

    public function test_alert_family_renders(): void
    {
        $html = $this->render(<<<'BLADE'
            <x-ui.alert variant="destructive">
                <x-ui.alert.title>Heads up</x-ui.alert.title>
                <x-ui.alert.description>Something went wrong.</x-ui.alert.description>
            </x-ui.alert>
            BLADE);

        $this->assertStringContainsString('role="alert"', $html);
        $this->assertStringContainsString('border-destructive/50', $html);
        $this->assertStringContainsString('Heads up', $html);
        $this->assertStringContainsString('Something went wrong.', $html);
    }

    public function test_table_family_renders(): void
    {
        $html = $this->render(<<<'BLADE'
            <x-ui.table>
                <x-ui.table.header>
                    <x-ui.table.row>
                        <x-ui.table.head>Name</x-ui.table.head>
                        <x-ui.table.head>Role</x-ui.table.head>
                    </x-ui.table.row>
                </x-ui.table.header>
                <x-ui.table.body>
                    <x-ui.table.row>
                        <x-ui.table.cell>Jane</x-ui.table.cell>
                        <x-ui.table.cell>Admin</x-ui.table.cell>
                    </x-ui.table.row>
                </x-ui.table.body>
                <x-ui.table.footer>
                    <x-ui.table.row><x-ui.table.cell>2 users</x-ui.table.cell></x-ui.table.row>
                </x-ui.table.footer>
                <x-ui.table.caption>Total: 2</x-ui.table.caption>
            </x-ui.table>
            BLADE);

        $this->assertStringContainsString('<table', $html);
        $this->assertStringContainsString('<thead', $html);
        $this->assertStringContainsString('<tbody', $html);
        $this->assertStringContainsString('<tfoot', $html);
        $this->assertStringContainsString('<caption', $html);
        $this->assertStringContainsString('overflow-auto', $html);
    }


    public function test_tabs_family_renders_with_alpine_state(): void
    {
        $html = $this->render(<<<'BLADE'
            <x-ui.tabs default-value="board">
                <x-ui.tabs.list>
                    <x-ui.tabs.trigger value="board">Board</x-ui.tabs.trigger>
                    <x-ui.tabs.trigger value="list">List</x-ui.tabs.trigger>
                </x-ui.tabs.list>
                <x-ui.tabs.content value="board">Board view</x-ui.tabs.content>
                <x-ui.tabs.content value="list">List view</x-ui.tabs.content>
            </x-ui.tabs>
            BLADE);

        $this->assertStringContainsString('x-data="{ active: \'board\' }"', $html);
        $this->assertStringContainsString('role="tablist"', $html);
        $this->assertStringContainsString('role="tab"', $html);
        $this->assertStringContainsString('role="tabpanel"', $html);
        $this->assertStringContainsString('data-[state=active]:bg-background', $html);
    }

    public function test_dialog_family_renders(): void
    {
        $html = $this->render(<<<'BLADE'
            <x-ui.dialog name="edit-user" max-width="lg">
                <x-ui.dialog.header>
                    <x-ui.dialog.title>Edit user</x-ui.dialog.title>
                    <x-ui.dialog.description>Update the details.</x-ui.dialog.description>
                </x-ui.dialog.header>
                <div>Body</div>
                <x-ui.dialog.footer>
                    <x-ui.button variant="outline">Cancel</x-ui.button>
                    <x-ui.button type="submit">Save</x-ui.button>
                </x-ui.dialog.footer>
            </x-ui.dialog>
            BLADE);

        $this->assertStringContainsString('x-on:open-dialog.window', $html);
        $this->assertStringContainsString("\$event.detail === 'edit-user'", $html);
        $this->assertStringContainsString('role="dialog"', $html);
        $this->assertStringContainsString('aria-modal="true"', $html);
        $this->assertStringContainsString('sm:max-w-lg', $html);
        $this->assertStringContainsString('aria-labelledby="edit-user-dialog-title"', $html);
        $this->assertStringContainsString('Edit user', $html);
        $this->assertStringContainsString('Close', $html);
    }

    public function test_alert_dialog_family_renders(): void
    {
        $html = $this->render(<<<'BLADE'
            <x-ui.alert-dialog name="confirm-delete">
                <x-ui.alert-dialog.header>
                    <x-ui.alert-dialog.title>Delete project?</x-ui.alert-dialog.title>
                    <x-ui.alert-dialog.description>This cannot be undone.</x-ui.alert-dialog.description>
                </x-ui.alert-dialog.header>
                <x-ui.alert-dialog.footer>
                    <x-ui.alert-dialog.cancel>Cancel</x-ui.alert-dialog.cancel>
                    <x-ui.alert-dialog.action type="submit">Delete</x-ui.alert-dialog.action>
                </x-ui.alert-dialog.footer>
            </x-ui.alert-dialog>
            BLADE);

        $this->assertStringContainsString('role="alertdialog"', $html);
        $this->assertStringContainsString('Delete project?', $html);
        $this->assertStringContainsString('x-on:click="show = false"', $html);
        $this->assertStringContainsString('sm:mt-0', $html); // cancel button outline styles
    }

    public function test_sheet_family_renders_with_side_variants(): void
    {
        foreach (['top', 'bottom', 'left', 'right'] as $side) {
            $html = $this->render(<<<BLADE
                <x-ui.sheet name="filters" side="{$side}">
                    <x-ui.sheet.header>
                        <x-ui.sheet.title>Filters</x-ui.sheet.title>
                    </x-ui.sheet.header>
                    <p>Content</p>
                </x-ui.sheet>
                BLADE);

            $this->assertStringContainsString('x-on:open-sheet.window', $html);
            $this->assertStringContainsString('role="dialog"', $html);
            $this->assertStringContainsString('Filters', $html);
        }

        $html = $this->render('<x-ui.sheet name="s" side="left"><x-ui.sheet.title>T</x-ui.sheet.title></x-ui.sheet>');
        $this->assertStringContainsString('inset-y-0 left-0', $html);
        $this->assertStringContainsString('-translate-x-full', $html);
    }

    public function test_dropdown_menu_family_renders(): void
    {
        $html = $this->render(<<<'BLADE'
            <x-ui.dropdown-menu align="right">
                <x-slot:trigger>
                    <x-ui.button variant="outline">Open</x-ui.button>
                </x-slot:trigger>
                <x-ui.dropdown-menu.label>My account</x-ui.dropdown-menu.label>
                <x-ui.dropdown-menu.separator />
                <x-ui.dropdown-menu.item>Profile</x-ui.dropdown-menu.item>
                <x-ui.dropdown-menu.checkbox-item checked>Columns</x-ui.dropdown-menu.checkbox-item>
                <x-ui.dropdown-menu.radio-item checked>Compact</x-ui.dropdown-menu.radio-item>
                <x-ui.dropdown-menu.shortcut>⌘K</x-ui.dropdown-menu.shortcut>
            </x-ui.dropdown-menu>
            BLADE);

        $this->assertStringContainsString('x-data="{ open: false }"', $html);
        $this->assertStringContainsString('@click.outside', $html);
        $this->assertStringContainsString('role="menuitem"', $html);
        $this->assertStringContainsString('role="menuitemcheckbox"', $html);
        $this->assertStringContainsString('role="menuitemradio"', $html);
        $this->assertStringContainsString('My account', $html);
        $this->assertStringContainsString('bg-popover', $html);
    }

    public function test_select_renders_with_hidden_input_and_items(): void
    {
        $html = $this->render(<<<'BLADE'
            <x-ui.select name="priority" value="high" placeholder="Pick one">
                <x-ui.select.item value="critical">Critical</x-ui.select.item>
                <x-ui.select.item value="high">High</x-ui.select.item>
                <x-ui.select.item value="low" label="Low priority">Low</x-ui.select.item>
            </x-ui.select>
            BLADE);

        $this->assertStringContainsString('name="priority"', $html);
        $this->assertStringContainsString('<input type="hidden"', $html);
        $this->assertStringContainsString('role="combobox"', $html);
        $this->assertStringContainsString('role="listbox"', $html);
        $this->assertStringContainsString('data-select-item', $html);
        $this->assertStringContainsString('data-value="critical"', $html);
        $this->assertStringContainsString('data-label="Critical"', $html);
        $this->assertStringContainsString('data-label="Low priority"', $html);
    }

    public function test_popover_renders(): void
    {
        $html = $this->render(<<<'BLADE'
            <x-ui.popover align="right">
                <x-slot:trigger>
                    <x-ui.button variant="ghost">Notifications</x-ui.button>
                </x-slot:trigger>
                <p>Panel content</p>
            </x-ui.popover>
            BLADE);

        $this->assertStringContainsString('x-data="{ open: false }"', $html);
        $this->assertStringContainsString('w-72', $html);
        $this->assertStringContainsString('Panel content', $html);
    }

    public function test_switch_and_checkbox_render_with_form_inputs(): void
    {
        $html = $this->render('<x-ui.switch name="active" :checked="true" />');
        $this->assertStringContainsString('name="active"', $html);
        $this->assertStringContainsString('type="hidden"', $html);
        $this->assertStringContainsString('role="switch"', $html);
        $this->assertStringContainsString('value="1"', $html);
        $this->assertStringContainsString('value="0"', $html);
        $this->assertStringContainsString('data-[state=checked]:bg-primary', $html);

        $html = $this->render('<x-ui.checkbox name="terms" checked />');
        $this->assertStringContainsString('name="terms"', $html);
        $this->assertStringContainsString('type="hidden"', $html);
        $this->assertStringContainsString('border-primary', $html);

        // Standalone (no name) renders no form inputs.
        $html = $this->render('<x-ui.checkbox checked />');
        $this->assertStringNotContainsString('type="hidden"', $html);
        $this->assertStringNotContainsString('name="', $html);
    }

    public function test_slider_renders_with_range_input(): void
    {
        $html = $this->render('<x-ui.slider name="volume" :value="30" :min="0" :max="100" :step="5" />');

        $this->assertStringContainsString('type="range"', $html);
        $this->assertStringContainsString('name="volume"', $html);
        $this->assertStringContainsString('min="0"', $html);
        $this->assertStringContainsString('max="100"', $html);
        $this->assertStringContainsString('step="5"', $html);
        $this->assertStringContainsString('bg-primary/20', $html);
        $this->assertStringContainsString('value: 30', $html);
    }

    public function test_command_family_renders(): void
    {
        $html = $this->render(<<<'BLADE'
            <x-ui.command>
                <x-ui.command.input placeholder="Search projects…" />
                <x-ui.command.list>
                    <x-ui.command.empty>No results.</x-ui.command.empty>
                    <x-ui.command.group heading="Projects">
                        <x-ui.command.item>Actionhub</x-ui.command.item>
                        <x-ui.command.item keywords="portal website">Portal</x-ui.command.item>
                    </x-ui.command.group>
                </x-ui.command.list>
            </x-ui.command>
            BLADE);

        $this->assertStringContainsString('data-cmd-item', $html);
        $this->assertStringContainsString('data-cmd-group', $html);
        $this->assertStringContainsString('data-cmd="portal website"', $html);
        $this->assertStringContainsString('x-model="query"', $html);
        $this->assertStringContainsString('x-on:keydown.down.prevent="move(1)"', $html);
        $this->assertStringContainsString('x-show="count === 0"', $html);
        $this->assertStringContainsString('Projects', $html);
    }

    public function test_command_dialog_renders(): void
    {
        $html = $this->render(<<<'BLADE'
            <x-ui.command.dialog name="palette" placeholder="Search…">
                <x-ui.command.group heading="Users">
                    <x-ui.command.item>Jane Doe</x-ui.command.item>
                </x-ui.command.group>
            </x-ui.command.dialog>
            BLADE);

        $this->assertStringContainsString('x-on:open-dialog.window', $html);
        $this->assertStringContainsString('p-0 overflow-hidden', $html);
        $this->assertStringContainsString('data-cmd-item', $html);
        $this->assertStringContainsString('placeholder="Search…"', $html);
        $this->assertStringContainsString('No results found.', $html);
    }

    public function test_existing_breeze_components_still_render(): void
    {
        $html = $this->render('<x-primary-button>Go</x-primary-button>');
        $this->assertStringContainsString('<button', $html);

        $html = $this->render('<x-text-input name="q" value="abc" />');
        $this->assertStringContainsString('name="q"', $html);

        $html = $this->render('<x-form-group label="Email" description="We never share it." id="email" required><input id="email"></x-form-group>');
        $this->assertStringContainsString('Email', $html);
        $this->assertStringContainsString('We never share it.', $html);
        $this->assertStringContainsString('*', $html);
        $this->assertStringNotContainsString('\n', $html);
    }
}

