import React from "react";
import Input from "@/components/common/Input";
import RadioButton from "@/components/common/Radio";
import FieldContainer from "@/components/common/FieldContainer";
import Checkbox from "@/components/common/Checkbox";

const Step1 = ({ formData, updateFormData }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  return (
    <div className="rtl container mx-auto px-4">
      <form>
        <Input
          label="ادخل اسم شركتك"
          placeholder="أسم شركتك"
          value={formData.name || ""}
          onChange={(value) => handleInputChange("name", value)}
        />

        <Input
          label="البريد الالكتروني"
          placeholder="البريد الالكتروني"
          value={formData.email || ""}
          onChange={(value) => handleInputChange("email", value)}
        />

        <Input
        label="ادخل الصناعه الخاصه بك"
        placeholder="ادخل الصناعه الخاصه بك"
        value={formData.industry || ""}
        onChange={(value) => handleInputChange("industry", value)}
        />
        
        <FieldContainer label="العدد التقريبي للموظفين" className="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4">
          <RadioButton
            name="employees"
            label="من 1 - 10"
            value="1-10"
            checked={formData.employees === "1-10"}
            onChange={(value) => handleInputChange("employees", value)}
          />
          <RadioButton
            name="employees"
            label="من 11 - 50"
            value="11-50"
            checked={formData.employees === "11-50"}
            onChange={(value) => handleInputChange("employees", value)}
          />
          <RadioButton
            name="employees"
            label="من 51 - 100"
            value="51-100"
            checked={formData.employees === "51-100"}
            onChange={(value) => handleInputChange("employees", value)}
          />
          <RadioButton
            name="employees"
            label="من 101 - 500"
            value="101-500"
            checked={formData.employees === "101-500"}
            onChange={(value) => handleInputChange("employees", value)}
          />
          
        </FieldContainer>

        <FieldContainer label="مرحلة البدء" className="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-3">
          <RadioButton
            name="stage"
            label="قبل البذور"
            value="before"
            checked={formData.stage === "before"}
            onChange={(value) => handleInputChange("stage", value)}
          />
          <RadioButton
            name="stage"
            label="المرحلة المبكرة"
            value="early"
            checked={formData.stage === "early"}
            onChange={(value) => handleInputChange("stage", value)}
          />
          <RadioButton
            name="stage"
            label="المرحلة المتوسطة"
            value="middle"
            checked={formData.stage === "middle"}
            onChange={(value) => handleInputChange("stage", value)}
          />
          <RadioButton
            name="stage"
            label="المرحلة المتقدمة"
            value="advanced"
            checked={formData.stage === "advanced"}
            onChange={(value) => handleInputChange("stage", value)}
          />
        </FieldContainer>

        <FieldContainer label="ما هي مهارات البرمجة الحالية ومستويات الخبرة لموظفيك؟(اختر كل ما ينطبق)" className="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4">
          <Checkbox
            name="skills"
            label="مبتدئ"
            // checked={formData.skills.includes("beginner")}
            onChange={(value) => handleInputChange("skills", value)}
          />

          <Checkbox
            name="skills"
            label="متوسط"
            // checked={formData.skills.includes("intermediate")}
            onChange={(value) => handleInputChange("skills", value)}
          />

          <Checkbox
            name="skills"
            label="متقدم"
            // checked={formData.skills.includes("advanced")}
            onChange={(value) => handleInputChange("skills", value)}
          />

          <Checkbox
            name="skills"
            label="متخصص"
            // checked={formData.skills.includes("expert")}
            onChange={(value) => handleInputChange("skills", value)}
          />
        </FieldContainer>

        <FieldContainer label="هل لديك أي موظفين يعملون من المنزل؟" className="grid grid-cols-2 gap-2 md:grid-cols-2 lg:grid-cols-2">
          <RadioButton
            name="home_workers"
            label="نعم"
            value="yes"
            checked={formData.home_workers === "yes"}
            onChange={(value) => handleInputChange("home_workers", value)}
          />
          <RadioButton
            name="home_workers"
            label="لا"
            value="no"
            checked={formData.home_workers === "no"}
            onChange={(value) => handleInputChange("home_workers", value)}
          />  
        </FieldContainer>
      </form>
    </div>
  );
};

export default Step1;
