import Image from "next/image";
import CustomLink from "../common/CustomLink";
import Contact from "../forms/Contact";

export default function Footer() {
  return (
    <>
      <Contact />
      <footer className="bg-blue-950 text-white pt-8">
        <div className="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8 place-items-center">
          {/* Logo and Description */}
          <div>
            <div className="mb-4 text-center items-center flex flex-col">
              <Image
                src="/footer-logo.png"
                alt="Mosnad Logo"
                width={170}
                height={170}
              />
              <h2 className="text-lg font-bold my-4">التجربة بألف برهان</h2>
              <p className="text-gray-100 mb-4 text-xs">
                التجربة بألف برهان تواصل مع من يفهمك، وابدأ الرحلة!
              </p>
            </div>
            <div className="flex flex-col gap-2 md:flex-row items-center md:items-start rtl:md:divide-x-reverse md:divide-x-2 divide-gray-300">
              <p className="pr-4 text-sm">
                <span className="font-bold">البريد الإلكتروني:</span>{" "}
                <CustomLink className="text-sm" href="mailto:info@mosnad.com">
                  info@mosnad.com
                </CustomLink>
              </p>
              <p className="pl-4 pr-6 text-sm">
                <span className="font-bold">الهاتف:</span> 967781806090+
              </p>
            </div>

            <div className="text-center flex flex-col items-center">
              <h4 className="text-sm font-bold mt-6">
                تابعنا عبر السوشيال ميديا
              </h4>
              <div className="flex mt-4 gap-4">
                {/* Social Media Icons */}
                <CustomLink href="https://facebook.com">
                  <Image
                    width={50}
                    height={50}
                    src="/social-media/facebook.png"
                    alt="Facebook"
                    className="w-6 h-6"
                  />
                </CustomLink>
                <CustomLink href="https://instagram.com">
                  <Image
                    width={50}
                    height={50}
                    src="/social-media/instagram.png"
                    alt="Instagram"
                    className="w-6 h-6"
                  />
                </CustomLink>
                <CustomLink href="https://twitter.com">
                  <Image
                    width={50}
                    height={50}
                    src="/social-media/x.png"
                    alt="Twitter"
                    className="w-6 h-6"
                  />
                </CustomLink>
                <CustomLink href="https://youtube.com">
                  <Image
                    width={50}
                    height={50}
                    src="/social-media/youtube.png"
                    alt="YouTube"
                    className="w-6 h-6"
                  />
                </CustomLink>
              </div>
            </div>
          </div>

          {/* Pages Links */}
          <div className="flex flex-col items-center md:items-start">
            <h3 className="text-lg font-bold mb-4">الصفحات</h3>
            <ul className="flex flex-col gap-5 text-center md:text-start lg:text-start">
              <li>
                <CustomLink href="/partners">الشركات</CustomLink>
              </li>
              <li>
                <CustomLink href="/youth">للشباب</CustomLink>
              </li>
              <li>
                <CustomLink href="/team">الفريق</CustomLink>
              </li>
              <li>
                <CustomLink href="/connect">تواصل</CustomLink>
              </li>
            </ul>
          </div>

          {/* Platform Links */}
          <div className="flex flex-col items-center lg:mb-8  md:items-start">
            <h3 className="text-lg font-bold mb-4">المنصة</h3>
            <ul className="flex flex-col gap-5 text-center md:text-start lg:text-start">
              <li>
                <CustomLink href="/">الرئيسية</CustomLink>
              </li>
              <li>
                <CustomLink href="/about">من نحن</CustomLink>
              </li>
              <li>
                <CustomLink href="/competitions">المسابقات</CustomLink>
              </li>
            </ul>
          </div>

          {/* Support Links */}
          <div className="flex flex-col items-center md:items-start">
            <h3 className="text-lg font-bold mb-4">الدعم</h3>
            <ul className="flex flex-col gap-5 text-center md:text-start lg:text-start">
              <li>
                <CustomLink href="/terms">الأحكام والشروط</CustomLink>
              </li>
              <li>
                <CustomLink href="/privacy-policy">سياسة الخصوصية</CustomLink>
              </li>
              <li>
                <CustomLink href="/faq">الأسئلة الشائعة</CustomLink>
              </li>
              <li>
                <CustomLink href="/contact">تواصل معنا</CustomLink>
              </li>
            </ul>
          </div>
        </div>

        <div className="bg-white text-[#070707] text-center py-3 mt-8 text-sm">
          <p>
            © حقوق الطبع والنشر 2024. جميع الحقوق تم تطويرها بواسطة فريق SAS طور
            بكل حب ❤️
          </p>
        </div>
      </footer>
    </>
  );
}
