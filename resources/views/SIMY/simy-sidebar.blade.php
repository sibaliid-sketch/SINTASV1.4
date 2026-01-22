@php
    $routeName = request()->route()->getName();
@endphp

<!-- Mobile Toggle Button -->
<button onclick="toggleSidebar()" class="fixed bottom-6 right-6 md:hidden bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-3 rounded-full shadow-lg hover:shadow-xl transition-all z-40" title="Toggle Sidebar">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<!-- Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden md:hidden" onclick="closeSidebar()"></div>

<!-- Sidebar -->
<div id="simy-sidebar" class="fixed top-0 left-0 h-full bg-gradient-to-br from-slate-950 via-gray-900 to-slate-900 backdrop-blur-xl bg-opacity-95 border-r border-slate-700/50 shadow-2xl z-50 transition-all duration-500 ease-out flex flex-col"
     style="position: fixed !important; top: 0 !important; left: 0 !important; width: 80px !important; height: 100vh !important; display: flex !important; flex-direction: column !important; z-index: 50 !important;" onmouseover="expandSidebar()" onmouseout="collapseSidebar()">
    <!-- Collapsed State -->
    <div id="sidebar-collapsed" class="flex flex-col items-center py-8 space-y-6">
        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 via-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/25">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>
        <div class="text-xs text-slate-400 font-medium transform -rotate-90 whitespace-nowrap tracking-wider">SIMY</div>
    </div>

    <!-- Expanded State -->
    <div id="sidebar-expanded" class="hidden w-80">
        <!-- Header -->
        <div class="flex items-center justify-start p-8 border-b border-slate-700/50">
            <div>
                <h2 class="text-xl font-bold bg-gradient-to-r from-blue-400 via-indigo-500 to-purple-600 bg-clip-text text-transparent">SIMY LMS</h2>
                <p class="text-sm text-slate-400 mt-1">Learning Management System</p>
            </div>
        </div>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-6">
            <!-- Beranda Section -->
            <div class="mb-8">
                <a href="{{ route('simy.beranda') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-blue-400 to-indigo-500 rounded-full mr-3"></div>
                    Beranda
                </a>
                <div class="space-y-3">
                    <a href="{{ route('simy.beranda') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500/20 to-indigo-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Beranda</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Social feed</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Learning Section -->
            <div class="mb-8">
                <a href="#" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-blue-400 to-indigo-500 rounded-full mr-3"></div>
                    Learning
                </a>
                <div class="space-y-3">
                    <a href="{{ route('simy.dashboard') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50 {{ str_contains($routeName, 'simy.dashboard') ? 'bg-gradient-to-r from-blue-500/20 to-indigo-500/20 border-blue-500/50' : '' }}">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500/20 to-indigo-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Dashboard</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Overview pembelajaran</div>
                        </div>
                    </a>

                    <a href="{{ route('simy.materials.index') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50 {{ str_contains($routeName, 'simy.materials') ? 'bg-gradient-to-r from-blue-500/20 to-indigo-500/20 border-blue-500/50' : '' }}">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500/20 to-teal-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Materi Pembelajaran</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Akses materi ajar</div>
                        </div>
                    </a>

                    <a href="{{ route('simy.assignments.index') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50 {{ str_contains($routeName, 'simy.assignments') ? 'bg-gradient-to-r from-blue-500/20 to-indigo-500/20 border-blue-500/50' : '' }}">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-500/20 to-orange-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Tugas & Pekerjaan</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Assignments & submissions</div>
                        </div>
                    </a>

                    <a href="{{ route('simy.quizzes.index') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50 {{ str_contains($routeName, 'simy.quizzes') ? 'bg-gradient-to-r from-blue-500/20 to-indigo-500/20 border-blue-500/50' : '' }}">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Kuis & Tes</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Practice tests</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Progress & Achievement Section -->
            <div class="mb-8">
                <a href="#" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-purple-400 to-pink-500 rounded-full mr-3"></div>
                    Progress
                </a>
                <div class="space-y-3">
                    <a href="{{ route('simy.progress.index') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50 {{ str_contains($routeName, 'simy.progress') ? 'bg-gradient-to-r from-blue-500/20 to-indigo-500/20 border-blue-500/50' : '' }}">
                        <div class="w-10 h-10 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Detail Progress</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Learning analytics</div>
                        </div>
                    </a>

                    <a href="{{ route('simy.certificates.index') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50 {{ str_contains($routeName, 'simy.certificates') ? 'bg-gradient-to-r from-blue-500/20 to-indigo-500/20 border-blue-500/50' : '' }}">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500/20 to-teal-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Sertifikat</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Completion certificates</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Community Section -->
            <div>
                <a href="#" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-emerald-400 to-teal-500 rounded-full mr-3"></div>
                    Community
                </a>
                <div class="space-y-3">
                    <a href="{{ route('simy.forum.index') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50 {{ str_contains($routeName, 'simy.forum') ? 'bg-gradient-to-r from-blue-500/20 to-indigo-500/20 border-blue-500/50' : '' }}">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Forum Diskusi</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Student community</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Ticket Section -->
            <div class="mb-8">
                <a href="{{ route('simy.ticket') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-purple-400 to-pink-500 rounded-full mr-3"></div>
                    Ticket
                </a>
            </div>

            <!-- Message Section -->
            <div class="mb-8">
                <a href="{{ route('simy.message') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-full mr-3"></div>
                    Message
                </a>
            </div>

            <!-- Notification Section -->
            <div class="mb-8">
                <a href="{{ route('simy.notification') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-emerald-400 to-teal-500 rounded-full mr-3"></div>
                    Notification
                </a>
            </div>

            <!-- Setting Section -->
            <div class="mb-8">
                <a href="{{ route('simy.setting') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-orange-400 to-red-500 rounded-full mr-3"></div>
                    Setting
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function expandSidebar() {
    const sidebar = document.getElementById('simy-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const collapsed = document.getElementById('sidebar-collapsed');
    const expanded = document.getElementById('sidebar-expanded');

    if (window.innerWidth >= 768) { // Only on desktop
        sidebar.style.width = '320px';
        collapsed.classList.add('hidden');
        expanded.classList.remove('hidden');
        overlay.classList.remove('hidden');
    }
}

function collapseSidebar() {
    const sidebar = document.getElementById('simy-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const collapsed = document.getElementById('sidebar-collapsed');
    const expanded = document.getElementById('sidebar-expanded');

    if (window.innerWidth >= 768) { // Only on desktop
        sidebar.style.width = '80px';
        expanded.classList.add('hidden');
        collapsed.classList.remove('hidden');
        overlay.classList.add('hidden');
    }
}

function toggleSidebar() {
    const sidebar = document.getElementById('simy-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const collapsed = document.getElementById('sidebar-collapsed');
    const expanded = document.getElementById('sidebar-expanded');
    
    const isExpanded = sidebar.style.width === '320px';
    
    if (isExpanded) {
        closeSidebar();
    } else {
        sidebar.style.width = '320px';
        collapsed.classList.add('hidden');
        expanded.classList.remove('hidden');
        overlay.classList.remove('hidden');
    }
}

function closeSidebar() {
    const sidebar = document.getElementById('simy-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const collapsed = document.getElementById('sidebar-collapsed');
    const expanded = document.getElementById('sidebar-expanded');
    
    sidebar.style.width = '80px';
    expanded.classList.add('hidden');
    collapsed.classList.remove('hidden');
    overlay.classList.add('hidden');
}

// Initialize collapsed state
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('simy-sidebar');
    sidebar.style.width = '80px';
    
    // Handle responsive behavior
    function handleResize() {
        if (window.innerWidth < 768) {
            // Mobile: keep sidebar hidden by default
            closeSidebar();
        }
    }
    
    window.addEventListener('resize', handleResize);
    handleResize(); // Call on load
});
</script>


