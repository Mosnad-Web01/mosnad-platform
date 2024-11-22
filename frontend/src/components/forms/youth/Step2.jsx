import React from "react";
import Input from "@/components/common/Input";
import Checkbox from "@/components/common/Checkbox";

const Step2 = ({ formData, updateFormData, onNext, onPrevious }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  return (
    <div>
      <h1 className="text-xl font-bold text-gray-700 mb-4">المسار الوظيفي</h1>
      <form>
        <Input
          label="المسار الوظيفي المفضل"
          placeholder="مثال: تطوير الويب"
          value={formData.careerPath}
          onChange={(value) => handleInputChange("careerPath", value)}
        />
        <Input
          label="ما الذي يحفزك في هذا المسار؟"
          placeholder="اكتب وصفًا قصيرًا"
          value={formData.motivation}
          onChange={(value) => handleInputChange("motivation", value)}
        />
        
      </form>
    </div>
  );
};

export default Step2;
