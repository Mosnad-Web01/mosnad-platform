import React from "react";
import Input from "@/components/common/Input";
import RadioButton from "@/components/common/Radio";
import FieldContainer from "@/components/common/FieldContainer";

const Step1 = ({ formData, updateFormData }) => {
  const handleInputChange = (field, value) => {
    updateFormData(field, value);
  };

  return (
    <div className="rtl container mx-auto px-4">
      <form>
        <Input
          label="اسم المستخدم"
          placeholder="الاسم"
          value={formData.name || ""}
          onChange={(value) => handleInputChange("name", value)}
        />
        
        <FieldContainer label="أختر المدينة" className="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-5">
          <RadioButton
            name="city"
            label="صنعاء"
            value="Sanaa"
            checked={formData.city === "Sanaa"}
            onChange={(value) => handleInputChange("city", value)}
          />
          <RadioButton
            name="city"
            label="عدن"
            value="Aden"
            checked={formData.city === "Aden"}
            onChange={(value) => handleInputChange("city", value)}
          />
          <RadioButton
            name="city"
            label="تعز"
            value="Taiz"
            checked={formData.city === "Taiz"}
            onChange={(value) => handleInputChange("city", value)}
          />
          <RadioButton
            name="city"
            label="المكلا"
            value="AlMakla"
            checked={formData.city === "AlMakla"}
            onChange={(value) => handleInputChange("city", value)}
          />
          <Input
            placeholder="أخرى أذكرها هنا"
            value={formData.city || ""}
            onChange={(value) => handleInputChange("city", value)}
          />
        </FieldContainer>

        <Input
          label="العنوان"
          placeholder="أدخل عنوانك"
          value={formData.address || ""}
          onChange={(value) => handleInputChange("address", value)}
        />
        
        <Input
          label="تاريخ الميلاد"
          placeholder="تاريخ الميلاد"
          value={formData.birthDate || ""}
          onChange={(value) => handleInputChange("birthDate", value)}
          type="date"
        />
        
        <Input
          label="رقم الجوال"
          placeholder="رقم الجوال"
          value={formData.phone || ""}
          onChange={(value) => handleInputChange("phone", value)}
        />

        <FieldContainer
          label="هل أنت خريج تكنولوجيا المعلومات؟"
          className="grid grid-cols-2  gap-2 "
        >
          <RadioButton
            name="isITGraduate"
            label="نعم"
            value="yes"
            checked={formData.isITGraduate === "yes"}
            onChange={(value) => handleInputChange("isITGraduate", value)}
          />
          <RadioButton
            name="isITGraduate"
            label="لا"
            value="no"
            checked={formData.isITGraduate === "no"}
            onChange={(value) => handleInputChange("isITGraduate", value)}
          />
        </FieldContainer>
      </form>
    </div>
  );
};

export default Step1;
