// BOOTSTRAP v5.0.0

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('a.imageModal').forEach(function(link) {
        link.addEventListener('click', function() {
            document.querySelector('.showimage').src = this.querySelector('img').src;
            var myModal = new bootstrap.Modal(document.getElementById('myModal'));
            myModal.show();   
        });
    });
    
    var backToTopButton = document.getElementById('back-to-top');
    if (backToTopButton) {
        var scrollTrigger = 100; // px
        function backToTop() {
            var scrollTop = window.scrollY;
            if (scrollTop > scrollTrigger) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        }
        backToTop();
        window.addEventListener('scroll', backToTop);
        backToTopButton.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});
