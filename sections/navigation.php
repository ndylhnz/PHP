<?php // Shared navigation section. ?>
<header class="site-header">
        <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Main navigation">
            <div class="container">
                <a class="navbar-brand" href="#home" aria-label="Wuthering Waves home">
                    <span class="brand-mark" aria-hidden="true">W</span>
                    <span class="brand-name">WUTHERING WAVES</span>
                </a>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNavigation"
                    aria-controls="mainNavigation"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavigation">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="logoutLink" href="logout.php">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light nav-button" href="#about">Discover</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
