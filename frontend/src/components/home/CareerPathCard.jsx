import Image from "next/image";

const CareerPathCard = ({ imageSrc,  label }) => {
  return (
    <div className="flex flex-col items-center justify-center gap-4">
      <figure className="w-[160px] h-[185px] overflow-hidden">
        <Image
          src={imageSrc}
          alt={label}
          width={100}
          height={100}
          className="w-full h-full object-cover"
        />
      </figure>
      <div>
        <span className="text-blue-950 text-sm font-bold">{label}</span>
      </div>
    </div>
  );
};

export default CareerPathCard;
