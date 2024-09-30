@if(App::environment('production'))
    <script async data-type="lazy" data-src="https://www.googletagmanager.com/gtag/js?id=G-GYB02J3BDN"></script>
    <script>
        function loadGTM() {
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'G-GYB02J3BDN');
        }
    </script>
@else
    <script>
        function loadGTM() {
        }
    </script>
@endif


<!-- install script -->
<script type='text/javascript'>
    const userInteractionEvents = ["scroll", "mouseover", "keydown", "touchstart", "touchmove", "wheel"];
    const loadScripts = () => {
        document.querySelectorAll("script,iframe[data-type='lazy']").forEach(function(elem) {
            elem.setAttribute("src", elem.getAttribute("data-src"))
        })
        loadGTM();
        userInteractionEvents.forEach(event => {
            window.removeEventListener(event, loadScripts)
        });
    }
    userInteractionEvents.forEach(event => {
        window.addEventListener(event, loadScripts, {
            once: true,
            passive: true
        })
    });
</script>






