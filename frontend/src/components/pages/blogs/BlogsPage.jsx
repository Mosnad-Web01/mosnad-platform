"use client";
import { Pagination } from "@/components/common/Pagination";
import Image from "next/image";
import Link from "next/link";
import { useState, useEffect } from "react";
import { getSearch } from "@/lib/axios";
import debounce from "lodash/debounce";
import SkeletonCard from "./SkeletonCard";

export const BlogsPage = ({
  blogs: initialBlogs,
  currentPage,
  lastPage,
  total,
}) => {
  const [searchQuery, setSearchQuery] = useState("");
  const [searchResults, setSearchResults] = useState([]);
  const [isSearching, setIsSearching] = useState(false);
  const [error, setError] = useState(null);

  const debouncedSearch = debounce(async (query) => {
    if (!query.trim()) {
      setSearchResults([]);
      setIsSearching(false);
      setError(null);
      return;
    }

    try {
      setIsSearching(true);
      setError(null);
      const { data } = await getSearch("/search/blogs", { query });
      if (data?.success) {
        setSearchResults(data.blogs);
      }
    } catch (err) {
      setSearchResults([]);
      setError(err?.message || "Failed to fetch search results");
      console.error("Search error:", err);
    } finally {
      setIsSearching(false);
    }
  }, 500);

  useEffect(() => {
    debouncedSearch(searchQuery);
    return () => debouncedSearch.cancel();
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [searchQuery]);

  const displayedBlogs = searchQuery.trim() ? searchResults : initialBlogs;

  const handleSearchChange = (e) => {
    setSearchQuery(e.target.value);
    setError(null);
  };

  return (
    <div>
      <div className="bg-gradient text-white py-16">
        <div className="container mx-auto px-4">
          <h1 className="text-4xl md:text-5xl font-bold text-center mb-6">
            Discover inspiring blogs
          </h1>
          <p className="text-xl text-center text-gray-100 mb-8">
            Read the latest inspiring blogs from our community
          </p>

          {/* Search Section */}
          <div className="max-w-3xl mx-auto flex flex-col md:flex-row gap-4">
            <input
              type="text"
              placeholder="ابحث باسم المقال"
              className="flex-1 px-6 py-3 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400"
              value={searchQuery}
              onChange={handleSearchChange}
            />
          </div>
        </div>
      </div>

      <div className="bg-gradient-to-b from-purple-200 via-pink-100 to-white">
        <div className="container mx-auto px-4 py-8">
          {/* Loading Skeleton Cards */}
          {isSearching && (
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
              {Array.from({ length: 6 }).map((_, index) => (
                <SkeletonCard key={index} />
              ))}
            </div>
          )}

          {/* Error State */}
          {error && (
            <div className="text-center py-4">
              <p className="text-red-500">{error}</p>
            </div>
          )}

          {/* Blogs Grid */}
          {!isSearching && (
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
              {displayedBlogs?.map((blog) => (
                <div
                  key={blog.id}
                  className="bg-white rounded-lg shadow-lg overflow-hidden  flex flex-col"
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
                  <div className="p-6 flex flex-col flex-grow">
                    <h2 className="text-2xl font-semibold mb-2 text-gray-800 truncate">
                      {blog.title}
                    </h2>
                    <p className="text-sm text-gray-500 mb-2">
                      <span className="font-medium">Categories:</span>{" "}
                      {blog.categories?.join(" , ") || "Uncategorized"}
                    </p>
                    <p className="text-sm text-gray-500 mb-4">
                      <span className="font-medium">Tags:</span>{" "}
                      {blog.tags?.join(" , ") || "No Tags"}
                    </p>
                    <p className="text-gray-600 mb-4 line-clamp-3 flex-grow">
                      {blog.content || "No content available."}
                    </p>
                    <div className="mt-auto">
                      <Link
                        href={`/blogs/${blog.id}`}
                        className="inline-block bg-gradient text-white px-4 py-2 rounded-lg transition-colors duration-300"
                      >
                        قراءة المزيد
                      </Link>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          )}

          {/* No Results Message */}
          {displayedBlogs?.length === 0 && !isSearching && (
            <p className="text-center text-gray-500 text-lg">
              {searchQuery ? "No matching blogs found." : "No blogs available."}
            </p>
          )}

          {/* Only show pagination when not searching */}
          {!searchQuery && (
            <Pagination
              currentPage={currentPage}
              lastPage={lastPage}
              total={total}
            />
          )}
        </div>
      </div>
    </div>
  );
};
