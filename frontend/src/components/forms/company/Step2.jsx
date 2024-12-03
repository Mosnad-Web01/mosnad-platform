import React from "react";
import Checkbox from "@/components/common/Checkbox";
import FieldContainer from "@/components/common/FieldContainer";
import RadioButton from "@/components/common/Radio";

const Step2 = ({ formData, updateFormData, errors }) => {
  const handleRadioChange = (name, value) => {
    updateFormData(name, value);
  };

  const handleCheckboxChange = (remote_hiring_preference, isChecked) => {
    const updatedPreferences = isChecked
      ? [
          ...(formData.remote_hiring_preferences || []),
          remote_hiring_preference,
        ] // Ensure it's an array
      : (formData.remote_hiring_preferences || []).filter(
          (pref) => pref !== remote_hiring_preference
        ); // Ensure it's an array
    updateFormData("remote_hiring_preferences", updatedPreferences);
  };

  return (
    <div>
      <form>
        {/* Radio Buttons for Training */}
        <FieldContainer
          label="هل تقدم حاليًا أي تدريب على البرمجة أو فرص تطوير لموظفيك؟"
          className="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-2"
          error={errors.training}
        >
          <RadioButton
            name="training"
            label="نعم"
            value="yes"
            checked={formData.training === "yes"}
            onChange={() => handleRadioChange("training", "yes")}
          />
          <RadioButton
            name="training"
            label="لا"
            value="no"
            checked={formData.training === "no"}
            onChange={() => handleRadioChange("training", "no")}
          />
        </FieldContainer>

        {/* Radio Buttons for Hiring */}
        <FieldContainer
          label="هل أنت مهتم بتوظيف الأفراد؟ بمهارات البرمجة من خلال برنامجنا التدريبين؟"
          className="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-2"
          error={errors.hiring}
        >
          <RadioButton
            name="hiring"
            label="نعم"
            value="yes"
            checked={formData.hiring === "yes"}
            onChange={() => handleRadioChange("hiring", "yes")}
          />
          <RadioButton
            name="hiring"
            label="لا"
            value="no"
            checked={formData.hiring === "no"}
            onChange={() => handleRadioChange("hiring", "no")}
          />
        </FieldContainer>

        {/* Checkboxes for Remote Hiring Preferences */}
        <FieldContainer
          label="ما هي الميزة التي يمكن أن تدعم رغبتك في التعيينات عن بعد؟ (اختر كل ما ينطبق)"
          className="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-2"
          error={errors.remote_hiring_preferences}
        >
          {[
            "مهارات تواصل وتعاون ممتازة",
            "تجربة العمل عن بعد",
            "الوعي الثقافي والقدرة على التكيف",
            "مهارات التطوير العامة",
            "التقنية المستقبلية",
            "اخرى",
          ].map((remote_hiring_preference) => (
            <Checkbox
              key={remote_hiring_preference}
              name="remote_hiring_preferences"
              label={remote_hiring_preference}
              checked={(formData.remote_hiring_preferences || []).includes(
                remote_hiring_preference
              )} // Safely check if the value exists
              onChange={(isChecked) =>
                handleCheckboxChange(remote_hiring_preference, isChecked)
              }
            />
          ))}
        </FieldContainer>
      </form>
    </div>
  );
};

export default Step2;
