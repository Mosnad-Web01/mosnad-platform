"use client";

import { usePathname } from "next/navigation";

const titles = {
  "/userProfile": "لوحة التحكم",
  "/userProfile/account/manage": "إدارة الحساب",
  "/userProfile/account/password": "كلمة المرور",
  "/userProfile/account/email": "البريد الالكتروني",
  "/userProfile/complete": "إكمال الحساب",
  "/userProfile/requests": "طلبات التقديم",
  "/userProfile/notifications": "الإشعارات",
  "/userProfile/files": "ملفاتي",
  "/userProfile/resume": "السيرة الذاتية",
};

export default function Header() {
  const pathname = usePathname(); // Get the current path
  const title = titles[pathname] || "لوحة التحكم"; // Set title based on path

  return (
    <header className="bg-white shadow py-6 px-4 sm:py-8 sm:px-6 rounded-2xl relative overflow-hidden">
      <h1 className="text-sm sm:text-base text-[#21255C] font-bold relative w-fit after:content-[''] after:absolute after:w-[calc(100%+2.5rem)] after:h-12 after:bg-blue-500/20 after:rounded-tl-full after:rounded-bl-full after:right-[-20px] after:top-1/2 after:-translate-y-1/2">
        {title}
      </h1>
    </header>
  );
}
