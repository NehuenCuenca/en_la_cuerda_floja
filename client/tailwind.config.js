/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors')

export default {
  content: ["./pages/**/*.{html,js}", "./components/**/*.{html,js}"],
  theme: {
    extend: {},
    colors: {
      transparent: "transparent",
      current: "currentColor",
      black: colors.black,
      white: colors.white,
      gray: colors.gray,
      emerald: colors.emerald,
      indigo: colors.indigo,
      yellow: colors.yellow,
      beige: '#EBC475',
      beigeLight: "#FFD29D",
      beigeDark: "#8C6B28",
      beigeStrong: "#D79F60",
      greyCard: "#D9D9D9",
    },
  },
  plugins: [],
};
