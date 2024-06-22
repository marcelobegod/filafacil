<!-- Seção de Footer/Rodapé -->


<div class="sidebar close">
    <?php
    // Incluir a sidebar correta de acordo com o nível do usuário
    include_once(__DIR__ . '/../API/function/switchNiveis.php');
    ?>
</div>

<!-- SCRIPS BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<!-- SCRIPTS -->
<script src="../assets/js/logout.js" defer></script>
<script src="../assets/js/manage_modals.js" defer></script>
<script src="../assets/js/initDynamicContent.js" defer></script>
<script src="../assets/js/loadContent.js"></script>

</body>

</html>