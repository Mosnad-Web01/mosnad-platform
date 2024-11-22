import React from "react";
import Input from "@/components/common/Input";

const Step3 = ({ formData, updateFormData, onNext, onPrevious }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  return (
    <div>
      <h1 className="text-xl font-bold text-gray-700 mb-4">التطلعات والأفكار</h1>
      <form>
        <Input
          label="ما هي تطلعاتك المستقبلية؟"
          placeholder="مثال: أن أكون مطور تطبيقات محترف"
          value={formData.aspirations}
          onChange={(value) => handleInputChange("aspirations", value)}
        />
        <Input
          label="هل لديك أفكار مشاريع؟ شاركنا فكرتك"
          placeholder="مثال: إنشاء منصة تعليم إلكتروني"
          value={formData.projectIdeas}
          onChange={(value) => handleInputChange("projectIdeas", value)}
        />
      
      </form>
    </div>
  );
};

export default Step3;
