import { BlogsPage } from '@/components/pages/blogs/BlogsPage';
import { get } from '@/lib/axios';

// Function to fetch blogs data
const fetchBlogsData = async () => {
  try {
    const response = await get('/blogs');
    return response?.blogs || [];
  } catch (error) {
    console.error('Error fetching blogs data:', error.message);
    return [];
  }
};

const blogs = await fetchBlogsData();

export const metadata = {
    title: 'Blogs',
   description: `Explore blogs like ${blogs?.[0]?.title || 'various topics'} with details and insights.`,
   keywords: blogs.length
   ? blogs.map((blog) => blog.meta_keywords).flat().join(', ')
   : 'blogs, articles, news, tech, lifestyle',
};

const Page = async () => {
  return (
   <BlogsPage blogs={blogs} />
  )
}

export default Page;



