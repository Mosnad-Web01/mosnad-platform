import JobListings from '@/components/home/JobListings';
import JobOpportunitiesPage from '@/components/pages/jop-opportunities/JobOpportunitiesPage';
import { get } from '@/lib/axios';

const fetchJobData = async () => {
	try {
		const data = await get('/job-opportunities');
		return data.opportunities;
	} catch (error) {
		console.error('Error fetching job data:', error.message);
		return [];
	}
};

//fetch Data
const opportunities = await fetchJobData();

export const metadata = {
	title: 'Job Opportunities',
	description: `Explore job opportunities such as ${
		opportunities?.[0]?.title || 'various roles'
	} with details about skills and experience required.`,
	keywords: opportunities?.[0]?.title,
};

const Page = async () => {
	// console.log( "jobData",jobData);
	return (
		<div>
		<JobOpportunitiesPage  jobData={opportunities} />
		</div>
	);
};

export default Page;