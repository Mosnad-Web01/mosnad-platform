"use client";

import { useParams } from "next/navigation";
import { useState, useEffect } from "react";
import { get } from "@/lib/axios";
import Image from "next/image";
import {
  Calendar,
  MapPin,
  X,
  ChevronLeft,
  ChevronRight,
  Share2,
  Heart,
  Download,
} from "lucide-react";
import Spinner from "@/components/common/Spinner";

const ActivityShow = () => {
  const params = useParams();
  const [activity, setActivity] = useState(null);
  const [loading, setLoading] = useState(true);
  const [selectedImage, setSelectedImage] = useState(null);
  const [currentImageIndex, setCurrentImageIndex] = useState(0);
  const [isLiked, setIsLiked] = useState(false);

  const fetchActivity = async (activityId) => {
    setLoading(true);
    try {
      const data = await get(`/activities/${activityId}`);
      setActivity(data);
    } catch (error) {
      console.error("Error fetching activity:", error);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    if (params.id) {
      fetchActivity(params.id);
    }
  }, [params.id]);

  const handleShare = () => {
    const url = window.location.href; // Get the current URL

    if (navigator.share) {
      navigator
        .share({
          title: activity.title,
          url: url,
        })
        .then(() => {
          console.log("Activity shared successfully!");
        })
        .catch((error) => {
          console.error("Error sharing activity:", error);
        });
    } else {
      // Fallback for browsers that do not support navigator.share()
      alert(`Share this activity: ${url}`);
    }
  };

  if (loading) {
    return (
      <div className="min-h-screen bg-white flex items-center justify-center">
        <div className="space-y-4 text-center">
          <Spinner />
        </div>
      </div>
    );
  }

  if (!activity) return null;

  const { title, description, location, activity_date, images } = activity;

  const navigateImage = (direction) => {
    if (selectedImage) {
      const currentIndex = images.indexOf(selectedImage);
      let newIndex;
      if (direction === "next") {
        newIndex = currentIndex === images.length - 1 ? 0 : currentIndex + 1;
      } else {
        newIndex = currentIndex === 0 ? images.length - 1 : currentIndex - 1;
      }
      setSelectedImage(images[newIndex]);
      setCurrentImageIndex(newIndex);
    }
  };

  return (
    <div className="min-h-screen bg-white">
      {/* Hero Section */}
      <div className="relative h-[85vh]">
        <Image
          src={images[0]}
          alt={title}
          layout="fill"
          objectFit="cover"
          priority
          className="brightness-75"
        />
        <div className="absolute inset-0 bg-gradient-to-b from-transparent to-black/70" />

        {/* Floating Action Buttons */}
        <div className="absolute top-8 right-8 flex space-x-4">
          <button
            className="p-3 bg-white/10 backdrop-blur-md rounded-full hover:bg-white/20 transition-all"
            onClick={handleShare}
          >
            <Share2 className="w-6 h-6 text-white" />
          </button>
        </div>

        {/* Hero Content */}
        <div className="absolute bottom-0 left-0 right-0 p-8 md:p-16">
          <div className="container mx-auto">
            <h1 className="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
              {title}
            </h1>
            <div className="flex flex-wrap gap-4 text-white/90">
              <div className="flex items-center space-x-2 bg-white/10 backdrop-blur-md rounded-full px-5 py-2.5">
                <Calendar className="w-5 h-5" />
                <span className="text-sm md:text-base">
                  {new Date(activity_date).toLocaleDateString("en-US", {
                    day: "numeric",
                    month: "long",
                    year: "numeric",
                  })}
                </span>
              </div>
              <div className="flex items-center space-x-2 bg-white/10 backdrop-blur-md rounded-full px-5 py-2.5">
                <MapPin className="w-5 h-5" />
                <span className="text-sm md:text-base">{location}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Main Content */}
      <div className="container mx-auto px-4 py-16">
        {/* Description Card */}
        <div className="bg-white rounded-2xl shadow-sm p-8 mb-12">
          <h2 className="text-2xl font-bold mb-6">وصف النشاط</h2>
          <p className="text-gray-700 leading-relaxed whitespace-pre-line">
            {description}
          </p>
        </div>

        {/* Gallery Section */}
        <div className="bg-white rounded-2xl shadow-sm p-8">
          <h2 className="text-2xl font-bold mb-6">معرض الصور</h2>
          <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            {images.map((image, index) => (
              <div
                key={index}
                className="relative aspect-square rounded-xl overflow-hidden cursor-pointer group"
                onClick={() => {
                  setSelectedImage(image);
                  setCurrentImageIndex(index);
                }}
              >
                <Image
                  src={image}
                  alt={`Gallery image ${index + 1}`}
                  layout="fill"
                  objectFit="cover"
                  className="transition duration-300 group-hover:scale-110"
                />
                <div className="absolute inset-0 bg-black/25 opacity-0 group-hover:opacity-100 transition-opacity" />
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* Image Modal */}
      {selectedImage && (
        <div className="fixed inset-0 bg-black/95 z-50 flex items-center justify-center">
          <button
            className="absolute top-4 right-4 text-white p-2 hover:bg-white/10 rounded-full transition-colors"
            onClick={() => setSelectedImage(null)}
          >
            <X className="w-8 h-8" />
          </button>

          <button
            className="absolute left-4 top-1/2 -translate-y-1/2 text-white p-2 hover:bg-white/10 rounded-full transition-colors"
            onClick={() => navigateImage("prev")}
          >
            <ChevronLeft className="w-8 h-8" />
          </button>

          <div className="relative w-full max-w-5xl aspect-[16/9]">
            <Image
              src={selectedImage}
              alt="Selected image"
              layout="fill"
              objectFit="contain"
              className="rounded-lg"
            />
          </div>

          <button
            className="absolute right-4 top-1/2 -translate-y-1/2 text-white p-2 hover:bg-white/10 rounded-full transition-colors"
            onClick={() => navigateImage("next")}
          >
            <ChevronRight className="w-8 h-8" />
          </button>

          <div className="absolute bottom-4 left-1/2 -translate-x-1/2 text-white">
            {currentImageIndex + 1} / {images.length}
          </div>
        </div>
      )}
    </div>
  );
};

export default ActivityShow;
