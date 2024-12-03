// src/providers/index.jsx
'use client';

import { AuthProvider } from '@/context/AuthContext';

/**
 * Providers component wraps the app with all necessary context providers.
 *
 * @param {React.ReactNode} children - The component tree to be wrapped.
 */
export function Providers({ children }) {
	return <AuthProvider>{children}</AuthProvider>;
}
