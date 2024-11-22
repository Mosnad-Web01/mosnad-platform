import React from "react";
import Checkbox from "@/components/common/Checkbox";

const Step4 = ({ formData, updateFormData, onNext, onPrevious }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  return (
    <div>
      <h1 className="text-xl font-bold text-gray-700 mb-4">الخبرات والورش</h1>
      <form>
        <Checkbox
          label="هل حضرت ورش عمل من قبل؟"
          checked={formData.hasWorkshops}
          onChange={(value) => handleInputChange("hasWorkshops", value)}
        />
        <Checkbox
          label="هل لديك خبرة في البرمجة؟"
          checked={formData.hasProgrammingExperience}
          onChange={(value) => handleInputChange("hasProgrammingExperience", value)}
        />
      
      </form>
    </div>
  );
};

export default Step4;
