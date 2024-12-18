"use client";
import { Pagination } from '@/components/common/Pagination';
import { useState, useEffect } from 'react';
import { getSearch } from '@/lib/axios';
import debounce from 'lodash/debounce';
import JobCard from './JobCard';
import JobCardSkeleton from './JobCardSkeleton';

const JobOpportunitiesPage = ({ jobData: initialJobData, currentPage, lastPage, total }) => {
  const [searchQuery, setSearchQuery] = useState('');
  const [searchResults, setSearchResults] = useState([]);
  const [isSearching, setIsSearching] = useState(false);
  const [error, setError] = useState(null);

  // Debounced search to minimize API calls
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
      const { data } = await getSearch('/search/job-opportunities', { query });
      if (data?.success) {
        setSearchResults(data.opportunities);
      } else {
        setSearchResults([]);
      }
    } catch (err) {
      setSearchResults([]);
      setError(err?.message || 'Failed to fetch search results');
      console.error('Search error:', err);
    } finally {
      setIsSearching(false);
    }
  }, 500);

  useEffect(() => {
    debouncedSearch(searchQuery);
    return () => debouncedSearch.cancel();
  // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [searchQuery]);

  const displayedOpportunities = searchQuery.trim() ? searchResults : initialJobData;

  const handleSearchChange = (e) => {
    setSearchQuery(e.target.value);
    setError(null);
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header Section */}
      <div className="bg-gradient text-white py-16">
        <div className="container mx-auto px-4">
          <h1 className="text-4xl md:text-5xl font-bold text-center mb-6">
            اكتشف الفرص الوظيفية المتميزة
          </h1>
          <p className="text-xl text-center text-gray-100 mb-8">
            استعرض الفرص المتاحة وابدأ مسيرتك المهنية معنا
          </p>

          {/* Search Section */}
          <div className="max-w-3xl mx-auto flex flex-col md:flex-row gap-4">
            <input
              type="text"
              placeholder="...ابحث عن الوظائف"
              value={searchQuery}
              onChange={handleSearchChange}
              className="flex-1 px-6 py-3 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400"
            />
          </div>
        </div>
      </div>

      {/* Jobs Grid */}
      <section className="container mx-auto px-4 py-12">
        <div className="space-y-6">
          {/* Loading Skeleton Cards */}
          {isSearching && (
             <div className='flex flex-col gap-2'>
              {Array.from({ length: 6 }).map((_, index) => (
                <JobCardSkeleton key={index} />
              ))}
            </div>
          )}

          {/* Error State */}
          {error && (
            <div className="text-center py-4">
              <p className="text-red-500">{error}</p>
            </div>
          )}

          {/* Job Cards */}
          {!isSearching && displayedOpportunities.length > 0 && (
            <div className='flex flex-col gap-2'>
              {displayedOpportunities.map((job) => (
                <JobCard
                  key={job.id}
                  id= {job.id}
                  title={job.title}
                  required_skills={job.required_skills}
                  experience={job.experience}
                  image_url = {job.imgurl}
                  end_date={job.end_date}
                />
              ))}
            </div>
          )}

          {/* No Results Message */}
          {!isSearching && displayedOpportunities.length === 0 && (
            <p className="text-center text-gray-500 text-lg">
              {searchQuery
                ? 'لم يتم العثور على وظائف مطابقة لبحثك.'
                : 'لا توجد وظائف متاحة في الوقت الحالي.'}
            </p>
          )}
        </div>
      </section>

      {/* Pagination */}
      {!searchQuery && (
        <div className="py-8">
          <Pagination currentPage={currentPage} lastPage={lastPage} total={total} />
        </div>
      )}
    </div>
  );
};

export default JobOpportunitiesPage;
