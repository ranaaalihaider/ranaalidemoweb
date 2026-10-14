/**
 * Ali Haider - Modern Portfolio Scripts
 * Interactions, Interactive Terminal, Dynamic Animations
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Navbar Scroll Effect
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 40) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
    highlightActiveNav();
  });

  // 2. Mobile Navigation Toggle
  const mobileToggle = document.getElementById('mobileToggle');
  const navLinks = document.getElementById('navLinks');
  if (mobileToggle && navLinks) {
    mobileToggle.addEventListener('click', () => {
      navLinks.classList.toggle('active');
      const icon = mobileToggle.querySelector('i');
      if (icon) {
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-xmark');
      }
    });

    // Close mobile nav when clicking a link
    navLinks.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        navLinks.classList.remove('active');
        const icon = mobileToggle.querySelector('i');
        if (icon) {
          icon.classList.add('fa-bars');
          icon.classList.remove('fa-xmark');
        }
      });
    });
  }

  // 3. Highlight Active Navigation on Scroll
  const sections = document.querySelectorAll('section[id]');
  function highlightActiveNav() {
    const scrollY = window.pageYOffset;
    sections.forEach(current => {
      const sectionHeight = current.offsetHeight;
      const sectionTop = current.offsetTop - 120;
      const sectionId = current.getAttribute('id');
      const navItem = document.querySelector(`.nav-link[href*="${sectionId}"]`);
      if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
        navItem?.classList.add('active');
      } else {
        navItem?.classList.remove('active');
      }
    });
  }

  // 4. Typewriter Effect in Hero Subtitle
  const typewriterElement = document.getElementById('typewriter');
  if (typewriterElement) {
    const roles = [
      'Software Engineer',
      'COMSATS University Alum / Tech Lead',
      'Full Stack Web Architect',
      'Modern PHP & Cloud Developer'
    ];
    let roleIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typingSpeed = 90;

    function type() {
      const currentRole = roles[roleIndex];
      if (isDeleting) {
        typewriterElement.textContent = currentRole.substring(0, charIndex - 1);
        charIndex--;
        typingSpeed = 45;
      } else {
        typewriterElement.textContent = currentRole.substring(0, charIndex + 1);
        charIndex++;
        typingSpeed = 90;
      }

      if (!isDeleting && charIndex === currentRole.length) {
        isDeleting = true;
        typingSpeed = 1800; // Pause at completion
      } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        roleIndex = (roleIndex + 1) % roles.length;
        typingSpeed = 450;
      }

      setTimeout(type, typingSpeed);
    }
    type();
  }

  // 5. Skills Tab Filtering
  const tabButtons = document.querySelectorAll('.tab-btn');
  const skillCards = document.querySelectorAll('.skill-card');

  tabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      tabButtons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.getAttribute('data-filter');
      skillCards.forEach(card => {
        const category = card.getAttribute('data-category');
        if (filter === 'all' || category === filter) {
          card.style.display = 'flex';
          card.style.animation = 'fadeIn 0.4s ease forwards';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  // 6. Interactive Developer Terminal
  const terminalInput = document.getElementById('terminalInput');
  const terminalHistory = document.getElementById('terminalHistory');
  const quickCmdChips = document.querySelectorAll('.quick-cmd-chip');

  const commandResponses = {
    help: `Available commands:
  • <span class="highlight">skills</span>    - List core tech capabilities & tools
  • <span class="highlight">education</span> - Details regarding COMSATS University Islamabad
  • <span class="highlight">projects</span>  - Key software engineering projects
  • <span class="highlight">contact</span>   - Direct contact links & details
  • <span class="highlight">sudo hire ali</span> - Instant hiring recommendation
  • <span class="highlight">clear</span>     - Clear terminal history`,

    skills: `🚀 <b>Core Competencies:</b>
  - Backend: PHP 8+, Node.js, Python, RESTful APIs, MVC Architecture
  - Frontend: Modern JavaScript (ES6+), HTML5, CSS3/Tailwind, Vue/React
  - Database: MySQL, PostgreSQL, Redis, MongoDB
  - Tools & Cloud: Git/GitHub, Docker, Linux, Apache, Postman`,

    education: `🎓 <b>Academic Background:</b>
  - <b>COMSATS University Islamabad (CUI)</b>
  - Degree: Bachelor of Science in Software Engineering
  - Focus: Data Structures, Distributed Systems, Software Design & Architecture, Database Engineering`,

    projects: `💻 <b>Featured Works:</b>
  1. <b>CloudDocs Enterprise</b> - PHP 8 document management engine
  2. <b>EduPortal COMSATS</b> - Academic Automation & GPA Analytics
  3. <b>DevSync</b> - Realtime collaborative developer workspace
  4. <b>NeuralMetrics</b> - Automated software telemetry dashboard`,

    contact: `📬 <b>Get in Touch:</b>
  - Email: <a href="mailto:ali.haider.dev@example.com" class="highlight">ali.haider.dev@example.com</a>
  - Campus: COMSATS University Islamabad, Park Road, Tarlai Kalan, Islamabad
  - Status: <span class="success">Open for full-time roles & high-impact contracts</span>`,

    'sudo hire ali': `🎉 <span class="success"><b>Access Granted! [STATUS: HIRE_APPROVED]</b></span>
  Congratulations on making the best engineering hire decision. 
  Ali Haider brings software craftsmanship, COMSATS academic excellence, and a high-velocity execution mindset to your team.
  <br>👉 <a href="#contact" class="highlight" style="text-decoration: underline;">Scroll to Contact section to schedule an interview!</a>`,

    clear: 'CLEAR_ACTION'
  };

  function executeCommand(cmd) {
    const cleanCmd = cmd.trim().toLowerCase();
    if (!cleanCmd) return;

    if (cleanCmd === 'clear') {
      if (terminalHistory) terminalHistory.innerHTML = '';
      return;
    }

    const commandEntry = document.createElement('div');
    commandEntry.className = 'terminal-output';
    commandEntry.innerHTML = `<div><span class="prompt-symbol">ali@engineer:~$</span> <span style="color:#fff;">${escapeHtml(cmd)}</span></div>`;

    const responseDiv = document.createElement('div');
    responseDiv.style.marginTop = '0.3rem';
    responseDiv.style.marginBottom = '0.8rem';

    if (commandResponses[cleanCmd]) {
      responseDiv.innerHTML = commandResponses[cleanCmd];
    } else {
      responseDiv.innerHTML = `<span style="color: #f87171;">Command not found: "${escapeHtml(cleanCmd)}". Type <span class="highlight">help</span> for valid commands.</span>`;
    }

    commandEntry.appendChild(responseDiv);
    if (terminalHistory) {
      terminalHistory.appendChild(commandEntry);
      terminalHistory.scrollTop = terminalHistory.scrollHeight;
    }
  }

  if (terminalInput) {
    terminalInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') {
        executeCommand(terminalInput.value);
        terminalInput.value = '';
      }
    });
  }

  quickCmdChips.forEach(chip => {
    chip.addEventListener('click', () => {
      const cmd = chip.getAttribute('data-cmd');
      if (cmd && terminalInput) {
        terminalInput.value = cmd;
        executeCommand(cmd);
        terminalInput.value = '';
      }
    });
  });

  function escapeHtml(text) {
    return text.replace(/[&<>"']/g, function(m) {
      return {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
      }[m];
    });
  }

  // 7. CV Preview Modal Handler
  const cvModal = document.getElementById('cvModal');
  const openCvBtns = document.querySelectorAll('.open-cv-modal');
  const closeCvBtn = document.getElementById('closeCvModal');

  openCvBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      if (cvModal) cvModal.classList.add('active');
    });
  });

  if (closeCvBtn && cvModal) {
    closeCvBtn.addEventListener('click', () => {
      cvModal.classList.remove('active');
    });

    cvModal.addEventListener('click', (e) => {
      if (e.target === cvModal) {
        cvModal.classList.remove('active');
      }
    });
  }

  // 8. Back to Top Button
  const backToTop = document.getElementById('backToTop');
  if (backToTop) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 400) {
        backToTop.style.display = 'flex';
      } else {
        backToTop.style.display = 'none';
      }
    });

    backToTop.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }
});
