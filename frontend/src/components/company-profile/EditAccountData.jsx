import { useCallback, useState, useEffect } from "react";
import Input from "@/components/common/Input";
import RadioButton from "@/components/common/Radio";
import FieldContainer from "@/components/common/FieldContainer";
import TextArea from "../common/TextArea";
import { put } from "@/lib/axios";

const EditCompanyForm = ({ userData }) => {
  const [loading, setLoading] = useState(false);
  const [submissionStatus, setSubmissionStatus] = useState(null);
  const [formData, setFormData] = useState({
    company_name: userData?.company_name || "",
    industry: userData?.industry || "",
    employees: userData?.employees || "",
    stage: userData?.stage || "",
    skills: Array.isArray(userData?.skills)
      ? userData.skills
      : JSON.parse(userData?.skills || "[]"), // Ensure it's parsed as an array    home_workers: userData?.home_workers || "",
    training: userData?.training || "",
    hiring: userData?.hiring || "",
    remote_hiring_preferences: Array.isArray(
      userData?.remote_hiring_preferences
    )
      ? userData.remote_hiring_preferences
      : JSON.parse(userData?.remote_hiring_preferences || "[]"), // Ensure it's parsed as an array    additional_notes: userData?.additional_notes || "",
    email: userData?.user_profile?.email || "",
    name: userData?.user_profile?.username || "",
    phone_number: userData?.user_profile?.phone_number || "",
    country: userData?.user_profile?.country || "",
    city: userData?.user_profile?.city || "",
    address: userData?.user_profile?.address || "",
    birth_date: userData.user_profile.birth_date
      ? userData.user_profile.birth_date.split("T")[0]
      : "",
    additional_notes: userData?.additional_notes || "",
    home_workers: userData?.home_workers || "",
  });

  const [errors, setErrors] = useState({});

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

  const validateForm = () => {
    let tempErrors = {};

    if (!formData.company_name) tempErrors.company_name = "اسم الشركة مطلوب";
    if (!formData.industry) tempErrors.industry = "مجال العمل مطلوب";
    if (!formData.employees) tempErrors.employees = "عدد الموظفين مطلوب";
    if (!formData.stage) tempErrors.stage = "المرحلة مطلوبة";
    if (!formData.home_workers)
      tempErrors.home_workers = "الرجاء تحديد العمل من المنزل";
    if (!formData.training) tempErrors.training = "الرجاء تحديد التدريب";
    if (!formData.hiring) tempErrors.hiring = "الرجاء تحديد التوظيف";
    if (!formData.additional_notes)
      tempErrors.additional_notes = "الملاحظات الإضافية مطلوبة";
    if (!formData.email) tempErrors.email = "البريد الإلكتروني مطلوب";
    if (!formData.name) tempErrors.name = "اسم المستخدم مطلوب";
    if (!formData.phone_number) tempErrors.phone_number = "رقم الهاتف مطلوب";
    if (!formData.country) tempErrors.country = "البلد مطلوب";
    if (!formData.city) tempErrors.city = "المدينة مطلوبة";
    if (!formData.address) tempErrors.address = "العنوان مطلوب";
    if (!formData.birth_date) tempErrors.birth_date = "تاريخ الميلاد مطلوب";

    setErrors(tempErrors);
    return Object.keys(tempErrors).length === 0;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validateForm()) {
      return;
    }
  
    const url = `/company-forms/${userData.id}`;
    const formDataToSubmit = new FormData();
  
    Object.keys(formData).forEach((key) => {
      const value = formData[key];
      if (Array.isArray(value)) {
        // Append each array value individually
        value.forEach((item) => formDataToSubmit.append(`${key}[]`, item));
      } else if (value !== null && value !== undefined) {
        formDataToSubmit.append(key, value);
      }
    });
  
    try {
      setLoading(true);
      setSubmissionStatus(null); // Reset status before submission
      const response = await put(url, formDataToSubmit, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });
      setSubmissionStatus({
        success: true,
        message: "Form submitted successfully!",
      });
      console.log("Form submitted successfully:", response);
    } catch (error) {
      setSubmissionStatus({ success: false, message: error.message });
      console.error("Form submission failed:", error.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <section className="bg-white m-2 rounded-xl p-2">
      <form onSubmit={handleSubmit} className="space-y-6">
        {/* Company Basic Info */}
        <FieldContainer className="p-2 grid grid-cols-1 md:grid-cols-2 gap-4">
          <Input
            label="اسم الشركة"
            name="company_name"
            type="text"
            placeholder="اسم الشركة"
            value={formData.company_name}
            onChange={handleInputChange("company_name")}
            errorMessage={errors.company_name}
          />
          <Input
            label="مجال العمل"
            name="industry"
            type="text"
            placeholder="مجال العمل"
            value={formData.industry}
            onChange={handleInputChange("industry")}
            errorMessage={errors.industry}
          />
        </FieldContainer>

        {/* Employees Count */}
        <FieldContainer
          error={errors.employees}
          header="عدد الموظفين"
          className="p-2 grid grid-cols-3 gap-4"
        >
          {["1-10", "11-50", "51+"].map((size) => (
            <RadioButton
              key={size}
              label={size}
              name="employees"
              value={size}
              checked={formData.employees === size}
              onChange={handleRadioChange("employees", size)}
            />
          ))}
        </FieldContainer>

        {/* Company Stage */}
        <FieldContainer
          error={errors.stage}
          header="مرحلة الشركة"
          className="p-2 grid grid-cols-2 gap-4"
        >
          {[
            { label: "قبل التأسيس", value: "before" },
            { label: "بعد التأسيس", value: "after" },
          ].map((stage) => (
            <RadioButton
              key={stage.value}
              label={stage.label}
              name="stage"
              value={stage.value}
              checked={formData.stage === stage.value}
              onChange={handleRadioChange("stage", stage.value)}
            />
          ))}
        </FieldContainer>

        {/* Skills */}
        <FieldContainer
          error={errors.skills}
          header="المهارات المطلوبة"
          className="p-2 grid grid-cols-1"
        >
          <TextArea
            label="المهارات"
            name="skills"
            placeholder="المهارات المطلوبة"
            value={formData.skills.join(", ")} // Display as a comma-separated string
            onChange={(value) => updateFormData("skills", value.split(", "))} // Convert back to an array
            errorMessage={errors.skills}
            rows={2}
          />
        </FieldContainer>

        {/* Work Options */}
        <FieldContainer className="p-2 grid grid-cols-1 md:grid-cols-3 gap-4">
          <FieldContainer
            error={errors.home_workers}
            header="العمل من المنزل"
            className="p-2"
          >
            {[
              { label: "نعم", value: "yes" },
              { label: "لا", value: "no" },
            ].map((option) => (
              <RadioButton
                key={option.value}
                label={option.label}
                name="home_workers"
                value={option.value}
                checked={formData.home_workers === option.value}
                onChange={handleRadioChange("home_workers", option.value)}
              />
            ))}
          </FieldContainer>

          <FieldContainer
            error={errors.training}
            header="التدريب"
            className="p-2"
          >
            {[
              { label: "نعم", value: "yes" },
              { label: "لا", value: "no" },
            ].map((option) => (
              <RadioButton
                key={option.value}
                label={option.label}
                name="training"
                value={option.value}
                checked={formData.training === option.value}
                onChange={handleRadioChange("training", option.value)}
              />
            ))}
          </FieldContainer>

          <FieldContainer
            error={errors.hiring}
            header="التوظيف"
            className="p-2"
          >
            {[
              { label: "نعم", value: "yes" },
              { label: "لا", value: "no" },
            ].map((option) => (
              <RadioButton
                key={option.value}
                label={option.label}
                name="hiring"
                value={option.value}
                checked={formData.hiring === option.value}
                onChange={handleRadioChange("hiring", option.value)}
              />
            ))}
          </FieldContainer>
        </FieldContainer>

        {/* Remote Hiring Preferences */}
        <FieldContainer
          error={errors.remote_hiring_preferences}
          className="p-2 grid grid-cols-1"
        >
          <TextArea
            label="متطلبات العمل عن بعد"
            name="remote_hiring_preferences"
            placeholder="متطلبات العمل عن بعد"
            value={formData.remote_hiring_preferences.join(", ")} // Display as a comma-separated string
            onChange={
              (value) =>
                updateFormData("remote_hiring_preferences", value.split(", ")) // Convert back to an array
            }
            errorMessage={errors.remote_hiring_preferences}
            rows={2}
          />
        </FieldContainer>
        {/* Additional Notes */}
        <FieldContainer className="p-2 grid grid-cols-1">
          <TextArea
            label="ملاحظات إضافية"
            name="additional_notes"
            placeholder="ملاحظات إضافية"
            value={formData.additional_notes}
            onChange={(value) => updateFormData("additional_notes", value)}
            errorMessage={errors.additional_notes}
            rows={3}
          />
        </FieldContainer>

        {/* User Profile Information */}
        <FieldContainer className="p-2 grid grid-cols-1 md:grid-cols-2 gap-4">
          <Input
            label="اسم المستخدم"
            name="name"
            type="text"
            placeholder="اسم المستخدم"
            value={formData.name}
            onChange={handleInputChange("name")}
            errorMessage={errors.name}
          />
          <Input
            label="البريد الإلكتروني"
            name="email"
            type="email"
            placeholder="البريد الإلكتروني"
            value={formData.email}
            onChange={handleInputChange("email")}
            errorMessage={errors.email}
          />
        </FieldContainer>

        <FieldContainer className="p-2 grid grid-cols-1 md:grid-cols-2 gap-4">
          <Input
            label="رقم الهاتف"
            name="phone_number"
            type="tel"
            placeholder="رقم الهاتف"
            value={formData.phone_number}
            onChange={handleInputChange("phone_number")}
            errorMessage={errors.phone_number}
          />
          <Input
            label="تاريخ الميلاد"
            name="birth_date"
            type="date"
            placeholder="تاريخ الميلاد"
            value={formData.birth_date}
            onChange={handleInputChange("birth_date")}
            errorMessage={errors.birth_date}
          />
        </FieldContainer>

        <FieldContainer className="p-2 grid grid-cols-1 md:grid-cols-3 gap-4">
          <Input
            label="البلد"
            name="country"
            type="text"
            placeholder="البلد"
            value={formData.country}
            onChange={handleInputChange("country")}
            errorMessage={errors.country}
          />
          <Input
            label="المدينة"
            name="city"
            type="text"
            placeholder="المدينة"
            value={formData.city}
            onChange={handleInputChange("city")}
            errorMessage={errors.city}
          />
          <Input
            label="العنوان"
            name="address"
            type="text"
            placeholder="العنوان"
            value={formData.address}
            onChange={handleInputChange("address")}
            errorMessage={errors.address}
          />
        </FieldContainer>

        <div className="flex justify-end p-2">
          <button
            type="submit"
            className="bg-gradient mt-4 text-white py-2 px-4 rounded"
          >
            {loading ? "  ارسال ... " : "تحديث"}
          </button>

          {submissionStatus && (
            <div
              className={`mt-4 p-2 rounded ${
                submissionStatus.success
                  ? "bg-green-100 text-green-800"
                  : "bg-red-100 text-red-800"
              }`}
            >
              {submissionStatus.message}
            </div>
          )}
        </div>
      </form>
    </section>
  );
};

export default EditCompanyForm;
