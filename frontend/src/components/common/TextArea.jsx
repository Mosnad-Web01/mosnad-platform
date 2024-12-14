"use client";

import React from "react";

const TextArea = ({
  name = "",
  label,
  placeholder,
  rows = 4,
  icon: Icon,
  errorMessage,
  additionalClasses = "",
  value,
  onChange,
  ...props
}) => {
  return (
    <div className={`flex flex-col mt-4 ${additionalClasses}`}>
      {label && (
        <label className="mb-2 text-sm font-medium text-[#21255C]">
          {label}
        </label>
      )}
      <div className="relative">
        {Icon && (
          <div className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
            <Icon />
          </div>
        )}
        <textarea
          placeholder={placeholder}
          rows={rows}
          value={value || ""}
          className={`w-full mt-1 px-4 py-4 rounded-lg bg-gray-50 border border-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400 ${
            Icon ? "pl-10" : ""
          } resize-none`}
          onChange={onChange} // Pass onChange directly without wrapper
          {...props}
        />
      </div>
      {errorMessage && (
        <p className="mt-1 text-sm text-red-500">{errorMessage}</p>
      )}
    </div>
  );
};

export default TextArea;
