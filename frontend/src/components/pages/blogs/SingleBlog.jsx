'use client';
import Image from 'next/image';
import React, { useState, useEffect } from 'react';
import { formatEnglishDate, formatArabicDate } from '@/utils/formatter';
const SingleBlog = ({ blog }) => {
	const [currentImageIndex, setCurrentImageIndex] = useState(0);
	const [isScrolled, setIsScrolled] = useState(false);

	useEffect(() => {
		const handleScroll = () => {
			setIsScrolled(window.scrollY > 50);
		};
		window.addEventListener('scroll', handleScroll);
		return () => window.removeEventListener('scroll', handleScroll);
	}, []);

	return (
		<div
			className="min-h-screen bg-gradient-to-b from-gray-50 to-white"
			dir="rtl">
			{/* Hero Section */}
			<div className="relative h-[90vh] w-full overflow-hidden">
				<Image
					src={blog.images[0]}
					fill
					priority
					quality={90}
					alt={blog.title}
					className="object-cover"
				/>
				<div className="absolute inset-0 bg-gradient-to-b from-black/40 via-black/30 to-black/70" />

				<div className="absolute inset-0 flex flex-col justify-end p-8 sm:p-16 max-w-7xl mx-auto">
					<div className="space-y-4 animate-fade-up">
						<div className="flex flex-wrap gap-3">
							{blog.categories.map((category, index) => (
								<span
									key={index}
									className="px-4 py-1.5 bg-white/10 backdrop-blur-sm text-white rounded-full text-sm border border-white/20">
									{category}
								</span>
							))}
						</div>
						<h1 className="text-4xl sm:text-6xl font-bold text-white leading-tight max-w-4xl">
							{blog.title}
						</h1>
						<div className="flex items-center gap-4 text-white/80 text-sm sm:text-base">
							<time className="flex items-center gap-2">
								<svg
									className="w-5 h-5"
									fill="none"
									stroke="currentColor"
									viewBox="0 0 24 24">
									<path
										strokeLinecap="round"
										strokeLinejoin="round"
										strokeWidth="2"
										d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
									/>
								</svg>
								<div className="flex flex-col ">
									<div>
										{formatArabicDate(blog.created_at)}
									</div>
									<div>
										{formatEnglishDate(blog.created_at)}
									</div>
								</div>
							</time>
						</div>
					</div>
				</div>
			</div>

			{/* Floating Header */}
			<div
				className={`fixed top-0 left-0 right-0 bg-white/80 backdrop-blur-xl z-50 transform transition-all duration-500 ${
					isScrolled ? 'translate-y-0 shadow-lg' : '-translate-y-full'
				}`}>
				<div className="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
					<h2 className="text-xl font-bold text-gray-800 truncate">
						{blog.title}
					</h2>
					<div className="flex gap-3">
						{blog.categories.slice(0, 2).map((category, index) => (
							<span
								key={index}
								className="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">
								{category}
							</span>
						))}
					</div>
				</div>
			</div>

			<main className="max-w-7xl mx-auto px-4 py-16">
				{/* Content Section */}
				<div className="grid grid-cols-1 lg:grid-cols-12 gap-12">
					<article className="lg:col-span-8 space-y-12">
						{/* Main Content */}
						<div className="prose prose-lg max-w-none">
							<div className="text-gray-700 leading-relaxed text-lg space-y-6">
								{blog.content}
							</div>
						</div>

						{/* Image Gallery */}
						<div className="space-y-6">
							<h3 className="text-2xl font-bold text-gray-900">
								معرض الصور
							</h3>
							<div className="grid grid-cols-2 gap-4">
								{blog.images.map((image, index) => (
									<div
										key={index}
										className="relative aspect-[4/3] rounded-xl overflow-hidden group cursor-pointer">
										<Image
											src={image}
											fill
											quality={75}
											sizes="500px"
											alt={`${blog.title} - صورة ${
												index + 1
											}`}
											className="object-cover transform transition-transform duration-500 group-hover:scale-110"
										/>
										<div className="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
									</div>
								))}
							</div>
						</div>
					</article>

					{/* Sidebar */}
					<aside className="lg:col-span-4 space-y-8">
						{/* Categories */}
						<div className="bg-gray-50 rounded-2xl p-6 shadow-sm">
							<h3 className="text-xl font-bold text-gray-900 mb-4">
								التصنيفات
							</h3>
							<div className="flex flex-wrap gap-2">
								{blog.categories.map((category, index) => (
									<span
										key={index}
										className="px-4 py-2 bg-white text-gray-800 rounded-full text-sm 
                                                   shadow-sm hover:shadow-md transition-all duration-300 cursor-pointer">
										{category}
									</span>
								))}
							</div>
						</div>

						{/* Tags */}
						<div className="bg-gray-50 rounded-2xl p-6 shadow-sm">
							<h3 className="text-xl font-bold text-gray-900 mb-4">
								الوسوم
							</h3>
							<div className="flex flex-wrap gap-2">
								{blog.tags.map((tag, index) => (
									<span
										key={index}
										className="px-4 py-2 bg-white text-gray-600 rounded-full text-sm 
                                                   hover:bg-gray-100 transition-colors duration-300 cursor-pointer">
										{tag}
									</span>
								))}
							</div>
						</div>

						{/* Meta Info */}
						<div className="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 shadow-sm">
							<h3 className="text-xl font-bold text-gray-900 mb-4">
								معلومات إضافية
							</h3>
							<div className="space-y-4">
								<div>
									<h4 className="font-semibold text-gray-700 mb-2">
										الوصف التعريفي
									</h4>
									<p className="text-gray-600 text-sm">
										{blog.meta_description}
									</p>
								</div>
								<div>
									<h4 className="font-semibold text-gray-700 mb-2">
										الكلمات المفتاحية
									</h4>
									<div className="flex flex-wrap gap-2">
										{blog.meta_keywords.map(
											(keyword, index) => (
												<span
													key={index}
													className="px-3 py-1 bg-white/50 text-gray-600 rounded-full text-xs">
													{keyword}
												</span>
											),
										)}
									</div>
								</div>
							</div>
						</div>
					</aside>
				</div>
			</main>
		</div>
	);
};

export default SingleBlog;
