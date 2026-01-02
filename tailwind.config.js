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
                "brand-red": "#FF0000", // Merah sesuai gambar
                "brand-black": "#1a1a1a", // Hitam navbar
                "brand-teal": "#02A388", // Hijau tosca pada judul section
                "brand-white": "#FFFFFF", // Putih
            },
            fontFamily: {
                sans: ["Figtree", "sans-serif"],
            },
        },
    },
    plugins: [],
};
