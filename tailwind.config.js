import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import preset from './vendor/filament/support/tailwind.config.preset'

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'heartbeat': 'heartbeat .9s ease-out infinite',
                'zoom-in': 'zoom-in 0.6s ease-out',
                'blurred-fade-in': 'blurred-fade-in 0.9s ease-in-out',
                'swing-drop-in': 'swing-drop-in 0.6s ease-out',
                'zoom-out': 'zoom-out 0.6s ease-out',
            },
            keyframes: {
                'heartbeat': {
                    '0%': { transform: 'scale(1)' },
                    '25%': { transform: 'scale(1.1)' },
                    '50%': { transform: 'scale(1)' },
                    '75%': { transform: 'scale(0.9)' },
                    '100%': { transform: 'scale(1)' },
                  },
                  'zoom-in': {
                    '0%': { opacity: '0', transform: 'scale(.5)' },
                    '100%': { opacity: '1', transform: 'scale(1)' },
                  },
                  'zoom-out': {
                    '0%': { opacity: '1', transform: 'scale(1)' },
                    '100%': { opacity: '0', transform: 'scale(.5)' },
                  },
                  'blurred-fade-in': {
                    "0%": {
                        "filter": "blur(5px)",
                        "opacity": "0"
                      },
                      "100%": {
                        "filter": "blur(0)",
                        "opacity": "1"
                      }
                  },
                  'swing-drop-in': {
                    "0%": {
                        "transform": "rotate(-30deg) translateY(-50px)",
                        "opacity": "0"
                      },
                      "100%": {
                        "transform": "rotate(0deg) translateY(0)",
                        "opacity": "1"
                      }
                  }
            }
        },
    },

    plugins: [forms, typography],
    darkMode: 'class',
};
