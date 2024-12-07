import { NextResponse } from 'next/server';

export function middleware(request) {
	const token = request.cookies.get('token')?.value;
	const role = request.cookies.get('role')?.value;
	const status = request.cookies.get('status')?.value;	

	console.log(role);

	// Handle unauthenticated users
	if (!token) {
		// Allow access to login and register routes
		if (
			request.nextUrl.pathname === '/login' ||
			request.nextUrl.pathname === '/register'
		) {
			return NextResponse.next();
		}
		// Redirect unauthenticated users to login for all other routes
		return NextResponse.redirect(new URL('/login', request.url));
	}

	    // Role-based access control for `/company` routes
		if (role === 'company') {
			const companyPath = request.nextUrl.pathname;
	
			// Suspended users: Only allow access to `/company/companyForm`
			if (status === 'suspended' && companyPath !== '/company/companyForm') {
				return NextResponse.redirect(new URL('/company/companyForm', request.url));
			}
	
			// Active users: Deny access to `/company/Companiesform`
			if (status === 'active' && companyPath === '/company/companyForm') {
				return NextResponse.redirect(new URL('/company', request.url)); // Or another default company route
			}
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
	matcher: ['/login', '/student', '/company', '/register' , '/company/:path*'],
};
