<div class="title-bundle mb-3">
    Los artículos del albarán <strong class="text-success">DEBEN COINCIDIR</strong> con los siguientes:
</div>
<div class="detail-bundle">
    <div class="row">
        <div class="col-sp-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 option">
            <strong>Oferta:</strong>
            <p>{{ $bundle->title }}</p>
        </div>
        <div class="col-sp-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 option">
            <strong>Importe:</strong><br>
            <p>{{ number_format($bundle->amount, 0) }}€</p>
        </div>
        <div class="col-sp-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 option">
            <strong>Ventas:</strong><br>
            <p>{{ $bundle->sales ?? 1 }}</p>
        </div>
        <div class="col-sp-12 col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 option">
            <strong>Puntos:</strong>
            <p>{{ $bundle->point }}</p>
        </div>
    </div>
</div>
<div class="row">
    @foreach($bundle->categories as $category)
        <div class="col-12 mb-3">
            <label class="form-label">{{ $category->title }}</label>
            <select name="products[{{ $category->id }}]"class="form-control select2" data-category-id="{{ $category->id }}" data-bundle-id="{{ $bundle->id }}" data-bundle-amount="{{ $bundle->amount }}">
                <option value="">-- Selecciona un producto --</option>
                @foreach($category->products as $productt)
                    <option value="{{ $productt->id }}">{{ $productt->title }}</option>
                @endforeach
            </select>
        </div>
    @endforeach
</div>

<div class="button-bundle d-flex flex-column flex-sm-row justify-content-between gap-1 mt-4">
    <a href="#" id="confirm-bundle" class="btn btn-danger w-100">Confirmar</a>
    <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Cancelar</button>
</div>

