import Image from 'next/image';

const AboutSection = () => {
    return (
        <section
            className="w-full"
            style={{
                background: 'radial-gradient(circle at calc(100% - 100px) 100px, rgba(238, 174, 202, 0.1) 0%, rgba(238, 174, 202, 0) 50%)',
                backgroundColor: 'white'
            }}
        >
            <div className="max-w-screen-xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-10 lg:gap-16 px-8 py-16">
                {/* Text Section */}
                <div className="lg:w-1/2 text-right flex flex-col gap-8 md:gap-12 text-black">
                    <div className="mb-4">
                        <h2 className="text-2xl md:text-3xl font-medium">(من نحن؟)</h2>
                    </div>

                    <div>
                        <h1 className="text-3xl md:text-5xl font-semibold">منصة مُسند</h1>
                    </div>
                    <div>
                        <p
                            className="text-lg md:text-2xl font-normal"
                            style={{
                                letterSpacing: '0.2px',
                                lineHeight: '1.8',
                            }}
                        >
                            صُممت مُسند لمساعدة الأفراد والشركات في إيجاد
                            نقاط إلتقاء بين المواهب اليمنية وأصحاب العمل
                            وتوفير السند للموهوب بجعله قادرًا على معرفة كل
                            مايلزمه في مساره المهني والبرمجي، وللشركات
                            بجعلها قادرة على الإستناد على جهة موثوقة تتولى
                            تزكية وإدارة عملية التوظيف للمواهب المعنية.
                        </p>
                    </div>
                </div>

                {/* Image Section */}
                <div className="lg:w-1/2 flex justify-center">
                    <Image
                        src="/whoarewe.svg"
                        alt="Who Are We"
                        width={438}
                        height={580}
                        className="rounded-lg block mt-10"
                    />
                </div>
            </div>
        </section>
    );
};

export default AboutSection;