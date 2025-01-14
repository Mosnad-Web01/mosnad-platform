import NotificationCard from "@/components/cards/NotificationCard";
import React from "react";

const notifications = [
  {
    id: 1,
    imageSrc: "/notification-message.png",
    title: "تنبيه جديد",
    description: "لديك إشعار جديد بشأن موعدك القادم.",
    date: "قبل 5 دقائق",
  },
  {
    id: 2,
    imageSrc: "/notification-message.png",
    title: "تمت الموافقة",
    description: "تمت الموافقة على طلبك بنجاح.",
    date: "قبل ساعتين",
  },
  {
    id: 3,
    imageSrc: "/notification-message.png",
    title: "رسالة جديدة",
    description: "تلقيت رسالة جديدة من المسؤول.",
    date: "اليوم الساعة 10:00 صباحاً",
  },
  {
    id: 4,
    imageSrc: "/notification-message.png",
    title: "تحديث الحساب",
    description: "يرجى تحديث بيانات حسابك لضمان استمرارية الخدمة.",
    date: "أمس الساعة 4:30 مساءً",
  },
];

const Notifications = () => {
  return (
    <article className="bg-white shadow rounded-2xl p-4 mt-4 max-h-screen overflow-auto">
      <h2 className="text-base text-[#21255C] font-bold mb-4">جميع الاشعارات</h2>

      <div className="flex flex-col gap-4">
        {notifications.map((notification) => (
          <NotificationCard
            key={notification.id}
            imageSrc={notification.imageSrc}
            title={notification.title}
            description={notification.description}
            date={notification.date}
          />
        ))}
      </div>
    </article>
  );
};

export default Notifications;
