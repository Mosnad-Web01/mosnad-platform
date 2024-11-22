import React from "react";

const FieldContainer = ({ label, children, className = "" }) => {
  return (
    <div>
      {label && (
        <label className={`text-sm text-[#21255C] font-medium mb-2 block`}>
          {label}
        </label>
      )}
      <div className={`${className}`}>
        {children}
      </div>
    </div>
  );
};

export default FieldContainer;
