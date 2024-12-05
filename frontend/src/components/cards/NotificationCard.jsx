import Image from "next/image";

export default function NotificationCard({ imageSrc, title, description, date }) {
  return (
    <div className="flex items-center bg-white border-t border-gray-200 mt-3 p-4 gap-6  text-right space-x-reverse space-x-4">
      {/* Text Content */}
      <div className="flex-1">
        <h2 className="text-base font-semibold text-[#4263C5]">{title}</h2>
        <p className="text-xs text-gray-600 mt-1">{description}</p>
        <p className="text-xs text-gray-400 mt-2">{date}</p>
      </div>
      {/* Image */}
      <div className="w-12 h-12 flex-shrink-0">
        <Image
          width={80}
          height={80}
          src={imageSrc}
          alt={title}
          className="w-full h-full object-cover rounded-full"
        />
      </div>
    </div>
  );
}
