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
          label="ماهو المسار الوظيفي الذي تهتم به؟"
          className="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-3"
        >
          <RadioButton
            name="job"
            value="Web Fullstack"
            label="Web Fullstack"
            checked={formData.job === "Web Fullstack"}
            onChange={(value) => handleInputChange("job", value)}
          />
          <RadioButton
            name="job"
            value="Mobile Fullstack"
            label="Mobile Fullstack"
            checked={formData.job === "Mobile Fullstack"}
            onChange={(value) => handleInputChange("job", value)}
          />
          <RadioButton
            name="job"
            value="UI/UX Designer"
            label="UI/UX Designer"
            checked={formData.job === "UI/UX Designer"}
            onChange={(value) => handleInputChange("job", value)}
          />

          <RadioButton
            name="job"
            value="Data Scientist"
            label="Data Scientist"
            checked={formData.job === "Data Scientist"}
            onChange={(value) => handleInputChange("job", value)}
          />

          <RadioButton
            name="job"
            value="DevOps"
            label="DevOps"
            checked={formData.job === "DevOps"}
            onChange={(value) => handleInputChange("job", value)}
          />
          <Input
            placeholder="أخرى اذكرها هنا"
            value={formData.job}
            onChange={(value) => handleInputChange("job", value)}
          />
        </FieldContainer>
        <TextArea
          label="لماذا انت مهتم بتعلم هذه المسار؟"
          rows={2}
          placeholder="اكتب وصفًا قصيرًا"
          value={formData.motivation}
          onChange={(value) => handleInputChange("motivation", value)}
        />
        <TextArea
          label=" ما هي اهدافك المهنية في المجال الذي اخترته؟ "
          rows={3}
          placeholder="اكتب وصفًا قصيرًا"
          value={formData.requirements}
          onChange={(value) => handleInputChange("requirements", value)}
        />
        <TextArea
          label="هل لديك أي مشاريع أو أفكار محددة ترغب في بنائها باستخدام مهاراتك المكتسبة حديثًا؟"
          rows={4}
          placeholder="اكتب وصفًا قصيرًا"
          value={formData.projectIdeas}
          onChange={(value) => handleInputChange("projectIdeas", value)}
        />
      </form>
    </div>
  );
};

export default Step2;
