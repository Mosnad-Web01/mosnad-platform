'use client';
import { FaRegUserCircle, FaTimes, FaUserCircle } from 'react-icons/fa';
import NavLink from './NavLink';
import Link from 'next/link';
import useLogout from '@/hooks/auth/useLogout';
import { useAuth } from '@/hooks/auth/useAuth';
import Image from 'next/image';

const Sidebar = ({ isOpen, onClose, navItems }) => {
	const { user } = useAuth();
	const logout = useLogout();

	const GradientButton = ({ href, children, primary, onClick }) => (
		<Link
			href={href}
			//to close sidebar
			onClick={(e) => {
				if (onClick) {
					onClick();
				}
			}}
			className={`group relative overflow-hidden block w-full rounded-lg px-6 py-3.5 text-center text-sm font-medium shadow-lg transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] ${
				primary
					? 'bg-gradient-to-r from-pink-500 to-red-500 text-white shadow-pink-500/25 hover:shadow-pink-500/35'
					: 'bg-gradient-to-r from-slate-700 to-slate-800 text-white shadow-slate-500/25 hover:shadow-slate-500/35'
			}`}>
			<span className="relative z-10">{children}</span>
			<div className="absolute inset-0 -translate-x-full bg-gradient-to-r from-white/10 to-transparent transition-transform duration-300 group-hover:translate-x-full" />
		</Link>
	);

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
						<ul className="space-y-2">
							{navItems.map((item, index) => (
								<NavLink
									key={index}
									label={item.label}
									href={item.href}
									icon={item.icon}
									isSidebar={true}
									onClick={onClose}
									className="flex items-center gap-3 rounded-lg px-4 py-3 text-slate-300 transition-all duration-200 hover:bg-slate-700/50 hover:text-white active:scale-95"
								/>
							))}
						</ul>
					</nav>

					{/* Auth Section */}
					{user ? (
						<div className="space-y-4 border-t border-slate-700/50 py-6">
							<div className="flex items-center gap-3 rounded-lg px-4 py-3 text-slate-300 transition-all duration-200 hover:bg-slate-700/50 hover:text-white active:scale-95">
								<Link href="/profile" onClick={onClose}>
									<div className="flex items-center gap-3">
										<div className="relative h-8 w-8 overflow-hidden rounded-full">
											<FaRegUserCircle className="text-2xl" />
										</div>
										<div className="flex flex-col">
											<span className="text-sm font-medium">
												{user?.name}
											</span>
											<span className="text-xs text-slate-400">
												{user?.email}
											</span>
										</div>
									</div>
								</Link>
							</div>
							<button
								onClick={() => {
									logout();
									onClose(); //to close the sidebar
								}}
								className="block w-full rounded-lg bg-gradient-to-r from-pink-500 to-red-500 px-6 py-3 text-center text-sm font-medium text-white shadow-md transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]">
								تسجيل الخروج
							</button>
						</div>
					) : (
						<div className="space-y-4 border-t border-slate-700/50 py-6">
							<div className="space-y-3">
								<GradientButton
									href="/register"
									primary
									onClick={onClose}>
									إنشاء حساب جديد
								</GradientButton>
								<GradientButton href="/login" onClick={onClose}>
									تسجيل الدخول
								</GradientButton>
							</div>
						</div>
					)}

					{/* Welcome Section */}
					{!user && (
						<div className="mt-8 overflow-hidden rounded-xl bg-gradient-to-br from-slate-700/50 via-slate-800/50 to-slate-900/50 p-6">
							<div className="relative">
								<div className="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-pink-500/10 blur-2xl" />
								<div className="absolute -left-6 -bottom-6 h-24 w-24 rounded-full bg-red-500/10 blur-2xl" />
								<div className="relative space-y-4 text-center">
									<div className="inline-flex animate-bounce items-center justify-center rounded-full bg-gradient-to-r from-pink-500 to-red-500 p-3">
										<span className="text-2xl">✨</span>
									</div>
									<div>
										<h3 className="text-lg font-semibold text-white">
											مرحبًا بك في Mosnad!
										</h3>
										<p className="mt-2 text-sm text-slate-400">
											انضم إلينا اليوم واكتشف الفرص
											المتاحة
										</p>
									</div>
								</div>
							</div>
						</div>
					)}
				</div>
			</div>
		</div>
	);
};

export default Sidebar;
