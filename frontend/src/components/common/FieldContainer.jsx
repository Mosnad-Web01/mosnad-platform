import React from "react";

const FieldContainer = ({ label, children, className = "", error }) => {
  return (
    <div className="mt-4">
      {label && (
        <label className="text-sm text-[#21255C] font-medium mb-2 block">
          {label}
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
