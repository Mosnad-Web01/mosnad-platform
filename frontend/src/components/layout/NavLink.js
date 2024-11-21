const NavLink = ({
	label,
	href,
	className = '',
	icon = null,
	isSidebar = false,
}) => {
	return (
		<li className={`flex items-center ${isSidebar ? 'gap-3' : ''}`}>
			{isSidebar && icon && <span className="text-xl ">{icon}</span>}
			<a
				href={href}
				className={`text-sm font-bold transition ${
					isSidebar
						? 'text-white hover:text-purple-200'
						: 'text-blue-950 hover:text-blue-500'
				} ${className}`}>
				{label}
			</a>
		</li>
	);
};

export default NavLink;
//   className={`text-sm font-bold text-blue-950 hover:text-blue-500 transition ${className}`}>
