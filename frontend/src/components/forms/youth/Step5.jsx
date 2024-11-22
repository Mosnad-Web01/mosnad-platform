import React from "react";
import Checkbox from "@/components/common/Checkbox";

const Step5 = ({ formData, updateFormData, onPrevious, onSubmit }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  return (
    <div>
      <h1 className="text-xl font-bold text-gray-700 mb-4">اللغات الأخرى</h1>
      <form>
        <Checkbox
          label="هل لديك معرفة بلغات برمجة أخرى؟"
          checked={formData.hasOtherLanguages}
          onChange={(value) => handleInputChange("hasOtherLanguages", value)}
        />

    
     
     
      </form>
    </div>
  );
};

export default Step5;
