import React from "react";
import Input from "@/components/common/Input";
import Checkbox from "@/components/common/Checkbox";
import FieldContainer from "@/components/common/FieldContainer";
import RadioButton from "@/components/common/Radio";
import TextArea from "@/components/common/TextArea";

const Step2 = ({ formData, updateFormData, onNext, onPrevious }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  return (
    <div>
      <form>
        <FieldContainer
          label="هل تقدم حاليًا أي تدريب على البرمجة أو فرص تطوير لموظفيك؟"
          className="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-2"
        >
          <RadioButton
            name="training"
            label="نعم"
            value="yes"
            checked={formData.training === "yes"}
            onChange={(value) => handleInputChange("training", value)}
          />
          <RadioButton
            name="training"
            label="لا"
            value="no"
            checked={formData.training === "no"}
            onChange={(value) => handleInputChange("training", value)}
          />
        </FieldContainer>

        <FieldContainer
          label="هل أنت مهتم بتوظيف الأفراد؟ بمهارات البرمجة من خلال برنامجنا التدريبين؟ "
          className="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-2"
        >
          <RadioButton
            name="employees"
            label="نعم"
            value="yes"
            checked={formData.employees === "yes"}
            onChange={(value) => handleInputChange("employees", value)}
          />

          <RadioButton
            name="employees"
            label="لا"
            value="no"
            checked={formData.employees === "no"}
            onChange={(value) => handleInputChange("employees", value)}
          />
        </FieldContainer>

        <FieldContainer
          label="ما هي الميزة التي يمكن أن تدعم رغبتك في التعيينات عن بعد؟ (اختر كل ما ينطبق)"
          className="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-2"
        >
          <Checkbox
            name="feature1"
            label="مهارات تواصل وتعاون ممتازة"
            checked={formData.feature1}
            onChange={(value) => handleInputChange("feature1", value)}
          />

          <Checkbox
            name="feature2"
            label="تجربة العمل عن بعد"
            checked={formData.feature2}
            onChange={(value) => handleInputChange("feature2", value)}
          />

          <Checkbox
            name="feature3"
            label="الوعي الثقافي والقدرة على التكيف"
            checked={formData.feature3}
            onChange={(value) => handleInputChange("feature3", value)}
          />
          <Checkbox
            name="feature4"
            label="مهارات التطوير العامة"
            checked={formData.feature4}
            onChange={(value) => handleInputChange("feature4", value)}
          />
          <Checkbox
            name="feature5"
            label="التقنية المستقبلية"
            checked={formData.feature5}
            onChange={(value) => handleInputChange("feature5", value)}
          />
          <Input
            placeholder=" أخرى اذكرها"
            type="text"
            name="feature6"
            value={formData.feature6}
            onChange={(value) => handleInputChange("feature6", value)}
          />
        </FieldContainer>
      </form>
    </div>
  );
};

export default Step2;
