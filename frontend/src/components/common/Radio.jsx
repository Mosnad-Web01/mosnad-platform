"use client";

import React from "react";

const RadioButton = ({ name, label, value, checked, onChange }) => (
  <div className="mt-2 w-full">
    <label
      className={`w-full px-4 py-4 flex items-center justify-start gap-1 rounded-lg border cursor-pointer text-center text-sm font-medium transition-all duration-300 ${
        checked
          ? "bg-[#D4EDDA] border-[#2EA154] text-[#2EA154]"
          : "bg-gray-50 border-gray-100 text-gray-400 hover:bg-gray-100"
      }`}
    >
      <input
        type="radio"
        name={name}
        value={value}
        checked={checked}
        onChange={() => onChange(value)}
        className="hidden"
      />
      <div
        className={`w-5 h-5 rounded-full border-2 flex items-center justify-center ${
          checked ? "bg-[#2EA154] border-[#2EA154]" : "bg-white border-gray-400"
        }`}
      >
        {checked && <div className="w-3 h-3 bg-white rounded-full" />}
      </div>
      <span className="ml-3">{label}</span>
    </label>
  </div>
);

export default RadioButton;
