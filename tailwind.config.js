import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                "clay-card":
                    "10px 10px 20px rgba(166, 180, 200, 0.4), inset -5px -5px 15px rgba(0, 0, 0, 0.05), inset 5px 5px 15px rgba(255, 255, 255, 0.9)",
                "clay-btn":
                    "5px 5px 10px rgba(166, 180, 200, 0.5), inset -3px -3px 8px rgba(0, 0, 0, 0.1), inset 3px 3px 8px rgba(255, 255, 255, 0.8)",
                "clay-input":
                    "inset 4px 4px 8px rgba(166, 180, 200, 0.4), inset -4px -4px 8px rgba(255, 255, 255, 0.9)",
            },
            borderRadius: {
                "4xl": "2rem",
                "5xl": "2.5rem",
            },
        },
    },

    plugins: [forms],
};
