"use client";

import { useState, useRef } from "react";
import { put } from "@/lib/axios";
import Image from "next/image";
import Input from "@/components/common/Input";

const ManagePassword = () => {
  const [errors, setErrors] = useState({});
  const [successMessage, setSuccessMessage] = useState("");
  const [isSubmitting, setIsSubmitting] = useState(false);
  const formRef = useRef(null);

  const [formData, setFormData] = useState({
    current_password: "",
    new_password: "",
    confirm_password: "",
  });

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrors({});
    setSuccessMessage("");
    setIsSubmitting(true);

    const { current_password, new_password, confirm_password } = formData;

    // Client-side validation
    let validationErrors = {};

    if (!current_password) {
      validationErrors.current_password = "يرجى إدخال كلمة المرور الحالية";
    }

    if (!new_password) {
      validationErrors.new_password = "يرجى إدخال كلمة المرور الجديدة";
    } else if (new_password.length < 8) {
      validationErrors.new_password =
        "يجب أن تكون كلمة المرور الجديدة على الأقل 8 أحرف";
    }

    if (!confirm_password) {
      validationErrors.confirm_password = "يرجى تأكيد كلمة المرور الجديدة";
    } else if (new_password !== confirm_password) {
      validationErrors.confirm_password =
        "كلمة المرور الجديدة وتأكيد كلمة المرور لا تتطابق";
    }

    if (Object.keys(validationErrors).length > 0) {
      setErrors(validationErrors);
      focusFirstError(validationErrors);
      setIsSubmitting(false);
      return;
    }

    try {
      const response = await put("/change-password", {
        current_password,
        new_password,
        confirm_password,
      });

      if (response?.status === "success") {
        setSuccessMessage(response.message);
        setFormData({
          current_password: "",
          new_password: "",
          confirm_password: "",
        });
        setTimeout(() => setSuccessMessage(""), 5000); // Auto-clear success message
      }
    } catch (error) {
      if (error.data?.errors) {
        setErrors(error.data.errors);
        focusFirstError(error.data.errors);
      } else if (error.data?.message) {
        setErrors({ general: error.data.message });
      } else {
        setErrors({ general: "حدث خطأ. يرجى المحاولة مرة أخرى" });
      }
    } finally {
      setIsSubmitting(false);
    }
  };

  const focusFirstError = (validationErrors) => {
    if (formRef.current) {
      const firstErrorField = Object.keys(validationErrors)[0];
      const field = formRef.current.querySelector(
        `[name="${firstErrorField}"]`
      );
      if (field) field.focus();
    }
  };

  return (
    <section>
      <div className="bg-white rounded-2xl py-3 shadow">
        <div className="flex gap-3 items-center border-b p-4 border-gray-100">
          <Image src="/lock.svg" alt="User" width={16} height={16} />
          <h2 className="text-base font-semibold text-[#21255C]">
            تعديل كلمة المرور
          </h2>
        </div>
        <form className="p-5" onSubmit={handleSubmit} ref={formRef}>
          {successMessage && (
            <div className="text-green-500 mb-3 text-right">
              {successMessage}
            </div>
          )}
          {errors.general && (
            <div className="text-red-500 mb-3 text-right">{errors.general}</div>
          )}

          <Input
            type="password"
            name="current_password"
            label="كلمة المرور الحالية"
            value={formData.current_password}
            placeholder="أدخل كلمة المرور الحالية"
            errorMessage={errors.current_password}
            onChange={handleInputChange}
          />

          <Input
            type="password"
            name="new_password"
            label="كلمة المرور الجديدة"
            value={formData.new_password}
            placeholder="أدخل كلمة المرور الجديدة"
            errorMessage={errors.new_password}
            onChange={handleInputChange}
          />

          <Input
            type="password"
            name="confirm_password"
            label="تأكيد كلمة المرور الجديدة"
            value={formData.confirm_password}
            placeholder="أكد كلمة المرور الجديدة"
            errorMessage={errors.confirm_password}
            onChange={handleInputChange}
          />

          <div className="flex justify-end">
            <button
              type="submit"
              disabled={isSubmitting}
              className={`py-3 px-5 bg-gradient text-white rounded-md mt-2 ${
                isSubmitting ? "opacity-50 cursor-not-allowed" : ""
              }`}
            >
              {isSubmitting ? "جاري التحديث..." : "تغيير كلمة المرور"}
            </button>
          </div>
        </form>
      </div>
    </section>
  );
};

export default ManagePassword;
