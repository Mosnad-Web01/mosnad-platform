// src/context/AuthContext.jsx
"use client";

import { createContext, useState, useEffect } from "react";

export const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);
    const [token, setToken] = useState(null);
	const [loading, setLoading] = useState(true);

	useEffect(() => {
		const savedUser = localStorage.getItem("user");
		const savedToken = localStorage.getItem("token");
	
		if (savedUser && savedToken) {
		  setUser(JSON.parse(savedUser));
		  setToken(savedToken);
		}
	
		setLoading(false); // Finished loading
	  }, []);

	useEffect(() => {
		if (user && token) {
		  localStorage.setItem("user", JSON.stringify(user));
		  localStorage.setItem("token", token);
		} else {
		  localStorage.removeItem("user");
		  localStorage.removeItem("token");
		}
	  }, [user, token]);

    return (
        <AuthContext.Provider value={{ user, setUser, token, setToken }}>
            {children}
        </AuthContext.Provider>
    );
};
