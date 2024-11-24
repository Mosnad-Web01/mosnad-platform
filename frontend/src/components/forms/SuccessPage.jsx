import React from "react";

const SuccessPage = () => {
  return (
    <div className="flex flex-col items-center justify-center text-center space-y-4">
      <h1 className="text-3xl font-bold text-green-600">تم الإرسال بنجاح!</h1>
      <p className="text-gray-600">
        شكرًا لك على إكمال النموذج. سيتم التواصل معك قريبًا.
      </p>
      <button
        onClick={() => window.location.reload()} // Refresh the page (optional)
        className="px-6 py-2 bg-gradient mt-12 text-white rounded-lg"
      >
        العودة إلى البداية
      </button>
    </div>
  );
};

export default SuccessPage;