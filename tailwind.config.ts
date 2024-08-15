import form from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */

export default {
    content: ['./resources/**/*.{php,html,js,ts,vue,jsx,tsx}'],
    theme: {
        extend: {}
    },
    plugins: [form]
};
