@extends('layouts.main')

@section('content')

<!-- Page Header -->
<div class="mb-12 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 tracking-tight">Get in Touch</h1>
    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Have a question, feedback, or just want to say hi? We'd love to hear from you. Fill out the form below and we'll get back to you as soon as possible.
    </p>
</div>

<div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Contact Information Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Info Card 1 -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-start gap-4">
            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-gray-900 mb-1">Email Us</h3>
                <p class="text-sm text-gray-500 mb-2">Our friendly team is here to help.</p>
                <a href="mailto:hello@example.com" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">hello@example.com</a>
            </div>
        </div>

        <!-- Info Card 2 -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-start gap-4">
            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-gray-900 mb-1">Visit Us</h3>
                <p class="text-sm text-gray-500 mb-2">Come say hello at our office.</p>
                <span class="text-sm font-medium text-gray-900">100 Smith Street<br>Melbourne, VIC 3000</span>
            </div>
        </div>

        <!-- Info Card 3 -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-start gap-4">
            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-gray-900 mb-1">Call Us</h3>
                <p class="text-sm text-gray-500 mb-2">Mon-Fri from 8am to 5pm.</p>
                <a href="tel:+15550000000" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">+1 (555) 000-0000</a>
            </div>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="lg:col-span-2">
        <div class="bg-white p-8 md:p-10 rounded-xl shadow-sm border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Send us a message</h2>
            
            <form action="#" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First name</label>
                        <input type="text" name="first_name" id="first_name" placeholder="John"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                    </div>
                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last name</label>
                        <input type="text" name="last_name" id="last_name" placeholder="Doe"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email address</label>
                    <input type="email" name="email" id="email" placeholder="john@example.com"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>

                <!-- Subject -->
                <div class="mb-6">
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                    <input type="text" name="subject" id="subject" placeholder="How can we help?"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>

                <!-- Message -->
                <div class="mb-8">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea name="message" id="message" rows="5" placeholder="Leave us a message..."
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all resize-none"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Send Message
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
    
</div>

@endsection