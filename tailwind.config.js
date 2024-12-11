import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: false, 
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
            colors: {
                border: "#FFFFFF",
                button: "#FFFFFF",
                background: "#101112",
                foreground: "#D4D4D4",
                primary:{
                    DEFAULT: "#1A1B1E",
                    foreground: "#FFFFFF",
                },
                
            },
        },
    },

    plugins: [forms],
};
