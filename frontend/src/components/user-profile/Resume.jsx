

const Resume = () => {
  return (
    <article className="bg-white shadow rounded-2xl p-4 mt-4 max-h-screen overflow-auto">
      <h2 className="text-base text-[#21255C] font-bold mb-4">السيرة الذاتية</h2>
      
      {/* Responsive object to display the PDF */}
      <div className="w-full h-[600px] rounded-lg overflow-hidden border border-gray-200">
        <object
          data="/cv/cv.pdf"
          type="application/pdf"
          className="w-full h-full"
        >
          <p>Unable to display PDF. Please <a href="/cv/cv.pdf">download the PDF</a>.</p>
        </object>
      </div>
    </article>
  );
};

export default Resume;
