import React from "react";
import Checkbox from "@/components/common/Checkbox";
import TextArea from "@/components/common/TextArea";

const Step4 = ({ formData, updateFormData, onNext, onPrevious }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  return (
    <div>
      <form>
        <TextArea
          label="صف موقفًا اضطررت فيه إلى حل مشكلة بطريقة إبداعية أو التفكير خارج الصندوق. ما هي المشكلة وكيف تعاملت معها؟"
          placeholder="ادخل النص هنا"
          rows={2}
          errorMessage=""
          additionalClasses="mb-6"
          value={formData.motivation || ""}
          onChange={(e) => handleInputChange("motivation", e.target.value)}
        />
        <TextArea
          label="اشرح الاختلافات بين website و web application؟ فيه إلى حل مشكلة بطريقة إبداعية أو التفكير خارج الصندوق. ما هي المشكلة وكيف تعاملت معها؟"
          placeholder="ادخل النص هنا"
          rows={2}
          errorMessage=""
          additionalClasses="mb-6"
          value={formData.difference || ""}
          onChange={(e) => handleInputChange("difference", e.target.value)}
        />
        <TextArea
          label="تخيل أنك تقوم بإنشاء صفحة ويب لشركة محلية. ما الخطوات التي ستتخذها للتأكد من أن الصفحة سهلة الاستخدام وجذابة بصريًا؟"
          placeholder="ادخل النص هنا"
          rows={2}
          errorMessage=""
          additionalClasses="mb-6"
          value={formData.steps || ""}
          onChange={(e) => handleInputChange("steps", e.target.value)}
        />
      </form>
    </div>
  );
};

export default Step4;
