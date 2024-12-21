import { useState } from "react";
import { toast, ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
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
    imgurl: null,
    end_date: "",
  });

  const [errors, setErrors] = useState({});
  const [isSubmitting, setIsSubmitting] = useState(false);

  const validateForm = () => {
    const newErrors = {};
    
    if (!formData.title.trim()) {
      newErrors.title = "يرجى إدخال العنوان";
    }
    
    if (!formData.description.trim()) {
      newErrors.description = "يرجى إدخال الوصف";
    }
    
    if (!formData.required_skills.trim()) {
      newErrors.required_skills = "يرجى إدخال المهارات المطلوبة";
    }
    
    if (!formData.experience) {
      newErrors.experience = "يرجى اختيار مستوى الخبرة";
    }
    
    if (!formData.position_level) {
      newErrors.position_level = "يرجى اختيار مستوى الوظيفة";
    }
    
    if (!formData.end_date) {
      newErrors.end_date = "يرجى اختيار تاريخ الانتهاء";
      
    }

    if(formData.end_date){
      const today = new Date();
      const endDate = new Date(formData.end_date);
      if (endDate < today) {
        newErrors.end_date = "تاريخ الانتهاء يجب ان يكون بعد التاريخ الحالي";
      }
    }



    if (!formData.imgurl) {
      newErrors.imgurl = "يرجى تحميل صورة";
    }

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
    // Clear error when user starts typing
    if (errors[name]) {
      setErrors({ ...errors, [name]: "" });
    }
  };

  const handleFileChange = (e) => {
    setFormData({ ...formData, imgurl: e.target.files[0] });
    if (errors.imgurl) {
      setErrors({ ...errors, imgurl: "" });
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
  
    if (!validateForm()) {
      toast.error("يرجى ملء جميع الحقول المطلوبة");
      return;
    }
  
    setIsSubmitting(true);
    const formDataToSend = new FormData();
    Object.keys(formData).forEach((key) =>
      formDataToSend.append(key, formData[key])
    );
  
    try {
      await post("/job-opportunities", formDataToSend, {
        "Content-Type": "multipart/form-data",
      });
      toast.success("تم إرسال الفرصة الوظيفية بنجاح!");
      setFormData({
        title: "",
        description: "",
        required_skills: "",
        experience: "",
        position_level: "",
        other_criteria: "",
        imgurl: null,
        end_date: "",
      });
      setErrors({});
    } catch (error) {
      // Capture and display backend validation errors
      const backendErrors = error.response?.data?.errors || {};
      if (Object.keys(backendErrors).length > 0) {
        const newErrors = {};
        for (const key in backendErrors) {
          newErrors[key] = backendErrors[key].join(", ");
        }
        setErrors(newErrors);
        toast.error("حدث خطأ في التحقق. يرجى مراجعة الحقول.");
      } else {
        toast.error("حدث خطأ أثناء الإرسال. حاول مرة أخرى.");
      }
    } finally {
      setIsSubmitting(false);
    }
  };
  

  const ErrorMessage = ({ message }) => (
    <p className="text-red-500 text-sm mt-1">{message}</p>
  );

  return (
    <section className="bg-white m-2 rounded-xl p-4">
      <ToastContainer />
        <form onSubmit={handleSubmit} className="grid lg:grid-cols-2 gap-6">
          <div>
            <Input
              name="title"
              label="العنوان"
              value={formData.title}
              onChange={handleInputChange}
              placeholder="أدخل العنوان"
            />
            {errors.title && <ErrorMessage message={errors.title} />}
          </div>

          <div>
            <Input
              name="required_skills"
              label="المهارات المطلوبة"
              value={formData.required_skills}
              onChange={handleInputChange}
              placeholder="أدخل المهارات المطلوبة"
            />
            {errors.required_skills && <ErrorMessage message={errors.required_skills} />}
          </div>

          <div>
            <SelectInput
              name="experience"
              label="الخبرة"
              value={formData.experience}
              onChange={handleInputChange}
              options={[
                { value: "", label: "اختر مستوى الخبرة" },
                { value: "سنة - سنتين", label: "سنة - سنتين" },
                { value: "3-5 سنوات", label: "3-5 سنوات" },
                { value: "5+ سنوات", label: "5+ سنوات" },
              ]}
            />
            {errors.experience && <ErrorMessage message={errors.experience} />}
          </div>

          <div>
            <SelectInput
              name="position_level"
              label="مستوى الوظيفة"
              value={formData.position_level}
              onChange={handleInputChange}
              options={[
                { value: "", label: "اختر المستوى" },
                { value: "مستوى مبتدئ", label: "مستوى مبتدئ" },
                { value: "مستوى متوسط", label: "مستوى متوسط" },
                { value: "مستوى خبير", label: "مستوى خبير" },
              ]}
            />
            {errors.position_level && <ErrorMessage message={errors.position_level} />}
          </div>

          <div>
            <Input
              name="other_criteria"
              label="معايير أخرى"
              value={formData.other_criteria}
              onChange={handleInputChange}
              placeholder="أدخل المعايير الأخرى"
            />
          </div>

          <div>
            <Input
              name="imgurl"
              label="تحميل صورة"
              type="file"
              onChange={handleFileChange}
            />
            {errors.imgurl && <ErrorMessage message={errors.imgurl} />}
          </div>

          <div>
            <Input
              name="end_date"
              label="تاريخ الانتهاء"
              type="date"
              value={formData.end_date}
              onChange={handleInputChange}
            />
            {errors.end_date && <ErrorMessage message={errors.end_date} />}
          </div>

          <div className="lg:col-span-2">
            <TextArea
              name="description"
              label="الوصف"
              value={formData.description}
              onChange={(value) => {
                setFormData({ ...formData, description: value });
                if (errors.description) {
                  setErrors({ ...errors, description: "" });
                }
              }}
              placeholder="أدخل الوصف"
              additionalClasses="w-full"
            />
            {errors.description && <ErrorMessage message={errors.description} />}
          </div>

          <button
            type="submit"
            className="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors duration-300 lg:col-span-2"
            disabled={isSubmitting}
          >
            {isSubmitting ? "جاري الإرسال..." : "إرسال"}
          </button>
        </form>
    </section>
  );
};

export default JobForm;