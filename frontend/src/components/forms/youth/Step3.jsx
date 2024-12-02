import React from "react";
import RadioButton from "@/components/common/Radio";
import FieldContainer from "@/components/common/FieldContainer";

const Step3 = ({ formData, updateFormData }) => {
  // Handle radio button changes
  const handleRadioChange = (name, value) => {
    updateFormData(name, value); // Update formData with the selected value
  };

  // Questions and their corresponding form keys
  const questions = [
    {
      label:
        "هل حصلت على أي دورات أو ورش عمل سابقة تتعلق بالمجال الذي اخترته أو تكنولوجيا المعلومات بشكل عام؟",
      name: "has_workshops",
    },
    {
      label:
        "هل لديك أي خبرة في العمل مع التعليمات البرمجية، حتى خارج الإطار الرسمي؟",
      name: "has_coding_experience",
    },
    {
      label: "هل أنت على دراية بأي لغة برمجة أخرى غير HTML وCSS؟",
      name: "knows_other_languages",
    },
  ];

  // Options for the radio buttons
  const options = [
    { label: "نعم", value: 1 },
    { label: "لا", value: 0 },
  ];

  return (
    <div className="rtl container mx-auto px-4">
      <form>
        <div className="flex flex-col gap-10">
          {questions.map((question) => (
            <FieldContainer
              key={question.name}
              label={question.label}
              className="grid gap-4 grid-cols-2"
            >
              {options.map((option) => (
                <RadioButton
                  key={option.value}
                  name={question.name}
                  label={option.label}
                  value={option.value}
                  checked={formData[question.name] === option.value}
                  onChange={(value) => handleRadioChange(question.name, value)}
                />
              ))}
            </FieldContainer>
          ))}
        </div>
      </form>
    </div>
  );
};

export default Step3;
