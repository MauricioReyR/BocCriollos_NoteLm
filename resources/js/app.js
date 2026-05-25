import './bootstrap';
import Alpine from 'alpinejs';

// ====================
// TESTIMONIAL FORM (defined BEFORE Alpine.start())
// ====================

window.testimonialForm = function () {
  return {
    open: false,
    form: { name: '', role: '', rating: 5, text: '', website: '' },
    hoverRating: 0,
    errors: {},
    submitted: false,
    submitting: false,

    validate() {
      this.errors = {};
      if (!this.form.name.trim()) this.errors.name = 'El nombre es obligatorio';
      if (!this.form.text.trim()) this.errors.text = 'El testimonio es obligatorio';
      if (this.form.text.trim().length < 10) this.errors.text = 'El testimonio debe tener al menos 10 caracteres';
      if (this.form.rating < 1 || this.form.rating > 5) this.errors.rating = 'Selecciona una calificación';
      return Object.keys(this.errors).length === 0;
    },

    submitForm() {
      if (!this.validate()) return;
      this.submitting = true;
      this.errors = {};

      fetch('/testimonios', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
          'Accept': 'application/json',
        },
        body: JSON.stringify(this.form),
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          this.submitting = false;
          this.submitted = true;
          this.form = { name: '', role: '', rating: 5, text: '', website: '' };
        } else {
          this.submitting = false;
          if (data.errors) {
            const fieldMap = { name: 'name', role: 'role', rating: 'rating', text: 'text' };
            Object.keys(data.errors).forEach(field => {
              const mapped = fieldMap[field] || field;
              this.errors[mapped] = data.errors[field][0];
            });
          } else {
            this.errors._general = data.message || 'Error al enviar el testimonio';
          }
        }
      })
      .catch(() => {
        this.submitting = false;
        this.errors._general = 'Error de conexión. Intenta de nuevo.';
      });
    },

    resetForm() {
      this.open = false;
      this.submitted = false;
      this.errors = {};
      this.form = { name: '', role: '', rating: 5, text: '', website: '' };
    },
  };
};

// Alpine.js está disponible globalmente
window.Alpine = Alpine;

// Inicializar Alpine (después de definir los componentes)
Alpine.start();

// ==================== 
// ERROR HANDLING
// ====================

// Global error handler para errores no capturados
window.addEventListener('error', (event) => {
  console.error('[Global Error]:', event.error);
  // En producción, enviar a error tracking service (e.g., Sentry)
});

// Handler para promesas rechazadas no capturadas
window.addEventListener('unhandledrejection', (event) => {
  console.error('[Unhandled Promise Rejection]:', event.reason);
});

// Wrapper seguro para ejecutar funciones críticas
function safeExecute(fn, fallback = () => {}) {
  try {
    return fn();
  } catch (error) {
    console.error('[safeExecute Error]:', error);
    if (typeof fallback === 'function') {
      fallback();
    }
  }
}

// ==================== 
// FUNCIONES GLOBALES
// ====================

// Smooth scroll function con error handling
window.smoothScroll = function(elementId) {
  try {
    if (!elementId || typeof elementId !== 'string') {
      console.warn('[smoothScroll] Invalid elementId:', elementId);
      return;
    }
    
    const element = document.getElementById(elementId);
    if (!element) {
      console.warn('[smoothScroll] Element not found:', elementId);
      return;
    }
    
    element.scrollIntoView({ behavior: 'smooth' });
  } catch (error) {
    console.error('[smoothScroll Error]:', error);
    // Fallback: instant scroll
    try {
      const element = document.getElementById(elementId);
      if (element) element.scrollIntoView();
    } catch (e) {
      console.error('[smoothScroll Fallback Error]:', e);
    }
  }
};

// Counter Animation Function con error handling
window.animateCounter = function(element, target, duration = 2000) {
  try {
    if (!element || typeof target !== 'number' || duration < 0) {
      console.warn('[animateCounter] Invalid arguments:', { element, target, duration });
      if (element) element.textContent = target || 0;
      return;
    }
    
    let current = 0;
    const increment = target / (duration / 16);
    const startTime = Date.now();
    
    const animate = () => {
      try {
        const elapsed = Date.now() - startTime;
        current = Math.min((elapsed / duration) * target, target);
        
        element.textContent = Math.floor(current);
        
        if (elapsed < duration) {
          requestAnimationFrame(animate);
        } else {
          element.textContent = target;
        }
      } catch (error) {
        console.error('[animateCounter Animation Error]:', error);
        element.textContent = target;
      }
    };
    
    requestAnimationFrame(animate);
  } catch (error) {
    console.error('[animateCounter Error]:', error);
    if (element) element.textContent = target || 0;
  }
};

