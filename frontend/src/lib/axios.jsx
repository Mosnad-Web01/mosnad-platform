// src/lib/axios.js
import axios from "axios";
import Cookies from "js-cookie";

const instance = axios.create({
  baseURL: "http://localhost:8000/api", // Adjust baseURL for your environment
  headers: {
    "Content-Type": "application/json",
  },
});

// Add request interceptor
instance.interceptors.request.use(
  (config) => {
    const token = Cookies.get("token");
    if (token) {
      config.headers["Authorization"] = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

// Add response interceptor
instance.interceptors.response.use(
  (response) => response,
  async (error) => {
    if (error.response?.status === 401) {
      // Handle unauthorized access
      Cookies.remove("token");
      window.location.href = "/login";
    }
    return Promise.reject(error);
  }
);

/**
 * Utility method for GET requests
 * @param {string} url - The endpoint URL
 * @param {object} params - Query parameters (optional)
 * @returns {Promise}
 */
export const get = async (url, params = {}) => {
  try {
    const response = await instance.get(url, { params });
    return response.data;
  } catch (error) {
    handleError(error);
  }
};
export const getSearch = async (url, params = {}) => {
  try {
    const response = await instance.get(url, { params });
    return response;  // Return the full response
  } catch (error) {
    console.error('API Error:', error.response?.data?.message || error.message);
    throw error.response?.data || error;
  }
};

/**
 * Utility method for POST requests
 * @param {string} url - The endpoint URL
 * @param {object|FormData} data - The request payload
 * @param {object} customHeaders - Custom headers (optional)
 * @returns {Promise}
 */
export const post = async (url, data, customHeaders = {}) => {
  try {
    const response = await instance.post(url, data, {
      headers: customHeaders,
    });
    return response.data;
  } catch (error) {
    handleError(error);
  }
};

/**
 * Utility method for PUT requests
 * @param {string} url - The endpoint URL
 * @param {object} data - The request payload
 * @param {object} customHeaders - Custom headers (optional)
 * @returns {Promise}
 */
export const put = async (url, data, customHeaders = {}) => {
  try {
    const response = await instance.put(url, data, {
      headers: customHeaders,
    });
    return response.data; // Return the response data on success
  } catch (error) {
    const message = error.response?.data?.message || "An unexpected error occurred";
    const errors = error.response?.data?.errors || {}; // Capture detailed validation errors if present

    // Re-throw the error in a structured format for further handling
    throw {
      message, // General error message
      errors,  // Detailed validation errors
      status: error.response?.status || 500, // Include status code for more context
    };
  }
};

/**
 * Utility method for DELETE requests
 * @param {string} url - The endpoint URL
 * @returns {Promise}
 */
export const del = async (url) => {
  try {
    const response = await instance.delete(url);
    return response.data;
  } catch (error) {
    handleError(error);
  }
};

/**
 * Centralized error handling
 * @param {object} error - The error object
 */
const handleError = (error) => {
  const message = error.response?.data?.message || "An unexpected error occurred";
  console.error("API Error:", message);
  throw new Error(message); // Re-throw the error to handle it in calling code
};

export default instance;
