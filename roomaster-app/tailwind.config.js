/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#B5D7FF',
          100: '#9AC8FF',
          200: '#74B1F2',
          300: '#569FE2',
          400: '#4895C2',
          500: '#3B7BA0',
          600: '#2E6280',
          700: '#254F67',
          800: '#153343',
          900: '#112A35',
        },
        secondary: {
          50: '#FFE1C1',
          100: '#FFD2A3',
          200: '#FFC385',
          300: '#FEB161',
          400: '#EE914E',
          500: '#D97A47',
          600: '#C66531',
          700: '#A35139',
          800: '#85422E',
          900: '#773825',
        },
        grey: {
          50: '#F9FAFB',
          100: '#F3F4F6',
          200: '#E5E7EA',
          300: '#D2D5DB',
          400: '#9EA2AE',
          500: '#6D717F',
          600: '#4D5461',
          700: '#394050',
          800: '#212936',
          900: '#131927',
        },
        green: {
          50: '#E0F8E6',
          500: '#43B75D',
          800: '#256533',
        },
        red: {
          50: '#FCE5E5',
          500: '#EE443F',
          800: '#832523',
        },
        yellow: {
          50: '#FFF7E6',
          500: '#FFAA00',
          800: '#8C5E00',
        }
      },
      borderRadius: {
        'xxs': '4px',
        'xs': '8px',
        'sm': '12px',
        'md': '16px',
        'lg': '20px',
        'xl': '24px',
      },
      spacing: {
        'xxs': '4px',
        'xs': '8px',
        'sm': '12px',
        'md': '16px',
        'lg': '20px',
        'xl': '24px',
      }
    },
  },
  plugins: [],
}
