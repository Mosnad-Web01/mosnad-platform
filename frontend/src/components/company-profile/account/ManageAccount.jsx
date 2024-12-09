import Image from "next/image";
import Link from "next/link";
import { useState } from "react";
import AccountInfo from "./AccountInfo";
import EditAccountPage from "./EditAccountPage";

const ManageAccount = () => {
  const [activeTab, setActiveTab] = useState('AccountInfo');

  const accountInfo = [
    { label: "اسم الشركة", value: "مسند التدريب والتوظيف" },
    { label: "نبذة عن الشركة", value: "وراء كل مشروع برمجي، مسند تجمع، توفّر، وتوظف المهارات البرمجية المبنية (للأفراد - للشركات)" },
    { label: "البريد الإلكتروني الخاص بالشركة", value: "Mosnad@gmail.com" },
    { label: "رقم الهاتف", value: "777777777" },
    { label: "مجال عمل الشركة", value: "- برمجة مواقع\n- برمجة تطبيقات\n- UI/UX\n- الحاسوب وتقنية المعلومات" },
    { label: "نوع بيئة العمل", value: "مختلط" },
    { label: "الموقع رسمي خاص بالجهة", value: "Mosnad.com" },
    { label: "منصة رسمية بأحد مواقع التواصل الاجتماعي", value: "https://www.facebook.com/Mosnad" },
    { label: "المحافظة", value: "صنعاء" },
    { label: "المدينة", value: "مديرية صنعاء" },
    { label: "الشارع/الحي", value: "شارع بغداد" },
  ];

  return (

<div>

  {activeTab === 'AccountInfo' && <AccountInfo accountInfo={accountInfo} activetab={activeTab} setActiveTab={setActiveTab} />}
  {activeTab === 'Edit' && <EditAccountPage accountInfo={accountInfo} activetab={activeTab} setActiveTab={setActiveTab} />}
</div>
  );
  
}

export default ManageAccount;
