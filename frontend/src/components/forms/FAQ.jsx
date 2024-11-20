  "use client";
  import React, { useState } from "react";
  import ToggleButtonGroup from "../common/ToggleButtonGroup";

  const FAQ = ({ faqs, extraClasses = "" }) => {
    const [activeTab, setActiveTab] = useState("trainer");
    const [expanded, setExpanded] = useState(null);

    const toggleFAQ = (index) => {
      setExpanded(expanded === index ? null : index);
    };

    const filteredFaqs = faqs[activeTab] || [];

    return (
      <div className={`w-full px-0 lg:px-8 ${extraClasses}`}>
        {/* Tab Buttons */}
        <div className="bg-white w-fit mx-auto p-[6px] rounded-lg my-4 shadow-md">
          <ToggleButtonGroup
            options={[
              { label: "زائر (متدرب)", value: "trainer" },
              { label: "مستفيد (شركة)", value: "company" },
            ]}
            activeOption={activeTab}
            onOptionChange={setActiveTab}
            extraClasses="mb-6"
          />
        </div>

        {/* FAQ List */}
        <div>
          {filteredFaqs.map((faq, index) => (
            <div key={index} className="relative mb-4">
              {/* Red curved shape */}
              <div 
                style={{ right: '-5px' }}
                className="absolute top-0 h-full w-4 bg-[#F03F74] rounded-r-xl" 
              />
              
              {/* White card content */}
              <div className="relative bg-white shadow-md rounded-lg px-2 lg:px-6 py-4 hover:shadow-lg transition">
                <div
                  className="flex justify-between items-center cursor-pointer"
                  onClick={() => toggleFAQ(index)}
                >
                  <div className="flex items-center">
                    {faq.icon && <span className="mr-2">{faq.icon}</span>}
                    <p className="text-xs lg:text-base">{faq.question}</p>
                  </div>
                  <span className="text-white bg-gradient w-7 h-7 flex items-center justify-center rounded-full font-mono">
                    {expanded === index ? "-" : "+"}
                  </span>
                </div>
                {expanded === index && (
                  <div className="mt-2 text-gray-600">{faq.answer}</div>
                )}
              </div>
            </div>
          ))}
        </div>
      </div>
    );
  };

  export default FAQ;