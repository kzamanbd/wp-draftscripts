import form from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */

export default {
    important: true,
    content: [
        './resources/**/*.{php,html,js,ts,vue,jsx,tsx}',
        './classes/**/*.{php,html}',
        './includes/**/*.{php,html}',
        './templates/**/*.{php,html}'
    ],
    theme: {
        extend: {}
    },
    plugins: [form]
};
