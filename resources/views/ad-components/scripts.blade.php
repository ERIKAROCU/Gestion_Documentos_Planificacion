<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('documentModal');
    const modalContent = document.getElementById('modalContent');
    const modalTitle = document.getElementById('documentModalLabel');
    let abortController;

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-url');
        const title = button.getAttribute('data-title') || 'Detalles del Documento';

        modalTitle.textContent = title;
        modalContent.innerHTML = '<p>Cargando...</p>';

        // Cancelar cualquier solicitud anterior
        if (abortController) abortController.abort();
        abortController = new AbortController();

        fetch(url, { signal: abortController.signal })
            .then(response => response.text())
            .then(html => {
                modalContent.innerHTML = html;
            })
            .catch(error => {
                if (error.name !== 'AbortError') {
                    modalContent.innerHTML = '<p>Error al cargar el contenido.</p>';
                    console.error('Error:', error);
                }
            });
    });

    modal.addEventListener('hide.bs.modal', function () {
        if (abortController) abortController.abort();
    });
});

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');
    const container = document.getElementById('documents-container');

    searchForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Evita la recarga de la página.

        const query = searchInput.value;

        fetch(`?q=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor.');
                }
                return response.text(); // Obtén el HTML del contenido actualizado.
            })
            .then((html) => {
                container.innerHTML = html; // Reemplaza el contenido de la tabla.
            })
            .catch((error) => {
                console.error('Error en la búsqueda:', error);
            });
    });
});

</script>
