"use client";

import { useState, useEffect } from "react";
import { get } from "@/lib/axios";
import Link from "next/link";
import Image from "next/image";
import Spinner from "@/components/common/Spinner";

const Activities = () => {
  const [activities, setActivities] = useState([]);
  const [pagination, setPagination] = useState({
    currentPage: 1,
    lastPage: 1,
  });
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState("");

  const fetchActivities = async (page = 1) => {
    setLoading(true);
    try {
      const data = await get(`/activities?page=${page}`);
      setActivities(data);
      setPagination({
        currentPage: page,
        lastPage: 1,
      });
    } catch (error) {
      console.error("Error fetching activities:", error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchActivities();
  }, []);

  const handlePagination = (page) => {
    if (page >= 1 && page <= pagination.lastPage) {
      fetchActivities(page);
    }
  };

  const filteredActivities = activities.filter((activity) => {
    return activity.title.toLowerCase().includes(searchTerm.toLowerCase());
  });

  return (
    <div className="min-h-screen bg-white">
      {/* Hero Section */}
      <div className="bg-gradient text-white py-16">
        <div className="container mx-auto px-4">
          <h1 className="text-4xl md:text-5xl font-bold text-center mb-6">
            Discover Amazing Activities
          </h1>
          <p className="text-xl text-center text-gray-100 mb-8">
            Find and join exciting events in your area
          </p>

          {/* Search Section */}
          <div className="max-w-3xl mx-auto flex flex-col md:flex-row gap-4">
            <input
              type="text"
              placeholder="ابحث باسم النشاط"
              className="flex-1 px-6 py-3 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400"
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
            />
          </div>
        </div>
      </div>

      <div className="container mx-auto px-4 py-12">
        {loading ? (
          <div className="flex justify-center items-center h-64">
            <Spinner />
          </div>
        ) : (
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            {filteredActivities.length > 0 ? (
              filteredActivities.map((activity, index) => {
                const images = activity.images || [];
                const firstImage = images[0];

                return (
                  <div
                    key={activity.id}
                    className="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col h-full"
                  >
                    {firstImage && (
                      <div className="relative h-80 overflow-hidden">
                        <Image
                          src={firstImage}
                          alt={`activity-${activity.id}-image`}
                          className="w-full h-full object-cover"
                          width={400}
                          height={300}
                        />
                      </div>
                    )}
                    <div className="p-6 flex flex-col flex-grow">
                      <h3 className="text-2xl font-bold mb-2 text-gray-800 line-clamp-2">
                        {activity.title}
                      </h3>
                      <div className="flex items-center mb-3 text-gray-600">
                        <svg
                          className="w-5 h-5 mr-2"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                          />
                          <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                          />
                        </svg>
                        <p>{activity.location}</p>
                      </div>
                      <div className="flex items-center mb-4 text-gray-600">
                        <svg
                          className="w-5 h-5 mr-2"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            strokeWidth="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                          />
                        </svg>
                        <p>
                          {new Date(activity.activity_date).toLocaleString()}
                        </p>
                      </div>
                      <div className="mt-auto">
                        <Link
                          href={`/activities/${activity.id}`}
                          className="inline-block w-full text-center bg-gradient text-white font-bold py-3 px-6 rounded-full "
                        >
                          View Details
                        </Link>
                      </div>
                    </div>
                  </div>
                );
              })
            ) : (
              <div className="col-span-full text-center py-12">
                <svg
                  className="w-16 h-16 mx-auto text-gray-400 mb-4"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>
                <p className="text-xl text-gray-600">No activities found</p>
              </div>
            )}
          </div>
        )}

        {/* Pagination Controls */}
        <div className="flex justify-center items-center gap-4 mt-12">
          {pagination.currentPage > 1 && (
            <button
              onClick={() => handlePagination(pagination.currentPage - 1)}
              className="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-3 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
              Previous
            </button>
          )}
          <span className="text-lg font-medium text-gray-700">
            Page {pagination.currentPage} of {pagination.lastPage}
          </span>
          {pagination.currentPage < pagination.lastPage && (
            <button
              onClick={() => handlePagination(pagination.currentPage + 1)}
              className="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-3 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
              Next
            </button>
          )}
        </div>
      </div>
    </div>
  );
};

export default Activities;
