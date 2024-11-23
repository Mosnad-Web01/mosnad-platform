import React from "react";
import RadioButton from "@/components/common/Radio";
import FieldContainer from "@/components/common/FieldContainer";
import TextArea from "@/components/common/TextArea";

const Step3 = ({ formData, updateFormData, onNext, onPrevious }) => {
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
          errorMessage=""
          additionalClasses="mb-6"
          value={formData.other || ""}
          onChange={(e) => handleInputChange("other", e.target.value)}
        />
      </form>
    </div>
  );
};

export default Step3;
