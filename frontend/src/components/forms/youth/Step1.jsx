import React from "react";
import Input from "@/components/common/Input";
import Checkbox from "@/components/common/Checkbox";

const Step1 = ({ formData, updateFormData, onNext }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  return (
    <div className="rtl container mx-auto px-4">
      <h1 className="text-xl font-bold text-gray-700 mb-4">البيانات الشخصية</h1>
      <form>
        <Input
          label="اسم المستخدم"
          placeholder="أدخل اسمك"
          value={formData.name}
          onChange={(value) => handleInputChange("name", value)}
        />
        <Input
          label="العنوان"
          placeholder="أدخل عنوانك"
          value={formData.address}
          onChange={(value) => handleInputChange("address", value)}
        />
        <Checkbox
          label="هل أنت خريج تكنولوجيا المعلومات؟"
          checked={formData.isITGraduate}
          onChange={(value) => handleInputChange("isITGraduate", value)}
        />
       
      </form>
    </div>
  );
};

export default Step1;
