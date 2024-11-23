import Image from "next/image";
import React from "react";

const CurvedCard = ({ image, title, subtitle }) => {
  return (
    <div className="flex gap-6 justify-center items-center bg-white/20 shadow-md rounded-full w-full max-w-xs p-6 hover:shadow-lg transition-shadow duration-300">
      <div className="text-center">
        <h3 className="text-lg font-bold text-[#21255C]">{title}</h3>
        <p className="text-base text-[#21255C] font-bold">{subtitle}</p>
      </div>
      <div className="place-self-center">
        <Image src={image} alt={title} width={80} height={80} />
      </div>
    </div>
  );
};

export default CurvedCard;
