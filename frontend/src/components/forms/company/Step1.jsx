import React from "react";
import Input from "@/components/common/Input";
import RadioButton from "@/components/common/Radio";
import FieldContainer from "@/components/common/FieldContainer";
import Checkbox from "@/components/common/Checkbox";

const Step1 = ({ formData, updateFormData }) => {
  const handleInputChange = (name) => (event) => {
    updateFormData(name, event.target.value);
  };

  const handleRadioChange = (name, value) => {
    updateFormData(name, value); // Update formData with the selected value
  };

  const handleCheckboxChange = (skill, isChecked) => {
    const updatedSkills = isChecked
      ? [...formData.skills, skill] // Add the skill
      : formData.skills.filter((s) => s !== skill); // Remove the skill
    updateFormData("skills", updatedSkills);
  };

  return (
    <div className="rtl container mx-auto px-4">
      <form>
        {/* Text Inputs */}
        <Input
          label="ادخل اسم شركتك"
          name="name"
          type="text"
          placeholder="أسم شركتك"
          value={formData.name || ""}
          onChange={handleInputChange("name")}
        />

        <Input
          label="البريد الالكتروني"
          name="email"
          type="email"
          placeholder="البريد الالكتروني"
          value={formData.email || ""}
          onChange={handleInputChange("email")}
        />

        <Input
          label="ادخل الصناعه الخاصه بك"
          name="industry"
          type="text"
          placeholder="ادخل الصناعه الخاصه بك"
          value={formData.industry || ""}
          onChange={handleInputChange("industry")}
        />

        {/* Radio Buttons for Employees */}
        <FieldContainer
          label="العدد التقريبي للموظفين"
          className="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4"
        >
          {["1-10", "11-50", "51-100", "101-500"].map((range) => (
            <RadioButton
              key={range}
              name="employees"
              label={`من ${range}`}
              value={range}
              checked={formData.employees === range}
              onChange={() => handleRadioChange("employees", range)}
            />
          ))}
        </FieldContainer>

        {/* Radio Buttons for Stage */}
        <FieldContainer
          label="مرحلة البدء"
          className="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-3"
        >
          {[
            { value: "before", label: "قبل البذور" },
            { value: "early", label: "المرحلة المبكرة" },
            { value: "middle", label: "المرحلة المتوسطة" },
            { value: "advanced", label: "المرحلة المتقدمة" },
          ].map(({ value, label }) => (
            <RadioButton
              key={value}
              name="stage"
              label={label}
              value={value}
              checked={formData.stage === value}
              onChange={() => handleRadioChange("stage", value)}
            />
          ))}
        </FieldContainer>

        {/* Checkboxes for Skills */}
        <FieldContainer
          label="ما هي مهارات البرمجة الحالية ومستويات الخبرة لموظفيك؟ (اختر كل ما ينطبق)"
          className="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4"
        >
          {["مبتدئ", "متوسط", "متقدم", "متخصص"].map((skill) => (
            <Checkbox
              key={skill}
              name="skills"
              label={skill}
              checked={formData.skills.includes(skill)}
              onChange={(isChecked) => handleCheckboxChange(skill, isChecked)}
            />
          ))}
        </FieldContainer>

        {/* Radio Buttons for Home Workers */}
        <FieldContainer
          label="هل لديك أي موظفين يعملون من المنزل؟"
          className="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-2"
        >
          {[
            { value: "yes", label: "نعم" },
            { value: "no", label: "لا" },
          ].map(({ value, label }) => (
            <RadioButton
              key={value}
              name="home_workers"
              label={label}
              value={value}
              checked={formData.home_workers === value}
              onChange={() => handleRadioChange("home_workers", value)}
            />
          ))}
        </FieldContainer>
      </form>
    </div>
  );
};

export default Step1;
