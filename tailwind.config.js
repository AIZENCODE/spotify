/** @type {import('tailwindcss').Config} */
module.exports = {

  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: 'class',
  theme: {
    extend: {
    
      fontFamily:{
        'noto':['Noto Sans JP'],
      },

      container: {
        center:true,
      },
      gridTemplateColumns: {
        // Simple 16 column grid
        '16': 'repeat(16, minmax(0, 1fr))',

        // Complex site-specific column configuration
        'footer': '200px minmax(900px, 1fr) 100px',
      },
      colors: {
        'port-gore': {
          '50': '#efeffe',
          '100': '#e1e3fe',
          '200': '#c9c9fc',
          '300': '#a9a8f9',
          '400': '#9085f4',
          '500': '#7e68ec',
          '600': '#704be0',
          '700': '#603dc5',
          '800': '#4e349f',
          '900': '#42317e',
          '950': '#20173b',
      },
        'mountain-meadow': {
          '50': '#f0fdf4',
          '100': '#dbfde6',
          '200': '#baf8cf',
          '300': '#84f1aa',
          '400': '#48e07d',
          '500': '#1db954',
          '600': '#14a547',
          '700': '#13823b',
          '800': '#156633',
          '900': '#13542c',
          '950': '#042f15',
      },
      'black-spotify': {
        '50': '#f7f7f7',
        '100': '#e3e3e3',
        '200': '#c8c8c8',
        '300': '#a4a4a4',
        '400': '#818181',
        '500': '#666666',
        '600': '#515151',
        '700': '#434343',
        '800': '#383838',
        '900': '#121212',
        '950': '#000000',
    },
    
      },

    },
  },
  plugins: [],
}

