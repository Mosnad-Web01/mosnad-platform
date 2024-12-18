import { BlogsPage } from '@/components/pages/blogs/BlogsPage';
import { get } from '@/lib/axios';

// Function to fetch paginated blogs data
const fetchBlogsData = async (page = 1) => {
  try {
    const response = await get(`/blogs?page=${page}`);
    return {
      blogs: response?.blogs || [],
      currentPage: response?.current_page || 1,
      lastPage: response?.last_page || 1,
      total: response?.total || 0,
    };
  } catch (error) {
    console.error('Error fetching blogs data:', error.message);
    return {
      blogs: [],
      currentPage: 1,
      lastPage: 1,
      total: 0,
    };
  }
};

// Metadata generator for paginated blogs page
export const generateMetadata = async ({ searchParams }) => {
  const page = parseInt(searchParams.page || '1', 10);
  const { blogs } = await fetchBlogsData(page);

  const metadata = {
    title: `Blogs - Page ${page}`,
    description: `Explore blogs on page ${page}, like ${blogs?.[0]?.title || 'various topics'} with details and insights.`,
    keywords: blogs.length
      ? blogs.map((blog) => blog.meta_keywords).flat().join(', ')
      : 'blogs, articles, news, tech, lifestyle',
  };

  return metadata;
};

// Server component for paginated blogs
const Page = async ({ searchParams }) => {
  const page = parseInt(searchParams.page || '1', 10);
  const { blogs, currentPage, lastPage, total } = await fetchBlogsData(page);

  return (
    <BlogsPage
      blogs={blogs}
      currentPage={currentPage}
      lastPage={lastPage}
      total={total}
    />
  );
};

export default Page;
