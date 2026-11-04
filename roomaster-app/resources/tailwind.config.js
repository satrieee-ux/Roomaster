/** @type {import('tailwindcss').Config} */
// Token warna & tipografi Roomaster (Tailwind v3).
// CATATAN: hex diestimasi dari gambar palet; cocokkan dengan Figma bila ada selisih.
export default {
  content: ['./resources/**/*.blade.php', './resources/**/*.js'],
  theme: {
    extend: {
      fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
      colors: {
        primary:   { 900: '#112A35', 800: '#153343', 500: '#3B7BA0' /* shade lain tetap */ },
secondary: { 500: '#D97A47' /* shade lain tetap */ },
grey:      { 50: '#F9FAFB', 100: '#F3F4F6', 200: '#E5E7EA', 500: '#6D717F', 800: '#212936' /* lainnya tetap */ },
success:   { 500: '#43B75D' /* lainnya tetap */ },
        danger: { 900: '#601C1C', 800: '#832424', 700: '#A92E2E', 600: '#DB3D3A', 500: '#F04440', 400: '#F26560', 300: '#F58380', 200: '#F8AAA8', 100: '#FAC5C3', 50: '#FCE5E5' },
        warning: { 900: '#6B4800', 800: '#8A5E00', 700: '#B87800', 600: '#E89C00', 500: '#FFAB00', 400: '#FFBA2E', 300: '#FFC84D', 200: '#FFD985', 100: '#FFE9B8', 50: '#FFF6E0' },
      },
      fontSize: {
        h4: ['28px', { lineHeight: '34px', fontWeight: '800' }],
        h5: ['24px', { lineHeight: '28px', fontWeight: '800' }],
        s1: ['18px', { lineHeight: '28px', fontWeight: '600' }],
        s2: ['16px', { lineHeight: '24px', fontWeight: '600' }],
        b1: ['16px', { lineHeight: '24px', fontWeight: '400' }],
        b2: ['16px', { lineHeight: '24px', fontWeight: '600' }],
        b3: ['14px', { lineHeight: '20px', fontWeight: '400' }],
        b4: ['14px', { lineHeight: '20px', fontWeight: '600' }],
        c1: ['12px', { lineHeight: '16px', fontWeight: '400' }],
        c2: ['12px', { lineHeight: '16px', fontWeight: '500' }],
        c3: ['10px', { lineHeight: '14px', fontWeight: '400' }],
      },
      boxShadow: {
        card: '0 4px 24px rgba(20, 26, 40, 0.10)',
      },
    },
  },
  plugins: [],
};
