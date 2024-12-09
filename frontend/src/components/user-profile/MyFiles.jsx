import Image from "next/image";
import React, { useState } from "react";

const MyFiles = () => {
  // Static example files for demonstration
  const [cvFile] = useState(null); // No CV file uploaded
  const [certificateFiles, setCertificateFiles] = useState([
    "example-certificate-1.pdf",
    "example-certificate-2.pdf",
  ]); // Example static Certificate files

  // Function to handle file download (using static links)
  const handleFileDownload = (fileName) => {
    const fileLink = `/files/${fileName}`; // Static path for demo (replace with actual file path)
    const link = document.createElement("a");
    link.href = fileLink;
    link.download = fileName;
    link.click();
  };

  // Function to handle file deletion
  const handleFileDelete = (fileName) => {
    setCertificateFiles((prevFiles) => prevFiles.filter((file) => file !== fileName));
  };

  return (
    <section>
      {/* CV Section */}
      <div className="bg-white rounded-md py-2 mt-4 shadow-md">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image src="/request.svg" alt="User" width={20} height={20} />
            <h2 className="text-base font-semibold text-[#21255C]">السير الذاتية الخاصة بي</h2>
          </div>
          <button className="px-4 py-2 border-[#F03F74] border-2 rounded-md text-[#F03F74] hover:bg-gradient hover:text-white transition duration-300">
            رفع سيرة ذاتية جديدة
          </button>
        </div>

        <div className="p-4">
          {/* Check if CV file exists */}
          {cvFile ? (
            <div className="flex justify-between items-center bg-[#F9F9F9] p-4 rounded-md border border-gray-200 shadow-sm hover:shadow-md transition">
              <div className="flex items-center gap-3">
                <Image src="/cv-file-icon.svg" alt="CV" width={20} height={20} />
                <span>{cvFile}</span>
              </div>
              <div className="flex gap-2">
                <button
                  onClick={() => handleFileDownload(cvFile)}
                  className="text-[#F03F74] hover:text-[#21255C] transition duration-300"
                >
                  تحميل
                </button>
                <button
                  onClick={() => alert("CV file deleted")} // Replace with actual delete function if needed
                  className="text-[#F03F74] hover:text-[#21255C] transition duration-300"
                >
                  حذف
                </button>
              </div>
            </div>
          ) : (
            <div className="flex flex-col justify-center items-center">
              <Image src="/no-files.svg" alt="No files" width={150} height={150} />
              <p className="text-gray-500">لا يوجد سيرة ذاتية مرفوعة</p>
            </div>
          )}
        </div>
      </div>

      {/* Certificates Section */}
      <div className="bg-white rounded-md py-2 mt-4 shadow-md">
        <div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
          <div className="flex gap-3 items-center">
            <Image src="/request.svg" alt="User" width={20} height={20} />
            <h2 className="text-base font-semibold text-[#21255C]">الشهادات الخاصة بي</h2>
          </div>
          <button className="px-4 py-2 border-[#F03F74] border-2 rounded-md text-[#F03F74] hover:bg-gradient hover:text-white transition duration-300">
            رفع شهادة جديدة
          </button>
        </div>

        <div className="flex p-4 gap-2 flex-wrap">
          {/* Check if Certificate files exist */}
          {certificateFiles.length > 0 ? (
            certificateFiles.map((file, index) => (
              <div
                key={index}
                className="flex gap-4 flex-col items-center justify-between bg-[#F9F9F9] p-4 rounded-md border border-gray-200 shadow-sm hover:shadow-md mb-3 transition w-full sm:w-auto"
              >
                <div className="flex items-center gap-3">
                  <span>{file}</span>
                </div>
                <div className="flex  gap-4">
                  <button
                    onClick={() => handleFileDownload(file)}
                    className="text-[#21255C] hover:text-[#F03F74] transition duration-300"
                  >
                    تحميل
                  </button>
                  <button
                    onClick={() => handleFileDelete(file)}
                    className="text-[#F03F74] hover:text-[#21255C] transition duration-300"
                  >
                    حذف
                  </button>
                </div>
              </div>
            ))
          ) : (
            <div className="flex flex-col justify-center items-center">
              <Image src="/no-files.svg" alt="No files" width={150} height={150} />
              <p className="text-gray-500">لا يوجد شهادات مرفوعة</p>
            </div>
          )}
        </div>
      </div>
    </section>
  );
};

export default MyFiles;
