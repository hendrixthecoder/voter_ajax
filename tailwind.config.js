const default_theme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      fontFamily: {
        'comf' : ['Comfortaa', 'sans-serif'],
        'lora' : ['Lora', 'serif'],
        'nun' : ['Nunito', 'sans-serif'],
        'libre' : ['Libre Baskerville', 'serif'],
        'monte' : ['Montserrat', 'sans-serif'],
        sans: ['Nunito', ... default_theme.fontFamily.sans],
      }
    },
  },
  corePlugins:{
    preflight: false,
  },
  
  plugins: [],
  
}

