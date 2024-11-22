import React from "react";
import Checkbox from "@/components/common/Checkbox";
import TextArea from "@/components/common/TextArea";
import FileUpload from "@/components/common/FileUpload";

const Step5 = ({ formData, updateFormData, onPrevious, onSubmit }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  return (
    <div>
      <form>
       <TextArea
       label="هل هناك أي شيء آخر ترغب في مشاركته عن نفسك أو عن سبب كونك مناسبًا لهذا المعسكر التدريبي؟"
       placeholder="ادخل النص هنا"
       rows={3}
       errorMessage=""
       additionalClasses="mb-6"
       value={formData.other || ""}
       onChange={(e) => handleInputChange("other", e.target.value)}
     />

    <FileUpload
          label="يرجى إرفاق سيرتك الذاتية وأي شهادات تعليمية ذات صلة بتكنولوجيا المعلومات (درجة جامعية، ورش عمل، دورات عبر الإنترنت، معسكرات تدريب، حساب Github...إلخ)؟"
          additionalClasses="mb-6"
          value={formData.document || ""}
          onChange={(e) => handleInputChange("document", e.target.files[0])}
        />
     
     
      </form>
    </div>
  );
};

export default Step5;
