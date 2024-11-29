import { useState } from 'react';

/**
 * Custom hook for managing form state and validation.
 *
 * @param {Object} initialValues - The initial state of the form.
 * @returns {Object} - Form state, validation errors, and handlers.
 */
export const useForm = (initialValues = {}) => {
	const [values, setValues] = useState(initialValues);
	const [errors, setErrors] = useState({});

	// Handle input change
	const handleChange = (e) => {
		const { name, value } = e.target;

		setValues((prevValues) => ({
			...prevValues,
			[name]: value,
		}));

		// Clear the error for the field when updated
		setErrors((prevErrors) => ({
			...prevErrors,
			[name]: '', // Reset specific field error
		}));
	};

	// Set errors directly from an external source (e.g., API)
	const setServerErrors = (serverErrors) => {
		setErrors(serverErrors);
	};

	// Reset the form
	const resetForm = () => {
		setValues(initialValues);
		setErrors({});
	};

	return {
		values,
		errors,
		handleChange,
		setServerErrors,
		resetForm,
	};
};
