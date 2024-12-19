import React, { useState } from "react";
import Input from "@/components/common/Input";
import SelectInput from "@/components/common/SelectInput";
import TextArea from "@/components/common/TextArea";
import { post } from "@/lib/axios";

const JobForm = () => {
  const [formData, setFormData] = useState({
    title: "",
    description: "",
    required_skills: "",
    experience: "",
    position_level: "",
    other_criteria: "",
    end_date: "",
    imgurl: null,
  });

  const [errors, setErrors] = useState({});

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const handleFileChange = (e) => {
    setFormData((prevData) => ({
      ...prevData,
      imgurl: e.target.files[0],
    }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const submissionData = new FormData();
    Object.keys(formData).forEach((key) => {
      submissionData.append(key, formData[key]);
    });

    try {
      const response = await post("/job-opportunities", submissionData, {
        "Content-Type": "multipart/form-data",
      });

      console.log("Success:", response);
      // Handle successful submission, e.g., clear form or show a success message
    } catch (error) {
      console.error("Error:", error);
      if (error.response?.data?.errors) {
        setErrors(error.response.data.errors);
      }
    }
  };

  return (
    <section className="bg-white m-2 rounded-xl p-4">
      <form onSubmit={handleSubmit} className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <Input
          name="title"
          label="عنوان الوظيفة"
          placeholder="أدخل عنوان الوظيفة"
          value={formData.title}
          onChange={handleChange}
          errorMessage={errors.title}
        />

        <SelectInput
          name="position_level"
          label="مستوى الوظيفة"
          value={formData.position_level}
          onChange={(e) => handleChange(e)}
          options={[
            { value: "", label: "اختر المستوى" },
            { value: "مستوى مبتدئ", label: "مستوى مبتدئ" },
            { value: "مستوى متوسط", label: "مستوى متوسط" },
            { value: "مستوى خبير", label: "مستوى خبير" },
          ]}
          errorMessage={errors.position_level}
        />

        <SelectInput
          name="experience"
          label="مستوى الخبرة"
          value={formData.experience}
          onChange={(e) => handleChange(e)}
          options={[
            { value: "", label: "اختر مستوى الخبرة" },
            { value: "سنة - سنتين", label: "سنة - سنتين" },
            { value: "3-5 سنوات", label: "3-5 سنوات" },
            { value: "5+ سنوات", label: "5+ سنوات" },
          ]}
          errorMessage={errors.experience}
        />

        <Input
          name="required_skills"
          label="المهارات المطلوبة"
          placeholder="أدخل المهارات المطلوبة"
          value={formData.required_skills}
          onChange={handleChange}
          errorMessage={errors.required_skills}
        />

        <Input
          name="end_date"
          type="date"
          label="تاريخ الانتهاء"
          value={formData.end_date}
          onChange={handleChange}
          errorMessage={errors.end_date}
        />

        <Input
          name="other_criteria"
          label="معايير أخرى"
          placeholder="أدخل معايير أخرى"
          value={formData.other_criteria}
          onChange={handleChange}
          errorMessage={errors.other_criteria}
        />

        <Input
          name="imgurl"
          type="file"
          label="تحميل الصورة"
          onChange={handleFileChange}
          errorMessage={errors.imgurl}
        />

        <TextArea
          name="description"
          label="الوصف الوظيفي"
          placeholder="أدخل الوصف الوظيفي هنا"
          rows={6}
          value={formData.description}
          onChange={(value) => setFormData((prev) => ({ ...prev, description: value }))}
          errorMessage={errors.description}
          additionalClasses="lg:col-span-2"
        />

        <button
          type="submit"
          className="col-span-full px-4 py-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-600"
        >
          إرسال
        </button>
      </form>
    </section>
  );
};

export default JobForm;
