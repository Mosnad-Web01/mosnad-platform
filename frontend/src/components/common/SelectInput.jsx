const SelectInput = ({
    label,
    value,
    options,
    onChange,
    errorMessage,
    dir = 'rtl',
    additionalClasses = '',
    multiple = false,
    ...props
  }) => {
    return (
      <div className={`mt-1 flex flex-col mb-6 ${additionalClasses}`}>
        {label && <label className="mb-2 text-sm text-[#21255C] font-medium">{label}</label>}
  
        <select
          value={multiple ? (Array.isArray(value) ? value : []) : value}
          onChange={(e) => {
            if (multiple) {
              const selectedOptions = Array.from(e.target.selectedOptions).map(option => option.value);
              onChange(selectedOptions);
            } else {
              onChange(e);
            }
          }}
          multiple={multiple}
          className={`w-full px-4 py-[15px] rounded-lg bg-gray-50 border border-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400 ${dir === 'rtl' ? 'text-right' : 'text-left'}`}
          {...props}
        >
          {options?.map((option, index) => (
            <option key={index} value={option.value}>
              {option.label}
            </option>
          ))}
        </select>
  
        {errorMessage && (
          <p className="mt-1 text-sm text-red-500">{errorMessage}</p>
        )}
      </div>
    );
  };
  
  export default SelectInput;
  