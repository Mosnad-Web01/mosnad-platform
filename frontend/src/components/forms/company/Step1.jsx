import React from "react";
import Input from "@/components/common/Input";
import RadioButton from "@/components/common/Radio";
import FieldContainer from "@/components/common/FieldContainer";
import Checkbox from "@/components/common/Checkbox";

const Step1 = ({ formData, updateFormData ,errors }) => {
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
          label="ادخل اسمك"
          name="name"
          type="text"
          placeholder="ادخل اسمك"
          value={formData.name || ""}
          onChange={handleInputChange("name")}
          errorMessage={errors.name}
        />
        <Input
          label="ادخل اسم شركتك"
          name="company_name"
          type="text"
          placeholder="أسم شركتك"
          value={formData.company_name || ""}
          onChange={handleInputChange("company_name")}
          errorMessage={errors.company_name}
        />
        <FieldContainer
          label="البلد"
          error={errors.country}
        >
          <Input
            name="country"
            type="text"
            placeholder="أدخل اسم البلد"
            value={formData.country || ""}
            onChange={handleInputChange("country")}
          />
        </FieldContainer>

        <FieldContainer
          label="أختر المدينة"
          className="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-5"
          error={errors.city}
        >
          {["صنعاء", "الحديدة", "عدن", "المكلا"].map((city) => (
            <RadioButton
              key={city}
              name="city"
              label={city}
              value={city}
              checked={formData.city === city}
              onChange={(value) => handleRadioChange("city", value)}
            />
          ))}
          <Input
            name="city"
            type="text"
            placeholder="أخرى أذكرها هنا"
            value={formData.city || ""}
            onChange={handleInputChange("city")}
          />
        </FieldContainer>

        <Input
          label="العنوان"
          name="address"
          placeholder="أدخل عنوانك"
          value={formData.address || ""}
          onChange={handleInputChange("address")}
          errorMessage={errors.address}
        />

        <Input
          label="تاريخ الميلاد"
          name="birth_date"
          placeholder="تاريخ الميلاد"
          value={formData.birth_date || ""}
          onChange={handleInputChange("birth_date")}
          type="date"
          errorMessage={errors.birth_date}
        />

        <Input
          label="رقم الجوال"
          name="phone_number"
          placeholder="رقم الجوال"
          value={formData.phone_number || ""}
          onChange={handleInputChange("phone_number")}
          errorMessage={errors.phone_number}
        />

        <Input
          label="البريد الالكتروني"
          name="email"
          type="email"
          placeholder="البريد الالكتروني"
          value={formData.email || ""}
          onChange={handleInputChange("email")}
          errorMessage={errors.email}
        />

        <Input
          label="ادخل الصناعه الخاصه بك"
          name="industry"
          type="text"
          placeholder="ادخل الصناعه الخاصه بك"
          value={formData.industry || ""}
          onChange={handleInputChange("industry")}
          errorMessage={errors.industry}
        />

        {/* Radio Buttons for Employees */}
        <FieldContainer
          label="العدد التقريبي للموظفين"
          className="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4"
          error={errors.employees}
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
          error={errors.stage}
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
          error={errors.skills}
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
          error={errors.home_workers}
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
