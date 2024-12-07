import BootcampCard from '@/components/card/BootcampCard';

// The fetch function to retrieve bootcamp data from your API
const fetchBootcamps = async () => {
  try {
    const res = await fetch('http://localhost:8000/api/bootcamps'); // Replace with your actual API URL
    const data = await res.json();

    // Log the data to inspect the structure
    console.log('Fetched bootcamps data:', data);

    // Access the 'data' array in the API response
    return Array.isArray(data.data) ? data.data : []; // Return data if it's an array
  } catch (error) {
    console.error('Error fetching bootcamps:', error);
    return [];
  }
};

const Bootcamps = async () => {
  const bootcamps = await fetchBootcamps(); // Fetch bootcamps using the new method

  return (
    <div className="max-w-screen-xl mx-auto px-4 py-8">
      <h1 className="text-3xl font-bold mb-6">All Bootcamps</h1>
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {bootcamps.map((bootcamp) => (
          <BootcampCard key={bootcamp.id} bootcamp={bootcamp} />
        ))}
      </div>
    </div>
  );
};

export default Bootcamps;
