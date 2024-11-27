const { default: Image } = require("next/image");


const CareerPoint = ({ text, icon }) => {
    return (
      <div className="flex items-center justify-end gap-4">
        <span className="text-gray-700 text-sm">{text}</span>
        <div className="w-14 h-14 bg-purple-50 rounded-full flex items-center justify-center">
          <Image src={icon} alt={text} width={32} height={32} />
        </div>
      </div>
    );
  };
  
  export default CareerPoint;
  