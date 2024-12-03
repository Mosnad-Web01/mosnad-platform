// src/hooks/auth/useAuth
import { useContext } from "react";
import { AuthContext } from "@/context/AuthContext";

/**
 * Custom hook to access the authentication context.
 * Provides access to user, token, and their respective setters.
 *
 * @returns {{ user: any, token: string, setUser: Function, setToken: Function }}
 */
export const useAuth = () => useContext(AuthContext);



