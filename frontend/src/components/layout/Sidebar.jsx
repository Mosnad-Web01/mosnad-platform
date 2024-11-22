'use client';
import { FaTimes } from 'react-icons/fa';
import NavLink from './NavLink';

const Sidebar = ({ isOpen, onClose, navItems }) => {
	return (
		<div
			className={`fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm transition-opacity duration-300 ${
				isOpen ? 'opacity-100 visible' : 'opacity-0 invisible'
			}`}>
			<div
				className={`fixed right-0 top-0 h-full w-80 transform bg-gradient-to-b from-slate-800 to-slate-900 text-white shadow-2xl transition-transform duration-500 ease-in-out ${
					isOpen ? 'translate-x-0' : 'translate-x-full'
				}`}>
				{/* Close Button */}
				<div className="flex justify-end p-4">
					<button
						onClick={onClose}
						className="rounded-full bg-slate-700/50 p-2 transition-all duration-200 hover:bg-slate-600/50 hover:rotate-90">
						<FaTimes className="h-5 w-5 text-slate-200" />
					</button>
				</div>

				{/* Sidebar Content */}
				<div className="px-6">
					{/* Navigation Links */}
					<nav className="mb-8">
						<ul className="space-y-4">
							{navItems.map((item, index) => (
								<NavLink
									key={index}
									label={item.label}
									href={item.href}
									icon={item.icon}
									isSidebar={true}
									className="flex items-center gap-3 rounded-lg px-4 py-3 text-slate-300 transition-all duration-200 hover:bg-slate-700/50 hover:text-white active:scale-95"
								/>
							))}
						</ul>
					</nav>

					{/* Auth Section */}
					<div className="space-y-4 border-t border-slate-700/50 py-6">
						<a
							className="bg-gradient block w-full rounded-lg px-6 py-3 text-center text-sm font-medium text-white shadow-md shadow-teal-500/25 transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
							href="#">
							إنشاء حساب
						</a>
						<a
							className="block w-full rounded-lg bg-gradient-to-r from-teal- to-emerald-500 px-6 py-3 text-center text-sm font-medium text-white shadow-md shadow-teal-500/25 transition-all duration-200 hover:scale-[1.02] hover:shadow-teal-500/35 active:scale-[0.98]"
							href="#">
							تسجيل الدخول
						</a>
					</div>

					{/* Welcome Section
					<div className="mt-8 rounded-lg bg-gradient-to-r from-slate-800/50 to-slate-700/50 p-6 text-center">
						<div className="inline-block rounded-full bg-teal-500/10 p-3">
							<span className="text-2xl">✨</span>
						</div>
						<h3 className="mt-3 text-lg font-semibold text-white">
							مرحبًا بك في Mosnad!
						</h3>
						<p className="mt-2 text-sm text-slate-400">
							ابدأ رحلتك معنا اليوم
						</p>
					</div> */}
				</div>
			</div>
		</div>
	);
};

export default Sidebar;
