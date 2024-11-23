"use client";
import React from "react";

const ToggleButtonGroup = ({ options, activeOption, onOptionChange ,containerStyle  ,buttonStyle}) => {
  return (
    <div className={`flex justify-center gap-4 ${containerStyle}`}>
      {options.map((option, index) => (
        <button
          key={index}
          className={` rounded-lg ${
            activeOption === option.value
              ? "bg-[#F6DAE3] text-blue-950 font-bold"
              : "bg-white text-gray-800 font-bold"
          }  ${buttonStyle}`}
          onClick={() => onOptionChange(option.value)}
        >
          {option.icon && <span className="mr-2 text-lg">{option.icon}</span>}
          {option.label}
        </button>
      ))}
    </div>
  );
};

export default ToggleButtonGroup;
