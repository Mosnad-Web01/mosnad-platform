const NavLink = ({
  label,
  href,
  className = "",
  icon = null,
  isSidebar = false,
}) => {
  // Check if the current link is active
  const isActive = window.location.pathname === href;

  return (
    <li className={`flex items-center ${isSidebar ? "gap-3" : ""}`}>
      {isSidebar && icon && <span className="text-xl">{icon}</span>}
      <div className="relative">
        <a
          href={href}
          className={`text-sm font-bold relative group transition ${
            isSidebar
              ? "text-white hover:text-purple-200"
              : "text-blue-950 hover:text-[#F03F74]"
          } ${
            isActive && !isSidebar
              ? "text-[#F03F74]"
              : "text-blue-950 hover:text-[#F03F74]"
          } ${className}`}
        >
          {label}
          <div
            className={`absolute -bottom-4 left-0 w-full h-[40px] ${
              isActive ? "opacity-100" : "opacity-0 group-hover:opacity-100"
            } transition-opacity duration-300`}
          >
            {/* Custom U-shape */}
            <div className="relative w-full h-full">
              {/* Left curved part */}
              <div className="absolute bottom-[2.5px] rounded-r-xl right-[-3px] w-[6px] h-[2px] bg-[#F03F74] transform rotate-[80deg] "></div>
              {/* Right curved part */}
              <div className="absolute bottom-[2.5px] rounded-r-xl left-[-3px] w-[6px] h-[2px] bg-[#F03F74] transform rotate-[100deg] "></div>
              {/* Bottom rectangle */}
              <div className="absolute bottom-0 w-full h-[2px] bg-[#F03F74] "></div>
            </div>
          </div>
        </a>
      </div>
    </li>
  );
};

export default NavLink;
