import React from "react";
import TextArea from "@/components/common/TextArea";

const Step3 = ({ formData, updateFormData, errors }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };


  return (
    <div className="rtl container mx-auto px-4">
      <form>
        <TextArea
          label="هل هناك أي شيء آخر ترغب في مشاركته حول احتياجاتك أو تفضيلاتك التدريبية على البرمجة؟"
          placeholder="اكتب هنا"
          rows={4}
          errorMessage={errors.additional_notes}
          additionalClasses="mb-6"
          value={formData.additional_notes || ""}
          onChange={(value) => handleInputChange("additional_notes", value)} // Handle value change
        />

       
      </form>
    </div>
  );
};

export default Step3;
