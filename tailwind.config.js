/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.{blade.php,vue}',
    './resources/js/**/*.{js,jsx,ts,tsx,vue}',
  ],
  theme: {
    extend: {
      fontFamily: {
        'playfair': ['Playfair Display', 'serif'],
        'lato': ['Lato', 'sans-serif'],
        'dancing': ['Dancing Script', 'cursive'],
      },
      colors: {
        'primary-green': '#2d6a4f',
        'bright-green': '#40916c',
        'gold': '#c9a84c',
        'gold-light': '#e8d5a0',
        'gold-dark': '#9a7b35',
        'cream': '#f5f9f5',
      },
      animation: {
        'particleFloat': 'particleFloat 6s infinite ease-in-out',
        'shine': 'shine 3s linear infinite',
        'shimmer': 'shimmer 5s infinite',
        'hintBounce': 'hintBounce 2s infinite',
        'buttonPulse': 'buttonPulse 2s infinite',
        'fadeIn': 'fadeIn 0.3s ease',
        'slideIn': 'slideIn 0.4s ease',
      },
      keyframes: {
        particleFloat: {
          '0%': { transform: 'translateY(105vh)', opacity: '0' },
          '50%': { opacity: '0.8' },
          '100%': { transform: 'translateY(-10vh)', opacity: '0' },
        },
        shine: {
          'to': { backgroundPosition: '200% center' },
        },
        shimmer: {
          '0%, 100%': { transform: 'translate(0, 0)' },
          '50%': { transform: 'translate(-30px, -30px)' },
        },
        hintBounce: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-10px)' },
        },
        buttonPulse: {
          '0%, 100%': { boxShadow: '0 5px 15px rgba(0,0,0,0.2), 0 0 0 0 rgba(201,168,76,0.4)' },
          '50%': { boxShadow: '0 5px 15px rgba(0,0,0,0.2), 0 0 0 12px rgba(201,168,76,0)' },
        },
        fadeIn: {
          'from': { opacity: '0' },
          'to': { opacity: '1' },
        },
        slideIn: {
          'from': { transform: 'translateY(-50px)', opacity: '0' },
          'to': { transform: 'translateY(0)', opacity: '1' },
        },
      },
    },
  },
  plugins: [],
}
