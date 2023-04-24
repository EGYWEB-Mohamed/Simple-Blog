/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    darkMode: 'class', // or 'media' or false
    theme: {
        extend: {
            colors: {
                gray: {
                    50:  '#f8f8f8',
                    100: '#efefef',
                    200:  '#cccccc',
                    300:  '#b6b6b6',
                    400:  '#d9d9d9',
                    500:  '#7d7d7d',
                    600:  '#686465',
                    700:  '#4d4948',
                    800:  '#323232',
                    900:  '#1c1c1c'
                },
            }
        },
        fontFamily: {
            sans: ['Roboto', 'sans-serif']
        },
    },
    variants: {
        extend: {
            backgroundOpacity: ['dark']
        }
    },
  plugins: [
      require('flowbite/plugin')
  ],
}

