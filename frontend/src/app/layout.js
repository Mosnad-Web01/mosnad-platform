// /src/app/layout.js
import Footer from '@/components/layout/Footer';
import './globals.css';
import { Inter, Readex_Pro } from 'next/font/google'; // Arabic font
import Navbar from '@/components/layout/Navbar';
import { Providers } from '@/providers';
import AosInit from '@/components/aos/AosInit'; // Import the AosInit component

const readexPro = Readex_Pro({
  subsets: ['arabic'],
  display: 'swap',
  weight: ['400', '500', '600', '700'],
  variable: '--font-readex-pro',
});

const inter = Inter({
  subsets: ['latin'],
  display: 'swap',
  weight: ['400', '500', '600', '700'],
  variable: '--font-inter',
});

export const metadata = {
  title: 'Create Next App',
  description: 'Generated by create next app',
};

export default function RootLayout({ children }) {
  return (
    <html lang="ar" dir="rtl" className={`${inter.variable} ${readexPro.variable}`}>
      <head>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
      </head>
      <body className="font-readex">
        <Providers>
          <Navbar />
          {children}
          <Footer />
        </Providers>

        {/* Include AOS initialization */}
        <AosInit /> 
      </body>
    </html>
  );
}