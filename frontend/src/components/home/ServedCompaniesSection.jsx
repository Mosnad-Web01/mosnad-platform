import Image from "next/image";

const ServedCompaniesSection = () => {
  return (
    <section className="w-full mt-[-10px]">
      <div
        className="relative"
        style={{
          background: `
            linear-gradient(
                to bottom,
                transparent 0%,
                rgba(249, 231, 243, 0.7) 30%,
                rgba(252, 231, 243, 0.7) 70%,
                transparent 100%
            )
          `,
          paddingTop: "3rem", // Adjust padding-top for more space
          paddingBottom: "3rem", // Adjust padding-bottom for more space
        }}
      >
        <div className="max-w-screen-xl mx-auto px-8 py-8 md:py-2">
          {/* Grouped Mosnad Logo and Text */}
          <div className="flex flex-col justify-between items-center md:flex-row gap-14">
            <div data-aos="fade-up" className="flex flex-col gap-6 items-center justify-center">
              {/* Mosnad Logo */}
              <figure className="max-w-[159px] max-h-[50px]">
                <Image src="/nav-logo.png" alt="Mosnad" width={159} height={50} />
              </figure>

              {/* Proud of Serving Text */}
              <div className="text-center md:text-right mt-4 md:mt-0">
                <h2 className="text-4xl font-bold text-gray-500">
                  نفتخر بخدمتهم
                </h2>
              </div>
            </div>

            {/* Servied Companies Logos */}
            <figure data-aos="fade-up" className="max-w-[150px] max-h-[60px] md:max-w-[200px] md:max-h-[100px]">
              <Image
                src="/jisr-logo.svg"
                alt="Jisr-logo.svg"
                width={217}
                height={113}
              />
            </figure>

            <figure data-aos="fade-up" className="max-w-[150px] max-h-[60px] md:max-w-[200px] md:max-h-[100px]">
              <Image
                src="/squadi-logo.svg"
                alt="Squadi-logo.svg"
                width={217}
                height={113}
              />
            </figure>
          </div>
        </div>
      </div>
    </section>
  );
};

export default ServedCompaniesSection;
