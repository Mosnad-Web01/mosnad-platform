import JobListings from '@/components/home/JobListings';
import JobOpportunitiesPage from '@/components/pages/jop-opportunities/JobOpportunitiesPage';
import { get } from '@/lib/axios';

const fetchJobData = async (page = 1) => {
	try {

		const response = await get(`/job-opportunities?page=${page}`);
		return {
			jobData: response?.opportunities || [],
			currentPage: response?.currentPage || 1,
			lastPage: response?.lastPage || 1,
			total: response?.total || 0,
		};

	} catch (error) {
		console.error('Error fetching job data:', error.message);
		return {
			jobData: [],
			currentPage: 1,
			lastPage: 1,
			total: 0,
		};
	}
};

// Metadata generator for paginated Job opportunities page
export const generateMetadata = async ({ searchParams }) => {
	const page = parseInt(searchParams.page || '1', 10);
	const { jobData } = await fetchJobData(page);

	const metadata = {
		title: `Job Opportunities - Page ${page}`,
		description: `Explore job opportunities such as ${jobData?.[0]?.title || 'various roles'} with details about skills and experience required.`,
		keywords: jobData.length
			? jobData.map((job) => job.meta_keywords).flat().join(', ')
			: '',
	};

	return metadata;
};

// Server component for paginated 
const Page = async ({ searchParams }) => {
	const page = parseInt(searchParams.page || '1', 10);
	const { jobData, currentPage, lastPage, total } = await fetchJobData(page);

	return (
		<JobOpportunitiesPage
			jobData={jobData}
			currentPage={currentPage}
			lastPage={lastPage}
			total={total}
		/>

	);
};

export default Page;