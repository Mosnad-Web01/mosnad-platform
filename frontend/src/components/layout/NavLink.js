const NavLink = ({ label, href, className }) => {
	return (
		<li>
			<a
				href={href}
				className={`text-blue-900 hover:text-blue-500 transition ${className}`}>
				{label}
			</a>
		</li>
	);
};

export default NavLink;
