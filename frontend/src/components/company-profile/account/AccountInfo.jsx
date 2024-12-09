import Image from 'next/image';
import Link from 'next/link';
import React from 'react';

const AccountInfo = ({ accountInfo, activetab, setActiveTab }) => {
	return (
		<section>
			<div className="bg-white rounded-lg shadow">
				{/* Header */}
				<div className="flex gap-3 items-center justify-between py-4 px-4 border-b border-gray-100">
					<div className="flex gap-3 items-center">
						<Image
							src="/manage-account-icon.svg"
							alt="User"
							width={16}
							height={16}
						/>
						<h2 className="text-base font-semibold text-[#21255C]">
							معلومات الحساب
						</h2>
					</div>
					
					<button
						
						onClick={() => setActiveTab('Edit')}
						className="px-4 py-2">
						<Image
							src="/edit.svg"
							alt="Edit"
							width={20}
							height={20}
						/>
					</button>
				</div>

				{/* Table */}
				<table className="w-full text-right">
					<tbody>
						{accountInfo.map((item, index) => (
							<tr
								key={index}
								className="border-b border-gray-100">
								<td className="p-4 text-sm text-[#203B7D]">
									{item.label}
								</td>
								<td className="p-4 text-xs whitespace-pre-line">
									{item.value}
								</td>
							</tr>
						))}
					</tbody>
				</table>
			</div>
		</section>
	);
};

export default AccountInfo;
