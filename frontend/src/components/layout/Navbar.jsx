"use client";
import { useState } from "react";
import Image from "next/image";
import {
  FaHome,
  FaThList,
  FaUsers,
  FaUserPlus,
  FaBriefcase,
  FaBookOpen,
  FaEnvelope,
} from "react-icons/fa";
import Sidebar from "./Sidebar";
import NavLink from "./NavLink";

const Navbar = () => {
  const [isSidebarOpen, setIsSidebarOpen] = useState(false);

  const navItems = [
    { label: "الرئيسية", href: "/", icon: <FaHome /> },
    { label: "من نحن", href: "/about", icon: <FaUsers /> },
    { label: "الشباب", href: "/YouthForm", icon: <FaUserPlus /> },
    { label: "الشركات", href: "/CompaniesForm", icon: <FaBriefcase /> },
    { label: "قصص النجاح", href: "#", icon: <FaBookOpen /> },
    { label: "تواصل معنا", href: "#", icon: <FaEnvelope /> },
    { label: "المستخدم", href: "/userProfile", icon: <FaThList /> },
  ];

  return (
    <header
      className="top-0 w-full sticky z-50 lg:backdrop-blur-md"
      style={{
        background:
          "linear-gradient( to left,rgba(252, 231, 243, 1) 0%, rgba(252, 231, 243, 0.8) 30%, rgba(252, 231, 243, 0.4) 60%, rgba(252, 231, 243, 0) 100%)",
      }}
    >
      <div className="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
        <div className="flex flex-row-reverse py-4 px-0 md:px-1 lg:px-2 xl:px-4 items-center justify-between md:flex-row">
          {/* Logo */}
          <div className="md:flex md:items-center md:gap-12">
            <a href="#" className="block text-teal-600">
              <Image
                src="/nav-logo.png"
                alt="Mosnad Logo"
                width={133}
                height={58}
                className="h-8 md:h-8 lg:h-11 w-auto"
              />
            </a>
          </div>

          {/* Navigation Links */}
          <div className="hidden lg:block">
            <nav aria-label="Global">
              <ul className="flex items-center gap-6 text-sm text-blue-900">
                {navItems.map((item, index) => (
                  <NavLink key={index} label={item.label} href={item.href} />
                ))}
              </ul>
            </nav>
          </div>

          {/* CTA Buttons and Mobile Menu */}
          <div className="flex items-center gap-4">
            <div className="sm:flex sm:gap-4">
              <div className="hidden sm:flex">
                <a
                  className="rounded-full bg-gradient px-6 sm:px-9 py-2 sm:py-3 text-sm font-medium text-white shadow transition hover:scale-105"
                  href="#"
                >
                  إنشاء حساب
                </a>
              </div>

              <div className="hidden sm:flex">
                <a
                  className="border rounded-full bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 px-5 py-2.5 text-sm font-medium text-transparent bg-clip-text hover:bg-gradient-to-br hover:from-purple-500 hover:via-pink-600 hover:to-red-600 hover:scale-105 transition"
                  href="#"
                >
                  تسجيل الدخول
                </a>
              </div>
            </div>
            <div className="block lg:hidden z-50">
              <button
                onClick={() => setIsSidebarOpen(!isSidebarOpen)}
                className="rounded text-gray-600 transition hover:text-gray-800"
              >
                <FaThList className="text-2xl cursor-pointer" />
              </button>
            </div>
          </div>
        </div>
      </div>

      {/* Sidebar Component */}
      <Sidebar
        isOpen={isSidebarOpen}
        onClose={() => setIsSidebarOpen(false)}
        navItems={navItems}
      />
    </header>
  );
};

export default Navbar;
