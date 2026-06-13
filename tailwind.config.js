export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#7C3AED',
        'primary-dark': '#6D28D9',
        lavender: '#A78BFA',
        background: '#FAF7FF',
        card: '#FFFFFF',
        text: '#2E1065',
        'text-muted': '#6B7280',
        'border-soft': '#E9D5FF',
        accent: '#FBBF24',
      },
      fontFamily: {
        sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'Segoe UI', 'Noto Color Emoji'],
      },
    },
  },
  plugins: [],
};
