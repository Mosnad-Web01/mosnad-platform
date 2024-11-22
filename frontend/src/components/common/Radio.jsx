import React from "react";

const RadioButton = ({ name, label, value, checked, onChange }) => (
  <div className="mb-4 flex items-center space-x-2">
    <input
      type="radio"
      name={name}
      value={value}
      checked={checked}
      onChange={(e) => onChange(e.target.value)}
      className="w-5 h-5 text-pink-500 rounded focus:ring-pink-500"
    />
    <label className="text-sm font-medium text-gray-700">{label}</label>
  </div>
);

export default RadioButton;
