/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/components/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/app/**/*.{js,ts,jsx,tsx,mdx}",
  ],
  theme: {
    extend: {
     backgroundImage: {
        'gradient': 'linear-gradient(90deg, #7351A1 0%, #8D4BA1 8%, #9A469F 16%, #A7429D 24%, #BF3694 32%, #D52786 40%, #E12079 48%, #EB1D6B 56%, #F3215C 64%, #F5304E 72%, #F63E40 80%, #F44C32 88%, #F15A22 100%)',
      },
      colors: {
        gray: {
          50: "#f6f6f6",
          100: "#e7e7e7",
          200: "#d1d1d1",
          300: "#b0b0b0",
          400: "#888888",
          500: "#666666",
          600: "#5d5d5d",
          700: "#4f4f4f",
          800: "#454545",
          900: "#3d3d3d",
          950: "#262626"
        },
        blue: {
          50: "#f0f4fe",
          100: "#dee5fb",
          200: "#c4d3f9",
          300: "#9cb8f4",
          400: "#6d91ed",
          500: "#4b6de6",
          600: "#364eda",
          700: "#2d3dc8",
          800: "#2a33a3",
          900: "#272f81",
          950: "#21255c"
        },
        purple: {
          50: "#f9f5ff",
          100: "#f2e9fe",
          200: "#e7d6fe",
          300: "#d4b6fc",
          400: "#ba87f9",
          500: "#a059f3",
          600: "#8a37e6",
          700: "#7626ca",
          800: "#6524a5",
          900: "#4c1c7a",
          950: "#370962"
        }
      },
    },
  },
  plugins: [],
};
