import React, { useState, useCallback, use } from "react";
import { put } from "@/lib/axios";
import Input from "@/components/common/Input";
import RadioButton from "@/components/common/Radio";
import FieldContainer from "@/components/common/FieldContainer";
import TextArea from "../common/TextArea";
import FileUpload from "../common/FileUpload";

const EditAccountDetails = ({ userData }) => {
  const [formData, setFormData] = useState({
    name: userData.user_profile.username,
    phone_number: userData.user_profile.phone_number,
    email: userData.user_profile.email,
    birth_date: userData.user_profile.birth_date
      ? userData.user_profile.birth_date.split("T")[0]
      : "",
    gender: userData.gender,
    address: userData.user_profile.address,
    city: userData.user_profile.city,
    country: userData.user_profile.country,

    is_it_graduate: userData.is_it_graduate,
    job_interest: userData.job_interest,
    motivation: userData.motivation,
    career_goals: userData.career_goals,
    project_ideas: userData.project_ideas,
    has_workshops: userData.has_workshops,
    workshop_clarify: userData.workshop_clarify,
    has_coding_experience: userData.has_coding_experience,
    coding_clarify: userData.coding_clarify,
    knows_other_languages: userData.knows_other_languages,
    languages: userData.languages,
    creative_problem_solving: userData.creative_problem_solving,
    website_vs_webapp: userData.website_vs_webapp,
    usability_steps: userData.usability_steps,
    additional_info: userData.additional_info,
    document: userData.document,
    documentPreview: userData.document,
  });

  const [errors, setErrors] = useState({});
  const [loading, setLoading] = useState(false);
  const [errorMessages, setErrorMessages] = useState({});
  const [successMessage, setSuccessMessage] = useState("");

  const validateForm = () => {
    let tempErrors = {};

    if (!formData.name) tempErrors.name = "اسم المستخدم مطلوب";

    if (!formData.gender) tempErrors.gender = "الرجاء تحديد النوع";

    if (!formData.country) {
      tempErrors.country = "الرجاء تحديد البلد";
    }

    if (!formData.city && !formData.city_input) {
      tempErrors.city = "أختر المدينة مطلوب";
    }

    if (!formData.address) tempErrors.address = "العنوان مطلوب";
    if (!formData.birth_date) tempErrors.birth_date = "تاريخ الميلاد مطلوب";
    if (!formData.phone_number) tempErrors.phone_number = "رقم الجوال مطلوب";
    if (formData.is_it_graduate === null)
      tempErrors.is_it_graduate =
        "الرجاء تحديد إذا كنت خريج تكنولوجيا المعلومات";

    if (!formData.job_interest)
      tempErrors.job_interest = "الرجاء اختيار المسار الوظيفي";
    if (!formData.motivation)
      tempErrors.motivation = "الرجاء كتابة سبب اهتمامك بهذا المسار";
    if (!formData.career_goals)
      tempErrors.career_goals = "الرجاء كتابة أهدافك المهنية";
    if (!formData.project_ideas)
      tempErrors.project_ideas = "الرجاء كتابة أفكار مشاريعك";

    if (formData.has_workshops === undefined) {
      tempErrors.has_workshops = "الرجاء الإجابة على السؤال";
    } else if (formData.has_workshops === 1 && !formData.workshop_clarify) {
      tempErrors.workshop_clarify =
        "الرجاء توضيح التفاصيل إذا كنت قد حصلت على ورش عمل";
    }

    if (formData.has_coding_experience === undefined) {
      tempErrors.has_coding_experience = "الرجاء الإجابة على السؤال";
    } else if (
      formData.has_coding_experience === 1 &&
      !formData.coding_clarify
    ) {
      tempErrors.coding_clarify =
        "الرجاء توضيح التفاصيل إذا كانت لديك خبرة برمجية";
    }

    if (formData.knows_other_languages === undefined) {
      tempErrors.knows_other_languages = "الرجاء الإجابة على السؤال";
    } else if (
      formData.knows_other_languages === 1 &&
      (!formData.languages || formData.languages.length === 0)
    ) {
      tempErrors.languages =
        "يرجى اختيار لغة واحدة على الأقل إذا كنت تعرف لغات برمجية أخرى";
    }
    if (!formData.creative_problem_solving) {
      tempErrors.creative_problem_solving =
        "الرجاء وصف موقف حل المشكلة الإبداعية";
    }
    if (!formData.website_vs_webapp) {
      tempErrors.website_vs_webapp =
        "الرجاء شرح الاختلافات بين website و web application";
    }
    if (!formData.usability_steps) {
      tempErrors.usability_steps = "الرجاء شرح خطوات تأكدك من سهولة الاستخدام";
    }
    if (!formData.additional_info) {
      tempErrors.additional_info =
        "الرجاء كتابة معلومات إضافية عن نفسك أو سبب كونك مناسبًا.";
    }

    if (!formData.document) {
      tempErrors.document =
        "الرجاء إرفاق سيرتك الذاتية أو أي شهادات تعليمية ذات صلة.";
    } else {
      const validTypes = [
        "application/pdf",
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
      ];
      const maxSize = 2 * 1024 * 1024;

      if (!validTypes.includes(formData.document.type)) {
        tempErrors.document = "الرجاء إرفاق ملف بصيغة PDF أو DOC أو DOCX.";
      }

      if (formData.document.size > maxSize) {
        tempErrors.document = "حجم الملف يجب أن لا يتجاوز 2 ميجابايت.";
      }
    }

    setErrors(tempErrors);
    return Object.keys(tempErrors).length === 0;
  };

  const handleFileChange = (e) => {
    // Ensure the file is passed correctly to the parent component
    updateFormData("document", e.target.files[0]);
  };

  const updateFormData = useCallback((key, value) => {
    setFormData((prev) => ({ ...prev, [key]: value }));
  }, []);

  const handleInputChange = useCallback(
    (name) => (event) => {
      updateFormData(name, event.target.value);
    },
    [updateFormData]
  );

  const handleRadioChange = useCallback(
    (name, value) => () => {
      updateFormData(name, value);
    },
    [updateFormData]
  );

  // Submit the form to update the youth form
  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validateForm()) {
      console.error("Validation failed.");
      return;
    }

    const url = `/youth-forms/${userData.id}`; // Endpoint relative to baseURL
    const formDataToSubmit = new FormData();

    // Append all form data fields
    Object.keys(formData).forEach((key) => {
      if (formData[key] !== null && formData[key] !== undefined) {
        formDataToSubmit.append(key, formData[key]);
      }
    });

    // Debug FormData
    for (let [key, value] of formDataToSubmit.entries()) {
      console.log(`${key}: ${value}`);
    }

    try {
      console.log("Submitting form data...");
      const response = await put(url, formDataToSubmit, {
        "Content-Type": "multipart/form-data", // Override headers for FormData
      });
      console.log("Form submitted successfully:", response);
    } catch (error) {
      console.log("Form data:", formData);
      console.log("URL" + "/youth-forms/" + userData.id);
      console.error("Form submission failed:", error.message);
    }
  };

  return (
    <div className="bg-white rounded-lg shadow mt-2 p-4">
      <form onSubmit={handleSubmit}>
        <FieldContainer
          label={"البيانات الشخصية"}
          error={errors.name}
          className="p-2 grid grid-cols-1 md:grid-cols-2 gap-4"
        >
          <Input
            label="اسم المستخدم"
            name="name"
            type="text"
            placeholder="اسم المستخدم"
            value={formData.name || ""}
            onChange={handleInputChange("name")}
            errorMessage={errors.name}
          />
          <Input
            label="رقم الجوال"
            name="phone_number"
            type="text"
            placeholder="رقم الجوال"
            value={formData.phone_number || ""}
            onChange={handleInputChange("phone_number")}
            errorMessage={errors.phone_number}
          />

          <Input
            label="البريد الالكتروني"
            name="email"
            type="text"
            placeholder="البريد الالكتروني"
            value={formData.email || ""}
            onChange={handleInputChange("email")}
            errorMessage={errors.email}
          />

          <Input
            label="تاريخ الميلاد"
            name="birth_date"
            type="date"
            placeholder="تاريخ الميلاد"
            value={formData.birth_date || ""}
            onChange={handleInputChange("birth_date")}
            errorMessage={errors.birth_date}
          />
        </FieldContainer>
        <FieldContainer
          error={errors.gender}
          header={"الجنس"}
          className="p-2 grid grid-cols-2 gap-4"
        >
          {[
            { label: "ذكر", value: "male" },
            { label: "انثى", value: "female" },
          ].map((gender) => (
            <RadioButton
              key={gender.value}
              label={gender.label}
              name="gender"
              value={gender.value}
              checked={formData.gender === gender.value}
              onChange={handleRadioChange("gender", gender.value)}
            />
          ))}
        </FieldContainer>

        <FieldContainer
          error={errors.address}
          className="p-2 grid mt-6 grid-cols-1 md:grid-cols-2 gap-4"
        >
          <Input
            label="العنوان"
            name="address"
            type="text"
            placeholder="العنوان"
            value={formData.address || ""}
            onChange={handleInputChange("address")}
            errorMessage={errors.address}
          />
          <Input
            label="المدينة"
            name="city"
            type="text"
            placeholder="المدينة"
            value={formData.city || ""}
            onChange={handleInputChange("city")}
            errorMessage={errors.city}
          />
        </FieldContainer>

        <FieldContainer
          error={errors.country}
          className="px-2 grid grid-cols-1"
        >
          <Input
            label="الدولة"
            name="country"
            type="text"
            placeholder="الدولة"
            value={formData.country || ""}
            onChange={handleInputChange("country")}
            errorMessage={errors.country}
          />
        </FieldContainer>

        <hr></hr>

        <FieldContainer
          error={errors.is_it_graduate}
          label="بيانات الاستبيان"
          header="هل أنت خريج تكنولوجيا المعلومات؟"
          className="p-2 grid grid-cols-1 md:grid-cols-2 gap-4"
        >
          {[
            { label: "نعم", value: 1 },
            { label: "لا", value: 0 },
          ].map((option) => (
            <RadioButton
              key={option.value}
              name="is_graduated"
              label={option.label}
              value={option.value}
              checked={formData.is_it_graduate === option.value} // Ensure correct field reference
              onChange={handleRadioChange("is_it_graduate", option.value)} // Use correct field reference
            />
          ))}
        </FieldContainer>

        <FieldContainer
          error={errors.job_interest}
          className="px-2 grid grid-cols-1"
        >
          <Input
            label="ماهو المسار الوظيفي الذي تهتم به؟"
            name="job_interest"
            type="text"
            placeholder="ماهو المسار الوظيفي الذي تهتم به؟"
            value={formData.job_interest || ""}
            onChange={handleInputChange("job_interest")}
            errorMessage={errors.job_interest}
          />
        </FieldContainer>

        <FieldContainer
          error={errors.motivation}
          className="px-2 grid grid-cols-1"
        >
          <TextArea
            label={"لماذا انت مهتم بتعلم هذه المسار؟"}
            name="motivation"
            placeholder="لماذا انت مهتم بتعلم هذه المسار؟"
            value={formData.motivation || ""}
            onChange={handleInputChange("motivation")}
            errorMessage={errors.motivation}
            rows={3}
          />
        </FieldContainer>

        <FieldContainer
          error={errors.career_goals}
          className="px-2 grid grid-cols-1"
        >
          <TextArea
            label={" ما هي اهدافك المهنية في المجال الذي اخترته؟"}
            name="career_goals"
            placeholder="ما هي اهدافك المهنية في المجال الذي اخترته؟"
            value={formData.career_goals || ""}
            onChange={handleInputChange("career_goals")}
            errorMessage={errors.career_goals}
            rows={3}
          />
        </FieldContainer>

        <FieldContainer
          error={errors.project_ideas}
          className="px-2 grid grid-cols-1"
        >
          <TextArea
            label={
              "هل لديك أي مشاريع أو أفكار محددة ترغب في بنائها باستخدام مهاراتك المكتسبة حديثًا؟"
            }
            name="project_ideas"
            placeholder="هل لديك أي مشاريع أو أفكار محددة ترغب في بنائها باستخدام مهاراتك المكتسبة حديثًا؟"
            value={formData.project_ideas || ""}
            onChange={handleInputChange("project_ideas")}
            errorMessage={errors.project_ideas}
            rows={3}
          />
        </FieldContainer>

        <FieldContainer
          error={errors.has_workshops}
          className="px-2 grid grid-cols-2 gap-4"
          header={"هل يوجد لديك ورش تدريبية؟"}
        >
          {[
            { label: "نعم", value: 1 },
            { label: "لا", value: 0 },
          ].map((option) => (
            <RadioButton
              key={option.value}
              name="has_workshops"
              label={option.label}
              value={option.value}
              checked={formData.has_workshops === option.value} // Ensure correct field reference
              onChange={handleRadioChange("has_workshops", option.value)} // Use correct field reference
            />
          ))}
        </FieldContainer>
        {formData.has_workshops === 1 ? (
          <FieldContainer
            error={errors.workshop_clarify}
            className="px-2 grid grid-cols-1"
          >
            <TextArea
              label={"تفاصيل الورش"}
              name="workshop_clarify"
              placeholder="تفاصيل الورش"
              value={formData.workshop_clarify || ""}
              onChange={handleInputChange("workshop_clarify")}
              errorMessage={errors.workshop_clarify}
              rows={3}
            />
          </FieldContainer>
        ) : (
          // When has_workshops is 0, reset the value and hide the TextArea
          <FieldContainer
            error={errors.workshop_clarify}
            className="px-2 grid grid-cols-1 hidden"
          >
            <TextArea
              label={"تفاصيل الورش"}
              name="workshop_clarify"
              placeholder="تفاصيل الورش"
              value={""} // Explicitly set the value to an empty string
              onChange={handleInputChange("workshop_clarify")}
              errorMessage={errors.workshop_clarify}
              rows={3}
            />
          </FieldContainer>
        )}

        <FieldContainer
          error={errors.has_coding_experience}
          className="px-2 grid grid-cols-2 gap-4"
          header={"هل لديك خبرة برمجية؟"}
        >
          {[
            { label: "نعم", value: 1 },
            { label: "لا", value: 0 },
          ].map((option) => (
            <RadioButton
              key={option.value}
              name="has_coding_experience"
              label={option.label}
              value={option.value}
              checked={formData.has_coding_experience === option.value}
              onChange={handleRadioChange(
                "has_coding_experience",
                option.value
              )}
            />
          ))}
        </FieldContainer>

        {formData.has_coding_experience === 1 ? (
          <FieldContainer
            error={errors.coding_clarify}
            className="px-2 grid grid-cols-1"
          >
            <TextArea
              label={"تفاصيل الخبرة البرمجية"}
              name="coding_clarify"
              placeholder="تفاصيل الخبرة البرمجية"
              value={formData.coding_clarify || ""}
              onChange={handleInputChange("coding_clarify")}
              errorMessage={errors.coding_clarify}
              rows={3}
            />
          </FieldContainer>
        ) : (
          <FieldContainer
            error={errors.coding_clarify}
            className="px-2 grid grid-cols-1 hidden"
          >
            <TextArea
              label={"تفاصيل الخبرة البرمجية"}
              name="coding_clarify"
              placeholder="تفاصيل الخبرة البرمجية"
              value={""} // Clear the value when hidden
              onChange={handleInputChange("coding_clarify")}
              errorMessage={errors.coding_clarify}
              rows={3}
            />
          </FieldContainer>
        )}

        {/* Handle knows_other_languages */}
        <FieldContainer
          error={errors.knows_other_languages}
          className="px-2 grid grid-cols-2 gap-4"
          header={"هل تعرف لغات أخرى؟"}
        >
          {[
            { label: "نعم", value: 1 },
            { label: "لا", value: 0 },
          ].map((option) => (
            <RadioButton
              key={option.value}
              name="knows_other_languages"
              label={option.label}
              value={option.value}
              checked={formData.knows_other_languages === option.value}
              onChange={handleRadioChange(
                "knows_other_languages",
                option.value
              )}
            />
          ))}
        </FieldContainer>

        {formData.knows_other_languages === 1 ? (
          <FieldContainer
            error={errors.languages}
            className="px-2 grid grid-cols-1"
          >
            <TextArea
              label={"اللغات الأخرى"}
              name="languages"
              placeholder="اللغات الأخرى"
              value={formData.languages || ""}
              onChange={handleInputChange("languages")}
              errorMessage={errors.languages}
              rows={3}
            />
          </FieldContainer>
        ) : (
          <FieldContainer
            error={errors.languages}
            className="px-2 grid grid-cols-1 hidden"
          >
            <TextArea
              label={"اللغات الأخرى"}
              name="languages"
              placeholder="اللغات الأخرى"
              value={""} // Clear the value when hidden
              onChange={handleInputChange("languages")}
              errorMessage={errors.languages}
              rows={3}
            />
          </FieldContainer>
        )}

        <FieldContainer className="px-2 grid grid-cols-1 md:grid-cols-2 gap-4">
          <TextArea
            label={"حل المشكلات الإبداعي"}
            name="creative_problem_solving"
            placeholder="حل المشكلات الإبداعي"
            value={formData.creative_problem_solving || ""}
            onChange={handleInputChange("creative_problem_solving")}
            errorMessage={errors.creative_problem_solving}
            rows={3}
          />

          <TextArea
            label={"مقارنة الموقع والتطبيق"}
            name="website_vs_webapp"
            placeholder="مقارنة الموقع والتطبيق"
            value={formData.website_vs_webapp || ""}
            onChange={handleInputChange("website_vs_webapp")}
            errorMessage={errors.website_vs_webapp}
            rows={3}
          />

          <TextArea
            label={"خطوات السهولة"}
            name="usability_steps"
            placeholder="خطوات السهولة"
            value={formData.usability_steps || ""}
            onChange={handleInputChange("usability_steps")}
            errorMessage={errors.usability_steps}
            rows={3}
          />

          <TextArea
            label={"معلومات اضافية"}
            name="additional_info"
            placeholder="معلومات اضافية"
            value={formData.additional_info || ""}
            onChange={handleInputChange("additional_info")}
            errorMessage={errors.additional_info}
            rows={3}
          />
        </FieldContainer>

        <FieldContainer className="px-2 grid grid-cols-1">
          <FileUpload
            label="السيرة الذاتية"
            additionalClasses="mb-6"
            errorMessage={errors.document}
            onChange={handleFileChange}
          />
        </FieldContainer>

        <button type="submit" disabled={loading}>
          {loading ? "Updating..." : "Update Form"}
        </button>

        {successMessage && <p>{successMessage}</p>}
        {errorMessages.general && <p>{errorMessages.general}</p>}
      </form>
    </div>
  );
};

export default EditAccountDetails;
