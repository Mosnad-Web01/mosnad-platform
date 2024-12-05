import { redirect } from "next/navigation";

const page = () => {
  redirect("/userProfile/account/manage");
};

export default page;