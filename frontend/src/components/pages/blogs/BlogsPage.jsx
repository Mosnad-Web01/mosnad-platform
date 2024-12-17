import Image from 'next/image';

export const BlogsPage = ({ blogs }) => {
  return (
    <div className="container mx-auto px-4 py-8">
      {/* Page Title */}
      <h1 className="text-4xl font-bold text-center mb-8 text-gray-800">
        Explore Our Blogs
      </h1>

      {/* Blogs Grid */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        {blogs?.map((blog) => (
          <div
            key={blog.id}
            className="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300"
          >
            {/* Blog Image */}
            {blog.images?.[0] && (
              <Image
                src={blog.images[0]}
                alt={blog.title}
                width={600}
                height={400}
                className="w-full h-48 object-cover"
              />
            )}

            {/* Blog Content */}
            <div className="p-6">
              {/* Title */}
              <h2 className="text-2xl font-semibold mb-2 text-gray-800 truncate">
                {blog.title}
              </h2>

              {/* Categories */}
              <p className="text-sm text-gray-500 mb-2">
                <span className="font-medium">Categories:</span>{' '}
                {blog.categories?.join(', ') || 'Uncategorized'}
              </p>

              {/* Tags */}
              <p className="text-sm text-gray-500 mb-4">
                <span className="font-medium">Tags:</span>{' '}
                {blog.tags?.join(', ') || 'No Tags'}
              </p>

              {/* Content */}
              <p className="text-gray-600 mb-4 line-clamp-3">
                {blog.content || 'No content available.'}
              </p>

              {/* Read More Button */}
              <a
                href="#"
                className="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors duration-300"
              >
                Read More
              </a>
            </div>
          </div>
        ))}
      </div>

      {/* No Blogs Fallback */}
      {blogs?.length === 0 && (
        <p className="text-center text-gray-500 text-lg">No blogs available.</p>
      )}
    </div>
  );
};
