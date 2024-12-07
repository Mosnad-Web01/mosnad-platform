import Image from "next/image";
import Link from "next/link";

const BootcampCard = ({ bootcamp }) => {
  return (
    <div className="flex flex-col lg:flex-row gap-12 p-6 rounded-xl bg-white border border-gray-200 shadow-md overflow-hidden">
      {/* Content Section */}
      <div className="w-full lg:w-2/4 flex flex-col justify-between order-2 lg:order-1">
        <div>
          <h2 className="text-xl lg:text-2xl font-semibold text-gray-800 mb-3">
            {bootcamp.name}
          </h2>
          <div className="flex flex-wrap gap-2 mb-3">
            {bootcamp.tags?.map((tag, index) => (
              <span
                key={index}
                className="px-3 py-1 text-xs bg-pink-50 text-pink-600 rounded-full font-medium"
              >
                {tag}
              </span>
            ))}
          </div>
          <p className="text-sm lg:text-base text-gray-600 line-clamp-3 mb-4">
            {bootcamp.description}
          </p>
        </div>

        {/* Additional Images Section */}
        <div className="mt-4">
          <div className="flex overflow-x-auto pb-4 space-x-4">
            {bootcamp.additional_images?.map((image, index) => (
              <div
                key={index}
                className="relative w-[160px] sm:w-[200px] h-[100px] sm:h-[120px] rounded-lg overflow-hidden"
              >
                <Image
                  src={image}
                  alt={`Additional image ${index + 1}`}
                  width={400}
                  height={240}
                  className="object-contain w-full h-full"
                />
              </div>
            ))}
          </div>
        </div>

        {/* Bootcamp Info */}
        <div className="flex flex-wrap items-center justify-between gap-4 mt-auto">
          <Link
            href={`/bootcamp/${bootcamp.id}`}
            className="inline-block bg-gradient mt-4 sm:mt-6 px-5 sm:px-6 py-2 sm:py-3 text-white rounded-lg text-sm sm:text-base"
          >
            المزيد من التفاصيل
          </Link>
        </div>
      </div>

      {/* Main Image Section */}
      <div className="lg:w-2/3 h-[280px] sm:h-[360px] lg:h-auto relative overflow-hidden rounded-xl order-1 lg:order-2">
        <Image
          src={bootcamp.main_image || "/default-image.jpg"}
          alt={bootcamp.name}
          fill
          className="object-contain w-full h-full"
          sizes="(max-width: 768px) 120vw, (max-width: 1200px) 50vw, 33vw"
        />
      </div>
    </div>
  );
};

export default BootcampCard;
