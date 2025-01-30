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
            });
    });

    // Manejar el envío del formulario con AJAX
    const form = document.getElementById('userForm');
    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Evita que el formulario se envíe de forma tradicional

            // Preparar los datos del formulario
            const formData = new FormData(form);

            // Realizar la solicitud AJAX
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json()) // Esperar respuesta en JSON
            .then(data => {
                if (data.success) {
                    // Si la respuesta es exitosa, redirigir o cerrar el modal
                    window.location.href = data.redirect;
                } else {
                    // Si hay errores, mostrarlos en el modal
                    modalContent.innerHTML = data.form_html;
                }
            })
            .catch(error => {
                modalContent.innerHTML = '<p>Error al procesar el formulario.</p>';
            });
        });
    }
});

</script>