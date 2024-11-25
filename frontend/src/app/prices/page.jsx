import Cards from "../../components/card/card";
export default function Pricing() {
	return (
		<div className="bg-[#EFEBF5] flex flex-col items-center  p-6 sm:p-8">
			<h1 className="text-3xl sm:text-4xl font-medium bg-white text-gray-800 text-center p-4 border-2 max-w-screen-2xl w-full border-gray-300 rounded-t-lg">
				{' '}
				عروض الأسعار
			</h1>
			<div className="border-2 bg-[#EDE1F0] bg-opacity-32 rounded-b-lg shadow-lg p-20  sm:pt-20 max-w-screen-2xl w-full">
				<div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
					{Cards.map((plan, index) => (
						<div
							key={index}
							className="bg-white rounded-3xl shadow-lg pb-6 text-center flex flex-col justify-between transform hover:scale-105 transition-transform duration-300 max-w-xl min-h-full">
							<div className="bg-gradient-to-r from-[#7451a1b6] to-[#f159228f] border rounded-t-3xl py-6 px-8 text-center">
								<h2 className="text-xl sm:text-xl font-bold text-gray-800">
									{plan.title}
								</h2>
							</div>
							<p className="text-gray-600 mt-2 text-center px-2 text-sm sm:text-sm">
								{plan.price}
							</p>
							<ul className="text-gray-700 mt-8 mb-8 space-y-3 text-right px-6">
								{plan.features.map((feature, i) => (
									<li
										key={i}
										className="flex items-center justify-between">
										<div className="w-6 h-6 border-2 bg-purple-800 border-purple-800 rounded-full flex items-center justify-center">
											<span className="text-white  text-sm">
												✔
											</span>
										</div>
										<span className="flex-1 text-center pr-2">
											{feature}
										</span>
									</li>
								))}
							</ul>
							<button className="mt-2 mx-8 py-2 px-6  sm:px-4  bg-gradient text-white rounded-lg w-auto sm:w-auto text-sm sm:text-base">
								اطلب الخدمة
							</button>
							<span className="text-gray-600 mt-4 text-center px-4 text-sm sm:text-sm">
								قد تختلف الضريبة حسب البلد الذي التقوم التحويل
								منه
							</span>
						</div>
					))}
				</div>
			</div>
			<div className="text-right mt-8">
				<span className="text-red-600 text-sm sm:text-sm">
					الضمانات و الاستبدالات
				</span>
				<p className="text-gray-600 text-sm sm:text-sm">
					أهمية الحصول على شخص مناسب لفريقك. <br />
					علاوة على ذلك، لضمان رضاكم، فإننا نقدم ضمان لمدة 90 يومًا في
					الخدمات التوظيف الخاصة بنا للعقود السنوية. إذا لم يلبي
					المبرمج الذي تم تعيينه
					<br />
					يمكننا إيجاد بديل مناسب دون تكلفة.
				</p>
			</div>
		</div>
	);
}