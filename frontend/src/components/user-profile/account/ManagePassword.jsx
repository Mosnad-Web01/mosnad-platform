import Input from '@/components/common/Input';
import Image from 'next/image';

const ManagePassword = () => {
	return (
		<section>
			<div className="bg-white rounded-2xl py-3 shadow ">
				<div className="flex gap-3 items-center border-b p-4 border-gray-100">
					<Image src="/lock.svg" alt="User" width={16} height={16} />
					<h2 className="text-base font-semibold text-[#21255C]">
						تعديل كلمة المرور
					</h2>
				</div>
				<form className="p-5">
					<Input
						label="كلمة المرور الحالية"
						type="password"
						placeholder="كلمة المرور الحالية"
					/>
					<Input
						label="كلمة المرور الجديدة"
						type="password"
						placeholder="كلمة المرور الجديدة"
					/>
					<Input
						label="تاكيد كلمة المرور الجديدة"
						type="password"
						placeholder="تاكيد كلمة المرور الجديدة"
					/>
					<button className="w-full py-3 bg-gradient text-white rounded-md mt-2">
						تغيير كلمة المرور
					</button>
				</form>
			</div>
		</section>
	);
};

export default ManagePassword;
