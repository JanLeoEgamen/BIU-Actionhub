import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            // shadcn/ui design tokens (ported from mockup/src/styles.css).
            // Values are space-separated oklch channels so Tailwind can inject
            // alpha: e.g. `bg-primary/90` -> `oklch(var(--primary) / .9)`.
            colors: {
                border: 'oklch(var(--border) / <alpha-value>)',
                input: 'oklch(var(--input) / <alpha-value>)',
                ring: 'oklch(var(--ring) / <alpha-value>)',
                background: 'oklch(var(--background) / <alpha-value>)',
                foreground: 'oklch(var(--foreground) / <alpha-value>)',
                primary: {
                    DEFAULT: 'oklch(var(--primary) / <alpha-value>)',
                    foreground: 'oklch(var(--primary-foreground) / <alpha-value>)',
                },
                secondary: {
                    DEFAULT: 'oklch(var(--secondary) / <alpha-value>)',
                    foreground: 'oklch(var(--secondary-foreground) / <alpha-value>)',
                },
                destructive: {
                    DEFAULT: 'oklch(var(--destructive) / <alpha-value>)',
                    foreground: 'oklch(var(--destructive-foreground) / <alpha-value>)',
                },
                success: {
                    DEFAULT: 'oklch(var(--success) / <alpha-value>)',
                    foreground: 'oklch(var(--success-foreground) / <alpha-value>)',
                },
                warning: {
                    DEFAULT: 'oklch(var(--warning) / <alpha-value>)',
                    foreground: 'oklch(var(--warning-foreground) / <alpha-value>)',
                },
                info: {
                    DEFAULT: 'oklch(var(--info) / <alpha-value>)',
                    foreground: 'oklch(var(--info-foreground) / <alpha-value>)',
                },
                muted: {
                    DEFAULT: 'oklch(var(--muted) / <alpha-value>)',
                    foreground: 'oklch(var(--muted-foreground) / <alpha-value>)',
                },
                accent: {
                    DEFAULT: 'oklch(var(--accent) / <alpha-value>)',
                    foreground: 'oklch(var(--accent-foreground) / <alpha-value>)',
                },
                popover: {
                    DEFAULT: 'oklch(var(--popover) / <alpha-value>)',
                    foreground: 'oklch(var(--popover-foreground) / <alpha-value>)',
                },
                card: {
                    DEFAULT: 'oklch(var(--card) / <alpha-value>)',
                    foreground: 'oklch(var(--card-foreground) / <alpha-value>)',
                },
                chart: {
                    1: 'oklch(var(--chart-1) / <alpha-value>)',
                    2: 'oklch(var(--chart-2) / <alpha-value>)',
                    3: 'oklch(var(--chart-3) / <alpha-value>)',
                    4: 'oklch(var(--chart-4) / <alpha-value>)',
                    5: 'oklch(var(--chart-5) / <alpha-value>)',
                },
                sidebar: {
                    DEFAULT: 'oklch(var(--sidebar) / <alpha-value>)',
                    foreground: 'oklch(var(--sidebar-foreground) / <alpha-value>)',
                    muted: 'oklch(var(--sidebar-muted) / <alpha-value>)',
                    primary: {
                        DEFAULT: 'oklch(var(--sidebar-primary) / <alpha-value>)',
                        foreground: 'oklch(var(--sidebar-primary-foreground) / <alpha-value>)',
                    },
                    accent: {
                        DEFAULT: 'oklch(var(--sidebar-accent) / <alpha-value>)',
                        foreground: 'oklch(var(--sidebar-accent-foreground) / <alpha-value>)',
                    },
                    border: 'oklch(var(--sidebar-border) / <alpha-value>)',
                    ring: 'oklch(var(--sidebar-ring) / <alpha-value>)',
                },
            },

            // Matches the mockup's `--radius-*` mapping from `@theme`:
            // sm = radius - 2, md = radius, lg = radius + 2, xl = radius + 4.
            borderRadius: {
                sm: 'calc(var(--radius) - 2px)',
                md: 'var(--radius)',
                lg: 'calc(var(--radius) + 2px)',
                xl: 'calc(var(--radius) + 4px)',
            },

            boxShadow: {
                pop: 'var(--shadow-pop)',
            },
        },
    },

    plugins: [forms],
};
