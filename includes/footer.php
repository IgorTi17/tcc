</div>
        </div>
    </div>
    <script>
        var hamburguer = document.querySelector('.hamburguer');
        hamburguer.addEventListener('click', function(){
            var menuCanto = document.querySelector('.menu-canto');
            if (menuCanto.classList.contains("some")) {
                menuCanto.classList.remove("some");
            }else{
                menuCanto.classList.add("some");
            }
        });

        var hamburguerCel = document.querySelector('.hamburguerCel');
        hamburguerCel.addEventListener('click', function(){
            var menuCel = document.querySelector('.menu-cel');
            if (menuCel.classList.contains("some")) {
                menuCel.classList.remove("some");
            }else{
                menuCel.classList.add("some");
            }
        });
    </script>
    <script src="https://kit.fontawesome.com/86de526b39.js" crossorigin="anonymous"></script>

	

</body>
</html>