"use client";

import Image from "next/image";
import Link from "next/link";
import { FaChevronLeft } from "react-icons/fa";

export default function Sidebar({ activeTab, setActiveTab, profile, tabData }) {
  return (
    <aside className="w-full sm:w-72 bg-white shadow-md h-fit flex flex-col rounded-2xl">
      {/* Profile Card */}
      <div className="p-4 sm:p-6 text-center">
        <div className="flex justify-center mb-4">
          <div className="w-16 h-16 sm:w-20 sm:h-20 rounded-full border-2 border-blue-300 overflow-hidden">
            <Image
              width={100}
              height={100}
              src={profile.image}
              alt="User"
              className="w-full h-full object-fill"
            />
          </div>
        </div>
        <h2 className="text-sm sm:text-lg font-bold text-[#21255C]">
          {profile.name}
        </h2>

        <div className="flex gap-2 mt-1 items-center justify-center">
          <Image src={profile.flagIcon} alt="Verified" width={15} height={15} />
          <p className="text-xs sm:text-sm text-gray-500">
            {new Date(profile.memberSince).toLocaleDateString("en-US", {
              year: "numeric",
              month: "long",
              day: "numeric",
            })}
          </p>
        </div>
        <div className="flex gap-2 items-center justify-center mt-2">
          <Image
            src={profile.statusIcon}
            alt="success"
            width={15}
            height={15}
          />
          <p className="text-sm sm:text-md text-[#2EA154]">{profile.status == "active" ? "نشط" : "غير نشط"}</p>
        </div>
      </div>

      {/* Navigation Links */}
      <nav className="flex-1 overflow-y-auto">
        {tabData.map((tab) => (
          <button
            key={tab.name}
            onClick={() => setActiveTab(tab.name)}
            className={`w-full flex border-t border-gray-100 items-center justify-between px-3 sm:px-4 py-2 sm:py-3 text-gray-400 hover:bg-[#D9DFF3] ${
              activeTab === tab.name ? "font-bold text-[#203B7D]" : ""
            }`}
          >
            <div className="flex items-center gap-2 sm:gap-3">
              {/* Add background to the icon when selected */}
              <div
                className={`p-2 sm:p-3 ${
                  activeTab === tab.name ? "bg-blue-500/20 rounded-full" : ""
                }`}
              >
                <Image src={tab.icon} alt={tab.label} width={16} height={16} />
              </div>
              <span className="text-xs sm:text-sm">{tab.label}</span>
            </div>
            <FaChevronLeft size={12} className="text-green-400" />
          </button>
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
