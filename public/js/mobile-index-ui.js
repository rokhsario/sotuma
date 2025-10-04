(function(){
  'use strict';

  function isTabletOrMobile(){ return window.innerWidth <= 1200; }
  function isServerMobile(){ return document.body.getAttribute('data-mobile') === '1'; }

  function ensureRoot(){
    var root = document.getElementById('mobile-experience-root');
    if (!root) {
      root = document.createElement('div');
      root.id = 'mobile-experience-root';
      document.body.appendChild(root);
    }
    return root;
  }

  function createTopNav(){
    var nav = document.createElement('div');
    nav.className = 'mobi-topnav';
    nav.id = 'mobile-topnav';

    function mk(label, iconClass, href){
      var a = document.createElement('a');
      a.className = 'mobi-btn';
      a.href = href || '#';
      a.innerHTML = '<i class="fa '+iconClass+'"></i><span>'+label+'</span>';
      return a;
    }

    var links = window.MobileNavLinks || {};
    nav.appendChild(mk('Qui Sommes Nous', 'fa-user', links.about || '/about-us'));
    nav.appendChild(mk('Projets', 'fa-th-large', links.projects || '/categories-projets'));
    nav.appendChild(mk('Catégories', 'fa-list', links.categories || '/categories'));
    nav.appendChild(mk('Contact', 'fa-envelope', links.contact || '/contact'));
    return nav;
  }

  function createFooter(){
    var footer = document.createElement('div');
    footer.className = 'mobi-footer';

    var logoBox = document.createElement('div');
    logoBox.className = 'logo';
    var logo = document.createElement('img');
    logo.src = '/images/hethahou.png';
    logo.alt = 'SOTUMA';
    logoBox.appendChild(logo);

    var follow = document.createElement('div');
    follow.className = 'follow';
    follow.textContent = 'SUIVEZ-NOUS';

    var socials = document.createElement('div');
    socials.className = 'socials';

    function social(href, icon){
      var a = document.createElement('a');
      a.href = href; a.target = '_blank'; a.rel = 'noopener';
      a.innerHTML = '<i class="fab '+icon+'"></i>';
      return a;
    }

    socials.appendChild(social('https://www.instagram.com/sotuma_aluminium/', 'fa-instagram'));
    socials.appendChild(social('https://www.facebook.com/sotumasfax', 'fa-facebook-f'));
    socials.appendChild(social('https://www.tiktok.com/@sotumasotuma', 'fa-tiktok'));
    socials.appendChild(social('https://www.linkedin.com/company/sotuma/', 'fa-linkedin-in'));

    // Accordion sections
    var sections = [
      {title: 'Qui Sommes Nous', items: []},
      {title: 'Aide', items: []},
      {title: 'Guide', items: []},
      {title: 'Service Client', items: []}
    ];

    var accWrap = document.createElement('div');
    accWrap.className = 'mobi-acc';
    sections.forEach(function(sec){
      var item = document.createElement('div');
      item.className = 'mobi-acc-item';
      var head = document.createElement('button');
      head.className = 'mobi-acc-head';
      head.type = 'button';
      head.innerHTML = '<span>'+sec.title+'</span><i class="fa fa-plus"></i>';
      var body = document.createElement('div');
      body.className = 'mobi-acc-body';
      body.style.display = 'none';
      head.addEventListener('click', function(){
        var open = body.style.display !== 'none';
        body.style.display = open ? 'none' : 'block';
        head.querySelector('i').className = open ? 'fa fa-plus' : 'fa fa-minus';
      });
      item.appendChild(head);
      item.appendChild(body);
      accWrap.appendChild(item);
    });

    // Legal links
    var legal = document.createElement('div');
    legal.className = 'mobi-legal';
    legal.innerHTML = '<a href="#">Conditions Générales de Vente</a> · <a href="#">Mentions légales</a> · <a href="#">Politique de confidentialité</a>';

    footer.appendChild(logoBox);
    footer.appendChild(follow);
    footer.appendChild(socials);
    footer.appendChild(accWrap);
    footer.appendChild(legal);
    return footer;
  }

  function renderMobileUI(){
    if (!isTabletOrMobile() && !isServerMobile()) return;
    var root = ensureRoot();
    // Clear previous
    root.innerHTML = '';
    // Make sure topnav is visible if it exists server-rendered
    var serverTop = document.getElementById('mobile-topnav');
    if (serverTop) { serverTop.style.display = 'grid'; }
    // Add top nav
    var existingNav = document.getElementById('mobile-topnav');
    if (!existingNav) document.body.appendChild(createTopNav());

    // HERO
    var hero = document.createElement('section');
    hero.className = 'mobi-hero';
    hero.innerHTML = '<div class="logo"><img src="/images/hethahou1.png" alt="SOTUMA"/></div>'+
                     '<div class="slogan">'+(window.MobileData && window.MobileData.slogan ? window.MobileData.slogan : '')+'</div>';
    root.appendChild(hero);

    // PROJECT CATEGORIES
    var projSec = document.createElement('section');
    projSec.className = 'mobi-section';
    projSec.innerHTML = '<div class="mobi-title">Nos Projets</div>';
    var projGrid = document.createElement('div');
    projGrid.className = 'mobi-cards';
    var pData = (window.MobileData && window.MobileData.projectCategories) ? window.MobileData.projectCategories : [];
    pData.forEach(function(c){
      var card = document.createElement('a');
      card.className = 'mobi-card';
      card.href = (window.MobileData.projectCategoryBase || '/categories-projets') + '/' + c.slug;
      card.innerHTML = '<img class="mobi-card-img" src="'+c.image+'" alt="'+c.name+'"/>'+
                       '<div class="mobi-card-body">'+
                       '<div class="mobi-card-title">'+c.name+'</div>'+
                       '<div class="mobi-card-cta"><span class="txt">VOIR PLUS</span><span class="arr">➜</span></div>'+
                       '</div>';
      projGrid.appendChild(card);
    });
    projSec.appendChild(projGrid);
    root.appendChild(projSec);

    // PROCESSUS D'EXCELLENCE (simple 3 steps)
    var procSec = document.createElement('section');
    procSec.className = 'mobi-process';
    procSec.innerHTML = '<div class="mobi-title">Processus d\'Excellence</div>';
    var steps = document.createElement('div');
    steps.className = 'mobi-process-steps';
    var dataSteps = [
      {t:'Conception', d:'Étude et design de vos projets.'},
      {t:'Fabrication', d:'Qualité industrielle, finitions premium.'},
      {t:'Installation', d:'Pose experte et service après-vente.'}
    ];
    dataSteps.forEach(function(s){
      var st = document.createElement('div');
      st.className = 'mobi-step';
      st.innerHTML = '<h4>'+s.t+'</h4><p>'+s.d+'</p>';
      steps.appendChild(st);
    });
    procSec.appendChild(steps);
    root.appendChild(procSec);

    // PRODUCT CATEGORIES
    var prodSec = document.createElement('section');
    prodSec.className = 'mobi-section';
    prodSec.innerHTML = '<div class="mobi-title">Nos Produits</div>';
    var prodGrid = document.createElement('div');
    prodGrid.className = 'mobi-cards';
    var cData = (window.MobileData && window.MobileData.productCategories) ? window.MobileData.productCategories : [];
    cData.forEach(function(c){
      var card = document.createElement('a');
      card.className = 'mobi-card';
      card.href = (window.MobileData.productCategoryBase || '/categories') + '/' + c.slug;
      card.innerHTML = '<img class="mobi-card-img" src="'+c.image+'" alt="'+c.name+'"/>'+
                       '<div class="mobi-card-body">'+
                       '<div class="mobi-card-title">'+c.name+'</div>'+
                       '<div class="mobi-card-cta"><span class="txt">VOIR PLUS</span><span class="arr">➜</span></div>'+
                       '</div>';
      prodGrid.appendChild(card);
    });
    prodSec.appendChild(prodGrid);
    root.appendChild(prodSec);

    // FOOTER
    root.appendChild(createFooter());

    // MAP under footer
    if (window.MobileData && window.MobileData.mapSrc) {
      var mapWrap = document.createElement('div');
      mapWrap.style.margin = '8px 0 0 0';
      mapWrap.innerHTML = '<iframe src="'+window.MobileData.mapSrc+'" width="100%" height="300" style="border:0;display:block" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>';
      root.appendChild(mapWrap);
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', renderMobileUI);
  } else {
    renderMobileUI();
  }

  window.addEventListener('resize', function(){
    clearTimeout(window.__mobileUiR);
    window.__mobileUiR = setTimeout(renderMobileUI, 150);
  });
})();


