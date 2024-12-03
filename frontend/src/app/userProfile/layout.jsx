import Sidebar from '@/components/profile/Sidebar';
import Header from '@/components/profile/Header';

export default function UserProfileLayout({ children }) {
  return (
    <main className="bg-gray-50 py-6">
      <div className="flex flex-col sm:flex-row min-h-screen mx-auto max-w-screen-xl gap-4 px-4 sm:px-6">
        {/* Sidebar is persistent for all pages */}
        <Sidebar />
        <div className="flex-grow">
          {/* Header updates dynamically based on the page */}
          <Header />
          <main className="mt-4">{children}</main>
        </div>
      </div>
    </main>
  );
}
