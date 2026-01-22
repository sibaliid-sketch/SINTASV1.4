@php
    $routeName = request()->route()?->getName() ?? null;
    $dept = null;
    if ($routeName && str_starts_with($routeName, 'departments.')) {
        $parts = explode('.', $routeName);
        if (count($parts) >= 2) {
            $dept = $parts[1];
            if ($dept === 'overview') {
                $dept = $parts[2] ?? null;
            }
        }
    }
    
    // Force department name for direct access
    if (!$dept && str_contains(request()->path(), 'departments/academic')) {
        $dept = 'academic';
    }
    
    // Final fallback - always set to academic for this sidebar file
    if (!$dept) {
        $dept = 'academic';
    }
@endphp

@if($dept)

<!-- Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden md:hidden" onclick="closeSidebar()"></div>

<!-- Sidebar -->
<div id="department-sidebar" class="fixed top-0 left-0 h-full bg-gradient-to-br from-slate-950 via-gray-900 to-slate-900 backdrop-blur-xl bg-opacity-95 border-r border-slate-700/50 shadow-2xl z-50 transition-all duration-500 ease-out flex flex-col"
     style="position: fixed !important; top: 0 !important; left: 0 !important; width: 80px !important; height: 100vh !important; display: flex !important; flex-direction: column !important; z-index: 50 !important;" onmouseover="expandSidebar()" onmouseout="collapseSidebar()">
    <!-- Collapsed State -->
    <div id="sidebar-collapsed" class="flex flex-col items-center py-8 space-y-6">
        <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 via-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg shadow-cyan-500/25">
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
            <!-- Beranda -->
            <div class="mb-8">
                <a href="{{ route('departments.' . $dept . '.beranda') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-full mr-3"></div>
                    Beranda
                </a>
            </div>

            <!-- General -->
            <div class="mb-8">
                <a href="{{ route('departments.' . $dept . '.general') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-full mr-3"></div>
                    General
                </a>
            </div>

            <!-- HRIS -->
            <div class="mb-8">
                <a href="{{ route('departments.' . $dept . '.hris') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-emerald-400 to-teal-500 rounded-full mr-3"></div>
                    HRIS
                </a>
            </div>

            <!-- Tools -->
            <div class="mb-8">
                <a href="{{ route('departments.' . $dept . '.tools') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-purple-400 to-pink-500 rounded-full mr-3"></div>
                    Tools
                </a>
            </div>

            <!-- Message -->
            <div class="mb-8">
                <a href="{{ route('departments.' . $dept . '.message') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-cyan-400 to-blue-500 rounded-full mr-3"></div>
                    Message
                </a>
            </div>

            <!-- Notification -->
            <div class="mb-8">
                <a href="{{ route('departments.' . $dept . '.notification') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-emerald-400 to-teal-500 rounded-full mr-3"></div>
                    Notification
                </a>
            </div>

            <!-- Ticket -->
            <div class="mb-8">
                <a href="{{ route('departments.' . $dept . '.ticket') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-purple-400 to-pink-500 rounded-full mr-3"></div>
                    Ticket
                </a>
            </div>

            <!-- Help -->
            <div class="mb-8">
                <a href="{{ route('departments.' . $dept . '.setting') }}" class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 flex items-center hover:text-white transition-colors">
                    <div class="w-1 h-4 bg-gradient-to-b from-orange-400 to-red-500 rounded-full mr-3"></div>
                    Help
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function expandSidebar() {
    if (window.innerWidth < 768) return; // Desktop only
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
    if (window.innerWidth < 768) return; // Desktop only
    const sidebar = document.getElementById('department-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const collapsed = document.getElementById('sidebar-collapsed');
    const expanded = document.getElementById('sidebar-expanded');

    sidebar.style.width = '80px';
    expanded.classList.add('hidden');
    collapsed.classList.remove('hidden');
    overlay.classList.add('hidden');
}

function toggleSidebar() {
    const sidebar = document.getElementById('department-sidebar');
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
    const sidebar = document.getElementById('department-sidebar');
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

// Initialize collapsed state
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('department-sidebar');
    sidebar.style.width = '80px';

    // Add resize event listener
    window.addEventListener('resize', handleResize);
});
</script>
@endif





