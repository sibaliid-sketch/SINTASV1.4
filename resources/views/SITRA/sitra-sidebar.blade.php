@php
    $routeName = request()->route()->getName();
@endphp

<!-- Mobile Toggle Button -->
<button onclick="toggleSidebar()" class="fixed bottom-6 right-6 md:hidden bg-gradient-to-r from-green-600 to-cyan-600 text-white p-3 rounded-full shadow-lg hover:shadow-xl transition-all z-40" title="Toggle Sidebar">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<!-- Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden md:hidden" onclick="closeSidebar()"></div>

<!-- Sidebar -->
<div id="sitra-sidebar" class="fixed top-0 left-0 h-full bg-gradient-to-br from-slate-950 via-gray-900 to-slate-900 backdrop-blur-xl bg-opacity-95 border-r border-slate-700/50 shadow-2xl z-50 transition-all duration-500 ease-out flex flex-col"
     style="position: fixed !important; top: 0 !important; left: 0 !important; width: 80px !important; height: 100vh !important; display: flex !important; flex-direction: column !important; z-index: 50 !important;" onmouseover="expandSidebar()" onmouseout="collapseSidebar()">
    <!-- Collapsed State -->
    <div id="sidebar-collapsed" class="flex flex-col items-center py-8 space-y-6">
        <div class="w-10 h-10 bg-gradient-to-br from-green-400 via-teal-500 to-cyan-600 rounded-2xl flex items-center justify-center shadow-lg shadow-green-500/25">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
        </div>
        <div class="text-xs text-slate-400 font-medium transform -rotate-90 whitespace-nowrap tracking-wider">SITRA</div>
    </div>

    <!-- Expanded State -->
    <div id="sidebar-expanded" class="hidden w-80">
        <!-- Header -->
        <div class="flex items-center justify-start p-8 border-b border-slate-700/50">
            <div>
                <h2 class="text-xl font-bold bg-gradient-to-r from-green-400 via-teal-500 to-cyan-600 bg-clip-text text-transparent">SITRA Portal</h2>
                <p class="text-sm text-slate-400 mt-1">Parent Monitoring System</p>
            </div>
        </div>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-6">
            <!-- Beranda Section -->
            <div class="mb-8">
                <a href="{{ route('sitra.beranda') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-green-400 to-teal-500 rounded-full mr-3"></div>
                    Beranda
                </a>
                <div class="space-y-3">
                    <a href="{{ route('sitra.beranda') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500/20 to-teal-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

            <!-- Main Navigation -->
            <div class="mb-8">
                <a href="#" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-green-400 to-teal-500 rounded-full mr-3"></div>
                    Navigation
                </a>
                <div class="space-y-3">
                    <a href="{{ route('sitra.dashboard') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50 {{ $routeName === 'sitra.dashboard' ? 'bg-gradient-to-r from-green-500/20 to-teal-500/20 border-green-500/50' : '' }}">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500/20 to-teal-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Dashboard</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Overview anak</div>
                        </div>
                    </a>

                    @if(isset($childrenData) && count($childrenData) > 0)
                        @foreach($childrenData as $childData)
                            <a href="{{ route('sitra.child.academic', $childData['user']->id) }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500/20 to-indigo-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium">{{ $childData['user']->name }}</div>
                                    <div class="text-xs text-slate-500 group-hover:text-slate-400">Academic monitoring</div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Features Section -->
            <div>
                <a href="#" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-purple-400 to-pink-500 rounded-full mr-3"></div>
                    Features
                </a>
                <div class="space-y-3">
                    <a href="{{ route('sitra.child.reports', $childrenData[0]['user']->id ?? null) }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Laporan Akademik</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Progress reports</div>
                        </div>
                    </a>

                    <a href="{{ route('sitra.child.messages', $childrenData[0]['user']->id ?? null) }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50">
                        <div class="w-10 h-10 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Pesan & Komunikasi</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Chat dengan guru</div>
                        </div>
                    </a>

                    <a href="{{ route('sitra.settings') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50 {{ $routeName === 'sitra.settings' ? 'bg-gradient-to-r from-green-500/20 to-teal-500/20 border-green-500/50' : '' }}">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500/20 to-teal-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Pengaturan</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Preferensi akun</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Ticket Section -->
            <div class="mb-8">
                <a href="{{ route('sitra.ticket') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-purple-400 to-pink-500 rounded-full mr-3"></div>
                    Ticket
                </a>
            </div>

            <!-- Message Section -->
            <div class="mb-8">
                <a href="{{ route('sitra.message') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-full mr-3"></div>
                    Message
                </a>
            </div>

            <!-- Notification Section -->
            <div class="mb-8">
                <a href="{{ route('sitra.notification') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-emerald-400 to-teal-500 rounded-full mr-3"></div>
                    Notification
                </a>
            </div>

            <!-- Setting Section -->
            <div class="mb-8">
                <a href="{{ route('sitra.setting') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-orange-400 to-red-500 rounded-full mr-3"></div>
                    Setting
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function expandSidebar() {
    if (window.innerWidth < 768) return; // Desktop only
    const sidebar = document.getElementById('sitra-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const collapsed = document.getElementById('sidebar-collapsed');
    const expanded = document.getElementById('sidebar-expanded');

    sidebar.style.width = '320px';
    collapsed.classList.add('hidden');
    expanded.classList.remove('hidden');
    overlay.classList.remove('hidden');
}

function collapseSidebar() {
    if (window.innerWidth < 768) return; // Desktop only
    const sidebar = document.getElementById('sitra-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const collapsed = document.getElementById('sidebar-collapsed');
    const expanded = document.getElementById('sidebar-expanded');

    sidebar.style.width = '80px';
    expanded.classList.add('hidden');
    collapsed.classList.remove('hidden');
    overlay.classList.add('hidden');
}

function toggleSidebar() {
    const sidebar = document.getElementById('sitra-sidebar');
    const isExpanded = sidebar.style.width === '320px';
    if (isExpanded) {
        closeSidebar();
    } else {
        const overlay = document.getElementById('sidebar-overlay');
        const collapsed = document.getElementById('sidebar-collapsed');
        const expanded = document.getElementById('sidebar-expanded');
        
        sidebar.style.width = '320px';
        collapsed.classList.add('hidden');
        expanded.classList.remove('hidden');
        overlay.classList.remove('hidden');
    }
}

function closeSidebar() {
    const sidebar = document.getElementById('sitra-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const collapsed = document.getElementById('sidebar-collapsed');
    const expanded = document.getElementById('sidebar-expanded');
    
    sidebar.style.width = '80px';
    expanded.classList.add('hidden');
    collapsed.classList.remove('hidden');
    overlay.classList.add('hidden');
}

function handleResize() {
    if (window.innerWidth < 768) {
        closeSidebar();
    }
}

// Initialize expanded state
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sitra-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const collapsed = document.getElementById('sidebar-collapsed');
    const expanded = document.getElementById('sidebar-expanded');
    
    // Add resize event listener
    window.addEventListener('resize', handleResize);

    sidebar.style.width = '320px';
    collapsed.classList.add('hidden');
    expanded.classList.remove('hidden');
    overlay.classList.remove('hidden');
});
</script>


