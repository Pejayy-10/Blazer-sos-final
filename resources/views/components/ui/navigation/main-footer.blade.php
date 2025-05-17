<footer class="app-footer">
    <div class="container mx-auto px-4 md:px-8">
        <div class="footer-columns">
            <div class="footer-column">
                <h4 class="footer-column-title">Blazer SOS</h4>
                <p class="text-sm text-white/70 mb-4">A digital yearbook platform for preserving your college memories forever.</p>
            </div>
            
            <div class="footer-column">
                <h4 class="footer-column-title">Quick Links</h4>
                <div class="footer-column-links">
                    <a href="#features" class="footer-link">Features</a>
                    <a href="#yearbooks" class="footer-link">Yearbooks</a>
                    <a href="{{ route('about') }}" class="footer-link">About</a>
                    <a href="#testimonials" class="footer-link">Testimonials</a>
                </div>
            </div>
            
            <div class="footer-column">
                <h4 class="footer-column-title">Account</h4>
                <div class="footer-column-links">
                    <a href="{{ route('login') }}" class="footer-link">Login</a>
                    <a href="{{ route('register') }}" class="footer-link">Register</a>
                    <a href="{{ route('password.request') }}" class="footer-link">Reset Password</a>
                </div>
            </div>
            
            <div class="footer-column">
                <h4 class="footer-column-title">Contact</h4>
                <ul class="space-y-2 text-white/70 text-sm">
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        support@blazersos.com
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +1 (123) 456-7890
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        University Campus, City
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p class="text-white/70 text-sm">© {{ date('Y') }} Blazer SOS. All rights reserved.</p>
            
            <div class="footer-social">
                <a href="#" class="footer-social-link" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                </a>
                
                <a href="#" class="footer-social-link" aria-label="Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                </a>
                
                <a href="#" class="footer-social-link" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                </a>
            </div>
        </div>
    </div>
</footer> 