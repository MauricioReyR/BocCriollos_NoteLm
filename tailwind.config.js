/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        // Colores Premium Bocaditos Criollos
        'burnt-red': {
          50: '#F8E8E5',
          100: '#F0D1CC',
          200: '#E1A399',
          300: '#D17566',
          400: '#C24733',
          500: '#B8341D', // Principal
          600: '#A52E18',
          700: '#7C2312',
          800: '#53180C',
          900: '#2A0C06',
        },
        'warm-orange': {
          50: '#FEF4E8',
          100: '#FDE8D0',
          200: '#FBD1A1',
          300: '#F9BA72',
          400: '#F7A343',
          500: '#E67E22', // Principal
          600: '#D97D1F',
          700: '#B8691A',
          800: '#865014',
          900: '#54320D',
        },
        'elegant-black': '#0F0F0F',
        'warm-gray': '#2C2C2C',
        'cream': '#F5F1E8',
        'soft-gold': '#D4AF37',
        'earth-green': '#556B2F',
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
        display: ['Playfair Display', 'serif'],
        mono: ['JetBrains Mono', 'monospace'],
      },
      fontSize: {
        xs: ['0.75rem', { lineHeight: '1rem', letterSpacing: '0.02em' }],
        sm: ['0.875rem', { lineHeight: '1.25rem', letterSpacing: '0.01em' }],
        base: ['1rem', { lineHeight: '1.5rem' }],
        lg: ['1.125rem', { lineHeight: '1.75rem' }],
        xl: ['1.25rem', { lineHeight: '1.75rem' }],
        '2xl': ['1.5rem', { lineHeight: '2rem' }],
        '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
        '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
        '5xl': ['3rem', { lineHeight: '1.2' }],
        '6xl': ['3.75rem', { lineHeight: '1.1' }],
      },
      lineHeight: {
        'tight': '1.1',
        'snug': '1.2',
        'normal': '1.5',
        'relaxed': '1.75',
        'loose': '2',
      },
      spacing: {
        '128': '32rem',
        '144': '36rem',
      },
      animation: {
        'fade-in': 'fadeIn 0.6s ease-in-out',
        'slide-up': 'slideUp 0.6s ease-out',
        'slide-down': 'slideDown 0.6s ease-out',
        'pulse-soft': 'pulseSoft 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
        'float': 'float 3s ease-in-out infinite',
        'reveal-bottom': 'revealFromBottom 0.8s ease-out forwards',
        'reveal-left': 'revealFromLeft 0.8s ease-out forwards',
        'reveal-right': 'revealFromRight 0.8s ease-out forwards',
        'glow-pulse': 'glowPulse 2s infinite',
        'parallax': 'parallaxShift 0.3s ease-out',
        'border-glow': 'borderGlow 2s infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        slideDown: {
          '0%': { transform: 'translateY(-20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        pulseSoft: {
          '0%, 100%': { opacity: '1' },
          '50%': { opacity: '0.8' },
        },
        float: {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%': { transform: 'translateY(-10px)' },
        },
        revealFromBottom: {
          '0%': { opacity: '0', transform: 'translateY(30px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        revealFromLeft: {
          '0%': { opacity: '0', transform: 'translateX(-30px)' },
          '100%': { opacity: '1', transform: 'translateX(0)' },
        },
        revealFromRight: {
          '0%': { opacity: '0', transform: 'translateX(30px)' },
          '100%': { opacity: '1', transform: 'translateX(0)' },
        },
        glowPulse: {
          '0%': { boxShadow: '0 0 0 0 rgba(214, 175, 55, 0.7)' },
          '50%': { boxShadow: '0 0 0 10px rgba(214, 175, 55, 0)' },
          '100%': { boxShadow: '0 0 0 0 rgba(214, 175, 55, 0)' },
        },
        parallaxShift: {
          '0%': { transform: 'translateY(0)' },
          '100%': { transform: 'translateY(20px)' },
        },
        borderGlow: {
          '0%': { 
            borderColor: 'transparent',
            boxShadow: '0 0 0 0 rgba(214, 175, 55, 0)',
          },
          '50%': {
            borderColor: 'rgb(214, 175, 55)',
            boxShadow: '0 0 20px rgba(214, 175, 55, 0.3)',
          },
          '100%': {
            borderColor: 'transparent',
            boxShadow: '0 0 0 0 rgba(214, 175, 55, 0)',
          },
        },
      },
      backdropBlur: {
        xs: '2px',
        sm: '4px',
        md: '12px',
        lg: '16px',
        xl: '24px',
      },
      borderRadius: {
        xl: '1rem',
        '2xl': '1.5rem',
        '3xl': '2rem',
      },
      boxShadow: {
        'premium': '0 20px 25px -5px rgba(15, 15, 15, 0.15)',
        'premium-lg': '0 25px 50px -12px rgba(15, 15, 15, 0.2)',
        'premium-inner': 'inset 0 2px 4px 0 rgba(255, 255, 255, 0.05)',
        'glow': '0 0 20px rgba(230, 126, 34, 0.3)',
        'glow-red': '0 0 20px rgba(184, 52, 29, 0.3)',
      },
      backgroundImage: {
        'gradient-to-br-warm': 'linear-gradient(135deg, #B8341D 0%, #E67E22 100%)',
        'gradient-dark-warm': 'linear-gradient(135deg, #0F0F0F 0%, #2C2C2C 100%)',
        'glass': 'rgba(255, 255, 255, 0.05)',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
