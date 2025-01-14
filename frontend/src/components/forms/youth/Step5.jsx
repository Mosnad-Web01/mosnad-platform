import React from "react";
import TextArea from "@/components/common/TextArea";
import FileUpload from "@/components/common/FileUpload";

const Step5 = ({ formData, updateFormData, errors }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  const handleFileChange = (e) => {
    // Ensure the file is passed correctly to the parent component
    updateFormData("document", e.target.files[0]);
  };

  return (
    <div>
      <form>
        <TextArea
          label="هل هناك أي شيء آخر ترغب في مشاركته عن نفسك أو عن سبب كونك مناسبًا لهذا المعسكر التدريبي؟"
          placeholder="ادخل النص هنا"
          rows={3}
          additionalClasses="mb-6"
          value={formData.additional_info || ""}
          errorMessage={errors.additional_info}
          onChange={(value) => handleInputChange("additional_info", value)} // Handling text area change
        />

        <FileUpload
          label="يرجى إرفاق سيرتك الذاتية وأي شهادات تعليمية ذات صلة بتكنولوجيا المعلومات (درجة جامعية، ورش عمل، دورات عبر الإنترنت، معسكرات تدريب، حساب Github...إلخ)؟"
          additionalClasses="mb-6"
          errorMessage={errors.document}
          onChange={handleFileChange} // Handling file change
        />
      </form>
    </div>
  );
};

export default Step5;
