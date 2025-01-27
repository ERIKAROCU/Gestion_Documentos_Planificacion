 <form id="search-form" method="GET" class="mb-4">
    <div class="input-group">
        <input 
            type="text" 
            id="search-input" 
            name="q" 
            class="form-control" 
            placeholder="Buscar documentos por titulo, origen o fecha(Y-M-D)..." 
            value="{{ request('q') }}" 
            autocomplete="off"
        >
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>
