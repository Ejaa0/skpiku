import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans], // Pastikan font Figtree sudah ditambahkan ke dalam proyek
      },
      colors: {
        primary: '#1D4ED8',  // Warna primer
        secondary: '#9333EA', // Warna sekunder
      },
      spacing: {
        '128': '32rem', // Menambah jarak kustom
      },
      backgroundColor: {
        // Atur background default untuk memastikan putih
        'default': '#ffffff',
      },
      textColor: {
        // Atur warna teks default
        'default': '#333333',
      },
    },
  },

  darkMode: false, // Nonaktifkan dark mode agar tidak digunakan

  plugins: [forms], // Plugin forms untuk mengelola elemen form di Tailwind
};
