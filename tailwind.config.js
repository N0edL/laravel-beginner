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
            colors: {
                black: "#000000",
                gray: {
                    light: '#3A3A3C',
                    DEFAULT: '#262626',
                    dark: '#1A1A1A',
                },
                '_blue': "#0A84FF",
                '_indigo': "#5E5CE6",
                '_purple': "#BF5AF2",
                '_mint': "#66D4CF",
                '_green': "#30D158",
                '_yellow': "#FFD60A",
                '_orange': "#FF9F0A",
                '_pink': "#FF375F",
                '_red': "#FF453A",
                '_white': "#FFFFFF",
                '_light-white': "#F2F2F7",
            },

            fontFamily: {
                sans: [
                    "-apple-system",
                    "BlinkMacSystemFont",
                    "San Francisco",
                    "Helvetica Neue",
                    "Arial",
                    "sans-serif",
                ],
            },
        },
    },

    plugins: [forms],
};
