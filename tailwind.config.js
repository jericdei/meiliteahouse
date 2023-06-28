/** @type {import('tailwindcss').Config} */
module.exports = {
    important: true,

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                heading: ['Poppins', 'sans-serif'],
                body: ['Telegraf', 'sans-serif'],
                chinese: ['Long Cang'],
            },
            colors: {
                primary: '#890202',
                'primary-dark': '#88181A',
                secondary: '#bf9b30',
                success: '#22c55e',
                info: '3b82f6',
                warning: '#f59e0b',
                help: '#a855f7',
                danger: '#ef4444',
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
}
