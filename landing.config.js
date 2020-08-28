// tailwind.config.js
module.exports = {
    important: true,
    purge: [
        './resources/views/layouts/landing.blade.php',
        './resources/views/landing/*.blade.php',
        './resources/views/landing/**/*.blade.php'
    ],
    corePlugins: {
        animation: false,
    },
    theme: {
        boxShadow: {
            default: '0 4px 10px 0 rgba(0, 0, 0, 0.25)',
            lg: '0 7px 20px 0 rgba(0, 0, 0, 0.275)',
        },
        fontFamily: {
            sans: [
                'Montserrat',
                'system-ui',
                '-apple-system',
                'BlinkMacSystemFont',
                'Segoe UI',
                'Roboto',
                'Helvetica Neue',
                'Arial',
                'Noto Sans',
                'sans-serif',
                'Apple Color Emoji',
                'Segoe UI Emoji',
                'Segoe UI Symbol',
                'Noto Color Emoji'
            ],
        },
        borderRadius: {
            default: '6px',
            full: '9999px',
        },
        colors: {
            transparent: 'transparent',
            black: '#272727',
            white: '#F6F6F6',
            'super-white': '#FFFFFF',
            blue: {
                light: '#8BAFE5',
                primary: '#007DF1',
                dark: '#003380',
            },
            gray: {
                light: '#c4c4c4',
                primary: '#6D6D6D',
                dark: '#272727',
            },
        }
    },
    variants: {
        margin: ['responsive', 'first']
    },
    plugins: [],
};
