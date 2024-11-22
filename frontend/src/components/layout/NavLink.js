const NavLink = ({
	label,
	href,
	className = '',
	icon = null,
	isSidebar = false,
}) => {
	// You'll need to implement this based on your routing system (e.g., using useLocation from react-router)
	const isActive = window.location.pathname === href;

	return (
		<li className={`flex items-center ${isSidebar ? 'gap-3' : ''}`}>
			{isSidebar && icon && <span className="text-xl">{icon}</span>}
			<div className="relative">
				<a
					href={href}
					className={`text-sm font-bold transition relative group ${
						isSidebar
							? 'text-white hover:text-purple-200'
							: 'text-blue-950 hover:text-[#F03F74]'
					} ${ !isSidebar && isActive ? 'text-[#F03F74]' : 'text-blue-950 hover:text-blue-500'} ${className}`}>
					{label}
					<div
						className={`absolute -bottom-4 left-0 w-full ${
							isActive && !isSidebar ? 'opacity-100' : 'opacity-0'
						} transition-opacity duration-300`}>
						<svg
							width="53"
							height="8"
							viewBox="0 0 53 8"
							fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path
								d="M50.818 0.957031L51.639 5.94282C51.6399 5.94789 51.636 5.9525 51.6308 5.9525H1.65047C1.64532 5.9525 1.6414 5.94787 1.64226 5.94279L2.46329 1.06723"
								stroke="#F03F74"
								strokeWidth="2.49773"
							/>
						</svg>
					</div>
					{!isActive && (
						<span className="absolute -bottom-2 left-0 w-full h-[2px] bg-pink-300 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
					)}
				</a>
			</div>
		</li>
	);
};

export default NavLink;
