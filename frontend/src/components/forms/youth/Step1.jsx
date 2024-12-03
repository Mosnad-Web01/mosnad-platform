import React from "react";
import Input from "@/components/common/Input";
import RadioButton from "@/components/common/Radio";
import FieldContainer from "@/components/common/FieldContainer";

const Step1 = ({ formData, updateFormData, errors }) => {
  const handleInputChange = (name) => (event) => {
    updateFormData(name, event.target.value);
  };

  const handleRadioChange = (name, value) => {
    updateFormData(name, value);
  };

  return (
    <div className="rtl container mx-auto px-4">
      <form>
        <Input
          label="اسم المستخدم"
          name="name"
          type="text"
          placeholder="الاسم"
          value={formData.name || ""}
          onChange={handleInputChange("name")}
          errorMessage={errors.name}
        />

        <FieldContainer
          label="أختر المدينة"
          className="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-5"
          error={errors.city} // Display error message if present
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
          name="phone"
          placeholder="رقم الجوال"
          value={formData.phone || ""}
          onChange={handleInputChange("phone")}
          errorMessage={errors.phone}
        />

        <FieldContainer
          label="هل أنت خريج تكنولوجيا المعلومات؟"
          className="grid grid-cols-2 gap-2"
          error={errors.is_it_graduate}
        >
          {[
            { label: "نعم", value: "1" },
            { label: "لا", value: "0" },
          ].map((option) => (
            <RadioButton
              key={option.value}
              name="is_it_graduate"
              label={option.label}
              value={option.value}
              checked={formData.is_it_graduate === option.value}
              onChange={(value) => handleRadioChange("is_it_graduate", value)}
            />
          ))}
        </FieldContainer>
       
      </form>
    </div>
  );
};

export default Step1;
