"use client";

import Image from "next/image";
import Link from "next/link";
import { usePathname } from "next/navigation";
import { FaChevronLeft } from "react-icons/fa";

const sidebarItems = [
  {
    label: "إدارة الحساب",
    href: "/userProfile/account",
    icon: "/manage-account-icon.svg",
  },
  {
    label: "السيرة الذاتية",
    href: "/userProfile/resume",
    icon: "/request.svg",
  },
  {
    label: "إكمال الحساب",
    href: "/userProfile/complete",
    icon: "/verify-icon.svg",
  },
  {
    label: "طلبات التقديم على الفرص",
    href: "/userProfile/requests",
    icon: "/request.svg",
  },
  { label: "ملفاتي", href: "/userProfile/files", icon: "/files.svg" },
  {
    label: "الإشعارات",
    href: "/userProfile/notifications",
    icon: "/notification.svg",
  },
];

export default function Sidebar() {
  const pathname = usePathname();

  return (
    <aside className="w-full sm:w-72 bg-white shadow-md h-fit flex flex-col rounded-2xl">
      {/* Profile Card */}
      <div className="p-4 sm:p-6 text-center">
        <div className="flex justify-center mb-4">
          <div className="w-16 h-16 sm:w-20 sm:h-20 rounded-full border-2 border-blue-300 bg-gray-200 overflow-hidden">
            <Image
              width={100}
              height={100}
              src="/userImage.jpg"
              alt="User"
              className="w-full h-full object-cover"
            />
          </div>
        </div>
        <h2 className="text-sm sm:text-lg font-bold text-[#21255C]">ريم محمد محبوب</h2>

        <div className="flex gap-2 mt-1 items-center justify-center">
          <Image src="/flag.svg" alt="Verified" width={15} height={15} />
          <p className="text-xs sm:text-sm text-gray-500">عضو منذ سنة</p>
        </div>
        <div className="flex gap-2 items-center justify-center mt-1">
          <Image src="/success.svg" alt="success" width={15} height={15} />
          <p className="text-xs sm:text-md text-[#2EA154]">حساب نشط</p>
        </div>
      </div>

      {/* Navigation Links */}
      <nav className="flex-1 overflow-y-auto">
        {sidebarItems.map((item) => (
          <Link
            key={item.href}
            href={item.href}
            className={`flex border-t border-gray-100 items-center justify-between px-3 sm:px-4 py-2 sm:py-3 text-gray-400 hover:bg-[#D9DFF3] ${
              pathname === item.href ? "font-bold text-[#203B7D]" : ""
            }`}
          >
            <div className="flex items-center gap-2 sm:gap-3">
              {/* Add background to the icon when selected */}
              <div
                className={`p-2 sm:p-3 ${
                  pathname === item.href ? "bg-blue-500/20 rounded-full" : ""
                }`}
              >
                <Image
                  src={item.icon}
                  alt={item.label}
                  width={16}
                  height={16}
                />
              </div>
              <span className="text-xs sm:text-sm">{item.label}</span>
            </div>
            <FaChevronLeft size={12} className="text-green-400" />
          </Link>
        ))}
      </nav>

      {/* Logout Button */}
      <div className="border-t border-gray-100">
        <Link
          href="/logout"
          className="flex items-center justify-between px-3 sm:px-4 py-2 sm:py-3 text-gray-700 hover:bg-gray-100"
        >
          <div className="flex items-center gap-4 sm:gap-6">
            <Image src="/logout.svg" alt="Logout" width={16} height={16} />
            <h3 className="text-xs sm:text-sm">تسجيل الخروج</h3>
          </div>
        </Link>
      </div>
    </aside>
  );
}
