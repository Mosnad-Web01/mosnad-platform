// /src/components/AosInit.js
'use client'; // Mark this component as a Client Component
import Script from 'next/script';

const AosInit = () => {
  return (
    <Script
      src="https://unpkg.com/aos@2.3.1/dist/aos.js"
      strategy="afterInteractive"
      onLoad={() => {
        const AOS = require('aos');
        AOS.init();
      }}
    />
  );
};

export default AosInit;