// ==================== 
// EVENT LISTENERS
// ====================

document.addEventListener('DOMContentLoaded', function() {
  // ==================== 
  // SCROLL REVEAL ANIMATIONS
  // ====================
  
  const revealOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const revealObserver = new IntersectionObserver(function(entries) {
    entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
        try {
          // Determinar dirección de animación
          const direction = entry.target.dataset.scrollReveal || 'bottom';
          const delay = entry.target.dataset.delay || index * 100;
          
          setTimeout(() => {
            try {
              entry.target.classList.add(`animate-reveal-${direction}`);
              entry.target.style.removeProperty('opacity');
            } catch (error) {
              console.error('[Scroll Reveal Animation Error]:', error);
            }
          }, delay);
          
          revealObserver.unobserve(entry.target);
        } catch (error) {
          console.error('[Scroll Reveal Error]:', error);
        }
      }
    });
  }, revealOptions);

  // Observar elementos con data-scroll-reveal
  try {
    document.querySelectorAll('[data-scroll-reveal]').forEach(el => {
      el.style.opacity = '0';
      revealObserver.observe(el);
    });
  } catch (error) {
    console.error('[Scroll Reveal Setup Error]:', error);
  }

  // Fallback: animación para elementos con [data-animate]
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
  };

  const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
      try {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-fade-in');
        }
      } catch (error) {
        console.error('[Fallback Animation Error]:', error);
      }
    });
  }, observerOptions);

  try {
    document.querySelectorAll('[data-animate]').forEach(el => {
      observer.observe(el);
    });
  } catch (error) {
    console.error('[Fallback Setup Error]:', error);
  }

  // ==================== 
  // NAVBAR ACTIVE LINK DETECTION
  // ====================
  
  function updateActiveNavLink() {
    try {
      const sections = ['hero', 'combos', 'productos', 'categorias', 'testimonios', 'cta-whatsapp'];
      const scrollPosition = window.scrollY + 150;
      
      sections.forEach(sectionId => {
        try {
          const section = document.getElementById(sectionId);
          if (section) {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
              // Remover clase activa de todos los links
              document.querySelectorAll('[data-nav-link]').forEach(link => {
                link.classList.remove('text-warm-orange-400', 'border-b-2', 'border-warm-orange-400');
              });
              
              // Agregar clase activa al link correspondiente
              const activeLink = document.querySelector(`[data-nav-link="${sectionId}"]`);
              if (activeLink) {
                activeLink.classList.add('text-warm-orange-400', 'border-b-2', 'border-warm-orange-400');
              }
            }
          }
        } catch (error) {
          console.error(`[Navbar Link Update Error for ${sectionId}]:`, error);
        }
      });
    } catch (error) {
      console.error('[Navbar Active Link Error]:', error);
    }
  }

  if (window.addEventListener) {
    try {
      window.addEventListener('scroll', updateActiveNavLink);
      updateActiveNavLink(); // Llamada inicial
    } catch (error) {
      console.error('[Navbar Setup Error]:', error);
    }
  }

  // ==================== 
  // PARALLAX EFFECT ON HERO ELEMENTS
  // ====================
  
  try {
    const parallaxElements = document.querySelectorAll('[data-parallax]');
    
    if (parallaxElements.length > 0 && window.addEventListener) {
      window.addEventListener('scroll', () => {
        try {
          const scrolled = window.pageYOffset;
    
    parallaxElements.forEach(el => {
      const speed = el.dataset.parallax || 0.5;
      el.style.transform = `translateY(${scrolled * speed}px)`;
    });
        } catch (error) {
          console.error('[Parallax Error]:', error);
        }
      });
    }
  } catch (error) {
    console.error('[Parallax Setup Error]:', error);
  }

  // ==================== 
  // PAGE LOAD FADE-IN
  // ====================
  
  try {
    // Animar elementos principales al cargar
    document.body.style.opacity = '0';
    setTimeout(() => {
      try {
        document.body.style.transition = 'opacity 0.6s ease-in';
        document.body.style.opacity = '1';
      } catch (error) {
        console.error('[Page Load Fade-in Error]:', error);
        document.body.style.opacity = '1';
      }
    }, 100);
  } catch (error) {
    console.error('[Page Load Setup Error]:', error);
    document.body.style.opacity = '1';
  }
});

