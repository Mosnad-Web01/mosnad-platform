import Sidebar from "@/components/profile/Sidebar";
import Header from "@/components/profile/Header";

export default function UserProfileLayout({ children }) {
  const profile = {
    image: "/userImage.svg",
    name: "مسند للتدريب والتوظيف",
    flagIcon: "/flag.svg",
    memberSince: "عضو منذ سنة",
    statusIcon: "/success.svg",
    status: "حساب نشط",
  };

  const menuItems = [
    { label: "معلومات الحساب", href: "/companyProfile/account", icon: "/manage-account-icon.svg" },
    { label: "طلبات التوظيف", href: "/companyProfile/requests", icon: "/request.svg" },
    { label: "إدارة الموظفين", href: "/companyProfile/employees", icon: "/verify-icon.svg" },
    { label: "الإشعارات", href: "/companyProfile/notifications", icon: "/notification.svg" },
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
