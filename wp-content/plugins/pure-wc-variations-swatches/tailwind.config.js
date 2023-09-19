/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{js,jsx,ts,tsx}"
  ],
  experimental:{
    appDir:true,
  },
  theme: {
    extend: {
      colors: {
        theme: '#3C42E0',
        heading: '#121420',
        textBody: '#76767C',
        text2: '#616266',
        text3: '#A6A8B6',
        text4: '#8A8B92',
        white6: '#FFFFFF99',
        blue: '#000',
        red: '#000',
        gray: '#F6F7FB',
        gray2: '#C2CAE7',
        pink: '#FEDEED',

        current: 'currentColor',
      },
      dropShadow: {
        'xl': ' 0px 8px 20px rgba(61, 110, 168, 0.1)',
        '2xl': ' 0px 0px 30px 1px rgba(60, 66, 224, 0.4)',
      }

    },
    borderRadius: {
      'none': '0',
      'sm': '2px',
      DEFAULT: '4px',
      'md': '8px',
      'lg': '10px',
      'xl': '16px',
      '2xl': '20px',
      '3xl': '24px',
      'full': '9999px',
    },
    fontFamily: {
      heading: "'Poppins', sans-serif",
      body: "'Poppins', sans-serif",
      fontAwesome: "'Font Awesome 6 Pro'",
    },
    container: {
      // you can configure the container to be centered
      center: true,

      // or have default horizontal padding
      padding: '15px',

      screens: {
        sm: '576px',
        md: '768px',
        lg: '992px',
        xl: '1200px',
        '2xl': '1400px',
      },
    },
    fontSize: {
      'xs': '8px',
      'sm': '10px',
      'tiny': '12px',
      'base': '14px',
      'lg': '16px',
      'xl': '18px',
      '2xl': '20px',
      '3xl': '22px',
      '4xl': '24px',
      '5xl': '36px',
    },
    transitionTimingFunction: {
      'toggle-switch-timing': 'cubic-bezier(0.785, 0.135, 0.15, 0.86)'
    },
    screens: {
      'xs': '320px',
      // => @media (min-width: 320px) { ... }

      'sm': '576px',
      // => @media (min-width: 576px) { ... }

      'md': '768px',
      // => @media (min-width: 768px) { ... }

      'lg': '992px',
      // => @media (min-width: 992px) { ... }

      'xl': '1201px',
      // => @media (min-width: 1200px) { ... }

      'xxl': '1401px',
      // => @media (min-width: 1400px) { ... }

      'xxxl': '1601px',
      // => @media (min-width: 1601px) { ... }

      'maxDesktop': {'max': '1800px'},
      // => @media (max-width: 1700px) { ... }

      'max2Xl': {'max': '1600px'},
      // => @media (max-width: 1600px) { ... }

      'maxXl': {'max': '1400px'},
      // => @media (max-width: 1200px) { ... }

      'maxLg': {'max': '1200px'},
      // => @media (max-width: 1200px) { ... }

      'maxMd': {'max': '991px'},
      // => @media (max-width: 991px) { ... }

      'maxSm': {'max': '767px'},
      // => @media (max-width: 767px) { ... }

      'maxXs': {'max': '575px'},
      // => @media (max-width: 575px) { ... }


      'minMaxDesktop': {'min': '1601px', 'max': '1800px'},
      // => @media (min-width: 1601px) and (max-width: 1800px) { ... }

      'minMaxLaptop': {'min': '1401px', 'max': '1600px'},
      // => @media (min-width: 1401px) and (max-width: 1600px) { ... }

      'minMaxTablet': {'min': '1201px', 'max': '1400px'},
      // => @media (min-width: 1201px) and (max-width: 1400px) { ... }

      'minMaxTab': {'min': '992px', 'max': '1200px'},
      // => @media (min-width: 992px) and (max-width: 1200px) { ... }

      'minMaxTabSmall': {'min': '768px', 'max': '991px'},
      // => @media (min-width: 768px) and (max-width: 991px) { ... }

      'minMaxMobile': {'min': '576px', 'max': '767px'},
      // => @media (min-width: 576px) and (max-width: 576px) { ... }
    },
  },
  plugins: [],
}
