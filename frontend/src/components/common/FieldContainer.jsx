import React from "react";

const FieldContainer = ({ label,header, children, className = "", error }) => {
  return (
    <div className="mt-3">
      {label && (
        <label className="text-md font-bold text-[#21255C]  mb-2 block">
          {label}
        </label>
      )}

      {header && (
        <label className="mb-2 mr-3 text-sm text-[#21255C] font-medium">
          {header}
        </label>
      )}  

      <div className={`${className}`}>
        {children}
      </div>
      {/* Display error message if it exists */}
      {error && <p className="text-red-500 text-sm mt-1 mb-3">{error}</p>}
    </div>
  );
};

export default FieldContainer;
