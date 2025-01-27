<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('usersModal');
        const modalContent = document.getElementById('modalContent');
        const modalTitle = document.getElementById('usersModalLabel');

        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const url = button.getAttribute('data-url');
            const title = button.getAttribute('data-title') || 'Modal';

            modalTitle.textContent = title;
            modalContent.innerHTML = '<p>Cargando...</p>';

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    modalContent.innerHTML = html;
                })
                .catch(error => {
                    modalContent.innerHTML = '<p>Error al cargar el contenido.</p>';
                    /* console.error('Error:', error); */
                });
        });
    });

</script>