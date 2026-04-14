<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.overlayScrollbars.min.js"></script>
<script src="assets/js/custom-scrollbar.js"></script>
<script src="assets/js/apexcharts.min.js"></script>
<script src="assets/js/sales.js"></script>
<script src="assets/js/revenue.js"></script>
<script src="assets/js/source.js"></script>
<script src="assets/js/jquery-jvectormap-2.0.5.min.js"></script>
<script src="assets/js/gdp-data.js"></script>
<script src="assets/js/continents-mill.js"></script>
<script src="assets/js/world-map-markers3.js"></script>
<script src="assets/js/custom.js"></script>
<script>
    (() => {
        "use strict";

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll(".needs-validation");

        // Loop over them and prevent submission
        Array.from(forms).forEach((form) => {
            form.addEventListener(
                "submit",
                (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add("was-validated");
                },
                false
            );
        });
    })();
</script>