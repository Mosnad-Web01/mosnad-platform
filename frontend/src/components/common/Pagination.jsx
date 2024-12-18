import Link from "next/link";

export const Pagination = ({ currentPage, lastPage, total }) => {
    const generatePageLinks = () => {
      const pages = [];
      for (let i = 1; i <= lastPage; i++) {
        pages.push(
          <a
            key={i}
            href={`?page=${i}`}
            className={`px-4 py-2 border ${
              i === currentPage ? 'bg-blue-600 text-white' : 'bg-white text-gray-800'
            } rounded-lg hover:bg-blue-500 hover:text-white transition`}
          >
            {i}
          </a>
        );
      }
      return pages;
    };
  
    return (
      <div className="flex flex-col items-center mt-8">
        <p className="text-gray-600 text-sm mb-4">
          Showing page {currentPage} of {lastPage}, total blogs: {total}.
        </p>
        <div className="flex gap-2">
        {currentPage < lastPage && (
            <Link
              href={`?page=${currentPage + 1}`}
              className="px-4 py-2 border bg-white text-gray-800 rounded-lg hover:bg-blue-500 hover:text-white transition"
            >
              التالي
            </Link>
          )}
          {generatePageLinks()}

                    {currentPage > 1 && (
            <Link
              href={`?page=${currentPage - 1}`}
              className="px-4 py-2 border bg-white text-gray-800 rounded-lg hover:bg-blue-500 hover:text-white transition"
            >
              السابق
            </Link>
          )}
        </div>
      </div>
    );
  };
  