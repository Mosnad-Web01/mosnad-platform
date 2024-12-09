'use client';

import Input from '@/components/common/Input';
import Image from 'next/image';
import { useState } from 'react';

const ManageEmail = () => {
	const [email, setEmail] = useState('yasser@gmail.com');

	const handleEmailChange = (event) => {
		setEmail(event.target.value);
	};

	return (
		<section>
			<div className="bg-white rounded-2xl py-3 shadow">
				<div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
					<div className="flex gap-3 items-center">
						<Image
							src="/email-icon.svg"
							alt="User"
							width={16}
							height={16}
						/>
						<h2 className="text-base font-semibold text-[#21255C]">
							البريد الإلكتروني
						</h2>
					</div>
					<button className="px-4 py-2">
						<Image
							src="/edit.svg"
							alt="Edit"
							width={20}
							height={20}
						/>
					</button>
				</div>
				<form className="p-5">
					<Input
						label="البريد الإلكتروني"
						type="email"
						value={email}
						onChange={handleEmailChange} // handle updates
					/>
				</form>
			</div>
		</section>
	);
};

export default ManageEmail;