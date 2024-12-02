import React from "react";
import Input from "@/components/common/Input";
import Checkbox from "@/components/common/Checkbox";
import FieldContainer from "@/components/common/FieldContainer";
import RadioButton from "@/components/common/Radio";
import TextArea from "@/components/common/TextArea";

const Step2 = ({ formData, updateFormData, onNext, onPrevious }) => {
  const handleInputChange = (name) => (event) => {
    updateFormData(name, event.target.value);
  };
  const handleRadioChange = (name, value) => {
    updateFormData(name, value); // Update formData with the selected value
  };

  return (
    <div>
      <form>
        <FieldContainer
          label="ماهو المسار الوظيفي الذي تهتم به؟"
          className="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-3"
        >
          {["مطور FullStack", "مطور Flutter", "مطور laravel"].map((job) => (
            <RadioButton
              key={job}
              label={job}
              name="job_interest"
              value={job}
              checked={formData.job_interest === job}
              onChange={(value) => handleRadioChange("job_interest", value)}
            />
          ))}
          <Input
            name="job"
            type="text"
            placeholder="أخرى اذكرها هنا"
            value={formData.job || ""}
            onChange={handleInputChange("job")}
          />
        </FieldContainer>
        <TextArea
          label="لماذا انت مهتم بتعلم هذه المسار؟"
          rows={2}
          placeholder="اكتب وصفًا قصيرًا"
          value={formData.motivation || ""}
          onChange={(value) => updateFormData("motivation", value)}
          />
        <TextArea
          label=" ما هي اهدافك المهنية في المجال الذي اخترته؟ "
          rows={3}
          placeholder="اكتب وصفًا قصيرًا"
          value={formData.career_goals || ""}
          onChange={(value) => updateFormData("career_goals", value)}
        />
        <TextArea
          label="هل لديك أي مشاريع أو أفكار محددة ترغب في بنائها باستخدام مهاراتك المكتسبة حديثًا؟"
          rows={4}
          placeholder="اكتب وصفًا قصيرًا"
          value={formData.project_ideas || ""}
          onChange={(value) => updateFormData("project_ideas", value)}
        />
      </form>
    </div>
  );
};

export default Step2;
