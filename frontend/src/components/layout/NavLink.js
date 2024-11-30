import Link from 'next/link';

const NavLink = ({
	label,
	href,
	className = '',
	icon = null,
	isSidebar = false,
	onClick,
}) => {
	// Determine if the current link is active
	const isActive = window.location.pathname === href;

	// Define the base styles for the link
	const baseStyles = `text-sm font-bold relative group transition ${className}`;
	const sidebarStyles = isSidebar
		? 'text-white hover:text-purple-200'
		: 'text-blue-950 hover:text-[#F03F74]';
	const activeStyles = isSidebar
		? 'text-[#c93662]'
		: 'text-[#F03F74]';

	return (
		<li className={`flex items-center ${isSidebar ? 'gap-3' : ''}`}>
			{/* Sidebar Icon */}
			{isSidebar && icon && (
				<span className={`text-2xl ${isActive ? 'text-[#c93662]' : ''}`}>
					{icon}
				</span>
			)}

			{/* Link */}
			<div className="relative">
				<Link
					href={href}
					onClick={onClick}
					className={`${baseStyles} ${sidebarStyles} ${
						isActive ? activeStyles : ''
					}`}>
					{label}

					{/* Custom U-shape underline for non-sidebar links */}
					{!isSidebar && (
						<div
							className={`absolute -bottom-4 left-0 w-full h-[40px] ${
								isActive
									? 'opacity-100'
									: 'opacity-0 group-hover:opacity-100'
							} transition-opacity duration-300`}>
							<div className="relative w-full h-full">
								{/* Left curved part */}
								<div className="absolute bottom-[2.5px] rounded-r-xl right-[-3px] w-[6px] h-[2px] bg-[#F03F74] transform rotate-[80deg]"></div>
								{/* Right curved part */}
								<div className="absolute bottom-[2.5px] rounded-r-xl left-[-3px] w-[6px] h-[2px] bg-[#F03F74] transform rotate-[100deg]"></div>
								{/* Bottom rectangle */}
								<div className="absolute bottom-0 w-full h-[2px] bg-[#F03F74]"></div>
							</div>
						</div>
					)}
				</Link>
			</div>
		</li>
	);
};

export default NavLink;
