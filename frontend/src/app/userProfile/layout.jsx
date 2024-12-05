import Sidebar from "@/components/profile/Sidebar";
import Header from "@/components/profile/Header";

export default function UserProfileLayout({ children }) {
  const profile = {
    image: "/userImage.jpg",
    name: "ريم محمد محبوب",
    flagIcon: "/flag.svg",
    memberSince: "عضو منذ سنة",
    statusIcon: "/success.svg",
    status: "حساب نشط",
  };

  const menuItems = [
    { label: "إدارة الحساب", href: "/userProfile/account", icon: "/manage-account-icon.svg" },
    { label: "السيرة الذاتية", href: "/userProfile/resume", icon: "/request.svg" },
    { label: "إكمال الحساب", href: "/userProfile/complete", icon: "/verify-icon.svg" },
    { label: "طلبات التقديم على الفرص", href: "/userProfile/requests", icon: "/request.svg" },
    { label: "ملفاتي", href: "/userProfile/files", icon: "/files.svg" },
    { label: "الإشعارات", href: "/userProfile/notifications", icon: "/notification.svg" },
  ];

  return (
    <main className="bg-gray-50 py-6">
      <div className="flex flex-col sm:flex-row min-h-screen mx-auto max-w-screen-xl gap-4 px-4 sm:px-6">
        {/* Sidebar is persistent for all pages */}
        <Sidebar profile={profile} menuItems={menuItems} />
        <div className="flex-grow">
          {/* Header updates dynamically based on the page */}
          <Header />
          <main className="mt-4">{children}</main>
        </div>
      </div>
    </main>
  );
}
