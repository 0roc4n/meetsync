/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        }
      },
      animation: {
        fade_in: 'fadeIn 0.8s ease-in-out',
      },
      colors: {
        '#808080-9': 'rgba(128, 128, 128, 0.09)',
        '#828282-50': 'rgba(130, 130, 130, 0.7)', //placeholdercolor-gray
        '#333333-90': 'rgba(51, 51, 51, 0.9)', //hover for pagges in sidebar
        '#333333-60': 'rgba(51, 51, 51, 0.2)', //dashboard, cards icon
        '#333333-40': 'rgba(51, 51, 51, 0.4)',
        '#171717': '#171717', //log in and sign up button bg color
        '#2C2C2C': '#2C2C2C',
        '#828282': '#828282',
        '#BFB2FF': '#BFB2FF',
        '#E0E0E0': '#E0E0E0',
        '#9E9E9E': '#9E9E9E',
        '#EEEEEE': '#EEEEEE', //background color
        '#e0e0e2': '#e0e0e2', //background color
        '#636363': '#636363', // sidebar-sampleword
        '#ececec': '#ececec', // meetings-card-bgcolor
        '#cdcdcd': '#cdcdcd', //meetings-card-bordercolor
        '#cdcdcd-50': 'rgba(205, 205, 205, 0.50)', //header-organizationsnamebgcolor
        '#484848': '#484848', //meetings-cards-loc,date,textcolor
        '#f4f4f4': '#f4f4f4', //textfields-bgcolor
        '#171717-73': 'rgba(23, 23, 23, 0.73)', //all-pinned-favorite-hovercolorgray
        '#d8d8da': '#d8d8da',
        '#f2f2f3': '#f2f2f3',
        '#262626': '#262626',
        '#e6e6e6': '#e6e6e6', //hover for members name in manager members page
        '#dcdfe4': '#dcdfe4', //hover for latest, oldest, alphabetically
        '#d9d9d9': '#d9d9d9',
      },
      fontFamily: {
        inter: ['Inter', 'sans-serif'],
      },
      fontSize: {
        'xxs': '0.6875rem', //sidebar-MENU
      },
      borderWidth: {
        'header-stroke': '0.7px', //bottom line of header
      },
      width: {
        '75': '18.75rem', // equivalent to 77/4 (since Tailwind divides by 4 for spacing)
      },
      height: {
        '85': '85px', //card size
        '120': '36rem',
      },
    },
  },
  plugins: [],
}

