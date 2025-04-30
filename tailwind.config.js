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
                'black': "#000000",
                'dark-gray': "#1A1A1A",
                'gray': "#262626",
                'light-gray': "#3A3A3C",
                'blue': "#0A84FF",
                'indigo': "#5E5CE6",
                'purple': "#BF5AF2",
                'mint': "#66D4CF",
                'green': "#30D158",
                'yellow': "#FFD60A",
                'orange': "#FF9F0A",
                'pink': "#FF375F",
                'red': "#FF453A",
                'white': "#FFFFFF",
                'light-white': "#F2F2F7",
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
