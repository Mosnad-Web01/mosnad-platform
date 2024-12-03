import React from "react";
import RadioButton from "@/components/common/Radio";
import FieldContainer from "@/components/common/FieldContainer";

const Step3 = ({ formData, updateFormData, errors }) => {
  // Handle radio button changes
  const handleRadioChange = (name, value) => {
    updateFormData(name, value); // Update formData with the selected value
  };

  return (
    <div className="rtl container mx-auto px-4">
      <form>
        <div className="flex flex-col gap-10">
          {/* First Question */}
          <FieldContainer
            label="هل حصلت على أي دورات أو ورش عمل سابقة تتعلق بالمجال الذي اخترته أو تكنولوجيا المعلومات بشكل عام؟"
            className="grid gap-4 grid-cols-2"
            error={errors.has_workshops} // Pass the error for this question
          >
            <RadioButton
              name="has_workshops"
              label="نعم"
              value={1}
              checked={formData.has_workshops === 1}
              onChange={(value) => handleRadioChange("has_workshops", value)}
            />
            <RadioButton
              name="has_workshops"
              label="لا"
              value={0}
              checked={formData.has_workshops === 0}
              onChange={(value) => handleRadioChange("has_workshops", value)}
            />
          </FieldContainer>

          {/* Second Question */}
          <FieldContainer
            label="هل لديك أي خبرة في العمل مع التعليمات البرمجية، حتى خارج الإطار الرسمي؟"
            className="grid gap-4 grid-cols-2"
            error={errors.has_coding_experience} // Pass the error for this question
          >
            <RadioButton
              name="has_coding_experience"
              label="نعم"
              value={1}
              checked={formData.has_coding_experience === 1}
              onChange={(value) => handleRadioChange("has_coding_experience", value)}
            />
            <RadioButton
              name="has_coding_experience"
              label="لا"
              value={0}
              checked={formData.has_coding_experience === 0}
              onChange={(value) => handleRadioChange("has_coding_experience", value)}
            />
          </FieldContainer>

          {/* Third Question */}
          <FieldContainer
            label="هل أنت على دراية بأي لغة برمجة أخرى غير HTML وCSS؟"
            className="grid gap-4 grid-cols-2"
            error={errors.knows_other_languages} // Pass the error for this question
          >
            <RadioButton
              name="knows_other_languages"
              label="نعم"
              value={1}
              checked={formData.knows_other_languages === 1}
              onChange={(value) => handleRadioChange("knows_other_languages", value)}
            />
            <RadioButton
              name="knows_other_languages"
              label="لا"
              value={0}
              checked={formData.knows_other_languages === 0}
              onChange={(value) => handleRadioChange("knows_other_languages", value)}
            />
          </FieldContainer>
        </div>
      </form>
    </div>
  );
};

export default Step3;
