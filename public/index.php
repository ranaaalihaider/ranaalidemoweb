<?php
/**
 * Ali Haider - Software Engineer Portfolio
 * COMSATS University Islamabad
 */

session_start();

// Generate simple CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Contact Form Handling (PHP)
$form_status = null;
$form_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'contact') {
    // CSRF verification
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $form_status = 'error';
        $form_message = 'Security token validation failed. Please refresh and try again.';
    } else {
        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
        $subject = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS));
        $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS));

        if (empty($name) || !$email || empty($message)) {
            $form_status = 'error';
            $form_message = 'Please provide a valid name, email address, and message.';
        } else {
            // Simulated secure message dispatch
            $form_status = 'success';
            $form_message = "Thank you, " . htmlspecialchars($name) . "! Your message has been received. I will respond to your email ($email) promptly.";
            // Regenerate CSRF for security
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }
}

// Portfolio Configuration & Data
$profile = [
    'name' => 'Ali Haider',
    'title' => 'Software Engineer',
    'university' => 'COMSATS University Islamabad',
    'university_short' => 'CUI Islamabad',
    'tagline' => 'Engineering scalable web systems, clean backend architectures, and modern digital experiences.',
    'email' => 'alihaider.dev.pk@gmail.com',
    'phone' => '+92 312 9876543',
    'location' => 'Islamabad, Pakistan',
    'github' => 'https://github.com',
    'linkedin' => 'https://linkedin.com',
    'avatar' => 'assets/images/avatar.jpg'
];

$stats = [
    ['num' => '4+', 'label' => 'Years Crafting Code'],
    ['num' => '25+', 'label' => 'Completed Projects'],
    ['num' => '99.9%', 'label' => 'Client & Code Quality']
];

$skills = [
    // Backend
    ['name' => 'PHP 8.x / Modern OOP', 'cat' => 'backend', 'icon' => 'fa-brands fa-php', 'percent' => 95, 'level' => 'Advanced'],
    ['name' => 'Node.js & Express', 'cat' => 'backend', 'icon' => 'fa-brands fa-node-js', 'percent' => 88, 'level' => 'Proficient'],
    ['name' => 'Python & Scripting', 'cat' => 'backend', 'icon' => 'fa-brands fa-python', 'percent' => 82, 'level' => 'Proficient'],
    ['name' => 'RESTful APIs & Microservices', 'cat' => 'backend', 'icon' => 'fa-solid fa-network-wired', 'percent' => 92, 'level' => 'Advanced'],
    
    // Frontend
    ['name' => 'JavaScript (ES6+) / TypeScript', 'cat' => 'frontend', 'icon' => 'fa-brands fa-js', 'percent' => 90, 'level' => 'Advanced'],
    ['name' => 'HTML5 & Modern CSS3', 'cat' => 'frontend', 'icon' => 'fa-brands fa-html5', 'percent' => 95, 'level' => 'Expert'],
    ['name' => 'React.js & Component UI', 'cat' => 'frontend', 'icon' => 'fa-brands fa-react', 'percent' => 85, 'level' => 'Proficient'],
    ['name' => 'Tailwind CSS & Glassmorphism', 'cat' => 'frontend', 'icon' => 'fa-solid fa-wand-magic-sparkles', 'percent' => 92, 'level' => 'Advanced'],

    // Database & Cloud
    ['name' => 'MySQL & Relational Schema', 'cat' => 'database', 'icon' => 'fa-solid fa-database', 'percent' => 94, 'level' => 'Advanced'],
    ['name' => 'PostgreSQL & Optimization', 'cat' => 'database', 'icon' => 'fa-solid fa-server', 'percent' => 84, 'level' => 'Proficient'],
    ['name' => 'Git, GitHub & CI/CD', 'cat' => 'tools', 'icon' => 'fa-brands fa-git-alt', 'percent' => 92, 'level' => 'Advanced'],
    ['name' => 'Docker & Linux Server Admin', 'cat' => 'tools', 'icon' => 'fa-brands fa-docker', 'percent' => 80, 'level' => 'Intermediate']
];

