<div id="sidebar" class="sidebar" style="width: 250px; background-color: #000; height: 100vh; padding-top: 20px; transition: margin-left 0.3s ease; color: white;">

    <div class="d-flex align-items-center justify-content-center mb-4">
        {{-- Logo --}}
        <span class="fw-bold fs-4 text-white">Your Logo</span>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active text-white" href="#">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-list-task me-2"></i>
                Category
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-pencil-square me-2"></i>
                Posts
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-graph-up me-2"></i>
                Analytics
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-bar-chart me-2"></i>
                Chart
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-plugin me-2"></i>
                Plugins
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-compass me-2"></i>
                Explore
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-clock-history me-2"></i>
                History
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-gear me-2"></i>
                Setting
            </a>
        </li>
    </ul>
</div>

<style>
    .sidebar {
        margin-left: 0;
    }

    .sidebar.collapsed {
        margin-left: -250px; /* Hide the sidebar */
    }
</style>