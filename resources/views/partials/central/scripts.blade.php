<script>
(function(){
  var navToggle = document.getElementById('navToggle');
  var navLinks = document.getElementById('navLinks');
  if (!navToggle || !navLinks) return;

  function setMenu(open){
    navLinks.classList.toggle('open', open);
    navToggle.classList.toggle('open', open);
    navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
  }

  navToggle.addEventListener('click', function(){
    setMenu(!navLinks.classList.contains('open'));
  });

  navLinks.querySelectorAll('a').forEach(function(a){
    a.addEventListener('click', function(){ setMenu(false); });
  });
})();
</script>
@stack('scripts')
