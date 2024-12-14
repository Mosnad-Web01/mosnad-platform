import React from 'react';

const Spinner = () => {
  return (
    <div className="flex items-center justify-center min-h-[80vh] bg-gray-50">
      <div className="animate-spin rounded-full h-16 w-16 border-t-4 border-[#F03F74] border-opacity-50"></div>
    </div>
  );
};

export default Spinner;
