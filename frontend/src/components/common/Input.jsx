import React from 'react';

const Input = ({
  name = '',
  label,
  value,
  placeholder,
  type = 'text',
  icon: Icon,
  errorMessage,
  dir = 'rtl',
  additionalClasses = '',
  onChange,  // Ensure onChange is passed
  ...props
}) => {
  return (
    <div className={`mt-1 flex flex-col mb-6 ${additionalClasses}`}>
      {label && <label className="mb-2 text-sm text-[#21255C] font-medium">{label}</label>}
      <div className="relative mt-1">
        {Icon && (
          <div className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
            <Icon />
          </div>
        )}
        <input
          type={type}
          placeholder={placeholder}
          className={`w-full px-4 py-[15px] rounded-lg bg-gray-50 border border-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400 ${Icon ? "pl-10" : ""}`}
          value={value}  // Bind the value to the input field
          onChange={onChange}  // Ensure onChange is passed and handled
          dir={dir}
          name={name}
          {...props}
        />
      </div>
      {errorMessage && (
        <p className="mt-1 text-sm text-red-500">{errorMessage}</p>
      )}
    </div>
  );
};

export default Input;
