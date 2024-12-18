import SingleBlog from '@/components/pages/blogs/SingleBlog';
import { get } from '@/lib/axios';
import { notFound } from 'next/navigation';


const fetchBlogData = async (id) => {
	try {
		const response = await get(`/blogs/${id}`);
		return response?.blog || null;
	} catch (error) {
		console.error('Error fetching blog data:', error.message);
		return null;
	}
};

// Generate metadata for the page
export async function generateMetadata({ params }) {
	const blog = await fetchBlogData(params.id);

	if (!blog) {
		return {
			title: 'Blog Not Found',
			description: 'The requested blog could not be found.',
		};
	}

	return {
		title: blog.title,
		description: blog.meta_description || blog.excerpt,
		keywords: blog.meta_keywords?.join(', ') || 'blog, article',
	};
}

const Page = async ({ params }) => {
	const blog = await fetchBlogData(params.id);

	if (!blog) {
		notFound();
	}

	return <SingleBlog blog={blog} />;
};

export default Page;
