import Link from "next/link";

export default function CustomLink({ href, children }) {
  const isExternal = href.startsWith("http");
  return isExternal ? (
    <a href={href} target="_blank" rel="noopener noreferrer" className="hover:underline text-gray-400">
      {children}
    </a>
  ) : (
    <Link href={href} className="hover:underline text-[#FDFAFF] text-sm">
      {children}
    </Link>
  );
}
