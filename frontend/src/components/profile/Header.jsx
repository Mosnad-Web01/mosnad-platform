export default function Header({ title }) {
	return (
		<header className="bg-white shadow py-6 px-4 sm:py-8 sm:px-6 rounded-2xl relative overflow-hidden">
			<h1 className="text-sm sm:text-base text-[#21255C] font-bold relative w-fit after:content-[''] after:absolute after:w-[calc(100%+2.5rem)] after:h-12 after:bg-blue-500/20 after:rounded-tl-full after:rounded-bl-full after:right-[-20px] after:top-1/2 after:-translate-y-1/2">
				{title}
			</h1>
		</header>
	);
}