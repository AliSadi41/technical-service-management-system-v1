// ============================================================
// Sadi Teknik Servis – Ana JavaScript
// ============================================================

document.addEventListener('DOMContentLoaded', function () {

    // ── Scroll Fade-Up Animasyonları ──────────────────────
    const fadeEls = document.querySelectorAll('.fade-up');
    if (fadeEls.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        fadeEls.forEach(el => observer.observe(el));
    }

    // ── Sayaç Animasyonu ──────────────────────────────────
    function animateCounter(el) {
        const target = parseInt(el.getAttribute('data-target'), 10);
        const duration = 1800;
        const step = target / (duration / 16);
        let current = 0;
        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            el.textContent = Math.floor(current).toLocaleString('tr-TR');
        }, 16);
    }

    const counters = document.querySelectorAll('[data-target]');
    if (counters.length) {
        const cObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    cObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(el => cObserver.observe(el));
    }

    // ── Aktif Navbar Sayfası ──────────────────────────────
    const currentPath = window.location.pathname.split('/').pop();
    document.querySelectorAll('.main-navbar .nav-link').forEach(link => {
        const href = link.getAttribute('href') || '';
        if (href && href.split('/').pop() === currentPath && currentPath !== '') {
            link.classList.add('active');
        }
    });

    // ── Navbar Scroll Efekti ──────────────────────────────
    const navbar = document.querySelector('.main-navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.boxShadow = '0 4px 30px rgba(0,0,0,0.6)';
            } else {
                navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.4)';
            }
        });
    }

    // ── Form Gönderim Geri Bildirimi ──────────────────────
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function () {
            const btn = this.querySelector('button[type="submit"]');
            if (btn) {
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gönderiliyor...';
                btn.disabled = true;
            }
        });
    }

    // ── Admin Tablo Silme Onayı ───────────────────────────
    document.querySelectorAll('.btn-delete-confirm').forEach(btn => {
        btn.addEventListener('click', function (e) {
            if (!confirm('Bu kaydı silmek istediğinizden emin misiniz?')) {
                e.preventDefault();
            }
        });
    });

    // ── Smooth Scroll ─────────────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

});
