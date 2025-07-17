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
                blue: {
                    DEFAULT: "#0076df",
                },
                indigo: {
                    DEFAULT: "#5E5CE6",
                },
                purple: {
                    DEFAULT: "#BF5AF2",
                },
                mint: {
                    DEFAULT: "#66D4CF",
                },
                green: {
                    DEFAULT: "#30D158",
                },
                yellow: {
                    DEFAULT: "#FFD60A",
                },
                orange: {
                    DEFAULT: "#FF9F0A",
                },
                pink: {
                    DEFAULT: "#FF375F",
                },
                red: {
                    DEFAULT: "#FF453A",
                },
                white: {
                    DEFAULT: "#F5F5F7",
                }
            },

            fontFamily: {
                sans: [
                    "SF Pro Display",
                    "SF Pro Icons",
                    "Helvetica Neue",
                    "Helvetica",
                    "Arial",
                    "sans-serif",
                ],
            },
        },
    },

    plugins: [forms],
};
