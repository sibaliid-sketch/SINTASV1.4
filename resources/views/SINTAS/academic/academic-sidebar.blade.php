@php
    $routeName = request()->route()->getName();
    $dept = null;
    if (str_starts_with($routeName, 'departments.')) {
        $parts = explode('.', $routeName);
        if (count($parts) >= 2) {
            $dept = $parts[1];
            if ($dept === 'overview') {
                $dept = $parts[2] ?? null;
            }
        }
    }
@endphp

@if($dept)
<!-- Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden" onclick="closeSidebar()"></div>

<!-- Sidebar -->
<div id="department-sidebar" class="fixed top-0 left-0 h-full bg-gradient-to-br from-slate-950 via-gray-900 to-slate-900 backdrop-blur-xl bg-opacity-95 border-r border-slate-700/50 shadow-2xl z-50 transition-all duration-500 ease-out"
     style="width: 80px;" onmouseover="expandSidebar()" onmouseout="collapseSidebar()">
    <!-- Collapsed State -->
    <div id="sidebar-collapsed" class="flex flex-col items-center py-8 space-y-6">
        <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 via-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg shadow-cyan-500/25">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </div>
        <div class="text-xs text-slate-400 font-medium transform -rotate-90 whitespace-nowrap tracking-wider">MENU</div>
    </div>

    <!-- Expanded State -->
    <div id="sidebar-expanded" class="hidden w-80">
        <!-- Header -->
        <div class="flex items-center justify-start p-8 border-b border-slate-700/50">
            <div>
                <h2 class="text-xl font-bold bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-600 bg-clip-text text-transparent">Department Menu</h2>
                <p class="text-sm text-slate-400 mt-1">{{ ucfirst($dept) }} Department</p>
            </div>
        </div>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-6">
            <!-- General Section -->
            <div class="mb-8">
                <a href="{{ route('departments.' . $dept . '.general') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-full mr-3"></div>
                    General
                </a>
                <div class="space-y-3">
                    <a href="{{ route('departments.' . $dept) }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50">
                        <div class="w-10 h-10 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Dashboard</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Main overview</div>
                        </div>
                    </a>
                    <a href="{{ route('departments.overview.' . $dept) }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium">Overview</div>
                            <div class="text-xs text-slate-500 group-hover:text-slate-400">Detailed metrics</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Tools Section -->
            @if(in_array($dept, ['operations', 'it', 'academic']))
            <div>
                <a href="{{ route('departments.' . $dept . '.tools') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-purple-400 to-pink-500 rounded-full mr-3"></div>
                    @if($dept === 'academic')
                        Services
                    @else
                        Tools
                    @endif
                </a>
                <div class="space-y-3">
                    @if($dept === 'academic')
                        <!-- Services Management -->
                        <a href="{{ route('departments.academic.services') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500/20 to-indigo-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">Services</div>
                                <div class="text-xs text-slate-500 group-hover:text-slate-400">Manage services</div>
                            </div>
                        </a>

                        <!-- Programs Management -->
                        <a href="{{ route('departments.academic.programs') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">Programs</div>
                                <div class="text-xs text-slate-500 group-hover:text-slate-400">Manage programs</div>
                            </div>
                        </a>

                        <!-- Schedules Management -->
                        <a href="{{ route('departments.academic.schedules') }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">Schedules</div>
                                <div class="text-xs text-slate-500 group-hover:text-slate-400">Manage schedules</div>
                            </div>
                        </a>
                    @else
                        <a href="{{ route('admin.chat', $dept) }}" class="group flex items-center px-4 py-4 text-slate-300 hover:text-white rounded-xl hover:bg-gradient-to-r hover:from-slate-800/50 hover:to-slate-700/50 transition-all duration-300 border border-transparent hover:border-slate-600/50">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">Console Chat</div>
                                <div class="text-xs text-slate-500 group-hover:text-slate-400">Admin communication</div>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
function expandSidebar() {
    const sidebar = document.getElementById('department-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const collapsed = document.getElementById('sidebar-collapsed');
    const expanded = document.getElementById('sidebar-expanded');

    sidebar.style.width = '320px';
    collapsed.classList.add('hidden');
    expanded.classList.remove('hidden');
    overlay.classList.remove('hidden');
}

function collapseSidebar() {
    const sidebar = document.getElementById('department-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const collapsed = document.getElementById('sidebar-collapsed');
    const expanded = document.getElementById('sidebar-expanded');

    sidebar.style.width = '80px';
    expanded.classList.add('hidden');
    collapsed.classList.remove('hidden');
    overlay.classList.add('hidden');
}

function closeSidebar() {
    collapseSidebar();
}

// Initialize collapsed state
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('department-sidebar');
    sidebar.style.width = '80px';
});
</script>
@endif
