"use client";
import React from "react";

const ToggleButtonGroup = ({ options, activeOption, onOptionChange }) => {
  return (
    <div className={`flex justify-center gap-4`}>
      {options.map((option, index) => (
        <button
          key={index}
          className={`px-6 lg:px-12 py-2 rounded-lg ${
            activeOption === option.value
              ? "bg-[#F6DAE3] text-blue-950 font-bold"
              : "bg-white text-gray-800 font-bold"
          }`}
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
