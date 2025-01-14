import { useState } from "react";
import AccountInfo from "./AccountInfo";


const ManageAccount = ({ userData }) => {
  const [activeTab, setActiveTab] = useState('AccountInfo');

  const accountInfo = [
    { label: " اسم المستخدم", value: userData.user_profile.username },
    { label: "اسم الشركة", value: userData.company_name },
    { label: "البريد الإلكتروني الخاص بالشركة", value: userData.user_profile.email },
    { label: "رقم الهاتف", value: userData.user_profile.phone_number },
    { label: "المدينة", value: userData.user_profile.city },
    { label: "الدولة", value: userData.user_profile.country },
    { label: "الشارع/الحي", value: userData.user_profile.address },
    {label: "تاريخ افتتاح الشركة", value: new Date(userData.user_profile.birth_date).toLocaleDateString('en')},
  ];

  return (

<div>

  {activeTab === 'AccountInfo' && <AccountInfo accountInfo={accountInfo} activetab={activeTab} setActiveTab={setActiveTab} />}
</div>
  );
  
}

export default ManageAccount;