$projects = [
    [
        'title' => 'NexusFlow Enterprise ERP',
        'category' => 'Full Stack & PHP',
        'badge' => 'Enterprise System',
        'desc' => 'High-performance cloud-based resource planning and inventory workflow platform built with modern PHP, MySQL relational indexing, and reactive frontend components.',
        'tech' => ['PHP 8.2', 'MySQL', 'JavaScript', 'REST API', 'Tailwind'],
        'code_snippet' => "class OrderPipeline extends WorkflowEngine {\n    public function execute(): Response {\n        return \$this->dispatch(\$event);\n    }\n}"
    ],
    [
        'title' => 'COMSATS Academic GPA & Course Advisor',
        'category' => 'Web App & Automation',
        'badge' => 'CUI Special',
        'desc' => 'Smart academic forecasting portal tailored for COMSATS University Islamabad students to calculate semester CGPA trajectories, evaluate prerequisite roadmaps, and automate course planning.',
        'tech' => ['PHP', 'Vanilla JS', 'Chart.js', 'Bootstrap 5', 'MySQL'],
        'code_snippet' => "function computeTargetCGPA(\$credits, \$grades) {\n    \$totalPoints = array_sum(\$grades);\n    return round(\$totalPoints / \$credits, 2);\n}"
    ],
    [
        'title' => 'DevSync Collaborative Code Studio',
        'category' => 'WebSockets & Backend',
        'badge' => 'Real-Time App',
        'desc' => 'Realtime peer-to-peer coding workspace equipped with synchronized AST highlighting, live terminal execution emulator, and granular access tokens.',
        'tech' => ['Node.js', 'WebSockets', 'PHP Auth', 'Docker', 'Redis'],
        'code_snippet' => "devSync.on('cursorChange', (payload) => {\n    broadcastPeerStream(payload.socketId, payload.coords);\n});"
    ],
    [
        'title' => 'OmniPay Secure Gateway Middleware',
        'category' => 'Fintech & Security',
        'badge' => 'API Engine',
        'desc' => 'Robust webhook-driven payment aggregation abstraction with HMAC signature authentication, idempotency locks, and encrypted ledger tracking.',
        'tech' => ['PHP 8', 'cURL', 'HMAC-SHA256', 'PostgreSQL', 'JWT'],
        'code_snippet' => "\$signature = hash_hmac('sha256', \$payload, \$secretKey);\nif (!hash_equals(\$signature, \$headerHash)) {\n    throw new UnauthorizedWebhookException();\n}"
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Portfolio of Ali Haider - Software Engineer from COMSATS University Islamabad. Specializing in modern web applications, PHP 8, backend systems, and clean architecture.">
  <meta name="keywords" content="Ali Haider, Software Engineer, COMSATS University Islamabad, PHP Developer, Full Stack Developer, Portfolio, Pakistan">
  <meta name="author" content="Ali Haider">

  <!-- Open Graph Meta -->
  <meta property="og:title" content="Ali Haider | Software Engineer - COMSATS University Islamabad">
  <meta property="og:description" content="Explore software engineering projects, tech stack, and experience of Ali Haider.">
  <meta property="og:type" content="website">

  <title>Ali Haider | Software Engineer - COMSATS University Islamabad</title>

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Font Awesome 6 Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <!-- Subtle Ambient Grid Background -->
  <div class="bg-grid-pattern"></div>

  <!-- Navigation Bar -->
  <nav class="navbar" id="navbar">
    <div class="container nav-container">
      <a href="#hero" class="nav-logo" id="navLogo">
        <div class="logo-icon">AH</div>
        <div class="logo-text">Ali<span>Haider</span></div>
      </a>

      <ul class="nav-links" id="navLinks">
        <li><a href="#hero" class="nav-link active">Home</a></li>
        <li><a href="#about" class="nav-link">About</a></li>
        <li><a href="#education" class="nav-link">Education</a></li>
        <li><a href="#skills" class="nav-link">Skills</a></li>
        <li><a href="#projects" class="nav-link">Projects</a></li>
        <li><a href="#terminal" class="nav-link">Terminal</a></li>
        <li><a href="#contact" class="nav-link">Contact</a></li>
      </ul>

      <div class="nav-actions">
        <a href="#contact" class="btn btn-primary" id="navContactBtn">
          <i class="fa-solid fa-paper-plane"></i> Let's Talk
        </a>
        <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle navigation menu">
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="section hero-section" id="hero">
    <div class="container">
      <div class="hero-grid">
        
        <!-- Text Column -->
        <div class="hero-content">
          <div class="hero-badge-wrap">
            <span class="status-dot"></span>
            <span>Available for New Software Engineering Roles</span>
          </div>

          <h1 class="hero-title">
            Hi, I'm <span class="gradient-text"><?= htmlspecialchars($profile['name']); ?></span><br>
            <span id="typewriter" class="gradient-text-accent"><?= htmlspecialchars($profile['title']); ?></span>
          </h1>

          <div class="hero-affiliation">
            <i class="fa-solid fa-graduation-cap"></i>
            <span><?= htmlspecialchars($profile['university']); ?></span>
          </div>

          <p class="hero-desc">
            <?= htmlspecialchars($profile['tagline']); ?> Bridging robust algorithmic thinking from COMSATS with practical full-stack software craftsmanship.
          </p>

          <div class="hero-cta">
            <a href="#projects" class="btn btn-primary" id="heroProjectsBtn">
              <i class="fa-solid fa-laptop-code"></i> View Projects
            </a>
            <a href="#contact" class="btn btn-secondary" id="heroContactBtn">
              <i class="fa-solid fa-envelope"></i> Contact Me
            </a>
            <button class="btn btn-outline open-cv-modal" id="heroCvBtn">
              <i class="fa-solid fa-file-lines"></i> View Resume
            </button>
          </div>

          <!-- Quick Stats -->
          <div class="hero-stats">
            <?php foreach ($stats as $stat): ?>
              <div class="stat-item">
                <div class="stat-num"><?= htmlspecialchars($stat['num']); ?></div>
                <div class="stat-label"><?= htmlspecialchars($stat['label']); ?></div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- 3D Avatar Column -->
        <div class="hero-visual">
          <div class="avatar-wrapper">
            <div class="avatar-backdrop-glow"></div>
            
            <div class="avatar-frame">
              <img src="<?= htmlspecialchars($profile['avatar']); ?>" alt="Ali Haider 3D Avatar" class="avatar-img" id="heroAvatar">
            </div>

            <!-- Floating Tech Chips -->
            <div class="floating-chip top-left">
              <i class="fa-brands fa-php" style="color: #818cf8;"></i>
              <span>PHP 8.2 & Modern Backend</span>
            </div>

            <div class="floating-chip bottom-right">
              <i class="fa-solid fa-code" style="color: #06b6d4;"></i>
              <span>Full Stack Engineer</span>
            </div>

            <div class="floating-chip bottom-left">
              <i class="fa-solid fa-graduation-cap" style="color: #ec4899;"></i>
              <span>COMSATS Alum</span>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- About & Education Section -->
  <section class="section" id="about">
    <div class="container">
      <div class="section-header">
        <span class="section-tag"><i class="fa-solid fa-user-astronaut"></i> Background</span>
        <h2 class="section-title">Engineering Mindset & Education</h2>
        <p class="section-desc">Grounding modern web architecture in computer science rigor, disciplined code design, and continuous learning.</p>
      </div>

      <div class="about-grid">
        <!-- Bio Card -->
        <div class="glass-card about-info-card">
          <div>
            <h3 style="font-size: 1.6rem; margin-bottom: 1.2rem;">
              Passionate About <span class="gradient-text">Clean Code</span> & Problem Solving
            </h3>
            <p class="about-text">
              I am a Software Engineer equipped with formal computer science foundations from <b>COMSATS University Islamabad</b>. My engineering methodology revolves around writing testable, modular, and maintainable software that scales smoothly under production workloads.
            </p>
            <p class="about-text" style="margin-bottom: 2rem;">
              Whether architecting robust backend APIs in PHP, designing relational database models in MySQL, or constructing responsive, high-fidelity user interfaces, I prioritize security, speed, and polished developer experiences.
            </p>
          </div>

          <div class="about-features">
            <div class="feature-pill">
              <div class="feature-icon"><i class="fa-solid fa-cube"></i></div>
              <div>
                <span>Modular Architecture</span>
              </div>
            </div>
            <div class="feature-pill">
              <div class="feature-icon"><i class="fa-solid fa-bolt-lightning"></i></div>
              <div>
                <span>High Performance</span>
              </div>
            </div>
            <div class="feature-pill">
              <div class="feature-icon"><i class="fa-solid fa-shield-halved"></i></div>
              <div>
                <span>Security First</span>
              </div>
            </div>
            <div class="feature-pill">
              <div class="feature-icon"><i class="fa-solid fa-mobile-screen"></i></div>
              <div>
                <span>Fluid Responsive UX</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Education Card (COMSATS Focus) -->
        <div class="glass-card edu-timeline-card" id="education">
          <div class="timeline-header">
            <div class="feature-icon" style="width: 44px; height: 44px; font-size: 1.2rem;">
              <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div>
              <h3 style="font-size: 1.35rem;">Academic Journey</h3>
              <span style="font-size: 0.85rem; color: var(--text-muted);">Formal Foundations</span>
            </div>
          </div>

          <div class="timeline-item">
            <span class="timeline-dot"></span>
            <span class="timeline-date">Bachelor of Science</span>
            <h4 class="timeline-role">Software Engineering</h4>
            <div class="timeline-org">COMSATS University Islamabad (CUI)</div>
            <p class="timeline-desc">
              Comprehensive study encompassing Data Structures & Algorithms, Object-Oriented Analysis & Design, Database Systems, Web Engineering, Distributed Computing, and Agile Software Lifecycle.
            </p>
          </div>

          <div class="timeline-item">
            <span class="timeline-dot"></span>
            <span class="timeline-date">Focus Areas</span>
            <h4 class="timeline-role">System Design & Web Technologies</h4>
            <div class="timeline-org">CUI Tech Labs & Projects</div>
            <p class="timeline-desc">
              Spearheaded hands-on software laboratory projects, academic automation solutions, and collaborative team repositories adhering to clean code standards.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Skills Section -->
  <section class="section" id="skills">
    <div class="container">
      <div class="section-header">
        <span class="section-tag"><i class="fa-solid fa-microchip"></i> Capabilities</span>
        <h2 class="section-title">Skills & Technologies</h2>
        <p class="section-desc">A curated snapshot of the technologies, frameworks, and architectural paradigms I utilize every day.</p>
      </div>

      <!-- Filter Tabs -->
      <div class="skills-tabs">
        <button class="tab-btn active" data-filter="all">All Skills</button>
        <button class="tab-btn" data-filter="backend">Backend & APIs</button>
        <button class="tab-btn" data-filter="frontend">Frontend & UI</button>
        <button class="tab-btn" data-filter="database">Databases</button>
        <button class="tab-btn" data-filter="tools">DevOps & Tools</button>
      </div>

      <!-- Skills Grid -->
      <div class="skills-grid" id="skillsGrid">
        <?php foreach ($skills as $skill): ?>
          <div class="skill-card" data-category="<?= htmlspecialchars($skill['cat']); ?>">
            <div class="skill-header">
              <div class="skill-icon">
                <i class="<?= htmlspecialchars($skill['icon']); ?>"></i>
              </div>
              <div>
                <div class="skill-name"><?= htmlspecialchars($skill['name']); ?></div>
                <div class="skill-category"><?= ucfirst(htmlspecialchars($skill['cat'])); ?> • <?= htmlspecialchars($skill['level']); ?></div>
              </div>
            </div>

            <div class="skill-bar-wrap">
              <div class="skill-bar-info">
                <span>Proficiency</span>
                <span><?= $skill['percent']; ?>%</span>
              </div>
              <div class="skill-bar-bg">
                <div class="skill-bar-fill" style="width: <?= $skill['percent']; ?>%;"></div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Featured Projects Section -->
  <section class="section" id="projects">
    <div class="container">
      <div class="section-header">
        <span class="section-tag"><i class="fa-solid fa-laptop-code"></i> Portfolio</span>
        <h2 class="section-title">Featured Engineering Projects</h2>
        <p class="section-desc">Real-world applications showcasing scalable backend logic, interactive user experiences, and database efficiency.</p>
      </div>

      <div class="projects-grid">
        <?php foreach ($projects as $idx => $p): ?>
          <div class="project-card">
            <div class="project-preview">
              <div class="project-tag-badge"><?= htmlspecialchars($p['badge']); ?></div>
              <div class="project-visual-mockup">
                <pre class="mockup-code-block"><code><?= htmlspecialchars($p['code_snippet']); ?></code></pre>
              </div>
            </div>

            <div class="project-body">
              <h3 class="project-title"><?= htmlspecialchars($p['title']); ?></h3>
              <p class="project-desc"><?= htmlspecialchars($p['desc']); ?></p>

              <div class="project-techs">
                <?php foreach ($p['tech'] as $t): ?>
                  <span class="tech-tag"><?= htmlspecialchars($t); ?></span>
                <?php endforeach; ?>
              </div>

              <div class="project-footer">
                <a href="#contact" class="project-link-btn">
                  <span>Inquire Architecture</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="<?= htmlspecialchars($profile['github']); ?>" target="_blank" rel="noopener noreferrer" class="social-btn" title="View on GitHub" style="width: 34px; height: 34px; font-size: 0.95rem;">
                  <i class="fa-brands fa-github"></i>
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Interactive Terminal Section -->
  <section class="section" id="terminal">
    <div class="container">
      <div class="section-header">
        <span class="section-tag"><i class="fa-solid fa-terminal"></i> Interactive</span>
        <h2 class="section-title">Developer Terminal</h2>
        <p class="section-desc">Experience an interactive command prompt. Type commands or click the chips below to explore my profile like a pro.</p>
      </div>

      <div class="terminal-card">
        <div class="terminal-header">
          <div class="terminal-dots">
            <div class="terminal-dot red"></div>
            <div class="terminal-dot yellow"></div>
            <div class="terminal-dot green"></div>
          </div>
          <div class="terminal-title">ali@alihaider-comsats: ~/portfolio (bash)</div>
          <div style="font-size: 0.8rem; color: var(--text-muted);"><i class="fa-solid fa-lock"></i> ssh:ready</div>
        </div>

        <div class="terminal-body">
          <div id="terminalHistory">
            <div class="terminal-output">
              <span class="highlight">Antigravity Shell v2.4</span> [Connected to Ali Haider's Engineering Space]<br>
              Type <span class="highlight">'help'</span> to see all available commands, or click the quick command chips below.
            </div>
          </div>

          <div class="terminal-input-row">
            <span class="prompt-symbol">ali@engineer:~$</span>
            <input type="text" id="terminalInput" class="terminal-input" placeholder="try typing 'skills' or 'sudo hire ali'..." autocomplete="off" spellcheck="false">
          </div>

          <div class="quick-commands">
            <span style="font-size: 0.75rem; color: var(--text-muted); align-self: center;">Quick commands:</span>
            <button class="quick-cmd-chip" data-cmd="skills">skills</button>
            <button class="quick-cmd-chip" data-cmd="education">education</button>
            <button class="quick-cmd-chip" data-cmd="projects">projects</button>
            <button class="quick-cmd-chip" data-cmd="contact">contact</button>
            <button class="quick-cmd-chip" data-cmd="sudo hire ali">sudo hire ali</button>
            <button class="quick-cmd-chip" data-cmd="clear">clear</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section (PHP Handled) -->
  <section class="section" id="contact">
    <div class="container">
      <div class="section-header">
        <span class="section-tag"><i class="fa-solid fa-paper-plane"></i> Get In Touch</span>
        <h2 class="section-title">Let's Build Something Exceptional</h2>
        <p class="section-desc">Have a software engineering role, startup project, or technical consultation in mind? Send a message directly.</p>
      </div>

      <div class="contact-grid">
        <!-- Contact Information -->
        <div class="glass-card contact-info-card">
          <h3 style="font-size: 1.6rem; margin-bottom: 1rem;">Direct Channels</h3>
          <p style="color: var(--text-muted); margin-bottom: 2.2rem; font-size: 0.95rem;">
            I am currently open for full-time software engineering roles, contract development, and technical collaboration.
          </p>

          <div class="contact-method">
            <div class="contact-icon-box">
              <i class="fa-solid fa-envelope"></i>
            </div>
            <div>
              <div class="contact-method-title">Email</div>
              <a href="mailto:<?= htmlspecialchars($profile['email']); ?>" class="contact-method-val">
                <?= htmlspecialchars($profile['email']); ?>
              </a>
            </div>
          </div>

          <div class="contact-method">
            <div class="contact-icon-box">
              <i class="fa-solid fa-phone"></i>
            </div>
            <div>
              <div class="contact-method-title">Phone / WhatsApp</div>
              <a href="tel:<?= htmlspecialchars($profile['phone']); ?>" class="contact-method-val">
                <?= htmlspecialchars($profile['phone']); ?>
              </a>
            </div>
          </div>

          <div class="contact-method">
            <div class="contact-icon-box">
              <i class="fa-solid fa-building-columns"></i>
            </div>
            <div>
              <div class="contact-method-title">University & Location</div>
              <div class="contact-method-val">
                <?= htmlspecialchars($profile['university_short']); ?><br>
                <span style="font-size: 0.88rem; color: var(--text-muted);"><?= htmlspecialchars($profile['location']); ?></span>
              </div>
            </div>
          </div>

          <div class="social-links">
            <a href="<?= htmlspecialchars($profile['github']); ?>" target="_blank" rel="noopener noreferrer" class="social-btn" title="GitHub">
              <i class="fa-brands fa-github"></i>
            </a>
            <a href="<?= htmlspecialchars($profile['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="social-btn" title="LinkedIn">
              <i class="fa-brands fa-linkedin-in"></i>
            </a>
            <a href="mailto:<?= htmlspecialchars($profile['email']); ?>" class="social-btn" title="Direct Email">
              <i class="fa-solid fa-at"></i>
            </a>
          </div>
        </div>

        <!-- Contact Form Card -->
        <div class="glass-card contact-form-card">
          <h3 style="font-size: 1.6rem; margin-bottom: 1.5rem;">Send a Direct Message</h3>

          <!-- PHP Feedback Alert -->
          <?php if ($form_status === 'success'): ?>
            <div class="form-alert success">
              <i class="fa-solid fa-circle-check"></i>
              <span><?= htmlspecialchars($form_message); ?></span>
            </div>
          <?php elseif ($form_status === 'error'): ?>
            <div class="form-alert error">
              <i class="fa-solid fa-triangle-exclamation"></i>
              <span><?= htmlspecialchars($form_message); ?></span>
            </div>
          <?php endif; ?>

          <form action="#contact" method="POST" id="contactForm">
            <input type="hidden" name="action" value="contact">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">

            <div class="form-group">
              <label for="name" class="form-label">Your Name</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Sarah Jenkins" required value="<?= isset($_POST['name']) && $form_status === 'error' ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>

            <div class="form-group">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="sarah@company.com" required value="<?= isset($_POST['email']) && $form_status === 'error' ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <div class="form-group">
              <label for="subject" class="form-label">Subject</label>
              <input type="text" id="subject" name="subject" class="form-control" placeholder="Software Engineering Opportunity / Project Discussion" value="<?= isset($_POST['subject']) && $form_status === 'error' ? htmlspecialchars($_POST['subject']) : ''; ?>">
            </div>

            <div class="form-group">
              <label for="message" class="form-label">Your Message</label>
              <textarea id="message" name="message" class="form-control" rows="4" placeholder="Hello Ali, we would love to discuss a project..." required><?= isset($_POST['message']) && $form_status === 'error' ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary" id="sendMessageBtn" style="width: 100%;">
              <i class="fa-solid fa-paper-plane"></i> Send Message
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container footer-content">
      <div class="footer-text">
        &copy; <?= date('Y'); ?> <b><?= htmlspecialchars($profile['name']); ?></b>. All rights reserved. 
        <span style="display: block; font-size: 0.8rem; margin-top: 0.25rem;">Software Engineer • <?= htmlspecialchars($profile['university']); ?></span>
      </div>

      <div class="footer-links">
        <a href="#hero" class="footer-link">Home</a>
        <a href="#about" class="footer-link">About</a>
        <a href="#skills" class="footer-link">Skills</a>
        <a href="#projects" class="footer-link">Projects</a>
        <a href="#contact" class="footer-link">Contact</a>
      </div>

      <button class="back-to-top" id="backToTop" title="Back to top" aria-label="Back to top">
        <i class="fa-solid fa-arrow-up"></i>
      </button>
    </div>
  </footer>

  <!-- Modal for CV / Resume Preview -->
  <div class="modal-overlay" id="cvModal">
    <div class="glass-card modal-card">
      <button class="modal-close" id="closeCvModal" aria-label="Close modal">&times;</button>
      
      <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
        <div class="feature-icon" style="width: 44px; height: 44px;">
          <i class="fa-solid fa-file-pdf"></i>
        </div>
        <div>
          <h3 style="font-size: 1.4rem;">Ali Haider - Curriculum Vitae</h3>
          <p style="font-size: 0.85rem; color: var(--text-muted);">Software Engineer • <?= htmlspecialchars($profile['university']); ?></p>
        </div>
      </div>

      <div style="background: rgba(10, 14, 29, 0.7); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 1.5rem; margin-bottom: 1.5rem; font-size: 0.9rem; line-height: 1.7; color: #cbd5e1;">
        <div style="margin-bottom: 0.8rem;">
          <b style="color: #fff;">🎓 Education:</b> Bachelor of Science in Software Engineering, COMSATS University Islamabad (CUI).
        </div>
        <div style="margin-bottom: 0.8rem;">
          <b style="color: #fff;">💻 Core Specialization:</b> Backend Architecture (PHP 8, Node.js), Relational DB (MySQL), System Design, Modern UI (ES6, Tailwind, React).
        </div>
        <div>
          <b style="color: #fff;">🏆 Key Highlights:</b> Multiple enterprise production deployments, clean codebase architecture, and academic problem-solving excellence.
        </div>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 1rem;">
        <a href="mailto:<?= htmlspecialchars($profile['email']); ?>?subject=Requesting%20Full%20Resume%20-%20Ali%20Haider" class="btn btn-primary">
          <i class="fa-solid fa-envelope"></i> Request Full PDF Resume
        </a>
      </div>
    </div>
  </div>

  <!-- JavaScript Bundle -->
  <script src="assets/js/main.js"></script>
</body>
</html>
