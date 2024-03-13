import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    presets: ["./vendor/robsontenorio/mary/src/View/Components/**/*.php"],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            height: {
                112: "28rem",
                128: "32rem",
            },
            colors: {
                "home-primary": "rgb(33, 1, 85)",
            },
            animation: {
                heartbeat: "heartbeat .9s ease-out infinite",
                "zoom-in": "zoom-in 0.6s ease-out",
                "blurred-fade-in": "blurred-fade-in 0.9s ease-in-out",
                "swing-drop-in": "swing-drop-in 0.6s ease-out",
                "zoom-out": "zoom-out 0.6s ease-out",
                "rotate-90": "rotate-90 1s ease-in-out",
                "unrotate-90": "unrotate-90 1s ease-in-out",
                "rotate-180": "rotate-180 1s ease-in-out",
            },
            keyframes: {
                heartbeat: {
                    "0%": { transform: "scale(1)" },
                    "25%": { transform: "scale(1.1)" },
                    "50%": { transform: "scale(1)" },
                    "75%": { transform: "scale(0.9)" },
                    "100%": { transform: "scale(1)" },
                },
                "zoom-in": {
                    "0%": { opacity: "0", transform: "scale(.5)" },
                    "100%": { opacity: "1", transform: "scale(1)" },
                },
                "zoom-out": {
                    "0%": { opacity: "1", transform: "scale(1)" },
                    "100%": { opacity: "0", transform: "scale(.5)" },
                },
                "blurred-fade-in": {
                    "0%": {
                        filter: "blur(5px)",
                        opacity: "0",
                    },
                    "100%": {
                        filter: "blur(0)",
                        opacity: "1",
                    },
                },
                "swing-drop-in": {
                    "0%": {
                        transform: "rotate(-30deg) translateY(-50px)",
                        opacity: "0",
                    },
                    "100%": {
                        transform: "rotate(0deg) translateY(0)",
                        opacity: "1",
                    },
                },
                "rotate-90": {
                    "0%": {
                        transform: "rotate(0deg)",
                    },
                    "100%": {
                        transform: "rotate(90deg)",
                    },
                },
                "unrotate-90": {
                    "0%": {
                        transform: "rotate(90deg)",
                    },
                    "100%": {
                        transform: "rotate(0deg)",
                    },
                },
                "rotate-180": {
                    "0%": {
                        transform: "rotate(0deg)",
                    },
                    "100%": {
                        transform: "rotate(180deg)",
                    },
                },
            },
        },
    },

    plugins: [forms, typography, require("daisyui")],
    darkMode: "class",
};
