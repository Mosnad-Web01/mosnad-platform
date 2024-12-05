"use client";

import React from "react";
import Link from "next/link";
import { usePathname } from "next/navigation"; // Use usePathname for client-side navigation

const Layout = ({ children }) => {
  const pathname = usePathname(); // Get the current route path

  // Utility function for link styles
  const linkClass = (href) =>
    `text-sm px-4 py-2 rounded-lg ${
      pathname === href ? "bg-[#21255C] text-white" : "text-gray-400 hover:underline"
    }`;

  return (
    <>
      <nav className="bg-white shadow p-4 rounded-2xl my-4 flex justify-between items-center">
        <div className="flex gap-4">
          <Link href="/userProfile/account/manage" className={linkClass("/userProfile/account/manage")}>
            معلومات الحساب
          </Link>
          <Link href="/userProfile/account/password" className={linkClass("/userProfile/account/password")}>
            كلمة المرور
          </Link>
          <Link href="/userProfile/account/email" className={linkClass("/userProfile/account/email")}>
            البريد الالكتروني
          </Link>
        </div>
      </nav>

      <main>{children}</main>
    </>
  );
};

export default Layout;
