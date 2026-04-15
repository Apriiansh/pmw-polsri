/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './app/Views/**/*.php',
    './public/assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        // Primary — Sky Blue
        primary: {
          DEFAULT: '#0EA5E9',
          light:   '#38BDF8',
          dark:    '#0284C7',
          50:      '#F0F9FF',
          100:     '#E0F2FE',
        },
        // Accent — Bright Yellow
        accent: {
          DEFAULT: '#FACC15',
          light:   '#FEF08A',
          dark:    '#EAB308',
        },
      },
      fontFamily: {
        sans:    ['Inter', 'sans-serif'],
        display: ['Outfit', 'sans-serif'],
        mono:    ['JetBrains Mono', 'monospace'],
      },
      borderRadius: {
        'xl':  '1rem',
        '2xl': '1.25rem',
        '3xl': '1.5rem',
      },
      boxShadow: {
        'card':   '0 4px 6px -1px rgba(0,0,0,0.03), 0 2px 4px -1px rgba(0,0,0,0.02)',
        'btn':    '0 4px 14px rgba(14, 165, 233, 0.35)',
        'accent': '0 4px 14px rgba(250, 204, 21, 0.40)',
      },
      animation: {
        'pulse-soft': 'pulse-soft 2s ease-in-out infinite',
        'shimmer':    'shimmer 1.5s infinite',
      },
      keyframes: {
        'pulse-soft': {
          '0%, 100%': { opacity: '1', transform: 'scale(1)' },
          '50%':      { opacity: '0.5', transform: 'scale(0.85)' },
        },
        shimmer: {
          '0%':   { transform: 'translateX(-100%)' },
          '100%': { transform: 'translateX(100%)' },
        },
      },
      transitionTimingFunction: {
        smooth: 'cubic-bezier(0.25, 1, 0.5, 1)',
        bounce: 'cubic-bezier(0.34, 1.56, 0.64, 1)',
        sharp:  'cubic-bezier(0.4, 0, 0.2, 1)',
      },
    },
  },
  plugins: [],
};