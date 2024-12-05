import React from "react";

const StatusBadge = ({ text, status }) => {
  const getStatusStyles = () => {
    switch (status) {
      case "review":
        return "bg-yellow-100 text-yellow-500 border border-yellow-500";
      case "rejected":
        return "bg-red-100 text-red-500 border border-red-500";
      case "accepted":
        return "bg-green-100 text-green-500 border border-green-500";
      default:
        return "bg-gray-100 text-gray-500 border border-gray-500";
    }
  };

  return (
    <span
      className={`inline-block px-3 py-1 text-[10px] font-medium rounded-full break-words ${getStatusStyles()}`}
    >
      {text}
    </span>
  );
};

export default StatusBadge;
