// src/middleware.js
import { NextResponse } from 'next/server';
import Cookies from 'js-cookie';

export function middleware(request) {
	const token = request.cookies.get('token')?.value;
	const role = request.cookies.get('role')?.value;

	console.log(role);

	if (!token) {
		if (request.nextUrl.pathname !== '/login') {
			return NextResponse.redirect(new URL('/login', request.url));
		}
		return NextResponse.next();
	}

	// Role-based access control
	const rolePaths = {
		company: '/company',
		student: '/student',
	};

	// Prevent logged-in users from accessing login
	if (request.nextUrl.pathname === '/login') {
		return NextResponse.redirect(
			new URL(rolePaths[role] || '/', request.url),
		);
	}

	// Prevent logged-in users from accessing register
	if (request.nextUrl.pathname === '/register') {
		return NextResponse.redirect(
			new URL(rolePaths[role] || '/', request.url),
		);
	}

	// Prevent unauthorized access to specific role-based routes
	if (request.nextUrl.pathname.startsWith('/student') && role !== 'student') {
		return NextResponse.redirect(new URL('/404', request.url));
	}

	if (request.nextUrl.pathname.startsWith('/company') && role !== 'company') {
		return NextResponse.redirect(new URL('/404', request.url));
	}

	return NextResponse.next();
}
export const config = {
	matcher: ['/login', '/student', '/company', '/register'],
};
