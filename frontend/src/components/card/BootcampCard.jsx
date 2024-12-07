import Image from 'next/image';
import Link from 'next/link';

const BootcampCard = ({ bootcamp }) => {
  return (
    <div className="max-w-sm rounded overflow-hidden shadow-lg bg-white">
      {/* <Image
        src={bootcamp.main_image || '/default-image.jpg'} // Use relative path for images in the public folder
        alt={bootcamp.name}
        width={500}
        height={300}
        className="w-full h-48 object-cover"
      /> */}
      <div className="px-6 py-4">
        <div className="font-bold text-xl mb-2">{bootcamp.name}</div>
        <p className="text-gray-700 text-base">{bootcamp.description}</p>
      </div>
      <div className="px-6 pt-4 pb-2">
        <Link href={`/bootcamp/${bootcamp.id}`} className="text-pink-500 hover:text-pink-400 transition-all duration-300">
            See more details
        </Link>
      </div>
    </div>
  );
};

export default BootcampCard;
