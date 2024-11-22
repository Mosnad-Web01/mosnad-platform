import React from "react";

const Checkbox = ({ label, checked, onChange }) => (
  <div className="mb-4 flex items-center space-x-2">
    <input
      type="checkbox"
      checked={checked}
      onChange={(e) => onChange(e.target.checked)}
      className="w-5 h-5 text-pink-500 rounded focus:ring-pink-500"
    />
    <label className="text-sm font-medium text-gray-700">{label}</label>
  </div>
);

export default Checkbox;
