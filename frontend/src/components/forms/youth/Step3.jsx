import React from "react";
import RadioButton from "@/components/common/Radio";
import FieldContainer from "@/components/common/FieldContainer";

const Step3 = ({ formData, updateFormData, onNext, onPrevious }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  return (
    <div className="rtl container mx-auto px-4">
      <form>
        {/* Question 1 */}
        <div className="flex flex-col gap-10">
          <FieldContainer
            label="هل حصلت على أي دورات أو ورش عمل سابقة تتعلق بالمجال الذي اخترته أو تكنولوجيا المعلومات بشكل عام؟"
            className="grid gap-4 grid-cols-2"
          >
            <RadioButton
              name="workshops"
              label="نعم"
              value="yes"
              checked={formData.workshops === "yes"}
              onChange={(value) => handleInputChange("workshops", value)}
            />
            <RadioButton
              name="workshops"
              label="لا"
              value="no"
              checked={formData.workshops === "no"}
              onChange={(value) => handleInputChange("workshops", value)}
            />
          </FieldContainer>

          {/* Question 2 */}
          <FieldContainer
            label="هل لديك أي خبرة في العمل مع التعليمات البرمجية، حتى خارج الإطار الرسمي؟"
            className="grid gap-4 grid-cols-2"
          >
            <RadioButton
              name="codingExperience"
              label="نعم"
              value="yes"
              checked={formData.codingExperience === "yes"}
              onChange={(value) => handleInputChange("codingExperience", value)}
            />
            <RadioButton
              name="codingExperience"
              label="لا"
              value="no"
              checked={formData.codingExperience === "no"}
              onChange={(value) => handleInputChange("codingExperience", value)}
            />
          </FieldContainer>

          {/* Question 3 */}
          <FieldContainer
            label="هل أنت على دراية بأي لغة برمجة أخرى غير HTML وCSS؟"
            className="grid gap-4 grid-cols-2"
          >
            <RadioButton
              name="programmingLanguages"
              label="نعم"
              value="yes"
              checked={formData.programmingLanguages === "yes"}
              onChange={(value) =>
                handleInputChange("programmingLanguages", value)
              }
            />
            <RadioButton
              name="programmingLanguages"
              label="لا"
              value="no"
              checked={formData.programmingLanguages === "no"}
              onChange={(value) =>
                handleInputChange("programmingLanguages", value)
              }
            />
          </FieldContainer>
        </div>
      </form>
    </div>
  );
};

export default Step3;
