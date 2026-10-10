<?php // Main landing-page content. ?>
<main>
        <!-- HERO / HOME -->
        <section id="home" class="hero-section">
            <div class="hero-overlay" aria-hidden="true"></div>

            <div class="container hero-container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7 hero-copy">
                        <p id="welcomeMessage" class="welcome-message" role="status" aria-live="polite"><?php
    if (isset($_SESSION["username"])) {
        echo "Welcome, " . htmlspecialchars($_SESSION["username"], ENT_QUOTES, "UTF-8") . "!";
    } else {
        echo "Welcome to Wuthering Waves!";
    }
?></p>
                        <p class="eyebrow">A JOURNEY ACROSS SOLARIS-3</p>

                        <h1>Wuthering Waves</h1>

                        <p class="hero-description">
                            is a story-rich, open-world action RPG set on the post-apocalyptic
                            planet Solaris-3, where a catastrophic event known as the Lament has
                            fractured reality and unleashed monstrous, sound-based entities upon humanity.
                            Players step into the shoes of Rover, a legendary amnesiac who awakens to a
                            strange new world and possesses the unique ability to absorb and manipulate
                            the frequencies of defeated enemies. Together with powerful companions called
                            Resonators, players explore a vast sci-fi landscape, utilizing fluid wall-running
                            parkour and engaging in lightning-fast, high-skill combat where capturing and
                            transforming into monster "Echoes" is the key to reclaiming the future.
                        </p>

                        <div class="hero-actions">
                            <a href="#about" class="btn btn-light btn-lg px-4">Explore the world</a>
                            <a href="#features" class="hero-link">View features <span aria-hidden="true">↓</span></a>
                        </div>
                    </div>

                    <!-- Responsive element:
                         Desktop/tablet: character artwork sits beside the text.
                         Mobile: artwork moves below the text. -->
                    <div class="col-lg-5 hero-character-column">
                        <img
                            src="assets2/aemeath.png"
                            class="hero-character"
                            alt="Aemeath character artwork from Wuthering Waves"
                        >
                    </div>
                </div>
            </div>

            <a class="scroll-indicator" href="#about" aria-label="Scroll to About section">
                <span>SCROLL</span>
                <span aria-hidden="true">↓</span>
            </a>
        </section>

        <!-- ABOUT -->
        <section id="about" class="about-section">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <p class="eyebrow dark-eyebrow">THE WORLD OF WUTHERING WAVES</p>
                        <h2>A fractured world waiting to be explored.</h2>
                    </div>

                    <div class="col-lg-6">
                        <div class="about-panel">
                            <p>
                                Awaken as Rover and travel through Solaris-3, a world reshaped by
                                the Lament. Meet Resonators, uncover lost memories, and discover
                                the stories hidden throughout a vast open-world landscape.
                            </p>
                            <a href="#features" class="btn btn-outline-light">Discover more</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FEATURES -->
        <section id="features" class="features-section">
            <div class="container">
                <div class="text-center section-heading">
                    <p class="eyebrow dark-eyebrow">WHAT AWAITS YOU</p>
                    <h2>Explore. Fight. Echo.</h2>
                    <p>
                        Three elements that define the adventure across Solaris-3.
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <article class="feature-card h-100">
                            <span class="feature-number">01</span>
                            <h3>Open-World Exploration</h3>
                            <p>
                                Traverse a vast sci-fi landscape with fluid movement,
                                wall-running parkour and freedom to explore Solaris-3.
                            </p>
                        </article>
                    </div>

                    <div class="col-md-4">
                        <article class="feature-card h-100">
                            <span class="feature-number">02</span>
                            <h3>Fast-Paced Combat</h3>
                            <p>
                                Engage enemies through quick, high-skill combat built around
                                movement, timing and powerful Resonator abilities.
                            </p>
                        </article>
                    </div>

                    <div class="col-md-4">
                        <article class="feature-card h-100">
                            <span class="feature-number">03</span>
                            <h3>Echoes</h3>
                            <p>
                                Absorb defeated enemies and transform into their Echoes,
                                turning their frequencies into new powers for battle.
                            </p>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </main>
