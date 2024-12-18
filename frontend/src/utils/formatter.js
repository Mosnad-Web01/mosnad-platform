
export const formatEnglishDate = (dateString) => {
    const options = {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
    };
  
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', options); 
  };
  
 export const formatArabicDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('ar-SA', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};