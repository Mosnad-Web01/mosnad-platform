import React from "react";
import RadioButton from "@/components/common/Radio";
import Input from "@/components/common/Input";
import FieldContainer from "@/components/common/FieldContainer";
import Checkbox from "@/components/common/Checkbox";

const Step3 = ({ formData, updateFormData, errors }) => {
  const handleRadioChange = (name, value) => {
    updateFormData(name, value);
  };

  const handleInputChange = (name) => (event) => {
    updateFormData(name, event.target.value);
  };

  const handleCheckboxChange = (language, isChecked) => {
    const updatedLanguages = isChecked
      ? [...(formData.languages || []), language]
      : (formData.languages || []).filter((lang) => lang !== language);
    updateFormData("languages", updatedLanguages);
  };

  return (
    <div className="rtl container mx-auto px-4">
      <form>
        <div className="flex flex-col gap-2">
          {/* First Question */}
          <FieldContainer
            label="هل حصلت على أي دورات أو ورش عمل سابقة تتعلق بالمجال الذي اخترته أو تكنولوجيا المعلومات بشكل عام؟"
            className="grid gap-4 grid-cols-2"
            error={errors.has_workshops}
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

          {formData.has_workshops === 1 && (
            <Input
              label="يرجى التوضيح"
              name="workshop_clarify"
              placeholder="أذكر تفاصيل الدورات أو ورش العمل"
              value={formData.workshop_clarify || ""}
              onChange={handleInputChange("workshop_clarify")}
              errorMessage={errors.workshop_clarify}
            />
          )}

          {/* Second Question */}
          <FieldContainer
            label="هل لديك أي خبرة في العمل مع التعليمات البرمجية، حتى خارج الإطار الرسمي؟"
            className="grid gap-4 grid-cols-2"
            error={errors.has_coding_experience}
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

          {formData.has_coding_experience === 1 && (
            <Input
              label="يرجى التوضيح"
              name="coding_clarify"
              placeholder="أذكر تفاصيل الخبرة البرمجية"
              value={formData.coding_clarify || ""}
              onChange={handleInputChange("coding_clarify")}
              errorMessage={errors.coding_clarify}
            />
          )}

          {/* Third Question */}
          <FieldContainer
            label="هل أنت على دراية بأي لغة برمجة أخرى غير HTML وCSS؟"
            className="grid gap-4 grid-cols-2"
            error={errors.knows_other_languages}
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

          {formData.knows_other_languages === 1 && (
            <FieldContainer
              label="يرجى اختيار لغات البرمجة التي تعرفها"
              className="grid gap-2 grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
              error={errors.languages}
            >
              {["JavaScript", "Python", "Java", "C++", "Ruby"].map((language) => (
                <Checkbox
                  key={language}
                  name="languages"
                  label={language}
                  checked={(formData.languages || []).includes(language)}
                  onChange={(isChecked) => handleCheckboxChange(language, isChecked)}
                />
              ))}
            </FieldContainer>
          )}
        </div>
      </form>
    </div>
  );
};

export default Step3;
